<?php
session_start();
$currentdir = $_POST['currentdirectory'];
if ($currentdir == "/") {
  $target_folder = 'files/' . $_SESSION["userId"] . "/" . $_POST["foldername"];
} else {
  $target_folder = 'files/' . $_SESSION["userId"] . "/" . $currentdir . "/" . $_POST["foldername"];
}

echo $target_folder;

// Check if file already exists
if (file_exists($target_folder)) {
  $_SESSION["error"] = "Folder already exists!";
  header("Location: ./home.php");
} else {
  mkdir($target_folder, 0777, false);
  header("Location: ./home.php");
  $_SESSION["error"] = "Folder created! :D";
}
