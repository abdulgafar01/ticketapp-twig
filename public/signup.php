<?php
require_once __DIR__ . '/../vendor/autoload.php';
session_start();

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader);

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (strlen($password) < 4) {
        $error = 'Password must be at least 4 characters.';
    } else {
        $_SESSION['user'] = [
            'name' => htmlspecialchars($name),
            'email' => htmlspecialchars($email),
        ];
        header('Location: /index.php');
        exit;
    }
}

echo $twig->render('signup.twig', [
    'title' => 'Signup | TicketApp',
    'error' => $error,
    'session' => $_SESSION
]);
