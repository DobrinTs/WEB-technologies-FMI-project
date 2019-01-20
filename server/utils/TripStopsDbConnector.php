<?php
  include_once('dbUtils.php');
  session_start();

  class TripStopsDbConnector
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

      public function addTripStops($tripId, $dataArray)
      {
          $createStopStatement = $this->conn->prepare("INSERT INTO TripStops
            (tripId, stopIndex, placeName, plannedTime) VALUES (?, ?, ?, ?)");

          $dataArrayKeys = array_keys($dataArray);

          for ($i = 0; $i < count($dataArrayKeys); $i+=2) {
              $stopName = $dataArray[$dataArrayKeys[$i]];
              $stopTime = $dataArray[$dataArrayKeys[$i+1]];
              $stopIndex = $i/2 + 1;
              $createStopStatement->execute([$tripId, $stopIndex, $stopName, $stopTime]);
          }
      }

      public function getTripStopsByName($tripName)
      {
          $getFullTripStatement = $this->conn->prepare("SELECT TripStops.* FROM
          (SELECT * FROM Trips WHERE ownerId=? AND name=?) AS myTrips
          JOIN TripStops ON myTrips.id=TripStops.tripId
          ORDER BY TripStops.stopIndex");
          $getFullTripStatement->execute([$_SESSION['userId'], $tripName]);

          return $getFullTripStatement->fetchAll(PDO::FETCH_ASSOC);
      }

      public function saveComments($tripName, $comments)
      {
          $updateStatement = $this->conn->prepare("UPDATE TripStops SET notes = ?
            WHERE stopIndex = ? AND tripId IN
            (SELECT id FROM Trips WHERE ownerId = ? AND name = ?)");

          foreach ($comments as $stopIndex => $note) {
              $updateStatement->execute(
                [$note, $stopIndex, $_SESSION['userId'], $tripName]
              );
          }
      }

      public function changeStopImage($stopId, $fileName)
      {
          $updateStatement = $this->conn->prepare("UPDATE TripStops
            SET imageFileName = ?
            WHERE id = ? AND tripId IN (SELECT id FROM Trips WHERE ownerId = ?)
          ");

          $updateStatement->execute(
            [$fileName, $stopId, $_SESSION['userId']]
          );
      }
  }
