<?php
  include('../utils/redirects.php');
  redirectIfNotLoggedIn();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link href="home.css" rel="stylesheet" />
  <link href="navAndHeader.css" rel="stylesheet" />
  <link href="../main.css" rel="stylesheet" />
  <script defer src="../utils/ajax.js"></script>
  <script defer src="logout.js"></script>
</head>

<body>
  <header class="siteHeader">
    Trip Planner
  </header>

  <nav>
    <ul class="navList">
      <li class="navListItem"> <a href="" class="navLink">Начало</a> </li>
      <li class="navListItem"> <a href="../newTrip" class="navLink">Ново пътешествие</a> </li>
    </ul>
    <button type="button" id="logoutButton" class="logoutButton">Изход</button>
  </nav>

</body>

</html>
