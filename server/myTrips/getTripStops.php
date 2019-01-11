<?php
  include('../utils/TripStopsDbConnector.php');

  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $tripStopsDb = new TripStopsDbConnector();
      $tripStops = $tripStopsDb->getTripStopsById($_GET['tripId']);

      echo json_encode($tripStops);
  }
