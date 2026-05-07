<?php include '../config/database.php';
if(!isAdmin()) header("Location: login.php");

$enrollments = $conn->query("
    SELECT e.*, u.name as student_name, u.email, c.title as course_title 
    FROM enrollments e 
    JOIN users u ON e.student_id=u.id 
    JOIN courses c ON e.course_id=c.id 
    ORDER BY e.enrolled_at DESC
");
?>
<!DOCTYPE html>
<html>
<head><title>Manage Enrollments</title><link rel="stylesheet" href="../css/style.css"></head>
<body>
<div class="admin-container">
    <h1>All Enrollments</h1>
    <a href="dashboard.php" class="btn-secondary">← Back</a>
    
    <table class="admin-table">
        <tr><th>Student</th><th>Course</th><th>Enrolled Date</th><th>Status</th></tr>
        <?php while($row = $enrollments->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['student_name']; ?><br><small><?php echo $row['email']; ?></small></td>
            <td><?php echo $row['course_title']; ?></td>
            <td><?php echo date('d M Y', strtotime($row['enrolled_at'])); ?></td>
            <td><?php echo ucfirst($row['status']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>