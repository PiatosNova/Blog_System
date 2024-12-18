<?php
require_once 'C:\xampp\htdocs\Blog_System\config\security.php'; // Include the security functions

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    validateCSRFToken($_POST['csrf_token']);
    
    // Sanitize input data
    $username = sanitizeInput($_POST['username']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    
    // Process the registration (e.g., save to database)
    // ...
}
