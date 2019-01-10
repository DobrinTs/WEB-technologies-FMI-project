<?php
  session_start();

  function redirectIfLoggedIn()
  {
      if (isset($_SESSION['userId'])) {
          header("Location: ../home");
      }
  }

  function redirectIfNotLoggedIn()
  {
      if (!isset($_SESSION['userId'])) {
          header("Location: ../login");
      }
  }
