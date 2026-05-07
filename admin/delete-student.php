<?php include '../config/database.php';
if(!isAdmin()) header("Location: login.php");

$id = $_GET['id'];
$conn->query("DELETE FROM users WHERE id=$id AND role='student'");
header("Location: manage-students.php");
?>