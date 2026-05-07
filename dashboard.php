<?php include 'config/database.php';
if(!isLoggedIn()) header("Location: login.php");

$student_id = $_SESSION['user_id'];

// Get enrolled courses count
$enrolledCount = $conn->query("SELECT COUNT(*) as total FROM enrollments WHERE student_id=$student_id")->fetch_assoc()['total'];

// Get completed courses count
$completedCount = $conn->query("SELECT COUNT(*) as total FROM enrollments WHERE student_id=$student_id AND status='completed'")->fetch_assoc()['total'];

// Get recent enrollments
$recentEnrollments = $conn->query("
    SELECT e.*, c.title, c.image FROM enrollments e 
    JOIN courses c ON e.course_id = c.id 
    WHERE e.student_id = $student_id 
    ORDER BY e.enrolled_at DESC LIMIT 5
");
?>
<?php include 'includes/header.php'; ?>

<div class="dashboard-container">
    <h1>Welcome back, <?php echo $_SESSION['user_name']; ?>! 🎓</h1>
    
    <div class="stats-grid">
        <div class="stat-card">
            <h3><?php echo $enrolledCount; ?></h3>
            <p>Enrolled Courses</p>
        </div>
        <div class="stat-card">
            <h3><?php echo $completedCount; ?></h3>
            <p>Completed Courses</p>
        </div>
        <div class="stat-card">
            <h3>★ 4.8</h3>
            <p>Average Rating</p>
        </div>
    </div>
    
    <h2>Your Recent Courses</h2>
    <div class="courses-grid">
        <?php while($enroll = $recentEnrollments->fetch_assoc()): ?>
        <div class="course-card">
            <img src="uploads/<?php echo $enroll['image']; ?>" alt="<?php echo $enroll['title']; ?>">
            <div class="course-info">
                <h3><?php echo $enroll['title']; ?></h3>
                <p>Status: <?php echo ucfirst($enroll['status']); ?></p>
                <p>Enrolled on: <?php echo date('d M Y', strtotime($enroll['enrolled_at'])); ?></p>
                <a href="course-detail.php?id=<?php echo $enroll['course_id']; ?>" class="btn-enroll">Continue Learning →</a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>