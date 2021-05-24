<?php
include 'db_connection.php';
$conn = sqlConnect();
session_start();

if ($_GET["currentdirectory"] == "/") {
  $filedir = "files/" . $_SESSION['userId'] . $_GET["currentdirectory"] . $_GET["filename"];
} else {
  $filedir = "files/" . $_SESSION['userId'] . "/" . $_GET["currentdirectory"] . "/" . $_GET["filename"];
}

clearstatcache();
if(file_exists($filedir) && strpos($filedir,"..") == false) {
  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header("Cache-Control: no-cache, must-revalidate");
  header("Expires: 0");
  header('Content-Disposition: attachment; filename="'.basename($filedir).'"');
  header('Content-Length: ' . filesize($filedir));
  header('Pragma: public');

  flush();

  readfile($filedir,true);
} else {

}
?>
