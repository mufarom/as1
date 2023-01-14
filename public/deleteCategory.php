<?php
session_start();
require '../loadTemplate.php';
require '../database/database.php';

//Query Using Category ID & Delete Category
if (isset($_GET['category_id'])) {
    $categoryDelete = $pdo->prepare("DELETE FROM category
					WHERE category_id = ?");

    $values = [$_GET['category_id']];
    $categoryDelete->execute($values);

    $output = '<p>You have succesfully deleted a category!</p>';
    $title = 'Delete Category';
    require '../templates/layout.html.php';
}
