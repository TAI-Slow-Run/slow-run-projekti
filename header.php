<?php // header.php ?>
<header class="site-header">
  <div class="container">
    <a href="./" class="brand">slow run</a>
    <nav class="main-nav" aria-label="Päävalikko">
      <ul id = "list_menu">
        <li><a href="./news.php"    class="nav-link">UUTISET</a></li>
        <li><a href="./contact.php" class="nav-link">YHTEYS</a></li>
      </ul>
    </nav>
    <!--**************************************************** -->
    <div class = "off-screen-menu"> <!-- Added by Riku -->
      <ul>
        <li><a href="./news.php"    class="nav-link">UUTISET</a></li>
        <li><a href="./contact.php" class="nav-link">YHTEYS</a></li>
      </ul>
    </div>
    <!-- *******DIV element added by Riku ends here ********-->
    <i class="uil uil-bars hamburger" id="hamburger"></i>
  </div>
</header>
<script src = "./js_php/header.js"></script>
