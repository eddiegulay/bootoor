<?php

$servername = "localhost";       // e.g., "localhost"
$username = "root";     // Your MySQL username
$password = "localhost";     // Your MySQL password
$dbname = "cash_db";             // Database name

// Create a new MySQLi instance
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    // It's a good practice not to expose sensitive error details to users
    die("Connection failed. Please try again later.");
}

// Optional: Set the character set to UTF-8 for better compatibility
if (!$conn->set_charset("utf8")) {
    error_log("Error loading character set utf8: " . $conn->error);
    // Handle the error as needed
}


?>
