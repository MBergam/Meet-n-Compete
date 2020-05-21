<?php
include 'header.php';

// get preference from event type select
if(isset($_GET["preferences"])){
    $_SESSION['preference']=$_GET["preferences"];
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
    //set the error code to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully<br>";
    printCarouselIndicators($conn);
    getEvents($conn);
}
catch (PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
$conn = null;
// Get list of event from events table
function getEvents($conn){
    if(!isset($_SESSION['preference']) || $_SESSION['preference'] == "all"){
        $stmt = $conn->query('SELECT `event_id`,`event_date`,`location`,`event_name`,`event_type`,`user_name` FROM `events` 
                              ORDER BY `event_date`, `event_start_time`');
    }else{
        $stmt = $conn->prepare('SELECT `event_id`,`event_date`,`location`,`event_name`,`event_type`,`user_name` FROM `events` 
                              WHERE event_type = ?
                              ORDER BY `event_date`, `event_start_time`');
        $stmt->bindValue(1,$_SESSION['preference'],PDO::PARAM_STR);
        $stmt->execute();
    }
    if($stmt->rowCount() > 0){
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $current_date = date("Y-m-d");
        $count_current = 0;
        foreach ($results as $row){
            if($current_date <= $row['event_date']){
                $count_current++;
                list($year, $month, $day) = explode("-", $row['event_date']);
                printEvent($row['event_id'], monthConvert($month), $day, $row['location'], $row['event_name'], $row['event_type'], $row['user_name'] );
            }
        }
        if($count_current == 0){
            printNoEventMessage();
        }
    }
    else {
        printNoEventMessage();
    }
}
//Print each of event to browser
function printEvent($event_id, $month, $day, $location, $event_name, $event_type, $user_name)
{   
    $url = "eventDetail.php?item=" . urlencode($event_id);
                        
    echo '<!-- layout each event !-->
    <div class="event-container">
        <div class="date-container">
            <p><span class="month">'.$month.'</span>
                <span class="day">'.$day.'</span></p>
        </div>
        <div class="detail">
            <h3>'.$event_name.'</h3>
            <h5>Type: '.$event_type.'</h5>
            <h4>Location: '.$location.'</h4>
            <p>Created by <a href="'.$user_name.'">'.$user_name.'</a></p>
            <form method = "post" action="my-events.php">
            <a href="'.$url.'" class="button">Learn More</a>
            <input type="submit" name="btnJoin" value="Join Event" class="button">
            <input type="hidden" name="hd_event_id" value="'. $event_id .'" />
            </form>
        </div>
    </div>';
}
function printCarouselIndicators($conn){
    echo'
    <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselIndicators" data-slide-to="1"></li>
        <li data-target="#carouselIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img src="img/basketball.jpg" alt="#">		
            </div>
            <div class="carousel-item">
                <img src="img/soccer.jpg" alt="#">
            </div>
            <div class="carousel-item">
                <img src="img/playbasketball.jpg" alt="#">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
    </div>

    <main id="content">
        <div class="title-container">
            <h1>Upcoming events</h1>
            <hr>
        </div>
        <div class="container" id="event-type-select">
            <form>
                <label for="preferences">Event types:</label>
                <select name="preferences" id="preferences" onchange="this.form.submit()">
                    ';
                    if($_SESSION['preference'] == "all" || !isset($_SESSION['preference'])){
                        echo'<option value="all" selected>All types</option>';
                    }
                    $results = getPreferences($conn);
                    foreach($results as $row){
                        if($row['preference'] == $_SESSION['preference']){
                            echo '<option value="'.$row['preference'].'" selected>'.$row['preference'].'</option>';
                        }else{
                            echo '<option value="'.$row['preference'].'">'.$row['preference'].'</option>';
                        }
                    }
                    echo'
                </select>
            </form>
        </div>
        <div class="f-container">
    ';
}
echo '
        </div>
    </main>';

include 'footer.php';
?>