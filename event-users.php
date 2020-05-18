<?php
session_start();
include 'config.php';

////THIS IS THE DATABASE CREDENTIALS FOR WHOEVER USING PDO CONNECTING METHOD
$p_ini = parse_ini_file("config.ini",true);
$servername = $p_ini['Database']['servername'];
$username = $p_ini['Database']['username'];
$password = $p_ini['Database']['password'];
$database = $p_ini['Database']['database'];

$this_event_id = $_GET['event_id'];

$userID = $_GET['user_id'];

try{
    $conn = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
    //set the error code to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    findUsers($conn,$userID, $this_event_id);
}catch (PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
$conn = null;

function findUsers($conn, $userID, $this_event_id){
    $stmt = $conn->prepare('SELECT `event_id`,`user_name`
                        FROM  `event_users`
                        WHERE event_id = ? AND user_name = ?');
    $stmt->bindValue(1,$this_event_id,PDO::PARAM_INT);
    $stmt->bindValue(2, $userID, PDO::PARAM_STR_CHAR);
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
