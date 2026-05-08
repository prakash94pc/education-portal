<?php
// RDS Database Configuration with SSL
$host = 'mysql -h education-db.c3yas06kqp6r.ap-south-1.rds.amazonaws.com -P 3306 -u admin -p --ssl-mode=VERIFY_IDENTITY --ssl-ca=./global-bundle.pem';  // अपना RDS endpoint
$user = 'admin';                    // RDS username
$password = 'Prakash@123';        // RDS password
$dbname = 'education_db';
$port = 3306;

// SSL certificate path
$ssl_ca = '/var/www/html/global-bundle.pem';

// Create connection with SSL
$conn = mysqli_init();

// SSL options set करें
mysqli_ssl_set($conn, NULL, NULL, $ssl_ca, NULL, NULL);

// Connect with SSL
if (!mysqli_real_connect($conn, $host, $user, $password, $dbname, $port, NULL, MYSQLI_CLIENT_SSL)) {
    die("Connection failed: " . mysqli_connect_error());
}

// Verify SSL connection is active
if (mysqli_get_server_info($conn)) {
    // Optional: Check if SSL is actually used
    $ssl_status = mysqli_query($conn, "SHOW STATUS LIKE 'Ssl_cipher'");
    $ssl_row = mysqli_fetch_assoc($ssl_status);
    if ($ssl_row['Value']) {
        // SSL is working
    }
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
