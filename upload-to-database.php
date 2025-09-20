<?php
echo "Upload successful";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: admin-menu.php");
    exit;
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES["img-file"])) {
    echo '<pre>';
    var_dump($_POST);
    var_dump($_FILES["img-file"]);
    echo '</pre>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload successful</title>
</head>
<body>
<section class="action-container">
        <button type="submit" id="return-btn" class="login-submit">Return to the action choose</button>
    </section>

    <script src="./js_php/upload-to-database.js" type="module"></script>
</body>
</html>