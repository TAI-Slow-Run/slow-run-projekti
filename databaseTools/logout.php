<?php
include("connectionLibrary.php");
include("validationUtilities.php");

error_log("Logout php was called");

logout_session($connection);
?>