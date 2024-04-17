<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header('location: index.php');
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scheduler";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = $_POST["event_id"];
    $event_name = $_POST["event_name"];
    $date = $_POST["date"];
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];
    $location = $_POST["location"];
    $activity = $_POST["activity"];

    // Update the event in the database
    $sql = "UPDATE calendar_page SET event_name='$event_name', date='$date',start_time='$start_time', end_time='$end_time', location='$location', activity='$activity' WHERE event_id='$event_id'";

    if ($conn->query($sql) === true) {
        echo "Event updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <!-- Add your CSS styles here -->
</head>
<body>
    <h1>Edit Event</h1>
    <form method="post">
        <input type="hidden" name="event_id" value="<?php echo $_GET['event_id']; ?>">
        <label for="event_name">Event Name:</label>
        <input type="text" name="event_name" id="event_name" required><br>

        <label for="date">Event Start Date:</label>
        <input type="date" name="date" id="date" required><br>

        <label for="start_time">Event Start Time:</label>
        <input type="time" name="start_time" id="start_time" required><br>

        <label for="end_time">Event End Time:</label>
        <input type="time" name="end_time" id="end_time" required><br>

        <label for="location">Event Location:</label>
        <input type="text" name="location" id="location" required><br>

        <label for="activity">Event Activity:</label>
        <input type="text" name="activity" id="activity" required><br>

        <input type="submit" value="Update Event">
    </form>
</body>
</html>
