<footer class="site-prefooter" role="contentinfo" aria-label="Contact section">
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
</footer>

<footer class="site-footer">
  <div class="container container-footer">
    <p class="made-in">Made in TAI–TVT</p>
    <ul class="social">
      <li><a href="#" aria-label="Facebook"><i class="uil uil-facebook"></i></a></li>
      <li><a href="#" aria-label="LinkedIn"><i class="uil uil-linkedin"></i></a></li>
    </ul>
  </div>
</footer>
<script src = "contact_submit.js" type = "module"></script>
