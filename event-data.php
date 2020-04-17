<?php
require 'config.php';

$this_place_id = $_GET['place_id'];

$result = mysqli_query($con, "SELECT * FROM events WHERE event_marker_id = '$this_place_id'");

$data = array();
while ($row = mysqli_fetch_object($result))
{
    array_push($data, $row);
}

echo json_encode($data);
$con->close();