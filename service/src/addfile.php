<?php
session_start();

$target_file = 'files/' . $_SESSION["userId"] . $_POST["directory"] . basename($_FILES["file"]["name"]);
// Check if file already exists
if (file_exists($target_file)) {
  $_SESSION["error"] = "File already exists!";
  header("Location: ./home.php");
} else {
  $conn = sqlConnect();

  /*
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  */

  $sql = $conn->prepare("INSERT INTO (userid, file) VALUES (?, ?)");
  echo $conn->error;

  $sql->bind_param('ss', $_SESSION["userid"], basename($_FILES["file"]["name"]));
  if ($sql->execute() === FALSE) {
    $_SESSION["error"] = "Server Error";
  }
  sqlDisconnect($conn);
  header("Location: ./home.php");
  $_SESSION["error"] = "File added! :D"
}
