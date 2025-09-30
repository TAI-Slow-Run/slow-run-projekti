<?php

date_default_timezone_set('Europe/Helsinki');

include("./databaseTools/connectionLibrary.php");
include("./databaseTools/validationUtilities.php");

$admin_id = validate_session($connection);
if(!$admin_id) {
    header("Location: login.php");
    exit();
}
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
// session_unset();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page: add a new article to the data base</title>
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
        <h1 class="admin-container-title">Toiminto: lisää uusi artikkeli tietokantaan</h1>
        <div class="admin-container-explanation">
            <h2>Ohje lomakkeen täyttämiseen</h2>
            <p>Syötä alla olevaan lomakkeeseen artikkelin otsikko, päivämäärä ja artikkelin/uutisen teksti.</p>
            <ol class="first-level-list">
                <li>Kentät ”Otsikko” ja ”Teksti” ovat pakollisia.</li>
                <li>Päivämäärän voi:</li>
                <ul class="second-level-list">
                    <li>kirjoittaa käsin muodossa <strong>PP.KK.VVVV</strong>,</li>
                    <li>valita avattavasta kalenterista,</li>
                    <li>tai jättää tyhjäksi (tässä tapauksessa artikkeli tallennetaan tietokantaan nykyisellä päivämäärällä).</li>
                </ul>
                <li>Valitse kuvat vain JPG-muodossa</li>
                <ul class="second-level-list">
                    <li>kuvan leveys vähintään 1920px (jotta se näkyy selkeästi suurilla näytöillä),</li>
                    <li>kuvasuhde noin 16:10,</li>
                    <li>tiedostokoko enintään 2–3 Mt nopeaa latausta varten.</li>
                </ul>
            </ol>

        </div>

        <form method="post" id="admin-add-article" class="add-form" enctype="multipart/form-data" action="upload-to-database.php">
            <div class="input-wrapper">
                <label for="article-title">Syötä artikkelin otsikko: *</label>
                <input type="text" name="article-title" id="article-title" required class="article-title">
            </div>
            <div class="input-wrapper">
                <label for="article-date">Syötä päivämäärä (ei pakollinen):</label>
                <input type="date" name="article-date" id="article-date" class="article-date">
            </div>
            <div class="input-wrapper">
                <label for="article-text">Syötä artikkelin teksti: *</label>
                <textarea name="article-text" id="article-text" class="article-text"></textarea>
            </div>

            <!-- Block to choose file -->
            <div class="admin-add-upload-img">
                <label class="upload-img-button-label" for="img-file">Valitse tiedosto palvelimelle ladattavaksi:</label>
                <input type="file" id="img-file" name="img-file" class="upload-img-button" accept="image/*">
                <p class="upload-svg-info-text" id="upload-svg-info-text"></p>
            </div>
            <button type="submit" id="submit-btn" class="admin-btn">Lataa tietokantaan</button>

        </form>

    </section>

    <script src="./js_php/admin-menu-add-article.js" type="module"></script>

</body>

</html>
