<?php
  include('../utils/redirects.php');
  redirectIfLoggedIn();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link href="../login/login.css" rel="stylesheet" />
  <link href="../main.css" rel="stylesheet" />
  <script defer src="../utils/ajax.js"></script>
  <script defer src="../utils/formHandlers.js"></script>
  <script defer src="register.js"></script>
</head>

<body>
  <header class="introPageHeader">
    Trip Planner
  </header>

  <main>
    <header class="currentActionHeader">
      Регистрирайте се:
    </header>
    <strong id="formError" class="hide"></strong>

    <form method="post" action="" class="formStyles" id="registerForm">
      <label id="username" class="hide"></label>
      <input type="text" name="username" placeholder="Username" class="formItem">

      <label id="pass1" class="hide"></label>
      <input type="password" name="password" placeholder="Password" class="formItem">

      <label id="pass2" class="hide"></label>
      <input type="password" name="confirmPassword" placeholder="Confirm Password" class="formItem">

      <section class="buttons">
        <button type="submit" name="registerButton" id="registerButton" class="formButton registerButton">
          Регистрация
        </button>
      </section>

    </form>
  </main>
</body>

</html>
