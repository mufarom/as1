<h2>Add Auction</h2>
<div class="form-container">
    <form action="" method="POST">
        <input type="hidden" name="auction_id" value="<?= $auction['auction_id'] ?>">
        <input type="title" name="title" value="<?= $auction['title'] ?>" />
        <textarea name="description" rows="3" cols="40" placeholder="Auction Description"><?= $auction['description'] ?></textarea>
        <br>
        <select name="category_id">
            <?php
            foreach ($categoryStmt as $row) {
                if ($row['category_id'] == $auction['category_id']) { ?>
                    <option value="<?= $row['category_id'] ?>" selected="selected"><?= $row['name'] ?></option>
                <?php
                } else { ?>
                    <option value="<?= $row['category_id'] ?>"><?= $row['name'] ?></option>
            <?php
                }
            }
            ?>
        </select>
        <br>
        <input type="date" name="endDate" value="<?= $auction['endDate'] ?>">
        <br>
        <input type="submit" name="edit" value="Edit Auction">
        <input type="submit" name="delete" value="Delete Auction">
    </form>
</div>