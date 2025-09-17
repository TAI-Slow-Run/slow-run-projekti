<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login for admin</title>

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
    <section class="login-container">
        <p>Please, enter your login and password:</p>
        <form id="login-information" class="login-form">
            <input type="text" id="username" name="username" required>
            <input type="password" id="password" name="password" required>
            <button type="submit" id="submitButton" class="login-submit">Submit</button>
        </form>
    </section>

    <script src="./js_php/login.js" type="module"></script>
</body>

</html>