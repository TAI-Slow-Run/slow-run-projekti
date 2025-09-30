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
    // var_dump($_FILES["img-file"]);
    // var_dump($_FILES["img-file"]["name"]);
    // echo '</pre>';

    // Because the title and text fields are mandatory and the POST request is validated, 
    //these fields cannot be empty:
    $article_title = $_POST["article-title"] ?? null;
    $article_text = $_POST["article-text"] ?? null;

    $article_date = $_POST["article-date"] ?? null;
    //Handle the date field, as it may be null, if the admin didn't select a value in the form:
    if ($article_date == null) {
        // if the date field is null, then store today date to this field:
        $article_date = date("Y-m-d");
    }

    // Store the image file in the temporary folder images/temp-uploads:
    if ($_FILES["img-file"]) {
        $tempFileName = generateTempFileName();
        handleTempImgFile($tempFileName);
        $temp_upload_dir = "images/temp-uploads/";
    }

    // Send inserted data (title, date, text) to the DB:
    $stmt = $conn->prepare("INSERT INTO news (title, publication_date, article_text) 
                            VALUES (:title, :publication_date, :article_text)");
    $stmt->bindParam(":title", $article_title, PDO::PARAM_STR);
    $stmt->bindParam(":publication_date", $article_date, PDO::PARAM_STR);
    $stmt->bindParam(":article_text", $article_text, PDO::PARAM_STR);
    $stmt->execute();

    // get the ID of the uploaded record - we will use it then to create file name for uploading the image:
    $article_last_id = $conn->lastInsertId();

    $image_file_name_to_store = $article_last_id . '-news-image.jpg';
    $target_dir = "images/";

    if (file_exists($temp_upload_dir . $tempFileName)) {
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
    </section>

    <script src="./js_php/upload-to-database.js" type="module"></script>
</body>

</html>