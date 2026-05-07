<?php include 'config/database.php';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if($check->num_rows > 0) {
        $error = "Email already registered!";
    } else {
        $conn->query("INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')");
        header("Location: login.php?registered=1");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Sign Up - Shikhar Shiksha</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<div class="form-container">
    <h2>Create Free Account</h2>
    <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="tel" name="phone" placeholder="Phone Number" required>
        <input type="password" name="password" placeholder="Password (min 6 characters)" required>
        <button type="submit" class="btn-primary">Sign Up →</button>
    </form>
    <p style="margin-top:1rem">Already have account? <a href="login.php">Login</a></p>
</div>
</body>
</html>