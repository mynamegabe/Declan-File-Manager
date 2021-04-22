<?php
session_start();
function generateRandomString($length = 20) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

if(isset($_COOKIE["user"])) {
  //
} else {
  $userid = generateRandomString();
  setcookie("user", $userid, time() + (86400 * 30), "/");
  mkdir('files/' . $userid, 0777, true);
}

include 'db_connection.php';
?>
<html>
<head>
  <title>Declan</title>
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="static/images/logo_transparent.png">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <script type="text/javascript" src="static/js/init.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body onload="open()">
  <div class="center">
    <img src="static/images/logo_transparent.png" id="main-logo"/>
    <h1 id="title">The simplified and secure file manager</h1>
    <div id="full-form">
      <div id="form-swapper">
        <div id="form-swapper-slider"></div>
        <button onclick="loginForm()">Log In</button>
        <button onclick="signupForm()">Sign Up</button>
      </div>
      <div id="form-div">
        <div class="form">
          <form id="login" action="login.php" method="POST">
            <fieldset>
              <legend>Email</legend>
              <input type="email" name="email" id="email" placeholder="johndoe@gmail.com" class="inputfield"/>
            </fieldset>
            <fieldset>
              <legend>Password</legend>
              <input type="password" name="password" id="password" placeholder="********" class="inputfield"/>
            </fieldset>
            <input type="submit" name="submit" id="submit" value="Log In"/>
            <?php
            if(isset($_SESSION["error"])) {
              echo '<br><h1 class="error">' . $_SESSION["error"] . '</h1>';
              unset($_SESSION["error"]);
            }
            ?>
          </form>
        </div>
        <div class="form">
          <form id="signup" action="signup.php" method="POST">
            <fieldset class="half-fieldset">
              <legend>First Name</legend>
              <input type="text" name="firstname" id="firstname" placeholder="John" class="inputfield"/>
            </fieldset>
            <fieldset class="half-fieldset">
              <legend>Last Name</legend>
              <input type="text" name="lastname" id="lastname" placeholder="Doe" class="inputfield"/>
            </fieldset>
            <fieldset>
              <legend>Email</legend>
              <input type="email" name="email" id="email" placeholder="johndoe@gmail.com" class="inputfield"/>
            </fieldset>
            <fieldset>
              <legend>Password</legend>
              <input type="password" name="password" id="password" placeholder="********" class="inputfield"/>
            </fieldset>
            <fieldset>
              <legend>Confirm Password</legend>
              <input type="password" name="password" id="password" placeholder="********" class="inputfield"/>
            </fieldset>
            <input type="submit" name="submit" id="submit" value="Sign Up"/>
            <?php
            if(isset($_SESSION["error"])) {
              echo '<br><h1 class="error">' . $_SESSION["error"] . '</h1>';
              unset($_SESSION["error"]);
            }
            ?>
          </form>
        </div>
    </div>
  </div>
























  <!--
  <div class="center">
    <h1>Declan File Manager</h1>
    <form method="POST" action="upload.php" enctype="multipart/form-data">
      <input type="file" name="file"/>
      <br>
      <input type="submit" name="submit"/>
    </form>
  </div>
  -->
</body>
<footer>
  <script type="text/javascript" src="static/js/script.js"></script>
</footer>
</html>
