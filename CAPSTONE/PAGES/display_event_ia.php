<?php
session_start();

// Check if the user is logged in and get their email from the session
if (isset($_SESSION['user_email'])) {
    $user_email = $_SESSION['user_email'];

    require 'database_connection.php';

    $display_query = "SELECT event_id, date, end_date, start_time, end_time, location, activity 
                        FROM calendar_event 
                        WHERE user_email = '$user_email'";

    $results = mysqli_query($con, $display_query);
    $count = mysqli_num_rows($results);
    if ($count > 0) {
        $data_arr = array();
        $i = 1;
        while ($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
            $data_arr[$i]['event_id'] = $data_row['event_id'];
            $data_arr[$i]['title'] = $data_row['activity'];
            $data_arr[$i]['start'] = date("Y-m-d", strtotime($data_row['date']));
            $data_arr[$i]['end'] = date("Y-m-d", strtotime($data_row['end_date']));
            $data_arr[$i]['color'] = '#FC6A03';
            $data_arr[$i]['url'] = '';
            $data_arr[$i]['start_time'] = $data_row['start_time'];
            $data_arr[$i]['end_time'] = $data_row['end_time'];
            $data_arr[$i]['location'] = $data_row['location'];
            $i++;
        }

        $data = array(
            'status' => true,
            'msg' => 'successfully!',
            'data' => $data_arr
        );
    } else {
        $data = array(
            'status' => false,
            'msg' => 'No events found for this user'
        );
    }
    echo json_encode($data);
} else {
    header("Location: index.php"); // Redirect to your login page
    exit();
}
?>
