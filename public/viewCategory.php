<?php
session_start();
require '../loadTemplate.php';
require '../database/database.php';

//Query And Display Results Using Category ID
$id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

$categoryStmt = $pdo->prepare("SELECT a.auction_id, a.title, a.description, a.endDate, c.name, r.email, IFNULL(MAX(b.amount),0) as highest_bid
                            FROM auction a
                            JOIN category c ON a.category_id = c.category_id
                            JOIN registrations r ON a.user_id = r.user_id
                            LEFT JOIN bids b ON a.auction_id = b.auction_id
                            WHERE a.category_id = :id");
$categoryStmt->execute(['id' => $id]);

if ($categoryStmt->rowCount() > 0) {
    $output = loadTemplate('../templates/viewCategory.html.php', ['categoryStmt' => $categoryStmt]);
    $templateVars = ['title' => 'Category', 'output' => $output];
    $content = loadTemplate('../templates/layout.html.php', $templateVars);
    echo $content;
} else {
    $output =  '<p>No Auctions Available For This Category</p>';
    $title = 'Category';
    require '../templates/layout.html.php';
}
