<?php
  include('../utils/TripDbConnector.php');

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $rawData = file_get_contents('php://input');
      $dataArray = json_decode($rawData, true);

      if (invalidTripName($dataArray['tripName'])) {
          header('HTTP/1.1 400 Invalid trip name');
          echo 'Невалидно име на пътешествието';
          return;
      }

      $tripDb = new TripDbConnector();
      if ($tripDb->tripNameTaken($dataArray['tripName'])) {
          header('HTTP/1.1 409 Trip name taken');
          echo 'Името е заето';
          return;
      }

      $trip = $tripDb->newTrip($dataArray);
      echo "Great Success";
  }


  function invalidTripName($tripName)
  {
      return $tripName === "";
  }
