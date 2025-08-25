<?php

/**
 * Fetch Data from a Database Table with Optional Ordering
 *
 * This script allows fetching specific fields from a table in the database, 
 * with optional ordering of results. It checks if the provided fields are valid 
 * and exist in the given table. If the "*" field is requested, it fetches all columns.
 * 
 * Expected Data:
 * - tableName: The name of the table to fetch data from.
 * - fields: An array of fields to be fetched from the table. "*" can be used to fetch all fields.
 * - orderByFields: An array of fields to order the results by. Optional.
 *
 * Error Responses:
 * - 500: If an internal error occurs, such as invalid table or field.
 * 
 * Success Response:
 * - Returns a JSON response with column names and the queried data.
 *
 * @author Riku Theodorou <athrikardo@gmail.com>
 */

include("connection.php");

try {
    $data = getData();
    $tableName = $data[0] ?? null; //string
    $fields = $data[1] ?? null; // array of strings
    $orderByFields = $data[2] ?? null; // array of strings

    if(anyNull(false, $data[0], $data[1])) {
        http_response_code(500);
        header("Content-Type: application/json");
        echo json_encode(["error" => "Error: Received data us null"]);
        exit();
    }

    if(!in_array($tableName, $allowedTables, true)) {
        throw new PDOException("Table $tableName is not allowed. Please talk to the administrator");
    }

    $sql_statement = "SELECT COLUMN_NAME
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_NAME = :tableName;";

    $query = $connection->prepare($sql_statement);
    $query->execute([
        ":tableName" => $tableName
    ]);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    $allowedColumns = array_column($results, "COLUMN_NAME");

    if($fields[0] == "*") {
        
        if($orderByFields != null) {

            foreach($orderByFields as $field) {
                if(!in_array($field, $allowedColumns, true)) {
                    throw new PDOException("Field $field does not exist in the $tableName table");
                }
            }

            $sql_statement = "SELECT * FROM $tableName";

            $sql_statement .= " ORDER BY " . implode(", ", $orderByFields) . "";
        } else {
            $sql_statement = "SELECT * FROM $tableName";
        }

        $query = $connection->prepare($sql_statement);
        $query->execute();
    } else {
        foreach($fields as $field) {
            if(!in_array($field, $allowedColumns, true)) {
                throw new PDOException("Field $field does not exist in the $tableName table");
            }
        }

        if($orderByFields != null) {
            foreach($orderByFields as $field) {
                if(!in_array($field, $allowedColumns, true)) {
                    throw new PDOException("Field $field does not exist in the $tableName table");
                }
            }

            $sql_statement = "SELECT " . implode(", ", $fields) . " FROM $tableName";
            $sql_statement .= " ORDER BY " . implode(", ", $orderByFields) . "";

        } else {
            $sql_statement = "SELECT " . implode(", ", $fields) . " FROM $tableName";
        }

        
        $query = $connection->prepare($sql_statement);
        $query->execute();
    }

    header("Content-Type: application/json");
    echo json_encode(["success" => [getColumnsNames($query), $query->fetchAll()]]);
} catch (PDOException $e) {
    http_response_code(500);
    header("Content-Type: application/json");
    echo json_encode(["error" => $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    header("Content-Type: application/json");
    echo json_encode(["error" => $e->getMessage()]);
}
?>
