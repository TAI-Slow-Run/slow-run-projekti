<?php
session_start();
include_once "sql_query.php";
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// $unread_messages = get_unread_messages();
// $all_messages = get_all_messages();

// $_SESSION["unread_messages"] = $unread_messages;
// $_SESSION["all_messages"] = $all_messages;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page: read the messages</title>
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



    <section class="admin-container">
        <div class="toggle-btns">
            <button class="message-toggle-item active-toggle" id="unread-toggle">Lukemattomat viestit</button>
            <button class="message-toggle-item" id="all-toggle">Kaikki viestit</button>
        </div>
        <h1 class="admin-container-title" id="admin-container-title">Toiminto: Näe vain lukemattomat viestit</h1>


        <!-- <form method="post" id="admin-add-article" class="add-form" enctype="multipart/form-data" action="upload-to-database.php">

        </form> -->

    </section>

    <script src="./js_php/admin-menu-read-message.js" type="module"></script>

</body>

</html>