<?php
require_once 'C:/xampp/htdocs/Blog_System/config/security.php'; // Include security functions
require_once 'C:/xampp/htdocs/Blog_System/config/Database.php'; // Include the Database class
require_once 'C:/xampp/htdocs/Blog_System/models/User.php'; // Include your User model

class AuthController {
    private $db;
    private $user;
    private $errors = [];

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function register() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->errors = [];
            
            // Validate username
            if(empty($_POST['username'])) {
                $this->errors['username'] = "Username is required";
            } elseif(strlen($_POST['username']) < 3) {
                $this->errors['username'] = "Username must be at least 3 characters";
            }
            
            // Validate email
            if(empty($_POST['email'])) {
                $this->errors['email'] = "Email is required";
            } elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $this->errors['email'] = "Invalid email format";
            } elseif($this->user->emailExists($_POST['email'])) {
                $this->errors['email'] = "Email already exists";
            }
            
            // Validate password
            if(empty($_POST['password'])) {
                $this->errors['password'] = "Password is required";
            } elseif(strlen($_POST['password']) < 6) {
                $this->errors['password'] = "Password must be at least 6 characters";
            }

            if(empty($this->errors)) {
                $this->user->username = $_POST['username'];
                $this->user->email = $_POST['email'];
                $this->user->password = $_POST['password'];

                if($this->user->create()) {
                    $_SESSION['success_message'] = "Registration successful! Please login.";
                    header("Location: index.php?action=login");
                    exit();
                } else {
                    $this->errors['general'] = "Registration failed. Please try again.";
                }
            }
        }
        
        // Include errors in the view
        $errors = $this->errors;
        require_once 'views/auth/register.php';
    }

    public function login() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->errors = [];
            
            // Validate email
            if(empty($_POST['email'])) {
                $this->errors['email'] = "Email is required";
            }
            
            // Validate password
            if(empty($_POST['password'])) {
                $this->errors['password'] = "Password is required";
            }

            if(empty($this->errors)) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                $result = $this->user->login($email, $password);
                if($result) {
                    $_SESSION['user_id'] = $result['id'];
                    $_SESSION['username'] = $result['username'];
                    $_SESSION['profile_picture'] = $result['profile_picture'];
                    header("Location: index.php?controller=dashboard&action=index");
                    exit();
                } else {
                    $this->errors['general'] = "Invalid email or password";
                }
            }
        }
        
        // Include errors in the view
        $errors = $this->errors;
        require_once 'views/auth/login.php';
    }

    public function logout() {
        // Unset all session variables
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        
        // Clear the entire session
        session_unset();
        session_destroy();
        
        // Redirect to login page
        header("Location: index.php");
        exit();
    }

    public function process_login() {
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
                header('Location: index.php?controller=dashboard&action=index');
                exit();
            } else {
                // Handle login failure (e.g., invalid credentials)
                $error = "Invalid email or password.";
                header("Location: index.php?controller=auth&action=login&error=" . urlencode($error));
                exit();
            }
        } else {
            // If not a POST request, redirect to login
            header('Location: index.php?controller=auth&action=login');
            exit();
        }
    }
} 