<?php
  include('dbUtils.php');

  class UserDbConnector
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

      public function usernameExists($username)
      {
          $user = $this->getUser($username);
          return boolval($user);
      }

      public function usernameNotFound($username)
      {
          return !$this->usernameExists($username);
      }

      public function getUser($username)
      {
          $getUserStatement = $this->conn->prepare("SELECT * FROM Users WHERE username=?");
          $getUserStatement->execute([$username]);
          return $getUserStatement->fetch();
      }

      public function getUserId($username)
      {
          $user = $this->getUser($username);
          return $user['id'];
      }

      public function passwordDoesNotMatch($username, $password)
      {
          $user = $this->getUser($username);
          return !password_verify($password, $user['password']);
      }

      public function createUser($username, $password)
      {
          $passwordHash = password_hash($password, PASSWORD_DEFAULT);
          $registerStatement =
            $this->conn->prepare("INSERT INTO Users (username, password) VALUES (?, ?)");
          $registerStatement->execute([$username, $passwordHash]);
      }
  }
