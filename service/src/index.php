<?php
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
  <link rel="shortcut icon" href="images/logo_transparent.png">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200&display=swap" rel="stylesheet">
</head>
<body>
  <div class="center">
    <img src="images/logo_transparent.png" id="main-logo"/>
    <h1>The simplified and secure file manager</h1>
    <div id="full-form">
      <div id="form-swapper">
        <button onclick="loginForm()">Log In</button>
        <button onclick="signupForm()">Sign Up</button>
      </div>
      <div id="form-div">
        <form id="login" action="login.php" method="POST">

        </form>
        <form id="signup" action="signup.php" method="POST">

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
</html>
