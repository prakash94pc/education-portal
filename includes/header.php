 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>शिखर शिक्षा - Best Learning Platform</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<nav>
    <div class="logo">
        <i class="fas fa-graduation-cap"></i>
        <span>शिखर शिक्षा</span>
    </div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="courses.php">Courses</a></li>
        <?php if(isLoggedIn()): ?>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="my-courses.php">My Courses</a></li>
            <li><a href="logout.php">Logout (<?php echo $_SESSION['user_name']; ?>)</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Sign Up</a></li>
        <?php endif; ?>
    </ul>
</nav>