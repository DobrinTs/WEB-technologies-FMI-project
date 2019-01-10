<?php
  include('../utils/redirects.php');
  redirectIfNotLoggedIn();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
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
      <li class="navListItem"> <a href="" class="navLink">Home</a> </li>
      <li class="navListItem"> <a href="../newTrip" class="navLink">New Trip</a> </li>
    </ul>
    <button type="button" id="logoutButton" class="logoutButton">Logout</button>
  </nav>

</body>

</html>
