<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>You are welcome to Slow run</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.2.0/css/line.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.2.0/css/thinline.css">
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Libre+Bodoni:ital,wght@0,400..700;1,400..700&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="./css/responsive.css">
</head>

<body>
<?php include 'header.php'; ?>

<main class="contact-page">
  <section class="contact-section">
    <div class="container">

      <h2 class="section-title">Ota yhteyttä meihin</h2>
      <form id="contact-form" class="contact-form contact-form--page" method="post" autocomplete="on">
        <label class="visually-hidden" for="name">Nimesi</label>
        <input id="name" name="name" type="text" placeholder="Nimesi" required>

        <label class="visually-hidden" for="email">Sähköpostisi</label>
        <input id="email" name="email" type="email" placeholder="Sähköpostisi" required>

        <label class="visually-hidden" for="city">Paikkakuntasi</label>
        <input id="city" name="city" type="text" placeholder="Paikkakuntasi">

        <label class="visually-hidden" for="message">Vapaa viesti meille..</label>
        <textarea id="message" name="message" placeholder="Vapaa viesti meille.." rows="5"></textarea>

        <button class="btn-submit" type="submit">Lähetä</button>
      </form>
    </div>
  </section>
</main>

<?php 
  include 'footer.php'; 
?>

</body>

</html>
