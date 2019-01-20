<?php
  include('../utils/TripStopsDbConnector.php');

  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $tripStopsDb = new TripStopsDbConnector();
      $tripStops = $tripStopsDb->getTripStopsByName($_GET['tripName']);

      echo json_encode($tripStops);
  }
