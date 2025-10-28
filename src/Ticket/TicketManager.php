<?php
namespace Hacker\TicketappTwig\Ticket;

class TicketManager {
    public static function getAll() {
        if (!isset($_SESSION['tickets'])) {
            $_SESSION['tickets'] = [];
        }
        return $_SESSION['tickets'];
    }

    public static function add($title, $description) {
        $tickets = self::getAll();
        $tickets[] = [
            'id' => uniqid(),
            'title' => htmlspecialchars($title),
            'description' => htmlspecialchars($description),
            'status' => 'New'
        ];
        $_SESSION['tickets'] = $tickets;
    }

    public static function updateStatus($id, $status) {
        foreach ($_SESSION['tickets'] as &$ticket) {
            if ($ticket['id'] === $id) {
                $ticket['status'] = $status;
                break;
            }
        }
    }

    public static function delete($id) {
        $_SESSION['tickets'] = array_filter($_SESSION['tickets'], fn($t) => $t['id'] !== $id);
    }
}
