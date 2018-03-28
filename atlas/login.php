<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $databasename = "atlas";
    session_start();
    // Create connection
    $conn = new mysqli($servername, $username, $password, $databasename);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo $_POST["email"], $_POST["password"];
    $sql = "SELECT * FROM Users where email='".$_POST["email"]."' and is_active=1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "1111 ".$row["password"];
       if($_POST["password"] == $row["password"]){
        echo "2222";
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $row["email"];
        header("Location: ./index.php?");
        die();
       } else {
        $_SESSION['flash_message'] = "Invalid Password. Please enter a correct one!!";
        header("Location: ./index.php?");
        die();
       }
    } else {
        $_SESSION['flash_message'] = "Email doesn't exist. Please Register!!";
        header("Location: ./index.php?");
        die();
    }
    $conn->close();
?>