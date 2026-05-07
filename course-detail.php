<?php include 'config/database.php';
$course_id = $_GET['id'];
$course = $conn->query("SELECT * FROM courses WHERE id=$course_id")->fetch_assoc();

// Check if already enrolled
$isEnrolled = false;
if(isLoggedIn()) {
    $check = $conn->query("SELECT * FROM enrollments WHERE student_id={$_SESSION['user_id']} AND course_id=$course_id");
    $isEnrolled = $check->num_rows > 0;
}
?>
<?php include 'includes/header.php'; ?>

<div class="dashboard-container">
    <div style="display:flex; gap:2rem; flex-wrap:wrap">
        <div style="flex:1">
            <img src="uploads/<?php echo $course['image']; ?>" style="width:100%; border-radius:15px" alt="<?php echo $course['title']; ?>">
        </div>
        <div style="flex:1">
            <h1><?php echo $course['title']; ?></h1>
            <p><?php echo $course['description']; ?></p>
            <div class="price" style="font-size:2rem">
                ₹<?php echo $course['price']; ?>
                <span class="original-price">₹<?php echo $course['original_price']; ?></span>
            </div>
            <p><i class="fas fa-clock"></i> Duration: <?php echo $course['duration']; ?></p>
            <p><i class="fas fa-signal"></i> Level: <?php echo ucfirst($course['level']); ?></p>
            
            <?php if(!isLoggedIn()): ?>
                <a href="login.php" class="btn-primary">Login to Enroll</a>
            <?php elseif($isEnrolled): ?>
                <button class="btn-primary" disabled>Already Enrolled ✓</button>
            <?php else: ?>
                <a href="enroll.php?course_id=<?php echo $course_id; ?>" class="btn-primary">Enroll Now →</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>