<?php
require '../loadTemplate.php';
require '../database/database.php';

//Query And Display 10 Auctions With The Earliest End Date
$auctionStmt = $pdo->prepare("SELECT a.auction_id, a.title,a.description,a.endDate,c.name,r.email, IFNULL(MAX(b.amount),0) as highest_bid
                              FROM auction a
                              JOIN category c ON a.category_id = c.category_id
                              JOIN registrations r ON a.user_id = r.user_id
                              LEFT JOIN bids b ON a.auction_id = b.auction_id
                              GROUP BY a.auction_id
                              ORDER BY a.endDate ASC
                              LIMIT 10");
$auctionStmt->execute();

$output = loadTemplate('../templates/index.html.php', ['auctionStmt' => $auctionStmt]);
$title = 'Home';

require '../templates/layout.html.php';
