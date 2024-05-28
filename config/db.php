<?php
$dbHost = 'localhost';
$username = 'root';
$password = '';
$database = 'contact_system';

$conn = new mysqli($dbHost, $username, $password, $database);

if ($conn->connect_error) {
    die("Error connecting: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'users' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS contacts (
    contact_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    company VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'contacts' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

?>