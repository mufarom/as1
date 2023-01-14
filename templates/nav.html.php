<?php
require '../database/database.php';
?>
<nav>
    <ul>
        <?php
        $stmt = $pdo->prepare('SELECT * FROM category LIMIT 7');
        $stmt->execute();

        foreach ($stmt as $row) {
        ?>
            <li><a class="categoryLink" href="viewCategory.php?category_id=<?= $row['category_id'] ?>"><?= $row['name'] ?></a>
            </li>
        <?php
        }
        ?>
        <li>
            <a href="#">More</a>
            <ul class="submenu">
                <?php
                $stmt = $pdo->prepare('SELECT * FROM category WHERE category_id > 7');
                $stmt->execute();

                foreach ($stmt as $row) {
                ?>
                    <li><a class="categoryLink" href="viewCategory.php?category_id=<?= $row['category_id'] ?>"><?= $row['name'] ?></a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </li>
    </ul>
</nav>