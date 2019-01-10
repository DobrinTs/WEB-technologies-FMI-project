<?php
  include('../utils/redirects.php');
  redirectIfLoggedIn();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Login</title>
  <link href="login.css" rel="stylesheet" />
  <link href="../main.css" rel="stylesheet" />
  <script defer src="../utils/ajax.js"></script>
  <script defer src="../utils/loginRegisterHandlers.js"></script>
  <script defer src="login.js"></script>
</head>

<body>
  <header class="introPageHeader">
    Trip Planner
  </header>

  <main>
    <header class="currentActionHeader">
      Влезте в акаунта си:
    </header>
    <strong id="formError" class="hide"></strong>

    <form method="post" action="" class="formStyles" id="loginForm">
      <label id="username" class="hide"></label>
      <input type="text" name="username" placeholder="Username" class="formItem">

      <label id="password" class="hide"></label>
      <input type="password" name="password" placeholder="Password" class="formItem">

      <section class="buttons">
        <button type="submit" name="submitButton" class="formButton loginButton">
          Вход
        </button>

        <button type="button" name="registerButton" id="registerButton" class="formButton registerButton">
          Регистрация
        </button>
      </section>

    </form>
  </main>
</body>

</html>
