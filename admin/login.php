<?php include '../config/database.php';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $result = $conn->query("SELECT * FROM users WHERE email='$email' AND role='admin'");
    if($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        if(password_verify($password, $admin['password'])) {
            $_SESSION['user_id'] = $admin['id'];
            $_SESSION['user_name'] = $admin['name'];
            $_SESSION['user_role'] = 'admin';
            header("Location: dashboard.php");
            exit();
        }
    }
    $error = "Invalid credentials!";
}
?>
<!DOCTYPE html>
<html>
<head><title>Admin Login</title><link rel="stylesheet" href="../css/style.css"></head>
<body>
<div class="form-container">
    <h2>Admin Login</h2>
    <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Admin Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="btn-primary">Login as Admin</button>
    </form>
</div>
</body>
</html>