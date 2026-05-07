 
<?php include 'config/database.php'; ?>
<?php include 'includes/header.php'; ?>

<section class="hero">
    <div class="hero-content">
        <h1>Transform Your <span class="highlight">Career</span> with Expert Guidance</h1>
        <p>Learn from India's top educators • Live Classes • Recorded Lectures • Test Series • Certificate</p>
        <a href="courses.php" class="btn-primary">Explore Courses →</a>
        <a href="signup.php" class="btn-secondary">Start Free Trial</a>
    </div>
</section>

<section class="features">
    <h2>Why Choose <span style="color:#6c63ff">Shikhar Shiksha</span>?</h2>
    <div class="features-grid">
        <div class="feature-card">
            <i class="fas fa-chalkboard-teacher"></i>
            <h3>Expert Faculty</h3>
            <p>IIT/NIT alumni with 10+ years experience</p>
        </div>
        <div class="feature-card">
            <i class="fas fa-video"></i>
            <h3>Live + Recorded</h3>
            <p>24x7 access anytime, anywhere</p>
        </div>
        <div class="feature-card">
            <i class="fas fa-tasks"></i>
            <h3>Mock Tests</h3>
            <p>5000+ questions with real-time analysis</p>
        </div>
        <div class="feature-card">
            <i class="fas fa-certificate"></i>
            <h3>Certificate</h3>
            <p>Government recognized certificates</p>
        </div>
    </div>
</section>

<section class="courses-section">
    <h2 style="text-align:center">Featured <span style="color:#6c63ff">Courses</span></h2>
    <div class="courses-grid">
        <?php
        $result = $conn->query("SELECT * FROM courses WHERE featured=1 LIMIT 3");
        while($course = $result->fetch_assoc()):
        ?>
        <div class="course-card">
            <img src="uploads/<?php echo $course['image']; ?>" alt="<?php echo $course['title']; ?>">
            <div class="course-info">
                <h3><?php echo $course['title']; ?></h3>
                <p><?php echo substr($course['description'], 0, 100); ?>...</p>
                <div class="price">
                    ₹<?php echo $course['price']; ?>
                    <span class="original-price">₹<?php echo $course['original_price']; ?></span>
                </div>
                <a href="course-detail.php?id=<?php echo $course['id']; ?>" class="btn-enroll">View Details →</a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>