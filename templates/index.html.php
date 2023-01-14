<h1>Latest Listings</h1>

<?php
foreach ($auctionStmt as $auction) {
    $endDate = new DateTime($auction['endDate']);
    $currentDate = new DateTime();
    $timeRemaining = $endDate->diff($currentDate);
?>
    <ul class="productList">
        <li>
            <img src="product.png" alt="product name">
            <article>
                <h2><?= $auction['title'] ?></h2>
                <h3><?= $auction['name'] ?></h3>
                <p><?= $auction['description'] ?></p>
                <?php if ($currentDate > $endDate) { ?>
                    <p>Auction has ended</p>
                <?php } else { ?>
                    <p>Time Left: <?= $timeRemaining->format('%a days, %h hours, %i minutes, %s seconds') ?></p>
                <?php } ?>
                <p>Created by <?= $auction['email'] ?></p>
                <p class="price">Current bid: £<?= $auction['highest_bid'] ?></p>
                <a href="viewProduct.php?auction_id=<?= $auction['auction_id'] ?>" class="more auctionLink">More &gt;&gt;</a>
                <input type="hidden" name="auction_id" value="<?= $auction['auction_id'] ?>" />
                </form>
            </article>
        </li>
    </ul>
<?php
}
