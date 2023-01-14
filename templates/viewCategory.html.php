<h1>Category</h1>
<?php if($categoryStmt->rowCount() > 0){ ?>
    <?php foreach($categoryStmt as $category){
        $endDate = $category['endDate'] ? new DateTime($category['endDate']) : null;
        $currentDate = new DateTime();
        $timeRemaining = $endDate ? $endDate->diff($currentDate) : null;
    ?>
    <ul class="productList">
        <li>
            <img src="product.png" alt="product name">
            <article>
                <h2><?= $category['title'] ?></h2>
                <h3><?= $category['name'] ?></h3>
                <p><?= $category['description'] ?></p>
                <?php if($currentDate > $endDate){ ?>
                    <p>Auction has ended</p>
                <?php }else{ ?>
                    <p>Time Left: <?= $timeRemaining ? $timeRemaining->format('%a days, %h hours, %i minutes, %s seconds') : '' ?></p>
                <?php } ?>
                <p>Created by <?= $category['email']?></p>
                <p class="price">Current bid: £<?=$category['highest_bid'] ?? 0 ?></p>
                <a href="viewProduct.php?auction_id=<?= $category['auction_id'] ?>" class="more auctionLink">More &gt;&gt;</a>
                <input type="hidden" name="auction_id" value="<?= $category['auction_id']?>" />
            </form>
            </article>
        </li>
    </ul>
    <?php }
    }