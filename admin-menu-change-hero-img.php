<?php

date_default_timezone_set('Europe/Helsinki');

include("./databaseTools/connectionLibrary.php");
include("./databaseTools/validationUtilities.php");

$admin_id = validate_session($connection);
if (!$admin_id) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ylläpitosivu: Tervetuloa vaihtamaan pääkuvaa</title>
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
        <h1 class="admin-container-title">Toiminto: Vaihda pääkuvaa etusivulla</h1>
        <div class="admin-container-explanation">
            <p>Tässä osiossa voi vaihtaa pääkuvaa etusivulla.</p>
            <p>Valitse kuvat vain <strong>JPG</strong>-muodossa:</p>
            <ul class="first-level-list">
                <li>kuvan leveys vähintään 1920px (jotta se näkyy selkeästi suurilla näytöillä),</li>
                <li>kuvasuhde noin 16:10,</li>
                <li>tiedostokoko enintään 2–3 Mt nopeaa latausta varten.</li>
            </ul>
            <p><strong>Poistettu pääkuva ei voi palauttaa!</strong></p>
        </div>
    </section>

    <section class="admin-container">
        <form method="post" id="admin-change-main-img" class="add-form" enctype="multipart/form-data" action="main-img-manipulation.php">
            <!-- Block with demonstration of actual HERO-image  -->
            <div class="admin-hero-image">
                <p>Tällä hetkellä pääkuva näyttää tältä:</p>
                <img src="./images/main-banner.jpg" alt="Actual Hero image" width="200px">

            </div>
            <!-- Block to choose file -->
            <div class="admin-add-upload-img">
                <label class="upload-img-button-label" for="img-file">Valitse korvattava tiedosto:</label>
                <input type="file" id="img-file" name="img-file" class="upload-img-button"  accept="image/*">
                <p id="preview-img-text" hidden></p>
                <img src="" alt="Uploaded hero image" width="200px" hidden id="preview-img">
            </div>
            <button type="submit" id="submit-btn" class="admin-btn">Lataa tietokantaan</button>

        </form>
    </section>

    <script src="./js_php/admin-menu-change-hero-img.js" type="module"></script>

</body>

</html>