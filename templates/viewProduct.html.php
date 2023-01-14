<h1><?= $product['title'] ?></h1>
<article class="product">
    <img src="product.png" alt="product name">
    <section class="details">
        <h2><?= $product['title'] ?></h2>
        <h3><?= $product['name'] ?></h3>
        <p>Auction created by <?= $product['email'] ?></p>
        <p class="price">Current bid: £<?= $product['bid_amount'] ?? 0 ?></p>
        <time>Time left: 8 hours 3 minutes</time>
        <form action="" method="post">
            <input type="hidden" name="user_id" value="<?= $_GET['auction_id'] ?>" />
            <input type="text" name="amount" placeholder="Enter bid amount">
            <input type="submit" name="submitBid" value="Bid" class="submit-btn">
        </form>
    </section>
    <section class="description">
        <p><?= $product['description'] ?></p>
    </section>
    <section class="reviews">
        <h2>Reviews for <?= $product['email'] ?></h2>
        <ul>
            <?php foreach ($reviews as $review) : ?>
            <li><?= $review['review'] ?></li>
            <?php endforeach; ?>
        </ul>
        <form action="" method="post">
            <textarea name="review" placeholder="Add your review"></textarea>
            <input type="submit" name="submitReview" value="Add Review" class="review-btn">
        </form>
    </section>
</article>