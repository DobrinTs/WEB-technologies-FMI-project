<?php
  include('../utils/UserDbConnector.php');

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

      if (!$dataArray['confirmPassword']
        || $dataArray['confirmPassword'] !== $dataArray['password']) {
          header('HTTP/1.1 400 Password not confirmed');
          echo 'Паролите трябва да съвпадат';
          return;
      }

      $userDb = new UserDbConnector();

      if ($userDb->usernameExists($dataArray['username'])) {
          header('HTTP/1.1 409 Username is taken');
          echo 'Името е заето';
          return;
      }

      $userDb->createUser($dataArray['username'], $dataArray['password']);

      session_start();
      $_SESSION['username'] = $dataArray['username'];
      $_SESSION['userId'] = $userDb->getUserId($dataArray['username']);
      $_SESSION['session_start'] = time();

      echo 'Успешна регистрация';
  }
