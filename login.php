 
<?php include 'config/database.php';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if(password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];
            
            if($user['role'] == 'admin') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: dashboard.php");
            }
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "Email not found!";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login - Shikhar Shiksha</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<div class="form-container">
    <h2>Login to Your Account</h2>
    <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="btn-primary">Login</button>
    </form>
    <p style="margin-top:1rem">Don't have an account? <a href="signup.php">Sign Up</a></p>
    <p style="margin-top:0.5rem">Demo: student@student.com / student123</p>
</div>
</body>
</html>