<?php
include 'db_connection.php';
if (1==1) {
    session_start();
    $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
    $password = hash('sha256', filter_var($_POST["password"], FILTER_SANITIZE_STRING));

    $conn = sqlConnect();

    /*
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    */
    
    $sql = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    echo $conn->error;

    $sql->bind_param('ss', $email, $password);
    $sql->execute();

    $result=$sql->get_result();
    if($result){
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $_SESSION["userId"] = $row["userid"];
                header("Location: ./home.php");
            };
        } else {
            $_SESSION["error"] = "Invalid credentials";
            header("Location: ./index.php");
        }
    } else {
      echo "Error in "."<br>".$conn->error;
    }
    sqlDisconnect($conn);
}
?>
