<?php
session_start();

if(isset($_SESSION["userId"])) {
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
  <div id="navbar">
    <img src="static/images/logo_transparent.png" id="mini-logo"/>
    <form method="POST" action="search.php" id="search-form">
      <input type="text" id="search-bar" name="searchquery" placeholder="Files, folders, etc"/>
      <img src="static/images/icons/search2.png" id="search-button"/>
    </form>
    <img src="static/images/icons/user.png" id="profile-logo"/>
  </div>
  <div id="main-body">
    <div id="side-navbar">
      <a href="/home.php"><img src="/static/images/icons/binder.png"/></a>
      <a href="/home.php"><img src="/static/images/icons/favourite.png"/></a>
      <a href="/home.php"><img src="/static/images/icons/trash-bin.png"/></a>
    </div>
    <div id="content">

    </div>
  </div>
</body>
</html>
