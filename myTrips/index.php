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
  <link href="myTrips.css" rel="stylesheet" />
  <link href="navAndHeader.css" rel="stylesheet" />
  <link href="../main.css" rel="stylesheet" />
  <script defer src="../utils/ajax.js"></script>
  <script defer src="logout.js"></script>
  <script defer src="fetchMyTrips.js"></script>
  <script defer src="handleSelectChange.js"></script>
  <script defer src="saveComments.js"></script>
</head>

<body>
  <header class="siteHeader">
    Trip Planner
  </header>

  <nav>
    <ul class="navList">
      <li class="navListItem"> <a href="" class="navLink">Моите пътешествия</a> </li>
      <li class="navListItem"> <a href="../newTrip" class="navLink">Ново пътешествие</a> </li>
    </ul>
    <button type="button" id="logoutButton" class="logoutButton">Изход</button>
  </nav>

  <main>
    <section>
      <header>
        <h1 id="tripSectionHeading" class="mainHeading"></h1>
      </header>
      <select id="tripSelect" name="tripSelect" class="hide">
        <option value="">-----Избери-----</option>
      </select>
      <article id="tripInfo" class="hide">
        <header>
          <h1 id="tripArticleHeading" class="tripArticleHeading"></h1>
        </header>

        <section id="tripStops" class="stopsSection"></section>

        <form id="saveCommentsForm">
          <button type="submit" name="button" class="commentsSubmitButton">
            Запази коментарите
          </button>
        </form>
      </article>
    </section>
  </main>

</body>

</html>
