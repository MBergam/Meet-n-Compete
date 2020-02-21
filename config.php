<?php
ob_start(); //Turns on output buffering
session_start();

$timezone = date_default_timezone_set("America/Chicago");
$con = mysqli_connect("localhost", "root","","meetncompete");

if(mysqli_connect_errno()){
    echo "Failed to connect DB: ".mysqli_connect_errno();
}

?>
