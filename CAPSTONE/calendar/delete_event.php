<?php
// Connect to your database (replace with your database configuration)
$hostname = "localhost";
$username = "root";
$password = "";  
$database = "scheduler";   

$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if event_id is provided via POST
if (isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];

    // SQL query to delete the event with the given event_id
    $sql = "DELETE FROM calendar_page WHERE event_id = $event_id";

    if ($conn->query($sql) === TRUE) {
        // Deletion was successful
        $response = array(
            'status' => true,
            'msg' => 'Event deleted successfully'
        );
    } else {
        // Error occurred during deletion
        $response = array(
            'status' => false,
            'msg' => 'Error: ' . $conn->error
        );
    }

    // Close the database connection
    $conn->close();

    // Send a JSON response back to your JavaScript code
    echo json_encode($response);
} else {
    // If event_id is not provided, return an error response
    $response = array(
        'status' => false,
        'msg' => 'Event ID not provided'
    );
    echo json_encode($response);
}
?>
