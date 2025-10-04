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
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $messages = get_all_messages();
    $action = json_decode($_POST["btnAction"], true);
    $arrayOfCheckedItemIds = json_decode($_POST["checkedItemIds"], true);
    // echo '<pre>';
    // var_dump($arrayOfCheckedItemIds);
    // var_dump($action);
    // var_dump($messages);
    // echo '</pre>';
}

switch ($action) {
    case 'mark-as-read':
        $resultText = "Seuraavat viestit on merkitty luetuiksi:";

        foreach ($arrayOfCheckedItemIds as $ItemId) {

            foreach ($messages as $message) {
                if ($message["message_id"] == $ItemId) {
                    $name = $message['name'];
                    $date = $message['message_date'];
                    break;
                }
            }
            $resultText .= "<br>" . $name . ", " . $date;
            $stmt = $conn->prepare("UPDATE messages 
                                    SET is_read = '1' 
                                    WHERE message_id = :item_id;");
            $stmt->bindParam(':item_id', $ItemId, PDO::PARAM_INT);
            $stmt->execute();
        }
        break;

    case 'delete-msg':
        $resultText = "Tietokannasta on poistettu viesti, jonka lähettäjä on:";

        foreach ($arrayOfCheckedItemIds as $ItemId) {

            foreach ($messages as $message) {
                if ($message["message_id"] == $ItemId) {
                    $name = $message['name'];
                    $date = $message['message_date'];
                    break;
                }
            }
            $resultText .= "<br>" . $name . ", " . $date;

            $stmt = $conn->prepare("DELETE FROM messages
                                    WHERE message_id = :item_id;");
            $stmt->bindParam(':item_id', $ItemId, PDO::PARAM_INT);
            $stmt->execute();
        }
        break;

    default:
        echo '<pre>';
        var_dump("We don't know what to do");
        echo '</pre>';
        break;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viestin manipulointi onnistui</title>

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
        <p class="tesult-text"><?php echo $resultText; ?></p>
        <button type="submit" id="return-btn" class="admin-btn">Palaa toimintoon valitsemalla</button>
    </section>

    <script src="./js_php/upload-to-database.js" type="module"></script>
</body>

</html>