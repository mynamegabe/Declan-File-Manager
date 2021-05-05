<?php
session_start();
include 'db_connection.php';
if ($_POST["currentdirectory"] == "/") {
  $target_file = 'files/' . $_SESSION["userId"] . "/" . basename($_FILES["file"]["name"]);
} else {
  $target_file = 'files/' . $_SESSION["userId"] . $_POST["currentdirectory"] . "/" . basename($_FILES["file"]["name"]);
}

// Check if file already exists
if (file_exists($target_file)) {
  echo $target_file;
  $_SESSION["error"] = "File already exists!";
} else {
  $conn = sqlConnect();


  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  if ($_POST["currentdirectory"][0] == "/") {
    $filedir = "/" . basename($_FILES["file"]["name"]);
  } else {
    $filedir = $_POST["currentdirectory"] . "/" . basename($_FILES["file"]["name"]);
  }

  $filename = basename($_FILES["file"]["name"]);

  $sql = $conn->prepare("INSERT INTO files1 (userid, filedir, filename) VALUES (?, ?, ?)");
  $sql->bind_param('sss', $_SESSION["userId"], $filedir, $filename);
  if ($sql->execute() === FALSE) {
    $_SESSION["error"] = "Server Error";
    echo $sql -> error;
  } else {

    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    echo $target_file;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
    } else {
      echo "<br>Sorry, there was an error uploading your file.";
    }
  }
  sqlDisconnect($conn);
  $_SESSION["userId"];
  $_SESSION["wd"] = $_POST["currentdirectory"];
  //header("Location: ./home.php");
}
