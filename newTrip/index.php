<?php
  include('../utils/redirects.php');
  redirectIfNotLoggedIn();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Trip</title>
  <link href="../myTrips/navAndHeader.css" rel="stylesheet" />
  <link href="../main.css" rel="stylesheet" />
  <link href="newTrip.css" rel="stylesheet" />
  <script defer src="../utils/ajax.js"></script>
  <script defer src="../utils/formHandlers.js"></script>
  <script defer src="../myTrips/logout.js"></script>
  <script defer src="newTrip.js"></script>
</head>

<body>
  <header class="siteHeader">
    Trip Planner
  </header>

  <nav>
    <ul class="navList">
      <li class="navListItem"> <a href="../myTrips" class="navLink">Моите пътешествия</a> </li>
      <li class="navListItem"> <a href="" class="navLink">Ново пътешествие</a> </li>
    </ul>
    <button type="button" id="logoutButton" class="logoutButton">Изход</button>
  </nav>

  <main>
    <form class="newTripForm" method="post" id="tripForm">
      <strong id="formError" class="hide"></strong>

      <section class="customSection">
        <label for="tripName" class="tripNameLabel">Име на пътешествие: </label>
        <input type="text" name="tripName" id="tripName" class="inputField">
      </section>

      <section id="stopsSection" class="hide">
        <header>
          <h2 class="stopsSectionHeader">Въведете име и час за спирките:</h2>
        </header>
      </section>

      <button type="button" name="button" id="addButton" class="customButton addButton">
        Добавяне на спирка
      </button>
      <button type="submit" name="submitButton" class="customButton createButton">
        Създай пътешествието
      </button>

    </form>
  </main>
</body>

</html>
