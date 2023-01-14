<h2>You are now logged in user <?= $_SESSION['loggedin'] ?></h2>

<form action="addAuction.php" form method="POST">
    <input type="submit" value="Add Auction" class="form btn">
</form>

<form action="logout.php" form method="POST">
    <input type="submit" value="Logout" class="form btn">
</form>

<?php
foreach ($auctionStmt as $auction) {
?>
    <ul class="productList">
        <li>
            <img src="product.png" alt="product name">
            <article>
                <h2><?= $auction['title'] ?></h2>
                <h3><?= $auction['name']; ?></h3>
                <p><?= $auction['description'] ?></p>
                <a href="editAuction.php?auction_id=<?= $auction['auction_id'] ?>" class="more auctionLink">Edit Auction</a>
            </article>
        </li>
    </ul>
<?php
}
