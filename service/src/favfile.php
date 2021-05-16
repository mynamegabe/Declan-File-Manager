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

$sql = $conn->prepare("UPDATE " . $db . " SET fav = 'True' WHERE userid = ? AND filedir = ?");
$sql->bind_param('ss', $_SESSION['userId'], $filedir);
$sql->execute();

$rows = $sql->num_rows;
if($rows > 0){
  setCookie("Success","False");
} else {
  setCookie("Success","True");
}
?>
