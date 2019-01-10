<?php
  include('../utils/redirects.php');
  // redirectIfNotLoggedIn();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <p>hello</p>
    <p><?php echo $_SESSION['userId']?></p>
    <p><?php echo $_SESSION['username']?></p>
  </body>
</html>
