<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scheduler";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get parameters from the GET request after sanitizing them
$email = $conn->real_escape_string($_GET['email']);
$newStatus = $_GET['status'];

// Prepare and bind the UPDATE statement
$stmt = $conn->prepare("UPDATE user_form SET status = ? WHERE user_email = ?");
$stmt->bind_param("ss", $newStatus, $email);

// Execute the statement
if ($stmt->execute()) {
    echo "Status updated successfully";
} else {
    echo "Error updating status: " . $conn->error;
}

$stmt->close();
$conn->close();
?>