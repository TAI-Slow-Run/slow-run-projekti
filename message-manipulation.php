<?php
include_once "connection.php";
include_once "sql_query.php";

session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: admin-menu.php");
    exit;
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES["img-file"])) {
    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message manipulation was successful</title>

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
        <button type="submit" id="return-btn" class="admin-btn">Return to the action choose</button>
    </section>

    <script src="./js_php/upload-to-database.js" type="module"></script>
</body>

</html>