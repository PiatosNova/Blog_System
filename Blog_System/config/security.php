<?php
function secureSession() {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_secure', 1);
    ini_set('session.cookie_samesite', 'Strict');
    ini_set('session.gc_maxlifetime', 1800);
    ini_set('session.use_strict_mode', 1);
    
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params([
        'lifetime' => $cookieParams['lifetime'],
        'path' => '/',
        'domain' => $_SERVER['HTTP_HOST'],
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict'
    ]);

    session_start();

    if (!isset($_SESSION['created'])) {
        $_SESSION['created'] = time();
    }

    if (isset($_SESSION['created']) && (time() - $_SESSION['created'] > 1800)) {
        session_regenerate_id(true);
        $_SESSION['created'] = time();
    }

    if (!isset($_SESSION['last_ip'])) {
        $_SESSION['last_ip'] = $_SERVER['REMOTE_ADDR'];
    } elseif ($_SESSION['last_ip'] !== $_SERVER['REMOTE_ADDR']) {
        session_unset();
        session_destroy();
        session_start();
        $_SESSION['last_ip'] = $_SERVER['REMOTE_ADDR'];
    }

    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3600)) {
        session_unset();
        session_destroy();
        session_start();
    }
    $_SESSION['last_activity'] = time();
}

function validateSession() {
    if (session_status() === PHP_SESSION_NONE) {
        secureSession();
    }
    
    if (!isset($_SESSION['user_id'])) {
        $currentPage = basename($_SERVER['PHP_SELF']);
        if (!in_array($currentPage, ['login.php', 'register.php'])) {
            header('Location: ../views/login.php');
            exit();
        }
    }
}

function generateCSRFToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function validateCSRFToken($token) {
    if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        throw new Exception('Invalid CSRF token');
    }
}

function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validateImage($file) {
    error_log("Validating image: " . print_r($file, true));
    
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $maxSize = 5 * 1024 * 1024;
    
    if ($file['size'] > $maxSize) {
        error_log("Image too large: " . $file['size']);
        return false;
    }
    
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
    error_log("Image mime type: " . $mimeType);
    error_log("Image extension: " . $extension);
    
    if (!in_array($extension, $allowed) || 
        !in_array($mimeType, ['image/jpeg', 'image/png', 'image/gif'])) {
        error_log("Invalid image type");
        return false;
    }
    
    return true;
}

function xssClean($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

function validateVideo($file) {
    error_log("Validating video: " . print_r($file, true));
    
    $allowed = ['mp4', 'webm', 'ogg'];
    $maxSize = 50 * 1024 * 1024;
    
    if ($file['size'] > $maxSize) {
        error_log("Video too large: " . $file['size']);
        return false;
    }
    
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
    error_log("Video mime type: " . $mimeType);
    error_log("Video extension: " . $extension);
    
    if (!in_array($extension, $allowed) || 
        !in_array($mimeType, ['video/mp4', 'video/webm', 'video/ogg'])) {
        error_log("Invalid video type");
        return false;
    }
    
    return true;
}