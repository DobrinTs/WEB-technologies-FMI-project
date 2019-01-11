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
              $stopTime = $dataArray[$dataArrayKeys[$i]];
              $stopIndex = $i/2 + 1;
              $createStopStatement->execute([$tripId, $stopIndex, $stopName, $stopTime]);
          }
      }
  }
