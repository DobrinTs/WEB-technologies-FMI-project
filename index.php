<?php
  session_start();
  if (isset($_SESSION['userId'])) {
      header("Location: ./myTrips");
  } else {
      header("Location: ./login");
  }
