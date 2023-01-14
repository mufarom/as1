<?php
session_start();
require '../loadTemplate.php';
require '../database/database.php';

//Check If A User Is Already Logged In
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
    
    //Validate User Credentials
    if (isset($_POST['submit'])) {
        $checkCredentials = $pdo->prepare('SELECT * FROM registrations WHERE email = ?');
        $checkCredentials->execute([$_POST['email']]);
        $checkedCredentials = $checkCredentials->fetch();
        $_SESSION['loggedin'] = $_POST['email'];

        if (password_verify($_POST['password'], $checkedCredentials['password_hash'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $checkedCredentials['user_id'];

            $stmt = $pdo->prepare("SELECT a.auction_id, a.title, a.description, a.endDate, c.name, r.email, a.user_id
                        FROM auction a
                        JOIN category c ON a.category_id = c.category_id
                        JOIN registrations r ON a.user_id = r.user_id
                        LEFT JOIN bids b ON a.auction_id = b.auction_id
                        WHERE a.user_id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $auctionStmt = $stmt->fetchAll();


            $output = loadTemplate('../templates/listUserAuctions.html.php', ['auctionStmt' => $auctionStmt]);
            $title = 'Login';
            require '../templates/layout.html.php';
        } 
        //Show Error Message If User Credentials Are Not Valid
        else {
            $output = '<p>Sorry, your username and password could not be found</p>';
            $title = 'Login';
            require '../templates/layout.html.php';
        }
    }
    //Display Login Form If No User Is Logged In 
    else {
        $output = loadTemplate('../templates/login.html.php', []);
        $title = 'Login Form';
        require '../templates/layout.html.php';
    }
} 
//If There Is Already A User Session Display Login Menu
else {
    $stmt = $pdo->prepare("SELECT a.auction_id, a.title, a.description, a.endDate, c.name, r.email, a.user_id
                        FROM auction a
                        JOIN category c ON a.category_id = c.category_id
                        JOIN registrations r ON a.user_id = r.user_id
                        LEFT JOIN bids b ON a.auction_id = b.auction_id
                        WHERE a.user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $auctionStmt = $stmt->fetchAll();

    $output = loadTemplate('../templates/listUserAuctions.html.php', ['auctionStmt' => $auctionStmt]);
    $title = 'Login';
    require '../templates/layout.html.php';
}
