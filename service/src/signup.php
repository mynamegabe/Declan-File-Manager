<?php
include 'db_connection.php';
function generateRandomString($length = 20) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}
if (1==1) {
    session_start();
    $firstname = filter_var($_POST["firstname"], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST["lastname"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
    $password = hash('sha256', filter_var($_POST["password"], FILTER_SANITIZE_STRING));
    $id = generateRandomString();
    $conn = sqlConnect();
    $db_id = "files" . strval(rand(1,5));
    /*error_reporting(E_ALL);
    ini_set('display_errors', 1);
    */

    $sql = $conn->prepare("INSERT INTO users (userid, firstname, lastname, email, password, db) VALUES (?, ?, ?, ?, ?, ?)");

    /*echo $conn->error;*/

    $sql->bind_param('ssssss', $id, $firstname, $lastname, $email, $password, $db_id);
    if ($sql->execute() === TRUE) {
        header("Location: ./home.php");
        $_SESSION["success"] = "Registered!";
        mkdir('files/' . $id, 0777, true);
    } else {
        header("Location: ./index.php");
        $_SESSION["error"] = "Server error :(";
    }
    sqlDisconnect($conn);
}
?>
