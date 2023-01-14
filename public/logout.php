<?php
session_start();

//Unset And Destroy User Session On Logout
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    $_SESSION = array();

    session_destroy();
} 
//Unset And Destroy Admin Session On Logout
else if (isset($_SESSION['admin'])) {
    $_SESSION = array();

    session_destroy();
}

header('Location: index.php');
