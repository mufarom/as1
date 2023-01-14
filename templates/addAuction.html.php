<h2>Add Auction</h2>
<div class="form-container">
    <form action="addAuction.php" form method="POST">
        <input type="hidden" name="user_id" value="<?php echo $userId['user_id']; ?>">
        <input type="title" name="title" required placeholder="Auction Title">
        <textarea name="description" rows="3" cols="40" placeholder="Auction Description"></textarea>
        <br>
        <select name="category_id">
            <?php
            foreach ($stmt as $row) { ?>
                <option value=<?= $row['category_id'] ?>><?= $row['name'] ?></option>
            <?php
            }
            ?>
        </select>
        <br>
        <input type="date" name="endDate">
        <br>
        <input type="submit" name="submit" value="Add Auction" class="form-btn">
    </form>
</div>