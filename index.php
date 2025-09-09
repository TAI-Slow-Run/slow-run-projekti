<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>You are welcome to Slow run</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.2.0/css/line.css">

    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/responsive.css">
  </head>
  <body>
    <?php include __DIR__ . '/header.php'; ?>
    <main>
<!-- HERO -->
<section class="hero">
  <img class="hero-media" src="./images/main-banner.jpg" alt="Slow running on ice" />

  <div class="hero__inner">
    <h1 class="hero-title">Juokse hitaasti<br>niin voit paremmin</h1>
    <a href="#join" class="liity-btn">Liity mukaan</a>
  </div>
</section>
  <!-- MISTÄ ON KYSE -->
  <section class="section section--tight">
    <div class="container">
      <h2 class="section-title">Mistä on kyse?</h2>
      <p class="section-lead">
        Hitaalla eli matalasykkeisellä juoksemisella on todettu monia terveysvaikutuksia.
        Yleisesti rasitat kehoasi vähän, mutta saat suurimman osan terveyshyödyistä. Näin
        ollen pitkäikäisyys ja hyvinvointi paranee pitkällä aikavälillä ja vältät urheilun
        haittapuolet kehollesi.
      </p>

      <div class="features">
        <article class="feature">
          <i class="uil uil-shield-plus feature__icon" aria-hidden="true"></i>
          <h3 class="feature__title">Immuniteetti</h3>
          <p class="feature__text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            incididunt ut labore quis nostrud.
          </p>
          <p class="feature__text feature__text--muted">
            Esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat no.
          </p>
        </article>

        <article class="feature">
          <i class="uil uil-brain feature__icon" aria-hidden="true"></i>
          <h3 class="feature__title">Aivot</h3>
          <p class="feature__text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            incididunt ut labore quis nostrud.
          </p>
          <p class="feature__text feature__text--muted">
            Esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat no.
          </p>
        </article>

        <article class="feature">
          <i class="uil uil-analytics feature__icon" aria-hidden="true"></i>

          <h3 class="feature__title">Suorituskyky</h3>
          <p class="feature__text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            incididunt ut labore quis nostrud.
          </p>
          <p class="feature__text feature__text--muted">
            Esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat no.
          </p>
        </article>
      </div>
    </div>
  </section>

  <!-- KEITÄ OLEMME -->
  <section class="about">
    <div class="container">
      <h2 class="about__title">Keitä olemme?</h2>
      <p class="about__text">
        Olemme Slow run yhdistys, jonka tarkoituksena on parantaa ihmisten hyvinvointia, rentoutumista ja
        luoda tervettä yhteisöllisyyttä. Hidas juokseminen on askel kohti terveempää ja tasapainoisempaa
        elämää. Hitaasti juokseminen soveltuu lähes kaikille ja niin myös yhdistyksemme.
      </p>
    </div>
  </section>

  <!-- MIKSI MUKAAN -->
<section class="stairs">
  <h2 class="stairs__title">MIKSI MUKAAN?</h2>
</section>
    </main>
    <?php include __DIR__ . '/footer.php'; ?>
  </body>
</html>
