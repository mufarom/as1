<?php
session_start();
require '../loadTemplate.php';
require '../database/database.php';

//Edit Auction On Database
if(isset($_POST['edit'])) {
    $stmt = $pdo->prepare("UPDATE auction
                           SET title = :title, description = :description, category_id = :category_id , endDate = :endDate
                           WHERE auction_id = :auction_id");
    $values = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'category_id' => $_POST['category_id'],
        'endDate' => $_POST['endDate'],
        'auction_id' => $_GET['auction_id']
    ];
    $stmt->execute($values);
    
    $output = 'You Have Successfully Updated Auction Title ' . $_POST['title'] . '. View your other auctions <a href="login.php">here</a>';
    $title = 'Edit Auction';
    require '../templates/layout.html.php';
}
//Delete Auction From Database
else if(isset($_POST['delete'])){
    $deleteBids = $pdo->prepare("DELETE FROM bids WHERE auction_id = ?");
    $deleteBids->execute([$_GET['auction_id']]);

    $auctionDelete = $pdo->prepare("DELETE FROM auction 
                                WHERE auction_id = ? AND user_id = ?");
    $values = [$_GET['auction_id'], $_SESSION['user_id']];
    $auctionDelete->execute($values);

    $output = '<p>You Have Successfully Deleted The Auction! View your other auctions <a href="login.php">here</a></p>';
    $title = 'Delete Auction';
    require '../templates/layout.html.php';

} 
//Query And Display Auction With Form Using Auction ID
else if (isset($_GET['auction_id'])) {
    $auction_id = $_GET['auction_id'];
    $auctionIdStmt = $pdo->prepare("SELECT a.title, a.description, c.name, a.endDate, a.category_id, a.auction_id
                                     FROM auction a, category c, registrations r
                                     WHERE a.auction_id = $auction_id
                                     AND a.category_id = c.category_id 
                                     AND a.user_id = r.user_id");
    $auctionIdStmt->execute();
    $auction = $auctionIdStmt->fetch();
    $categoryStmt = $pdo->prepare('SELECT * FROM category');
    $categoryStmt->execute();
    $templateVars = ['auction' => $auction, 'categoryStmt' => $categoryStmt];
    $output = loadTemplate('../templates/editAuction.html.php', $templateVars);
    $templateVars = ['output' => $output, 'title' => 'Edit Auction'];
    $content = loadTemplate('../templates/layout.html.php', $templateVars);
    echo $content;
}
