<?php
include("./databaseTools/connectionLibrary.php");
$data = getData();

if(anyNull(true, $data)) {
    http_response_code(500);
    header("Content-type: application/json");
    echo json_encode(["error" => "Error: received data us null"]);
    exit();
}

 $id = getLastId("messages", "message_id") + 1;
 $sql_statement = "INSERT INTO messages(name, email, city, message) VALUES (:name, :email, :city, :message)";

 try {
    $query = $connection->prepare($sql_statement);
    $query->execute([
        ":name" => $data[0],
        ":email" => $data[1],
        ":city" => $data[2],
        ":message" => $data[3]
    ]);

    header("Content-type: application/json");
    echo json_encode(["success" => "User with email $data[1] added successfully"]);
 } catch(PDOException $e) {
    http_response_code(500);
    header("Content-Type: application/json");
    echo json_encode(["error" => $e->getMessage()]);
 } catch(Exception $e) {
    http_response_code(500);
    header("Content-Type: application/json");
    echo json_encode(["error" => $e->getMessage()]);
 }

 ?>