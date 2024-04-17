<?php

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Assuming you have a database connection established
    // Replace the following lines with your actual database connection code
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "scheduler";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve event_id from the POST data
    $event_id = $_POST['event_id'];

    // Perform the deletion
    $sql = "DELETE FROM calendar_page WHERE event_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);

    if ($stmt->execute()) {
        // Deletion successful
        $response = array('status' => true, 'msg' => 'Event deleted successfully');
    } else {
        // Deletion failed
        $response = array('status' => false, 'msg' => 'Error deleting event');
    }

    $stmt->close();
    $conn->close();

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} else {
    // If the request is not a POST request, return an error response
    $response = array('status' => false, 'msg' => 'Invalid request');
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

?>
