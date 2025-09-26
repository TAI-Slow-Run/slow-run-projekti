<?php
session_start();

include_once "sql_query.php";

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

//When page only downloaded, only unread messages should be shown:
if (!isset($_GET['filter'])) {
    $filter = "unread";
} else {
    $filter = $_GET['filter'] === 'all' ? 'all' : 'unread';
    $_SESSION['filter'] = $filter;
}

if ($filter === "unread") {
    $messages = get_unread_messages();
    $_SESSION["messages"] = $messages;
} else {
    $messages = get_all_messages();
    $_SESSION["messages"] = $messages;
}

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
unset($_SESSION["messages"]);
unset($_SESSION["filter"]);
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
        <form action="" method="get" class="toggle-btns" id="toggle">
            <button type="submit" name="filter" value="unread" class="message-toggle-item" id="unread-toggle">Lukemattomat viestit</button>
            <button type="submit" name="filter" value="all" class="message-toggle-item" id="all-toggle">Kaikki viestit</button>
        </form>

        <h1 class="admin-container-title" id="admin-container-title">Toiminto: Näe vain lukemattomat viestit</h1>
        <p></p>
        <p class="messages-amount" id="messages-amount"></p>

        <!-- This section fulfill by script in the end of the body -->
        <form method="post" id="admin-messages" class="add-form" enctype="multipart/form-data" action="message-manipulation.php">
            <!-- Hidden input for getting array with ids for checked items and sending it to the php request -->
        <input type="hidden" name="checkedItemIds" id="checkedItemIds">
        <!-- Hidden input for getting info about button (delete or mark as read) and sending it to the php request  -->
        <input type="hidden" name="btnAction" id="btnAction">

        </form>

    </section>

    <script>
        amountMessagesElement = document.getElementById("messages-amount");
        // Behavior of toggle-buttons to show either all messages or only unread ones:
        // The title text also changes depending on the selected option
        <?php
        $amountMessages = sizeof($messages);
        if ($filter === "all") {
        ?>
            amountMessagesElement.textContent = `Tietokannassa on <?php echo $amountMessages; ?> viestiä`;
            document.getElementById("all-toggle").classList.add("active-toggle");
            document.getElementById("admin-container-title").textContent = "Toiminto: Näe kaikki viestit";
        <?php
        } else {
        ?>
            amountMessagesElement.textContent = `Tietokannassa on <?php echo $amountMessages; ?> lukematonta viestiä`;
            document.getElementById("unread-toggle").classList.add("active-toggle");
            document.getElementById("admin-container-title").textContent = "Toiminto: Näe vain lukemattomat viestit";
        <?php
        }
        //Scrip for making HTML markup inside POST-form:
        foreach ($messages as $message) {
        ?>
            itemWrapper = document.createElement("div");
            itemWrapper.classList.add("item-wrapper");

            topWrapper = document.createElement("div");
            topWrapper.classList.add("top-wrapper");

            dateField = document.createElement("p");
            dateField.classList.add("data-field");
            dateField.textContent = "<?php echo $message["message_date"]; ?>";

            nameField = document.createElement("p");
            nameField.classList.add("data-field");
            name = <?php echo json_encode($message["name"]); ?>;
            nameField.textContent = name;

            emailField = document.createElement("p");
            emailField.classList.add("data-field");
            emailField.textContent = "<?php echo $message["email"]; ?>";

            cityField = document.createElement("p");
            cityField.classList.add("data-field");
            cityField.textContent = "<?php echo $message["city"]; ?>";

            topWrapper.appendChild(dateField);
            topWrapper.appendChild(nameField);
            topWrapper.appendChild(emailField);
            topWrapper.appendChild(cityField);
            itemWrapper.appendChild(topWrapper);

            //div for message's text and checkbox for it:
            bottomWrapper = document.createElement("div");
            bottomWrapper.classList.add("bottom-wrapper");
            //label for checkbox:
            wrapperLabel = document.createElement("label");
            wrapperLabel.setAttribute("for", "message<?php echo $message["message_id"]; ?>");
            msg = <?php echo json_encode($message['message']); ?>;
            wrapperLabel.textContent = msg;
            bottomWrapper.appendChild(wrapperLabel);
            //input checkbox:
            wrapperInput = document.createElement("input");
            wrapperInput.setAttribute("type", "checkbox");
            wrapperInput.classList.add("message-checkbox");
            wrapperInput.id = "<?php echo $message["message_id"]; ?>";
            wrapperInput.value = "<?php echo $message["message_id"]; ?>";
            wrapperInput.name = "message<?php echo $message["message_id"]; ?>"
            bottomWrapper.appendChild(wrapperInput);

            itemWrapper.appendChild(bottomWrapper);

            document.getElementById("admin-messages").appendChild(itemWrapper);
        <?php
        }
        ?>
        //Block with buttons: "Merkitse luetuksi" and "Poista pysyvästi":
        btnsWrapper = document.createElement("div");
        btnsWrapper.classList.add("btns-wrapper");
        //"Merkitse luetuksi":
        markAsReadBtn = document.createElement("button");
        markAsReadBtn.setAttribute("type", "submit");
        markAsReadBtn.classList.add("admin-btn");
        markAsReadBtn.id = "mark-as-read";
        markAsReadBtn.textContent = "Merkitse luetuksi";
        btnsWrapper.appendChild(markAsReadBtn);
        //"Poista pysyvästi":
        deleteMsgBtn = document.createElement("button");
        deleteMsgBtn.setAttribute("type", "submit");
        deleteMsgBtn.classList.add("admin-btn");
        deleteMsgBtn.id = "delete-msg";
        deleteMsgBtn.textContent = "Poista pysyvästi";
        btnsWrapper.appendChild(deleteMsgBtn);

        document.getElementById("admin-messages").appendChild(btnsWrapper);

        
    </script>

    <script src="./js_php/admin-menu-read-message.js" type="module"></script>

</body>

</html>