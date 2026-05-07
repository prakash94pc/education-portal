<?php include '../config/database.php';
if(!isAdmin()) header("Location: login.php");

$id = $_GET['id'];
$conn->query("DELETE FROM enrollments WHERE course_id=$id");
$conn->query("DELETE FROM courses WHERE id=$id");

header("Location: manage-courses.php");
?>