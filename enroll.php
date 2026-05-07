<?php include 'config/database.php';
if(!isLoggedIn()) header("Location: login.php");

$course_id = $_GET['course_id'];
$student_id = $_SESSION['user_id'];

// Check if already enrolled
$check = $conn->query("SELECT * FROM enrollments WHERE student_id=$student_id AND course_id=$course_id");
if($check->num_rows == 0) {
    $conn->query("INSERT INTO enrollments (student_id, course_id) VALUES ($student_id, $course_id)");
    $_SESSION['success'] = "Successfully enrolled in course!";
}

header("Location: my-courses.php");
?>