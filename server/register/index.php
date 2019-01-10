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

      if (!$dataArray['confirmPassword'] || $dataArray['confirmPassword'] !== $dataArray['password']) {
          header('HTTP/1.1 400 Password not confirmed');
          echo 'Паролите трябва да съвпадат';
          return;
      }

      $serverName = $configs->DB_SERVERNAME;
      $dbName = $configs->DB_NAME;
      $conn = new PDO(
          "mysql:host=$serverName;dbname=$dbName;charset=utf8",
          $configs->DB_USERNAME,
          $configs->DB_PASSWORD
      );

      $checkUsernameStatement = $conn->prepare("SELECT * from Users where username=?");
      $checkUsernameStatement->execute([$dataArray['username']]);

      if ($checkUsernameStatement->fetch()) {
          header('HTTP/1.1 409 Username is taken');
          echo 'Името е заето';
          return;
      }

      $passwordHash = password_hash($dataArray['password'], PASSWORD_DEFAULT);
      $registerStatement = $conn->prepare("INSERT INTO Users (username, password) VALUES (?, ?)");
      $registerStatement->execute([$dataArray['username'], $passwordHash]);

      session_start();
      $_SESSION['username'] = $dataArray['username'];
      $_SESSION['userId'] = $user['id'];
      $_SESSION['session_start'] = time();

      echo 'Успешна регистрация';
  }
