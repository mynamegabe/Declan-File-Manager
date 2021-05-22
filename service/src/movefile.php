<?php
include 'db_connection.php';
$conn = sqlConnect();
session_start();

if ($_POST["currentdirectory"] == "/") {
  $dir = 'files/' . $_SESSION["userId"] . "/";
  $filedir = $_POST["currentdirectory"] . $_POST["filename"];
} else {
  $dir = 'files/' . $_SESSION["userId"] . $_POST["currentdirectory"] . "/";
  $filedir = $_POST["currentdirectory"] . "/" . $_POST["filename"];
}

$target_file = $dir . $_POST["filename"];
$filename = $_POST["filename"];
$target_dir = $_POST["destination"];
if ($target_dir == "/") {
  $destination = 'files/' . $_SESSION["userId"] . $target_dir . $filename;
} else {
  $destination = 'files/' . $_SESSION["userId"] . $target_dir . "/" . $filename;
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

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

$sql = $conn->prepare("UPDATE " . $db . " SET filedir = ? WHERE userid = ? AND filedir = ?");
echo $conn->error;
$sql->bind_param('sss', $newfiledir, $_SESSION["userId"], $filedir);
$sql->execute();
if ($sql->execute() === FALSE) {
  $_SESSION["error"] = "Server Error";
  setCookie("Success","False");
} else {
  if (strpos($target_file, 'files') !== false && strpos($target_file, "..") == false) {
    if (!rename($target_file,$destination)) {
        setCookie("Success","False");
    } else {
      setCookie("Success","True");
    }
  }
  echo "Restricted file movement detected";
}
sqlDisconnect($conn);

?>
