<?php

/**
 * Executes a SQL SELECT Query and Fetches Results
 *
 * This script verifies administrator credentials and, upon successful authentication,
 * executes a provided SQL SELECT statement, returning the results in JSON format.
 * 
 * Expected Data:
 * - sql_statement: The SQL query to be executed (must be a SELECT statement).
 * - username: Administrator username for authentication.
 * - password: Corresponding password for authentication.
 *
 * Error Responses:
 * - 500: If the received data is null, authentication fails, or an exception occurs.
 * - Authentication fails if:
 *   - The username does not exist.
 *   - The password is incorrect.
 * - Only SELECT statements are allowed; any other SQL statement results in an error.
 * 
 * Success Response:
 * - Returns a JSON response with the column names and the fetched results from the query.
 *
 * @author Riku Theodorou <athrikardo@gmail.com>
 */

include("connectionLibrary.php");
$data = getData();
$main_sql_statement = $data[0] ?? null; //string
$username = "Riku"; // string
$password = "!,R=o&6^n(hZNxD@n"; // string

if(anyNull(true, $data)) {
    http_response_code(500);
    header("Content-Type: application/json");
    echo json_encode(["error" => "Error: Received data is null"]);
    exit();
}

try {
    $sql_statement = "SELECT * FROM administrators WHERE username = :username";
    $query = $connection->prepare($sql_statement);
    $query->execute([
        ":username" => $username
    ]);
    $result = $query->fetch();

    if($result == false) {
        throw new Exception("User $username does not exist");
    } else if(!password_verify($password, $result["hashed_password"])) {
        throw new Exception("Invalid credentials");
    } else  {
        if(strtoupper(strtok(trim($main_sql_statement), " ")) == "SELECT") {
            $query = $connection->prepare($main_sql_statement);
            $query->execute();
            $results = $query->fetchAll();
            if(count($results) == 0) {
                throw new Exception("No results fetched");
            } else {
                header("Content-Type: application/json");
                echo json_encode(["success" => [getColumnsNames($query), $results]]);
            }
        } else {
            throw new Exception("Only SELECT statements are allowed");
        }
    }
} catch(PDOException $e) {
    http_response_code(500);
    header("Content-Type: application/json");
    echo json_encode(["error" => $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    header("Content-Type: application/json");
    echo json_encode(["error" => $e->getMessage()]);
}
?>
