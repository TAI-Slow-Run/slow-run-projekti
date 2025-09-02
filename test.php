<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Left-Aligned Dropdown Hamburger Menu</title>
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/solid.css">
<style>
  body {
    margin: 0;
    font-family: Arial, sans-serif;
  }

  /* Navbar styling */
  .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #333;
    padding: 10px 20px;
    position: relative;
  }

  .navbar .logo {
    color: white;
    font-size: 20px;
    font-weight: bold;
    text-decoration: none;
  }

  .navbar ul {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
    transition: max-height 0.3s ease;
  }

  .navbar li {
    margin-left: 20px;
  }

  .navbar a {
    color: white;
    text-decoration: none;
    padding: 8px;
    display: block;
  }

  .navbar a:hover {
    background-color: #555;
    border-radius: 4px;
  }

  /* Hamburger icon */
  .hamburger {
    display: none;
    font-size: 24px;
    color: white;
    cursor: pointer;
  }

  /* Responsive dropdown for small screens */
  @media (max-width: 768px) {
    .navbar ul {
      flex-direction: column;   /* stack items vertically */
      max-height: 0;             /* hide menu */
      overflow: hidden;          /* prevent overflow */
      width: 100%;               /* full width */
      background-color: #333;
    }

    .navbar ul.active {
      max-height: 500px;         /* show menu */
    }

    .navbar li {
      margin: 0;                 /* remove default margin */
      text-align: left;          /* left-align text */
    }

    .navbar li a {
      padding: 12px 20px;        /* bigger clickable area */
      border-bottom: 1px solid #444; /* optional separator */
    }

    .hamburger {
      display: block;            /* show hamburger icon */
    }
  }
</style>
</head>
<body>

<nav class="navbar">
  <a href="#" class="logo">MySite</a>
  <ul id="menu">
    <li><a href="#">Home</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Services</a></li>
    <li><a href="#">Contact</a></li>
  </ul>
  <i class="uis uis-bars hamburger" id="hamburger"></i>
</nav>

<script>
  const hamburger = document.getElementById('hamburger');
  const menu = document.getElementById('menu');

  hamburger.addEventListener('click', () => {
    menu.classList.toggle('active'); // toggle dropdown
  });
</script>

</body>
</html>
