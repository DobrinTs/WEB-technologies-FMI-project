<?php
  include('../utils/TripStopsDbConnector.php');
  $imageGetter = include('../utils/imageGetter.php');

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $fileName = 'stop' . $_POST['stopId'] . '.jpeg';
      $uploaddir = '../images/';
      $uploadfile = $uploaddir . $fileName;

      if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
          $tripStopsDb = new TripStopsDbConnector();
          $tripStops = $tripStopsDb->changeStopImage(
            $_POST['stopId'],
            $fileName
          );
          $imageGetter.echoImageBase64($fileName);
      } else {
          header('HTTP/1.1 400 Move uploaded file failed');
          echo 'Possible file upload attack!';
      }
  }
