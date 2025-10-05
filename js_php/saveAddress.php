<?php
include("./../databaseTools/connectionLibrary.php");

$data = getData();

if(anyNull(true, $data)) {
    http_response_code(500);
     header("Content-type: application/json");
    echo json_encode(["error" => "Error: Received data us null"]);
    exit();
}


file_put_contents(__DIR__ . '/../.address.json', json_encode($data[0], JSON_PRETTY_PRINT));
echo json_encode(["success" => "Address has been stored successfuly"]);

?>