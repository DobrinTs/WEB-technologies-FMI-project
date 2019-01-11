<?php
  include('dbUtils.php');
  session_start();

  class TripDbConnector
  {
      private $conn;

      public function __construct()
      {
          $this->conn = createPDO();
      }

      public function __destruct()
      {
          $this->conn = null;
      }

      public function tripNameTaken($tripName)
      {
          $trip = $this->getTrip($tripName);
          return boolval($trip);
      }

      public function getTrip($tripName)
      {
          $getTripStatement = $this->conn->prepare("SELECT * FROM Trips
          WHERE ownerId = ? AND name = ?");
          $getTripStatement->execute([$_SESSION['userId'], $tripName]);
          return $getTripStatement->fetch();
      }

      public function newTrip($dataArray)
      {
          $createTripStatement =
            $this->conn->prepare("INSERT INTO Trips (ownerId, name) VALUES (?, ?)");
          $createTripStatement->execute([$_SESSION['userId'], $dataArray['tripName']]);
          $trip = $this->getTrip($dataArray['tripName']);


          $this->addTripStops($trip['id'], $dataArray);
      }

      private function addTripStops($tripId, $dataArray)
      {
          $createStopStatement = $this->conn->prepare("INSERT INTO TripStops
            (tripId, stopIndex, placeName, plannedTime) VALUES (?, ?, ?, ?)");
          $dataArrayKeys = array_keys($dataArray);
          $stopsKeys = array_slice($dataArrayKeys, 1);

          for ($i = 0; $i < count($stopsKeys); $i+=2) {
              $stopName = $dataArray[$stopsKeys[$i]];
              $stopTime = $dataArray[$stopsKeys[$i]];
              $stopIndex = $i/2 + 1;
              $createStopStatement->execute([$tripId, $stopIndex, $stopName, $stopTime]);
          }
      }
  }
