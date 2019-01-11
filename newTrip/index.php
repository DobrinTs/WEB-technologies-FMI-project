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
  <script defer src="../utils/formHandlers.js"></script>
  <script defer src="../home/logout.js"></script>
  <script defer src="newTrip.js"></script>
</head>

<body>
  <header class="siteHeader">
    Trip Planner
  </header>

  <nav>
    <ul class="navList">
      <li class="navListItem"> <a href="../home" class="navLink">Начало</a> </li>
      <li class="navListItem"> <a href="" class="navLink">Ново пътешествие</a> </li>
    </ul>
    <button type="button" id="logoutButton" class="logoutButton">Изход</button>
  </nav>

  <main>
    <form class="newTripForm" method="post" id="tripForm">
      <strong id="formError" class="hide"></strong>

      <section class="inputGroup">
        <label for="tripName" class="tripNameLabel">Име на пътешествие: </label>
        <input type="text" name="tripName" id="tripName">
      </section>

      <section id="stopsSection"></section>

      <button type="button" name="button" id="addStopButton">Добавяне на спирка</button>
      <button type="submit" name="submitButton">Създаване</button>

    </form>
  </main>
</body>

</html>
