<?php

require 'config.php';

    //$event_id
    /*$event_marker_id = $_POST['event_marker_id'];
    $event_time = $_POST['event_time'];
    $event_type = $_POST['event_type'];
    $event_description = $_POST['event_description'];
    $user_name = $_POST['user_name'];
    $location = $_POST['location'];
    $event_name = $_POST['event_name'];*/

    $event_marker_id = "";
    $event_time = "";
    $event_type = "";
    $event_description = "";
    $user_name = "";
    $location = "";
    $event_name = "test";


if(isset($_POST['submitBtn'])){

    /*$event_marker_id = strip_tags($_POST['reg_fname']);//remove html tags
    $fname = str_replace(' ','',$fname); //remove spaces
    $fname = ucfirst(strtolower($fname));
    $_SESSION['reg_fname'] = $fname;

    $event_time = strip_tags($_POST['evtTime']);//remove html tags
    $lname = str_replace(' ','',$lname); //remove spaces
    $lname = ucfirst(strtolower($lname));
    $_SESSION['reg_lname'] = $lname;

    $email = strip_tags($_POST['reg_email']);//remove html tags
    $email = str_replace(' ','',$email); //remove spaces
    $_SESSION['reg_email'] = $email;

    $username = strip_tags($_POST['reg_username']);
    $username = str_replace(' ', '',$username);
    $_SESSION['reg_username'] = $username;

    $password = strip_tags($_POST['reg_pass']);//remove html tags
    $_SESSION['reg_pass'] = $password;
    $password2 = strip_tags($_POST['reg_pass2']);//remove html tags
    $_SESSION['reg_pass2'] = $password2;

    $date = date("Y-m-d");*/

    //checkValidation($con, $fname, $lname, $username,$password,$password2,$email);

    //if(empty($error_array)){
        //$password = md5($password); //encrypt the password before sending to database

    //$query = mysqli_query($con,"insert into events values ('', '$fname', '$lname', '$username', '$email', '$password', '$date', '', '0', '0','0', 'no', ',')");
    $query = mysqli_query($con, "insert into events values ('', '9', '2020-08-04', 'Basketball', '', 'yeah', 'Spokane', '$event_name')");

}

$con->close();
