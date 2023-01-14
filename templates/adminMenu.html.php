<h2>You are now logged in admin <?= $_SESSION['admin'] ?></h2>
<form action="addCategory.php" form method="POST">
    <input type="submit" value="Add Category" class="form btn">
</form>
<form action="logout.php" form method="POST">
    <input type="submit" value="Logout" class="form btn">
</form>
<h2>Categories</h2>
<br>
<?php
foreach ($categoryStmt as $row) {
?>
    <ol>
        <p><?= $row['name'] ?></p><a href="editCategory.php?category_id=<?= $row['category_id'] ?>">Edit</a>
        <a href="deleteCategory.php?category_id=<?= $row['category_id'] ?>">Delete</a>
        <br>
    </ol>
<?php
}
