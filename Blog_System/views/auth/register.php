<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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
        .register-icon {
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
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        .login-link a {
            color: #0d6efd;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="text-center">
                <div class="register-icon">👤</div>
                <h2 class="mb-2">Create Account</h2>
                <p class="text-muted mb-4">Join our community today</p>
            </div>
            
            <form method="POST" action="index.php?controller=auth&action=register">
                <?php if(isset($errors['general'])): ?>
                    <div class="alert alert-danger mb-3">
                        <?php echo $errors['general']; ?>
                    </div>
                <?php endif; ?>
                
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <div class="input-group">
                        <span class="input-group-text">👤</span>
                        <input type="text" name="username" class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>" placeholder="Enter your name" required>
                    </div>
                    <?php if(isset($errors['username'])): ?>
                        <div class="invalid-feedback d-block"><?php echo $errors['username']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text">✉</span>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">🔒</span>
                        <input type="password" name="password" class="form-control" placeholder="Create a password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
                
                <div class="login-link">
                    <p>Already have an account? <a href="index.php?action=login">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 