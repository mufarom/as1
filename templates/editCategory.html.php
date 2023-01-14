<div class="form-container">
    <form action="editCategory.php" method="POST">
        <input type="hidden" name="category_id" value="<?= $edit['category_id'] ?>" />
        <input type="text" name="name" value="<?= $edit['name'] ?>" />
        <input type="submit" name="edit" value="Edit">
    </form>
</div>