<?php include '../config/database.php';
if(!isAdmin()) header("Location: login.php");

$totalStudents = $conn->query("SELECT * FROM users WHERE role='student'")->num_rows;
$totalCourses = $conn->query("SELECT * FROM courses")->num_rows;
$totalEnrollments = $conn->query("SELECT * FROM enrollments")->num_rows;
$totalRevenue = $conn->query("SELECT SUM(price) as total FROM courses c JOIN enrollments e ON c.id=e.course_id")->fetch_assoc()['total'] ?? 0;

$recentEnrollments = $conn->query("
    SELECT e.*, u.name as student_name, c.title as course_title 
    FROM enrollments e 
    JOIN users u ON e.student_id=u.id 
    JOIN courses c ON e.course_id=c.id 
    ORDER BY e.enrolled_at DESC LIMIT 10
");
?>
<!DOCTYPE html>
<html>
<head><title>Admin Dashboard</title><link rel="stylesheet" href="../css/style.css"></head>
<body>
<div class="admin-container">
    <h1>Welcome, Admin <?php echo $_SESSION['user_name']; ?>!</h1>
    
    <div class="stats-grid">
        <div class="stat-card"><h3><?php echo $totalStudents; ?></h3><p>Total Students</p></div>
        <div class="stat-card"><h3><?php echo $totalCourses; ?></h3><p>Total Courses</p></div>
        <div class="stat-card"><h3><?php echo $totalEnrollments; ?></h3><p>Total Enrollments</p></div>
        <div class="stat-card"><h3>₹<?php echo number_format($totalRevenue); ?></h3><p>Revenue</p></div>
    </div>
    
    <div style="margin:2rem 0">
        <a href="manage-courses.php" class="btn-primary">📚 Manage Courses</a>
        <a href="manage-students.php" class="btn-primary">👨‍🎓 Manage Students</a>
        <a href="manage-enrollments.php" class="btn-primary">📋 Enrollments</a>
        <a href="logout.php" class="btn-secondary">🚪 Logout</a>
    </div>
    
    <h2>Recent Enrollments</h2>
    <table class="admin-table">
        <tr><th>Student</th><th>Course</th><th>Date</th><th>Status</th></tr>
        <?php while($row = $recentEnrollments->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['student_name']; ?></td>
            <td><?php echo $row['course_title']; ?></td>
            <td><?php echo date('d M Y', strtotime($row['enrolled_at'])); ?></td>
            <td><?php echo ucfirst($row['status']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>