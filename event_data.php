<?php
session_start();
include 'config.php';

////THIS IS THE DATABASE CREDENTIALS FOR WHOEVER USING PDO CONNECTING METHOD
$p_ini = parse_ini_file("config.ini",true);
$servername = $p_ini['Database']['servername'];
$username = $p_ini['Database']['username'];
$password = $p_ini['Database']['password'];
$database = $p_ini['Database']['database'];

$this_place_id = $_GET['place_id'];
$seeEvents = $_GET['seeEvents'];

try{
    $conn = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
    //set the error code to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    findEvents($conn, $seeEvents, $this_place_id);
}catch (PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
$conn = null;

function findEvents($conn, $seeEvents, $this_place_id){
    $stmt = null;
    if($seeEvents != NULL){
        $stmt = $conn->prepare("SELECT `event_id`,`event_date`,`event_name`,`user_name`,`event_type` FROM events WHERE event_marker_id = ? AND event_date >= CURDATE()");
    }else{
        $stmt = $conn->prepare("SELECT * FROM events WHERE event_marker_id = ? AND event_date >= CURDATE()");
    }
    if($stmt != null){
        $stmt->bindValue(1, $this_place_id, PDO::PARAM_STR_CHAR);
        $stmt->execute();
        $data = array();
        if($stmt->rowCount() > 0){
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $row){
                array_push($data, $row);
            }
        }
        echo json_encode($data);
    }  
}