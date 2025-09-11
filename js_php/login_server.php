<?php
include("./../databaseTools/connectionLibrary.php");

$data = getData();
$username = $data[0] ?? null;
$password = $data[1] ?? null;

if(anyNull(true, $data)) {
    http_response_code(500);
    header("Content-type: application/json");
    echo json_encode(["error" => "Error: Received data us null"]);
    exit();
}

$sql_query = "SELECT * FROM administrators WHERE username = :username";

try {
    $query = $connection->prepare($sql_query);
    $query->execute([
        ":username" => $username
    ]);
    $result = $query->fetch();
    if($result == false ||
    !password_verify($password, $result["hashed_password"])) {
        throw new PDOException("Wrong credentials");
    } else {
        header("Content-Type: application/json");
        echo json_encode(["success" => "ok"]);
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