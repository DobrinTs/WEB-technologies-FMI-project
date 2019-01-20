<?php
  session_start();

  function redirectIfLoggedIn()
  {
      if (isset($_SESSION['userId'])) {
          header("Location: ../myTrips");
      }
  }

  function redirectIfNotLoggedIn()
  {
      if (!isset($_SESSION['userId'])) {
          header("Location: ../login");
      }
  }
