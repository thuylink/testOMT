<?php
// routes/web.php

require_once 'controllers/UserController.php';

$request = $_SERVER['REQUEST_URI'];
$controller = new UserController();

switch ($request) {
    case '/':
        require __DIR__ . '/../views/index.php';
        break;
    case '/user_create':
        $controller->showCreateForm();
        break;
    case '/store-user':
        $controller->createUser();
        break;
    case '/success':
        $controller->showSuccessMessage();
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/../views/404.php';
        break;
}
?>
