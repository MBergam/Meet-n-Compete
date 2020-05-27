<?php
ob_start(); //Turns on output buffering
$db = parse_ini_file("config.ini",true);
$servername = $db['Database']['servername'];
$database = $db['Database']['database'];
$DBusername = $db['Database']['username'];
$DBpassword = $db['Database']['password'];

// Set default timezone
date_default_timezone_set("America/Los_Angeles");

$con = mysqli_connect($servername, $DBusername,$DBpassword,$database);
//$con=mysqli_init();
//mysqli_real_connect($con, "meetncompete.mysql.database.azure.com", "mncadmin@meetncompete", "Mncteam2020!", "meetncompete", 3306);
if(mysqli_connect_errno()){
    echo "Failed to connect DB: ".mysqli_connect_errno();
}
