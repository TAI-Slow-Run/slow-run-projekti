<?php
include_once "connection.php";
include_once "sql_query.php";

include("./databaseTools/validationUtilities.php");

//session_start(); <-- I think it will work

date_default_timezone_set('Europe/Helsinki');

include("./databaseTools/connectionLibrary.php");
include("./databaseTools/validationUtilities.php");

$admin_id = validate_session($conn);
if (!$admin_id) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: admin-menu.php");
    exit;
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES["img-file"])) {

    // Store the image file in the temporary folder images/temp-uploads:
    if ($_FILES["img-file"]) {
        $tempFileName = generateTempFileName();
        handleTempImgFile($tempFileName);
        $temp_upload_dir = "images/temp-uploads/";
    }

    if (file_exists($temp_upload_dir . $tempFileName)) {
        $target_dir = "images/";
        $image_file_name_to_store = 'main-banner.jpg';
        rename($temp_upload_dir . $tempFileName, $target_dir . $image_file_name_to_store);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lataus onnistui</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.2.0/css/line.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.2.0/css/solid.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Libre+Bodoni:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet" />

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/responsive.css">
</head>

<body>
    <?php include __DIR__ . '/header.php'; ?>
    <section class="action-container">
        <button type="submit" id="return-btn" class="admin-btn">Palaa toimintoon valitsemalla</button>
        <p>Pääkuva on korvattu.</p>
        <a href="./index.php" class="liity-btn">Siirry pääsivulle</a>
    </section>

    <script src="./js_php/upload-to-database.js" type="module"></script>
</body>

</html>