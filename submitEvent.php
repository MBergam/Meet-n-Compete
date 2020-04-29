<?php

require 'config.php';

    //$event_id will be autoincremented in the database so no need to do anything with it here
    $event_marker_id = "";
    $event_date = "";
    $event_type = "";
    $event_description = "";
    $location = "";
    $event_name = "";
    $event_start_time = "";
    $event_duration = "";
    $user_name = $_SESSION['username']; //NOTE: I get an error when I am on register.php and am not logged in, not sure why but once you log in it goes away


if(isset($_POST['submitBtn'])){

    $event_marker_id = strip_tags($_POST['place_id']);//remove html tags
    $_SESSION['place_id'] = $event_marker_id;
    
    $event_date = strip_tags($_POST['datepickerToDB']);//remove html tags
    $_SESSION['datepickerToDB'] = $event_date;

    $event_type = strip_tags($_POST['sportTextToDB']);//remove html tags
    $_SESSION['sportTextToDB'] = $event_type;

    $event_description = strip_tags($_POST['description']);//remove html tags
    $_SESSION['description'] = $event_description;

    $location = strip_tags($_POST['createEvtLocationToDB']);//remove html tags
    $_SESSION['createEvtLocationToDB'] = $location;

    $event_name = strip_tags($_POST['eventName']);//remove html tags
    $_SESSION['eventName'] = $event_name;

    $event_start_time = strip_tags($_POST['evtTimeToDB']);//remove html tags
    $_SESSION['evtTimeToDB'] = $event_start_time;

    $event_duration = strip_tags($_POST['myRangeToDB']);//remove html tags
    $_SESSION['myRangeToDB'] = $event_duration;


    $query = mysqli_query($con, "insert into events values ('', '$event_marker_id', '$event_date', '$event_type', '$event_description', '$user_name', '$location', '$event_name', '$event_start_time', '$event_duration')");
    header("Location: Logged.php");

    $event_id = mysqli_query($con, "select event_id from events order by event_id desc limit 1"); //this gets the event_id of the newly created event so that the creator can be added as a user of their own event

    //$join_query = mysqli_query($con, "insert into event_users values ('$event_id', '$user_name')"); //add the creator of the event as a user of the event in the event_users table
}

$con->close();

