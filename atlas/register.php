<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "atlas";
// Create connection
$conn = new mysqli($servername, $username, $password, $databasename);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO `Users`(`name`, `email`, `mobile_number`, `password`, `is_active`) VALUES ('".$_POST["name"]."', '".$_POST["email"]."', '".$_POST["mobile_number"]."', '".$_POST["password"]."', 1)";
 $result = $conn->query($sql);
 $conn->close();
 if($result == 1) {
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $_POST["email"];
    header("Location: ./index.php?");
    die();
 } else {
     echo $result;
 }
?>