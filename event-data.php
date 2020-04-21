<?php
require 'config.php';

$this_place_id = $_GET['place_id'];
$seeEvents = $_GET['seeEvents'];

if($seeEvents != NULL){
    $result = mysqli_query($con, "SELECT `event_id`,`event_date`,`event_name` FROM events WHERE event_marker_id = '$this_place_id' AND event_date >= CURDATE()");
}else{
    $result = mysqli_query($con, "SELECT * FROM events WHERE event_marker_id = '$this_place_id' AND event_date >= CURDATE()");
}

$data = array();
while ($row = mysqli_fetch_object($result))
{
    array_push($data, $row);
}

echo json_encode($data);
$con->close();