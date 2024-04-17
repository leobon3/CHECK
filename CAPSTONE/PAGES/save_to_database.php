<?php
// Include your database connection code or config file if not already included
@include 'config.php';

// Establish database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "scheduler";

$conn = mysqli_connect($host, $username, $password, $database);

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $password = $_POST['password'];
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $user_type = $_POST['user_type'];
    $department = $_POST['department'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query to insert data into your database table
    $sql = "INSERT INTO user_form (name, user_email, password, position, user_type, department) VALUES ('$name', '$user_email', '$hashed_password', '$position', '$user_type', '$department')";

    if (mysqli_query($conn, $sql)) {
        // If the insertion was successful, echo 'success' back to the JavaScript function
        echo 'success';
    } else {
        // If there's an error, echo 'failure' or any other indicator back to the JavaScript function
        echo 'failure';
    }
} else {
    // If the request method is not POST, handle it accordingly
    echo "Invalid request";
}

// Close the database connection
mysqli_close($conn);
?>
