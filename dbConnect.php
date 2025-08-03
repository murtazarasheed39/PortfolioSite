<?php
// Database configuration
$host = 'localhost';        // Hostname
$dbname = 'portfolio_db';   // Database name (adjust if needed)
$username = 'root';         // MariaDB username (change if you've set one)
$password = '';             // MariaDB password (empty for default XAMPP)

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: set charset to utf8mb4
$conn->set_charset("utf8mb4");

// Success message (optional, can be removed in production)
echo "Connected successfully!";
?>
