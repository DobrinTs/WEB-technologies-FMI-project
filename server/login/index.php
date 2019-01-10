<?php
  $configs = include('../conf.php');

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $rawData = file_get_contents('php://input');
      $dataArray = json_decode($rawData, true);

      $usernameRegex = '/^\w{3,15}$/';
      if (!$dataArray['username'] || !preg_match($usernameRegex, $dataArray['username'])) {
          header('HTTP/1.1 400 Invalid username');
          echo 'Невалидно потребителско име';
          return;
      }

      if (!$dataArray['password'] || strlen($dataArray['password']) < 6) {
          header('HTTP/1.1 400 Invalid password');
          echo 'Паролата е прекалено къса';
          return;
      }

      $serverName = $configs->DB_SERVERNAME;
      $dbName = $configs->DB_NAME;
      $conn = new PDO(
          "mysql:host=$serverName;dbname=$dbName;charset=utf8",
          $configs->DB_USERNAME,
          $configs->DB_PASSWORD
      );

      $checkUsernameStatement = $conn->prepare("SELECT * FROM Users WHERE username=?");
      $checkUsernameStatement->execute([$dataArray['username']]);

      $user = $checkUsernameStatement->fetch();
      if (!$user) {
          header('HTTP/1.1 400 No such user');
          echo 'Няма потребител с такова име';
          return;
      }

      if (!password_verify($dataArray['password'], $user['password'])) {
          header('HTTP/1.1 400 Incorrect password');
          echo 'Неправилна парола';
          return;
      }


      session_start();
      $_SESSION['username'] = $dataArray['username'];
      $_SESSION['userId'] = $user['id'];
      $_SESSION['session_start'] = time();

      echo 'Успешен вход';
  }
