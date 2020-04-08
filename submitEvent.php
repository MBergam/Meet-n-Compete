<?php

require 'config.php';
//include 'Logged.php';



    //$event_id will be autoincremented in the database so no need to do anything with it here
    $event_marker_id = "";
    $event_time = "";
    $event_type = "";
    $event_description = "";
    $user_name = "";
    $location = "";
    $event_name = "";


if(isset($_POST['submitBtn'])){


    $event_marker_id = strip_tags($_POST['place_id']);//remove html tags
    //echo($event_marker_id);
    $_SESSION['place_id'] = $event_marker_id;
    
    $event_time = strip_tags($_POST['datepicker']);//remove html tags
    //echo($event_time);
    $_SESSION['datepicker'] = $event_time;

    //NOTE: will need to add a field to event table in db for event_time_of_day to store the start time for an event

    $event_type = strip_tags($_POST['sportText']);//remove html tags
    //echo($event_time);
    $_SESSION['sportText'] = $event_time;

    $event_description = strip_tags($_POST['description']);//remove html tags
    //echo($event_description);
    $_SESSION['description'] = $event_description;


    //--not sure how/where to get the user name--
    /*$user_name = strip_tags($_POST['']);//remove html tags
    //echo($user_name);
    $_SESSION[''] = $user_name;*/

    $location = strip_tags($_POST['createEvtLocation']);//remove html tags
    //echo($location);
    $_SESSION['createEvtLocation'] = $location;

    //THIS ONE WORKS, THE EVENT NAME IS ABLE TO BE GRABBED AND SENT TO DATABASE. ALL THE OTHER ONES DO NOT WORK
    $event_name = strip_tags($_POST['eventName']);//remove html tags
    //echo($event_name);
    $_SESSION['eventName'] = $event_name;


    $query = mysqli_query($con, "insert into events values ('', '$event_marker_id', '$event_time', '$event_type', '$event_description', ' $user_name', '$location', '$event_name')");

}

$con->close();
