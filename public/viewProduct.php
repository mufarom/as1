<?php
session_start();
require '../loadTemplate.php';
require '../database/database.php';

$auctionId = isset($_GET['auction_id']) ? intval($_GET['auction_id']) : 0;

//Query Database For Product
$productStmt = $pdo->prepare("SELECT a.title, a.description, a.endDate, c.name, r.email, a.user_id, MAX(b.amount) AS bid_amount
                              FROM auction a
                              JOIN category c ON a.category_id = c.category_id
                              JOIN registrations r ON a.user_id = r.user_id
                              LEFT JOIN (SELECT auction_id, MAX(amount) AS amount FROM bids GROUP BY auction_id) b ON a.auction_id = b.auction_id
                              WHERE a.auction_id = :auctionId");
$productStmt->execute(['auctionId' => $auctionId]);
$product = $productStmt->fetch();

//Submit User Bid
if (isset($_POST['submitBid'])) {
    //User Must Be Logged In To View The Product
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
        header('Location: login.php');
        exit;
    }
    else{
    $userId = $_SESSION['user_id'];

    $amount = $_POST['amount'];
    $bidStmt = $pdo->prepare("INSERT INTO bids (auction_id, user_id, amount) VALUES (:auctionId, :userId, :amount)");
    $bidStmt->execute(['auctionId' => $auctionId, 'userId' => $userId, 'amount' => $amount]);
    }
}

//Submit User Review
if (isset($_POST['submitReview'])) {
    //User Must Be Logged In To View The Product
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
        header('Location: login.php');
        exit;
    }
    else{
    $userId = $_SESSION['user_id'];

    $review = $_POST['review'];
    $reviewStmt = $pdo->prepare("INSERT INTO reviews (auction_id, user_id, review) VALUES (:auctionId, :userId, :review)");
    $reviewStmt->execute(['auctionId' => $auctionId, 'userId' => $userId, 'review' => $review]);
    }
}

//Get User Reviews
$reviewStmt = $pdo->prepare("SELECT r.review, re.email
                             FROM reviews r, registrations re, auction a
                             WHERE re.user_id = :userId
                             AND a.auction_id = r.auction_id
                             AND a.user_id = :userId");
$reviewStmt->execute(['userId' => $product['user_id']]);
$reviews = $reviewStmt->fetchAll();

//Display Product Chosen
if ($product) {
    $output = loadTemplate('../templates/viewProduct.html.php', [
        'product' => $product,
        'reviews' => $reviews,
    ]);
    $title = 'Product';
} else {
    $output = '<h1>Auction not found.</h1>';
    $title = 'Product';
}
require '../templates/layout.html.php';
