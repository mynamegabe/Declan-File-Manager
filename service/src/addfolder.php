<?php
session_start();

$target_dir = "files/";
$target_folder = 'files/' . $_SESSION["userId"] . "/" . $_POST["foldername"];
// Check if file already exists
if (file_exists($target_folder)) {
  $_SESSION["error"] = "Folder already exists!";
  header("Location: ./home.php");
} else {
  mkdir($target_folder, 0777, true);
  header("Location: ./home.php");
  $_SESSION["error"] = "Folder created! :D";
}
