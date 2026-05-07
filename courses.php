<?php include 'config/database.php'; ?>
<?php include 'includes/header.php'; ?>

<section class="courses-section">
    <h1 style="text-align:center">All <span style="color:#6c63ff">Courses</span></h1>
    
    <div class="courses-grid">
        <?php
        $result = $conn->query("SELECT * FROM courses ORDER BY featured DESC, id DESC");
        while($course = $result->fetch_assoc()):
        ?>
        <div class="course-card">
            <img src="uploads/<?php echo $course['image']; ?>" alt="<?php echo $course['title']; ?>">
            <div class="course-info">
                <h3><?php echo $course['title']; ?></h3>
                <p><?php echo substr($course['description'], 0, 120); ?>...</p>
                <div class="price">
                    ₹<?php echo $course['price']; ?>
                    <span class="original-price">₹<?php echo $course['original_price']; ?></span>
                </div>
                <p><i class="fas fa-clock"></i> <?php echo $course['duration']; ?></p>
                <a href="course-detail.php?id=<?php echo $course['id']; ?>" class="btn-enroll">View Details →</a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>