<?php                
require 'database_connection.php'; 
$display_query = "SELECT event_id, event_name, event_start_date, event_end_date, event_time, event_place, event_topic FROM calendar_page";           

$results = mysqli_query($con,$display_query);   
$count = mysqli_num_rows($results);  
if($count>0) 
{
	$data_arr=array();
    $i=1;
	while($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC))
	{	
	$data_arr[$i]['event_id'] = $data_row['event_id'];
	$data_arr[$i]['title'] = $data_row['event_name'];
	$data_arr[$i]['start'] = date("Y-m-d", strtotime($data_row['event_start_date']));
	$data_arr[$i]['end'] = date("Y-m-d", strtotime($data_row['event_end_date']));
	$data_arr[$i]['color'] = '#08f26e';
	$data_arr[$i]['url'] = '';
	$data_arr[$i]['event_time'] = $data_row['event_time'];
    $data_arr[$i]['event_place'] = $data_row['event_place'];
    $data_arr[$i]['event_topic'] = $data_row['event_topic'];
	$i++;
	}
	
	$data = array(
        'status' => true,
        'msg' => 'successfully!',
		'data' => $data_arr
    );
}
else
{
	$data = array(
                'status' => false,
                'msg' => 'Error!'				
            );
}
echo json_encode($data);
?>
