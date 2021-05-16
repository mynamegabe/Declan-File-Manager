<?php
include 'db_connection.php';
$conn = sqlConnect();
session_start();

if(isset($_SESSION["userId"])) {

  $userid = $_SESSION["userId"];
  $method = $_SERVER['REQUEST_METHOD'];
  if (isset($_SESSION["wd"])) {
    $target_folder = 'files/' . $_SESSION["userId"] . $_SESSION["wd"];
    $currentdir = $_SESSION["wd"];
    unset($_SESSION["wd"]);
  } elseif ($method === 'GET') {
    $target_folder = 'files/' . $_SESSION["userId"];
    $currentdir = "/";
  } elseif ($method === "POST") {
    $target_folder = 'files/' . $_SESSION["userId"] . $_POST["directory"];
    $currentdir = $_POST["directory"];
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

$sql = $conn->prepare("SELECT * FROM files1 WHERE fav = 'True' AND userid = ? AND filedir LIKE ?");
$dir_query = "%" . $currentdir . "%";
$sql->bind_param('ss', $_SESSION['userId'],$dir_query);
$sql->execute();

$result=$sql->get_result();
if($result){
    $favlist = "";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          if ($row['fav'] == "True")
            $favlist = $favlist . $row['filename'] . ",";
        };
        $favlist = substr($favlist,0,-1);
    }
} else {
  echo "Error in "."<br>".$conn->error;
}
sqlDisconnect($conn);
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
  <script>
  var favlist = <?php echo "'" . $favlist . "'"; ?>;
  </script>
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
          echo "<div class='folder notActive'>" . $folder . "<img src='static/images/icons/more.png' class='folder-context-button context-button'/></div>";
        }
        ?>
      </div>
      <h1>Files</h1>
      <div id="files">
        <?php
        foreach($files as $file) {
          echo "<div class='file notActive'>" . $file . "<img src='static/images/icons/more.png' class='file-context-button context-button'/></div>";
        }
        ?>
      </div>
    </div>

    <div id="item-popup">
      <button type="button" onclick="itemClose()">X</button>
      <div id="file-container">
        <h2 id="item-filename">ds.png</h2>
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
          <form action="addfile.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file" id="file-upload"/>
            <input type="hidden" name="currentdirectory" id="currentdirectory"/>
            <input type="submit" name="submit" value="Upload" class="submit"/>
          </form>
        </div>
      </div>
    </div>

    <div id="file-context-popup">
      <div id="file-context-menu">
        <div id="file-context-duplicate" class="file-context-option">
          <img src="static/images/icons/duplicate.png"/>Duplicate
        </div>
        <div id="file-context-move" class="file-context-option">
          <img src="static/images/icons/move.png"/>Move
        </div>
        <div id="file-context-delete" class="file-context-option">
          <img src="static/images/icons/trash-bin.png"/>Delete
        </div>
        <div id="file-context-fav" class="file-context-option">
          <img src="static/images/icons/nofavourite.png"/>Favourite
        </div>
        <div id="file-context-share" class="file-context-option">
          <img src="static/images/icons/share.png"/>Share
        </div>
      </div>
    </div>


    <div id="file-context-delete-confirm-box">
      <div>
        <button type="button" id="delete-close" onclick="deleteFileClose()">X</button>
        <div id="file-delete-div">
          <h3>Are you sure you want to delete<span></span></h3>
          <button id="file-context-delete-confirm">Confirm</button>
        </div>
      </div>
    </div>





    <form method="POST" action="" id="file-form">
      <input type="hidden" name="directory" id="get-directory"/>
    </form>
    <input type="hidden" id="use-filename"/>
  </div>
</body>
<footer>
  <script type="text/javascript" src="static/js/script.js"></script>
  <script>listFavs(favlist)</script>
</footer>
</html>
