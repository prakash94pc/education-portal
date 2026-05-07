<?php
// RDS Database Configuration with SSL
$host = 'education-db.c3yas06kqp6r.ap-south-1.rds.amazonaws.com';
$user = 'admin';
$password = 'Prakash@123';  // ← अपना actual password डालें
$dbname = 'education_db';
$port = 3306;

// Create connection with SSL
$conn = new mysqli();
$conn->ssl_set(null, null, '/var/www/html/global-bundle.pem', null, null);
$conn->real_connect($host, $user, $password, $dbname, $port, null, MYSQLI_CLIENT_SSL);

// Check connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Set charset
$conn->set_charset("utf8mb4");

// Start session
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin';
}
?>