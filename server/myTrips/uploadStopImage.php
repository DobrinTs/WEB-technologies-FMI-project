<?php
  include('../utils/TripStopsDbConnector.php');

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $fileNameExploded = explode('.', $_FILES['file']['name']);
      $fileNameExploded[0] = 'stop' . $_POST['stopId'];
      $fileName = implode('.', $fileNameExploded);

      $uploaddir = '../images/';
      $uploadfile = $uploaddir . $fileName;

      if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
          $tripStopsDb = new TripStopsDbConnector();
          $tripStops = $tripStopsDb->changeStopImage(
            $_POST['stopId'],
            $fileName
          );
          echo "Great Success";
      } else {
          header('HTTP/1.1 400 Move uploaded file failed');
          echo "Possible file upload attack!\n";
      }
  }
