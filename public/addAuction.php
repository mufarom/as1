<?php
session_start();
require '../loadTemplate.php';
require '../database/database.php';

//Add Auction To Database
if (isset($_POST['submit'])) {
    $stmt = $pdo->prepare('INSERT INTO auction (title, description, category_id, endDate, user_id)
                           VALUES (:title, :description, :category_id, :endDate , :user_id )
    ');

    $values = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'category_id' => $_POST['category_id'],
        'endDate' => $_POST['endDate'],
        'user_id' => $_POST['user_id']
    ];

    $stmt->execute($values);

    $output = '<p>You have successfully added Auction ' . $_POST['title'] . '. You can view your other auctions <a href="login.php">here</a></p>';
    $title = 'Login';
    require '../templates/layout.html.php';
}
//Show Auction Input Form
else {
    $userIdStmt = $pdo->prepare("SELECT * FROM registrations WHERE email = '" . $_SESSION['loggedin'] . "'");
    $userIdStmt->execute();
    $userId = $userIdStmt->fetch();

    $stmt = $pdo->prepare('SELECT * FROM category');
    $stmt->execute();

    $templateVars = ['userId' => $userId, 'stmt' => $stmt];
    $output = loadTemplate('../templates/addAuction.html.php', $templateVars);
    $title = 'Add Auction';
    require '../templates/layout.html.php';
}
