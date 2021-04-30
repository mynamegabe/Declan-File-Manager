<?php
session_start();

if(isset($_SESSION["userId"])) {

  $userid = $_SESSION["userId"];
  $method = $_SERVER['REQUEST_METHOD'];
  if ($method === 'GET') {
    $target_folder = 'files/' . $_SESSION["userId"];
  } elseif ($method === "POST") {
    $target_folder = 'files/' . $_SESSION["userId"] . "/" . $_POST["directory"];
  }
  $all = scandir($target_folder);
  $folders = array();
  $files = array();

  foreach($all as $file) {
    if (!($file == "." || $file == "..")) {
      if (is_dir($target_folder . "/" . $file)) {
        array_push($folders,$file);
      } else {
        array_push($files,$file);
      }
    }
  }

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
      <div id="add-button-div">
        <button type="button" onclick="addPopup()" id="add-button"><img src="/static/images/icons/add.png"/></button>
        <div id="add-dropdown">
          <button type="button" onclick="addFile()"><img src="/static/images/icons/document.png"/></button>
          <button type="button" onclick="addFolder()"><img src="/static/images/icons/folder.png"/></button>
        </div>
      </div>
      <a href="/home.php"><img src="/static/images/icons/binder.png"/></a>
      <a href="/home.php"><img src="/static/images/icons/favourite.png"/></a>
      <a href="/home.php"><img src="/static/images/icons/trash-bin.png"/></a>
    </div>
    <div id="content">
      <?php
      if (isset($_POST["directory"])) {
        echo "<h1 id='dir'>" . $_POST["directory"] . "</h1>";
      } else {
        echo "<h1 id='dir'>" . "/" . "</h1>";
      }
      ?>
      <h1>Folders</h1>
      <div id="folders">
        <?php
        foreach($folders as $folder) {
          echo "<div class='folder'>" . $folder . "</div>";
        }
        ?>
      </div>
      <h1>Files</h1>
      <div id="files">
        <?php
        foreach($files as $folder) {
          echo "<div class='file'>" . $file . "</div>";
        }
        ?>
      </div>
    </div>

    <div id="folder-popup">
      <div>
        <button type="button" id="folder-close" onclick="addFolderClose()">X</button>
        <div id="folder-popup-div">
          <h3>New Folder</h3>
          <form action="addfolder.php" method="POST">
            <input type="text" name="foldername" placeholder="Folder Name" id="foldername"/>
            <input type="submit" name="submit" value="Add Folder" class="submit"/>
          </form>
        </div>
      </div>
    </div>
    <div id="file-popup">
      <div>
        <button type="button" id="file-close" onclick="addFileClose()">X</button>
        <div id="file-popup-div">
          <h3>Upload File</h3>
          <form action="addfile.php" method="POST">
            <input type="file" name="file" id="file-upload"/>
            <input type="submit" name="submit" value="Upload" class="submit"/>
          </form>
        </div>
      </div>
    </div>
    <form method="POST" action="" id="file-form">
      <input type="text" name="directory" id="get-directory"/>
    </form>
  </div>
</body>
<footer>
  <script type="text/javascript" src="static/js/script.js"></script>
</footer>
</html>
