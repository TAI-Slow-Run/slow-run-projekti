<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin menu</title>

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
    <section class="action-container">
        <p>Please, choose the action:</p>
        <button type="submit" id="add-article" class="login-submit">Add a new article</button>
        <button type="submit" id="read-message" class="login-submit">Read the messages</button>
        <button type="submit" id="change-hero-img" class="login-submit">Change hero image on the index page</button>
        <button type="submit" id="change-contact" class="login-submit">Change contacts and map</button>
    </section>

    <script src="./js_php/admin-menu.js" type="module"></script>
</body>

</html>