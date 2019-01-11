<?php
  // include('../utils/dbUtils.php');
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

      $userDb = new UserDbConnector();
      if ($userDb->usernameNotFound($dataArray['username'])) {
          header('HTTP/1.1 400 No such user');
          echo 'Няма потребител с такова име';
          return;
      }

      if ($userDb->passwordDoesNotMatch($dataArray['username'], $dataArray['password'])) {
          header('HTTP/1.1 400 Incorrect password');
          echo 'Неправилна парола';
          return;
      }

      session_start();
      $_SESSION['username'] = $dataArray['username'];
      $_SESSION['userId'] = $userDb->getUserId($dataArray['username']);
      $_SESSION['session_start'] = time();

      echo 'Успешен вход';
  }
