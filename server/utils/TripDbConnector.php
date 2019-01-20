<?php
  include('dbUtils.php');
  include('TripStopsDbConnector.php');
  if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
  }

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
          $tsDb = new TripStopsDbConnector();
          $stopsDataArray = array_slice($dataArray, 1);
          $tsDb->addTripStops($tripId, $stopsDataArray);
      }

      public function getMyTrips()
      {
          $getTripsStatement = $this->conn->prepare("SELECT * FROM Trips
            WHERE ownerId = ?");
          $getTripsStatement->execute([$_SESSION['userId']]);
          return $getTripsStatement->fetchAll(PDO::FETCH_ASSOC);
      }
  }
