<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($userProfile['username']); ?>'s Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .profile-header {
            background: linear-gradient(90deg, #007bff, #00bfff);
            padding: 40px;
            text-align: center;
            color: white;
            border-radius: 0.5rem 0.5rem 0 0;
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid white;
            margin-top: -75px; /* Adjust for overlap */
        }
        .return-button {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 10;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php?controller=dashboard" class="btn btn-secondary return-button">Return to Dashboard</a>
        <div class="profile-header">
            <h1><?php echo htmlspecialchars($userProfile['username']); ?></h1>
            <img src="<?php echo htmlspecialchars($userProfile['profile_picture']); ?>" alt="Profile Picture" class="profile-picture">
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Email Address</h5>
                <p class="card-text"><?php echo htmlspecialchars($userProfile['email']); ?></p>
                <h5 class="card-title">About</h5>
                <p class="card-text"><?php echo nl2br(htmlspecialchars($userProfile['bio'])); ?></p>
                <?php if ($_SESSION['user_id'] == $userProfile['id']): // Show edit button only for the logged-in user ?>
                    <a href="index.php?controller=profile&action=edit" class="btn btn-primary">Edit Profile</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>