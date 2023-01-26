<?php
session_start();
require '../loadTemplate.php';
require '../database/database.php';

//Check If There Is Already An Admin Logged In
if (!isset($_SESSION['admin']) || $_SESSION['admin'] == false) {

    //Validate Login Credentials
    if (isset($_POST['submit'])) {
        $checkCredentials = $pdo->prepare('SELECT * FROM admin WHERE email = ?');
        $checkCredentials->execute([$_POST['email']]);
        $checkedCredentials = $checkCredentials->fetch();

        if (password_verify($_POST['password'], $checkedCredentials['password_hash'])) {
            $_SESSION['admin'] = $_POST['email'];

            $categoryStmt = $pdo->prepare('SELECT * FROM category');
            $categoryStmt->execute();

            $output = loadTemplate('../templates/adminMenu.html.php', ['categoryStmt' => $categoryStmt]);
            $title = 'Admin Menu';
            require '../templates/layout.html.php';
        } 
        else {
            $output = '<p>Sorry, You Seem Not To Be An Admin</p>';
            $title = 'Admin Login';
            require '../templates/layout.html.php';
        }
    } 
    //Display Login Form If No Admin Logged In
    else {
        $output = loadTemplate('../templates/manageAdmins.html.php', []);
        $title = 'Admin Login';
        require '../templates/layout.html.php';
    }
}
//If There Is Already An Admin Session Display Login Menu
else{
    $categoryStmt = $pdo->prepare('SELECT * FROM category');
    $categoryStmt->execute();

    $output = loadTemplate('../templates/adminMenu.html.php', ['categoryStmt' => $categoryStmt]);
    $title = 'Admin Menu';
    require '../templates/layout.html.php';
}