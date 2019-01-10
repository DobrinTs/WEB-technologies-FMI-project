<?php
  include('../utils/dbUtils.php');
  session_start();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $rawData = file_get_contents('php://input');
      $dataArray = json_decode($rawData, true);

      if (invalidTripName($dataArray['tripName'])) {
          header('HTTP/1.1 400 Invalid trip name');
          echo 'Невалидно име на пътешествието';
          return;
      }

      $conn = createPDO();
      var_dump($dataArray);

      $createTripStatement = $conn->prepare("INSERT INTO Trips (ownerId, name) VALUES (?, ?)");
      $createTripStatement->execute([$_SESSION['userId'], $dataArray['tripName']]);

      $getTripStatement = $conn->prepare("SELECT * FROM Trips
        WHERE ownerId = ? AND name = ?");
      $getTripStatement->execute([$_SESSION['userId'], $dataArray['tripName']]);
      $trip = $getTripStatement->fetch();

      $crateStopStatement = $conn->prepare("INSERT INTO TripStops
        (tripId, stopIndex, placeName, plannedTime) VALUES (?, ?, ?, ?)");

      $dataArrayKeys = array_keys($dataArray);
      for ($i = 1; $i < count($dataArrayKeys); $i+=2) {
          $stopName = $dataArray[$dataArrayKeys[$i]];
          $stopTime = $dataArray[$dataArrayKeys[$i]];
          $stopIndex = ($i + 1) / 2;
          $crateStopStatement->execute([$trip['id'], $stopIndex, $stopName, $stopTime]);
      }

      echo "Great Success";
  }

  function invalidTripName($tripName)
  {
      return $tripName === "";
  }
