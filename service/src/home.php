<?php
session_start();

if(isset($_COOKIE["user"])) {
  //
} else {
  $_SESSION["error"] = "Not logged in! D:";
  header("Location: ./index.php");
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
<body>

</body>
</html>
