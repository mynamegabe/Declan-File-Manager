<?php
include 'db_connection.php';
$conn = sqlConnect();
session_start();

if ($_POST["currentdirectory"] == "/") {
  $dir = 'files/' . $_SESSION["userId"] . "/";
} else {
  $dir = 'files/' . $_SESSION["userId"] . $_POST["currentdirectory"] . "/";
}

$target_file = $dir . $_POST["filename"];
$filedir = $_POST["currentdirectory"] . $_POST["filename"];
$filename = $_POST["filename"];

$reg = '/\\(([0-9]*?)\\)/';

$all = scandir($dir);
$numlist = array();
foreach($all as $file) {
  $purefilename = preg_replace($reg, "", $file);
  $puredupefilename = preg_replace($reg, "", $filename);
  if ($purefilename == $puredupefilename) {
    $matched = preg_match($reg, $file, $matches);
    array_push($numlist, intval($matches[0][1]));
  }
}
if (strpos($filename, '.') == true) {
  $filename_split = explode(".", $filename);
  $extension = end($filename_split);
  $has_bracks = preg_match($reg, $filename, $brackmatches);
  $filename_no_ext = substr($filename, 0, strpos($filename, $extension) - 1);
  if ($has_bracks) {
    $filename_no_ext = substr($filename_no_ext, 0, strpos($filename_no_ext, $brackmatches[0]));
  }

  if (count($numlist) > 0) {
    $num = max($numlist) + 1;
    $newfile = $dir . $filename_no_ext . "(" . $num . ")." . $extension;
    $newfilename = $filename_no_ext . "(" . $num . ")." . $extension;
  } else {
    $newfile = $dir . $filename_no_ext . "(1).". $extension;
    $newfilename = $filename_no_ext . "(1).". $extension;
  }
} else {
  if (count($numlist) > 0) {
    $num = max($numlist) + 1;
    $newfile = $dir . $filename . "(" . $num . ")";
    $newfilename = $filename . "(" . $num . ")";
  } else {
    $newfile = $dir . $filename . "(1)";
    $newfilename = $filename . "(1)";
  }
}

$newfiledir = $_POST["currentdirectory"] . $newfilename;

$sql = $conn->prepare("INSERT INTO files1 (userid, filedir, filename) VALUES (?, ?, ?)");
$sql->bind_param('sss', $_SESSION["userId"], $newfiledir, $newfilename);
if ($sql->execute() === FALSE) {
  $_SESSION["error"] = "Server Error";
  setCookie("Success","False");
} else {
  if (!copy($target_file, $newfile)) {
      setCookie("Success","False");
  } else {
    setCookie("Success","True");
  }
}
sqlDisconnect($conn);

?>
