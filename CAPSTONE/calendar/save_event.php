<?php                
require 'database_connection.php'; 
$event_name = $_POST['event_name'];
$event_start_date = date("y-m-d", strtotime($_POST['event_start_date'])); 
$event_end_date = date("y-m-d", strtotime($_POST['event_end_date'])); 
$event_time = $_POST['event_time'];
$event_place = $_POST['event_place'];
$event_topic = $_POST['event_topic'];
			
$insert_query = "INSERT INTO `calendar_page`(`event_name`, `event_start_date`, `event_end_date`, `event_time`, `event_place`, `event_topic`) VALUES ('".$event_name."','".$event_start_date."','".$event_end_date."','".$event_time."','".$event_place."','".$event_topic."')";            
if(mysqli_query($con, $insert_query)){
	$data = array(
        'status' => true,
        'msg' => 'Event added successfully!'
    );
}
else
{
	$data = array(
        'status' => false,
        'msg' => 'Sorry, Event not added.'				
    );
}
echo json_encode($data);	
?>
