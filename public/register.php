<?php
session_start();
require '../loadTemplate.php';
require '../database/database.php';

$valid = true;
$output = '';
$title = 'Registration Form';

//Validate Registration Form Input Data
if (isset($_POST['submit'])) {
    $nonempty = ['firstname', 'surname', 'email', 'password', 'cpassword'];
    foreach ($nonempty as $field) {
        if (!array_key_exists($field, $_POST) || empty($_POST[$field])) {
            $valid = false;
            $output .= '<p>Please enter your ' . $field . '</p>';
        }
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $valid = false;
        $output .= '<p>You must enter a valid email address</p>';
    }
    if ($_POST['password'] != $_POST['cpassword']) {
        $valid = false;
        $output .= '<p>Your passwords must match</p>';
    }
    if (strlen($_POST['password']) < 8) {
        $valid = false;
        $output .= '<p>Your password must be at least 8 characters long</p>';
    }

    $checkEmail = $pdo->prepare('SELECT * FROM registrations WHERE email = ?');
    $checkEmail->execute([$_POST['email']]);
    $checkedEmail = $checkEmail->rowCount();

    if ($checkedEmail > 0) {
        $valid = false;
        $output .= '<p>Email address already exists!</p>';
    }

    //Register User Into Database If Input Data Valid
    if ($valid) {
        $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $stmt = $pdo->prepare('INSERT INTO registrations (firstname, surname, email, password_hash) VALUES (:firstname, :surname, :email, :password_hash)');

        $values = [
            'firstname' => $_POST['firstname'],
            'surname' => $_POST['surname'],
            'email' => $_POST['email'],
            'password_hash' => $hash
        ];
        $stmt->execute($values);

        $output .= '<p>You have successfully registered! You can now <a href="login.php">log in</a></p>';
        $title = 'Registration Successful';
    }
    require '../templates/layout.html.php';
} 
//Show Registration Form
else {
    $output = loadTemplate('../templates/register.html.php', []);
    $templateVars = ['title' => 'Registration Form', 'output' => $output];
    $content = loadTemplate('../templates/layout.html.php', $templateVars);
    echo $content;
}
