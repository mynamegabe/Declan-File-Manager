<?php
include 'db_connection.php';
if (1==1) {
    session_start();
    $firstname = filter_var($_POST["firstname"], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST["lastname"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
    $password = hash('sha256', filter_var($_POST["password"], FILTER_SANITIZE_STRING));

    $conn = sqlConnect();

    $sql = $conn->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
    $sql->bind_param('ssss', $firstname, $lastname, $email, $password);
    if ($sql->execute() === TRUE) {
        header("Location: ./home.php");
        $_SESSION["success"] = "Registered!";
    } else {
        header("Location: ./index.php");
        $_SESSION["error"] = "Server error :(";
    }
    sqlDisconnect($conn);
}
?>
