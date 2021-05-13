<?php
include 'db_connection.php';
$conn = sqlConnect();
session_start();

if ($_POST["currentdirectory"] == "/") {
  $target_file = 'files/' . $_SESSION["userId"] . "/" . $_POST["filename"];
} else {
  $target_file = 'files/' . $_SESSION["userId"] . $_POST["currentdirectory"] . "/" . $_POST["filename"];
}
$filedir = $_POST["currentdirectory"] . $_POST["filename"];


$sql = $conn->prepare("SELECT db FROM users WHERE userid = ? ");
$sql->bind_param('s', $_SESSION['userId'],);
$sql->execute();

$result=$sql->get_result();
if($result){
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $db = $row["db"];
    }
} else {
  $db = "files1";
}

$sql = $conn->prepare("SELECT id FROM " . $db . " WHERE userid = ? AND filedir = ?");
$sql->bind_param('ss', $_SESSION['userId'], $filedir);
$sql->execute();

$result=$sql->get_result();
if($result){
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $fileid = $row["id"];
    }
}

$sql = $conn->prepare("DELETE FROM " . $db . " WHERE userid = ? AND filedir = ? AND id = ?");
$sql->bind_param('ssi', $_SESSION["userId"], $filedir, $fileid);
$sql->execute();
$rows = $sql->num_rows;

if($rows > 0){
  $row = $result->fetch_assoc();
  setCookie("Success","False");
} else {
  setCookie("Success","True");
  unlink($target_file);
}
/*
if ($sql->execute() === FALSE) {
  $_SESSION["error"] = "Server Error";
  echo $sql -> error;
} else {
  echo "File deleted";
  header("Location: ./home.php");
}
*/

?>
