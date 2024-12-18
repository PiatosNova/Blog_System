<?php
// Start session at the very beginning
session_start();

// Get controller and action from URL
$controller = isset($_GET['controller']) ? strtolower($_GET['controller']) : 'auth';
$action = isset($_GET['action']) ? strtolower($_GET['action']) : 'login';

// Check if an ID is provided for the profile view
$id = isset($_GET['id']) ? $_GET['id'] : null;

// If user is logged in and trying to access login/register, redirect to dashboard
if (isset($_SESSION['user_id']) && $controller === 'auth' && ($action === 'login' || $action === 'register')) {
    header("Location: index.php?controller=dashboard");
    exit();
}

// If user is not logged in and trying to access protected pages, redirect to login
if (!isset($_SESSION['user_id']) && $controller !== 'auth') {
    header("Location: index.php?controller=auth&action=login");
    exit();
}

$controllerName = ucfirst($controller) . "Controller";
$controllerFile = "controllers/" . $controllerName . ".php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerName();
    
    // Check if the action is 'view' and an ID is provided
    if ($action === 'view' && $id !== null) {
        $controller->view($id); // Pass the ID to the view method
    } elseif (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        if (method_exists($controller, 'index')) {
            $controller->index();
        } else {
            die("Action not found and no default index action available");
        }
    }
} else {
    die("Controller not found");
}

if ($controller === 'auth' && $action === 'register') {
    require_once 'views/auth/process_registration.php';
}

if ($controller === 'auth' && $action === 'process_login') {
    require_once 'controllers/process_login.php';
} 