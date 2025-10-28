<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Hacker\TicketappTwig\Auth\Auth;
use Hacker\TicketappTwig\Ticket\TicketManager;

session_start();

// Only logged-in users
if (!Auth::check()) {
    header('Location: /login.php');
    exit;
}

// Handle POST actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                TicketManager::add($_POST['title'], $_POST['description']);
                break;
            case 'update':
                TicketManager::updateStatus($_POST['id'], $_POST['status']);
                break;
            case 'delete':
                TicketManager::delete($_POST['id']);
                break;
        }
    }
    header('Location: /dashboard.php');
    exit;
}

$tickets = TicketManager::getAll();

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('dashboard.twig', [
    'title' => 'Dashboard',
    'tickets' => $tickets,
    'session' => $_SESSION,
]);
