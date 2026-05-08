<?php
// RDS Database Configuration
$host = 'education-db.c3yas06kqp6r.ap-south-1.rds.amazonaws.com';  // सिर्फ यही endpoint
$user = 'admin';
$password = 'Prakash@123';  // ⚠️ अपना RDS password डालें
$dbname = 'education_db';
$port = 3306;

// SSL Certificate path
$ssl_ca = '/var/www/html/global-bundle.pem';

// Create connection with SSL
$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, $ssl_ca, NULL, NULL);

if (!mysqli_real_connect($conn, $host, $user, $password, $dbname, $port, NULL, MYSQLI_CLIENT_SSL)) {
    die("Connection failed: " . mysqli_connect_error());
}

$conn->set_charset("utf8mb4");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin';
}
?>
