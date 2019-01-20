<?php
  include('../utils/TripStopsDbConnector.php');
  $imageGetter = include('../utils/imageGetter.php');

  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $tripStopsDb = new TripStopsDbConnector();
      $fileName = $tripStopsDb->getFileNameByStopId($_GET['stopId']);

      $imageGetter.echoImageBase64($fileName);
  }
