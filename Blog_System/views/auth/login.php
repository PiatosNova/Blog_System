<?php
require_once 'C:\xampp\htdocs\Blog_System\config\security.php'; // Corrected path

// Generate CSRF token
$csrfToken = generateCSRFToken();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 500px;
            margin: 50px auto;
        }
        .login-icon {
            color: #0d6efd;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            background-color: #f8f9fa;
        }
        .form-control:focus {
            background-color: #fff;
        }
        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 8px;
        }
        .btn-primary {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            font-weight: 500;
            margin-top: 20px;
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
        }
        .register-link a {
            color: #0d6efd;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="text-center">
                <div class="login-icon">↪</div>
                <h2 class="mb-2">Welcome Back</h2>
                <p class="text-muted mb-4">Login to your account</p>
            </div>
            
            <form method="POST" action="index.php?controller=auth&action=process_login">
                <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
                <?php if(isset($errors['general'])): ?>
                    <div class="alert alert-danger mb-3">
                        <?php echo $errors['general']; ?>
                    </div>
                <?php endif; ?>

                <?php if(isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success mb-3">
                        <?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text">✉</span>
                        <input type="email" name="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" placeholder="Enter your email" required>
                    </div>
                    <?php if(isset($errors['email'])): ?>
                        <div class="invalid-feedback d-block"><?php echo $errors['email']; ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">🔒</span>
                        <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
                
                <div class="register-link">
                    <p>Don't have an account? <a href="index.php?action=register">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 