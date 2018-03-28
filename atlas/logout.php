<?php
        session_start();
        $_SESSION['loggedin'] = false;
        $_SESSION['username'] = "";
        header("Location: ./index.php?");
        die();
?>