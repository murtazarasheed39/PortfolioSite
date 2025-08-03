<?php
$servername = "localhost";
$username = "root";
$password = ""; // adjust if you have a password
$dbname = "db.sql"; // adjust to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
