<?php
session_start();
require '../loadTemplate.php';
require '../database/database.php';

$title = 'Add Category';

//Add Category On Submit
if (isset($_POST['submit'])) {
	$stmt = $pdo->prepare('INSERT INTO category (name) VALUES (:name)');

	$values = ['name' => $_POST['name']];

	$stmt->execute($values);

	$output = '<p>Category Added Succesfully!</p>';
}
//Show Category Input Form
else {
	$output = loadTemplate('../templates/addCategory.html.php', []);
}
require '../templates/layout.html.php';
