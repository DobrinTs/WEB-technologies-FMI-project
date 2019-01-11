<?php
  include('../utils/TripDbConnector.php');

  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $tripDb = new TripDbConnector();
      $myTrips = $tripDb->getMyTrips();

      echo json_encode($myTrips);
  }
