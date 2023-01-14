<?php
session_start();
require '../loadTemplate.php';
require '../database/database.php';

$title = $_GET['search'];

//Get Search Form Input Data, Query The Database And Display Results
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $searchStmt = $pdo->prepare("SELECT a.auction_id, a.title,a.description,a.endDate,c.name,r.email, IFNULL(MAX(b.amount),0) as highest_bid
                                FROM auction a
                                JOIN category c ON c.category_id = a.category_id
                                JOIN registrations r ON a.user_id = r.user_id
                                LEFT JOIN bids b on a.auction_id = b.auction_id
                                WHERE a.title LIKE :search
                                OR a.description LIKE :search
                                OR c.name LIKE :search
                                OR r.email LIKE :search");
    $searchStmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $searchStmt->execute();

    $templateVars = ['searchStmt' => $searchStmt];
    $output = loadTemplate('../templates/search.html.php', $templateVars);
    $content = loadTemplate('../templates/layout.html.php', ['title' => $_GET['search'], 'output' => $output]);
    echo $content;
}
