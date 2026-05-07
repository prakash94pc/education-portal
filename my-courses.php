<?php include 'config/database.php';
if(!isLoggedIn()) header("Location: login.php");

$student_id = $_SESSION['user_id'];
$myCourses = $conn->query("
    SELECT e.*, c.title, c.description, c.image, c.duration 
    FROM enrollments e 
    JOIN courses c ON e.course_id = c.id 
    WHERE e.student_id = $student_id
    ORDER BY e.enrolled_at DESC
");
?>
<?php include 'includes/header.php'; ?>

<div class="dashboard-container">
    <h1>My <span style="color:#6c63ff">Courses</span></h1>
    
    <?php if($myCourses->num_rows == 0): ?>
        <p>You haven't enrolled in any courses yet. <a href="courses.php">Browse Courses</a></p>
    <?php else: ?>
        <div class="courses-grid">
            <?php while($course = $myCourses->fetch_assoc()): ?>
            <div class="course-card">
                <img src="uploads/<?php echo $course['image']; ?>" alt="<?php echo $course['title']; ?>">
                <div class="course-info">
                    <h3><?php echo $course['title']; ?></h3>
                    <p><?php echo substr($course['description'], 0, 100); ?>...</p>
                    <p><i class="fas fa-clock"></i> <?php echo $course['duration']; ?></p>
                    <p>Status: <span style="color:green"><?php echo ucfirst($course['status']); ?></span></p>
                    <a href="#" class="btn-enroll">Start Learning →</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>