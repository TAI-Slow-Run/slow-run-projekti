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
    <title>Hallintasivu: Tervetuloa vaihtamaan yhteystietoja</title>
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
        <h1 class="admin-container-title">Toiminto: Vaihda yhteystietoja ja karttaa</h1>
        <div class="admin-container-explanation">
            <p>Tässä osiossa osoite voidaan päivittää, ja päivitys näkyy kartalla.</p>
            <p>Osoite syötetään seuraavasti:</p>
            <ul class="second-level-list">
                <li>Ensimmäinen kenttä: kadun nimi,</li>
                <li>Toinen kenttä: rakennus ja numero,</li>
                <li>Kolmas kenttä: kaupunki ja postinumero.</li>
            </ul>
            <p><strong>*Katso esimerkki lomakkeen lopussa</strong></p>
        </div>
    </section>

    <section class="admin-container">
        <div id="outerContainer" class="add-form">
            <h3>Nykyinen kartta</h1>
            <div id="map" style="height: 450px;">
                <!-- Map is generated in the js file -->
            </div>
            <div class="admin-add-upload-img">
                <h2>Anna uusi osoite:</h2>
                <form id="formContainer">
                    <div class="input-wrapper">
                        <label for="address">Osoitte: </label>
                        <input type="text" name="address" id="address" required>
                    </div>

                    <div class="input-wrapper">
                        <label for="line1">Huoneisto ja numero: </label>
                        <input type="text" name="line1" id="line1" required>
                    </div>

                    <div class="input-wrapper">
                        <label for="line2">Kaupunki ja postinumero: </label>
                        <input type="text" name="line2" id="line2" required>
                    </div>

                    <button type="submit" id="submit-btn" class="admin-btn">Tallenna uusi osoite</button>

                </form>
                <div id="exampleDIV">
                    <span class="admin-container-explanation">----Esimerkki----</span>
                    <span class="admin-container-explanation">Osoitte: Rakuunamäki</span>
                    <span class="admin-container-explanation">Huoneisto ja numero: C 11</span>
                    <span class="admin-container-explanation">Kaupunki ja postinumero: Lappeenranta 50120</span>
                </div>
            </div>
        </div>
    </section>


    <script src="./js_php/admin-menu-change-contact.js" type="module"></script>

    <script
        defer
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo $_ENV["API_KEY"]; ?>&callback=initMap">
    </script>
</body>

</html>