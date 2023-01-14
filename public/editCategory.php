<?php
session_start();
require '../loadTemplate.php';
require '../database/database.php';

$title = 'Edit Category';

//Edit Category On Database
if (isset($_POST['edit'])) {
    $stmt = $pdo->prepare("UPDATE category
           SET name = :name
           WHERE category_id = :category_id ");
    $values = [
        'category_id' => $_POST['category_id'],
        'name' => $_POST['name'],
    ];
    $stmt->execute($values);

    $output =  'You Have Successfully Updated Category ' . $_POST['name'];
    require '../templates/layout.html.php';
}
//Query And Display Category Using Category ID
if (isset($_GET['category_id'])) {
    $editStmt = $pdo->prepare("SELECT * FROM category
                     WHERE category_id = ?");
    $editStmt->execute([$_GET['category_id']]);
    $edit = $editStmt->fetch();

    $templateVars = ['edit' => $edit];
    $output = loadTemplate('../templates/editCategory.html.php', $templateVars);
    require '../templates/layout.html.php';
}
