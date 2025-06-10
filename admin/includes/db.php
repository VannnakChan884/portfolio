<?php
// Database configuration
$host = 'localhost';         // usually 'localhost'
$dbname = 'portfolio_db';    // your database name
$user = 'root';      // your database username
$pass = '';      // your database password

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

// Optional: set charset to utf8
$conn->set_charset("utf8");
?>
