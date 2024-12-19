<?php
// public/index.php

require_once '../app/Controllers/ChatController.php';

$controller = new ChatController();

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'send':
        $controller->send();
        break;
    case 'receive':
        $controller->receive();
        break;
    default:
        $controller->index();
        break;
}
?>