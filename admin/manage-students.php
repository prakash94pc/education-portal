<?php include '../config/database.php';
if(!isAdmin()) header("Location: login.php");

$students = $conn->query("SELECT * FROM users WHERE role='student' ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head><title>Manage Students</title><link rel="stylesheet" href="../css/style.css"></head>
<body>
<div class="admin-container">
    <h1>Manage Students</h1>
    <a href="dashboard.php" class="btn-secondary">← Back</a>
    
    <table class="admin-table">
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Registered On</th><th>Action</th></tr>
        <?php while($student = $students->fetch_assoc()): ?>
        <tr>
            <td><?php echo $student['id']; ?></td>
            <td><?php echo $student['name']; ?></td>
            <td><?php echo $student['email']; ?></td>
            <td><?php echo $student['phone']; ?></td>
            <td><?php echo date('d M Y', strtotime($student['created_at'])); ?></td>
            <td><a href="delete-student.php?id=<?php echo $student['id']; ?>" onclick="return confirm('Delete student?')">🗑️ Delete</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>