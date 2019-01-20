<?php
  function createPDO()
  {
      $configs = include('../conf.php');
      $serverName = $configs->DB_SERVERNAME;
      $dbName = $configs->DB_NAME;
      return new PDO(
        "mysql:host=$serverName;dbname=$dbName;charset=utf8",
        $configs->DB_USERNAME,
        $configs->DB_PASSWORD
    );
  }
