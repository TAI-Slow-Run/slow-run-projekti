<?php
include("./../databaseTools/connectionLibrary.php");
$data = getData();
echo json_encode(["success" => $data]);
?>