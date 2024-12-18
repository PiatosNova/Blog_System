<?php
require_once 'C:/xampp/htdocs/Blog_System/config/security.php'; // Include security functions
require_once 'C:/xampp/htdocs/Blog_System/Models/User.php'; // Include your User model

// Start the session and secure it
secureSession();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    validateCSRFToken($_POST['csrf_token']);
    
    // Sanitize input data
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    
    // Create a User model instance
    $userModel = new User();
    
    // Attempt to log in the user
    $user = $userModel->login($email, $password);
    
    if ($user) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['profile_picture'] = $user['profile_picture'];
        
        // Redirect to the dashboard or home page
        header('Location: ../views/dashboard.php');
        exit();
    } else {
        // Handle login failure (e.g., invalid credentials)
        $error = "Invalid email or password.";
        header("Location: ../views/auth/login.php?error=" . urlencode($error));
        exit();
    }
} else {
    // If not a POST request, redirect to login
    header('Location: ../views/auth/login.php');
    exit();
}
