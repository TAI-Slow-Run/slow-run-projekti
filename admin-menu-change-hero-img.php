<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page: Welcome to change hero image</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.2.0/css/line.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.2.0/css/thinline.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Libre+Bodoni:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/responsive.css" />
</head>

<body>
    <?php include __DIR__ . '/header.php'; ?>
    <button type="submit" id="return-btn" class="admin-btn top-admin-btn">Palaa toimintoon valitsemalla</button>

    <!-- <section class="admin-container">
        <h1 class="admin-container-title">Toiminto: lisää uusi artikkeli tietokantaan</h1>
        

        <form method="post" id="admin-add-article" class="add-form" enctype="multipart/form-data" action="upload-to-database.php">

        </form>

    </section> -->

    <script src="./js_php/admin-menu-read-message.js" type="module"></script>

</body>

</html>
