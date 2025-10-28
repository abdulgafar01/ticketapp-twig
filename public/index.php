<?php
require_once __DIR__ . '/../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader);

session_start();

echo $twig->render('landing.twig', [
    'title' => 'TicketApp — Manage Your Tickets',
    'session' => $_SESSION,
]);
