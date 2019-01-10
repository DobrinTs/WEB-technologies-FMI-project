<?php
  include('../utils/redirects.php');
  redirectIfNotLoggedIn();


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>New Trip</title>
  <link href="../home/navAndHeader.css" rel="stylesheet" />
  <link href="../main.css" rel="stylesheet" />
  <link href="newTrip.css" rel="stylesheet" />
  <script defer src="../utils/ajax.js"></script>
  <script defer src="../home/logout.js"></script>
  <script defer src="newTrip.js"></script>
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
    <button type="button" id="logoutButton" class="logoutButton">Logout</button>
  </nav>

  <main>
    <form class="newTripForm" action="index.html" method="post">
      <section class="inputGroup">
        <label for="tripName" class="tripNameLabel">Enter trip name: </label>
        <input type="text" name="tripName" id="tripName" >
      </section>

      <section id="stopsSection"></section>

      <button type="button" name="button" id="addStopButton">Add stop</button>

    </form>
  </main>
</body>

</html>
