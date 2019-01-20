<?php
  include('../utils/TripStopsDbConnector.php');

  if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
      $rawData = file_get_contents('php://input');
      $dataArray = json_decode($rawData, true);

      $tripStopsDb = new TripStopsDbConnector();
      $tripStops = $tripStopsDb->saveComments(
        $dataArray['tripName'],
        $dataArray['comments']
      );

      echo 'Comments saved';
  }
