<?php if ($searchStmt->rowCount() > 0) { ?>
    <?php foreach ($searchStmt as $search) {
        $endDate = $search['endDate'] ? new DateTime($search['endDate']) : null;
        $currentDate = new DateTime();
        $timeRemaining = $endDate ? $endDate->diff($currentDate) : null;
    ?>
        <ul class="productList">
            <li>
                <img src="product.png" alt="product name">
                <article>
                    <h2><?= $search['title'] ?></h2>
                    <h3><?= $search['name'] ?></h3>
                    <p><?= $search['description'] ?></p>
                    <?php if ($currentDate > $endDate) { ?>
                        <p>Auction has ended</p>
                    <?php } else { ?>
                        <p>Time Left: <?= $timeRemaining ? $timeRemaining->format('%a days, %h hours, %i minutes, %s seconds') : '' ?></p>
                    <?php } ?>
                    <p>Created by <?= $search['email'] ?></p>
                    <p class="price">Current bid: £<?= $search['highest_bid'] ?? 0 ?></p>
                    <a href="viewProduct.php?auction_id=<?= $search['auction_id'] ?>" class="more auctionLink">More &gt;&gt;</a>
                    <input type="hidden" name="auction_id" value="<?= $search['auction_id'] ?>" />
                    </form>
                </article>
            </li>
        </ul>
<?php }
}
