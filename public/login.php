<?php
require_once __DIR__ . '/../vendor/autoload.php';
session_start();

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader);

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // In a real app, check DB; here we simulate
    if ($email === 'user@example.com' && $password === '1234') {
        $_SESSION['user'] = [
            'name' => 'Demo User',
            'email' => $email,
        ];
        header('Location: /index.php');
        exit;
    } else {
        $error = 'Invalid credentials. Try user@example.com / 1234.';
    }
}

echo $twig->render('login.twig', [
    'title' => 'Login | TicketApp',
    'error' => $error,
    'session' => $_SESSION
]);
