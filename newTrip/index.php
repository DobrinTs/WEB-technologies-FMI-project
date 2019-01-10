<?php
  include('../utils/redirects.php');
  redirectIfNotLoggedIn();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>New Trip</title>
  <!-- <link href="home.css" rel="stylesheet" /> -->
  <link href="../home/navAndHeader.css" rel="stylesheet" />
  <link href="../main.css" rel="stylesheet" />
</head>

<body>
  <header class="siteHeader">
    Trip Planner
  </header>

  <nav>
    <ul class="navList">
      <li class="navListItem"> <a href="../home" class="navLink">Home</a> </li>
      <li class="navListItem"> <a href="" class="navLink">New Trip</a> </li>
    </ul>
  </nav>
</body>

</html>
