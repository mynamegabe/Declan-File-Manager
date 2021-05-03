<?php
function sqlConnect()
 {
 $dbhost = "127.0.0.1";
 $dbuser = "root";
 $dbpass = "l3tsg01337";
 $db = "declan";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

 return $conn;
 }

function sqlDisconnect($conn)
 {
 $conn -> close();
 }

?>
