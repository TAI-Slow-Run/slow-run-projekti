<?php

date_default_timezone_set('Europe/Helsinki');

include("./databaseTools/connectionLibrary.php");
include("./databaseTools/validationUtilities.php");

$admin_id = validate_session($connection);
if(!$admin_id) {
    header("Location: login.php");
    exit();
}

echo "Welcome to change hero image";
?>