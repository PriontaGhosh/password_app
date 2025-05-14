<?php
// I'm using these values for my local MySQL database
$servername = "localhost";
$db_user   = "root";       // this is my MySQL username
$db_pass   = "";           // I don't have any password set
$db_name   = "password_app";  // this is the name of the DB I created

$conn = new mysqli($servername, $db_user, $db_pass, $db_name);

// just checking if it connects, if not then show error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
