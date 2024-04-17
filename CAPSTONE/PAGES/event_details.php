<?php
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    // Query the database to retrieve event details using $event_id
    // You can fetch event data and populate the form fields for editing.

    // Display event details and form for editing
    echo '<h3>Event Details</h3>';
    echo '<p>Event Name: ' . $event_name . '</p>';
    echo '<p>Event Date: ' . $date . '</p>';
    echo '<p>Event Time: ' . $start_time . '</p>';
    echo '<p>End Time: ' . $end_time . '</p>';
    echo '<p>Location: ' . $location . '</p>';
    echo '<p>Activity: ' . $activity . '</p>';
    // Create an edit form to allow users to update event details
    echo '<h3>Edit Event</h3>';
    echo '<form action="update_event.php" method="post">';
    echo '<input type="hidden" name="event_id" value="' . $event_id . '">';
    echo '<label for="event_name">Event Name:</label>';
    echo '<input type="text" name="event_name" value="' . $event_name . '">';
    echo '<label for="event_name">Start Time:</label>';
    echo '<input type="text" name="start_time" value="' . $start_time . '">';
    echo '<label for="event_name">End Time:</label>';
    echo '<input type="text" name="end_time" value="' . $end_time . '">';
    echo '<label for="event_name">Location:</label>';
    echo '<input type="text" name="location" value="' . $location . '">';
    echo '<label for="event_name">Activity:</label>';
    echo '<input type="text" name="activity" value="' . $activity . '">';
    // Add other form fields for editing...

    echo '<input type="submit" value="Save Changes">';
    echo '</form>';
} else {
    echo 'Event not found.';
}
?>
