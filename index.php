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
  <?php include __DIR__ . '/header.php'; ?>
  <main>
    <!-- HERO -->
    <section class="hero">
      <!-- <img class="hero-media" src="./images/main-banner.jpg" alt="Slow running on ice" /> -->
      <div class="hero__inner">
        <h1 class="hero-title">Juokse hitaasti<br>niin voit paremmin.</h1>
        <a href="#join" class="liity-btn">Liity mukaan</a><P></P>
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
            <!-- <i class="uit uit-shield-plus feature__icon" aria-hidden="true"></i> -->
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
            <!-- <i class="uit uit-brain feature__icon" aria-hidden="true"></i> -->
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
            <!-- <i class="uit uit-analytics feature__icon" aria-hidden="true"></i> -->
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
      <div class="stairs__wrapper">
        <div class="stairs__text">
          <h2 class="stairs__title">Miksi mukaan?</h2>
          <p class="stairs__subtitle">Arvomme näet alla:</p>
        </div>
        <div class="stairs__diagram" aria-hidden="true">
          <div class="step step--4"><span class="step__label">Pitkäikäisyys</span></div>
          <div class="step step--3"><span class="step__label">Fyysisyys</span></div>
          <div class="step step--2"><span class="step__label">Terve mieli</span></div>
          <div class="step step--1"><span class="step__label">Yhteisöllisyys</span></div>
        </div>


      </div>
    </section>

  <section class="site-prefooter" role="contentinfo" aria-label="Contact section">
  <div class="prefooter-grid">
    <!-- LEFT: FORM -->
    <section class="form-panel">
      <h2 class="form-title">
        Haluatko tietää<br>
        toiminnastamme lisää?
      </h2>
      <!-- correct address required -->
      <form id="contact-form" class="contact-form" method="post" autocomplete="on">
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
    </section>

    <!-- RIGHT: MAP -->
    <section class="map-panel" aria-label="Map to Slow Run ry">
      <img class = "map" src="./images/image1.png" alt="Kartta: Slow Run ry sijainti Lappeenrannassa">

      <div class="map-badge">
        <strong>SLOW RUN RY</strong>
        <span>Rakuunamäki 11 C</span>
        <span>50120 Lappeenranta</span>
      </div>

      <div class="map-pin" aria-hidden="true">
        <i class="uil uil-home"></i>
      </div>
    </section>
  </div>
</section>
  </main>
  <?php include __DIR__ . '/footer.php'; ?>
</body>

</html>