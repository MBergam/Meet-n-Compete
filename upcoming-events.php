<?php
include 'header.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
    //set the error code to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully<br>";
    printCarouselIndicators();
    getEvents($conn);
}
catch (PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
$conn = null;

//SELECT `event_id`,`event_time`,`location`,`event_name` FROM `events` 
function getEvents($conn){

    $stmt = $conn->query('SELECT `event_id`,`event_date`,`location`,`event_name` FROM `events`');
    if($stmt->rowCount() > 0){
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else {
        $results = null;
    }
    foreach ($results as $row){
        list($year, $month, $day) = explode("-", $row['event_date']);
        printEvent($row['event_id'], monthConvert($month), $day, $row['location'], $row['event_name']);
    }
}
function monthConvert($month){
    switch ($month){
        case 1:
            return "Jan";
            break;
        case 2:
            return "Feb";
            break;
        case 3:
            return "Mar";
            break;
        case 4:
            return "Apr";
            break;
        case 5:
            return "May";
            break;
        case 6:
            return "Jun";
            break;
        case 7:
            return "Jul";
            break;
        case 8:
            return "Aug";
            break;
        case 9:
            return "Sep";
            break;
        case 10:
            return "Oct";
            break;
        case 11:
            return "Nov";
            break;
        case 12:
            return "Dec";
            break;
        default:
    }
}
function printEvent($event_id, $month, $day, $location, $event_name)
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
            <h4>'.$location.'</h4>
            <a href="'.$url.'" class="button">Learn More</a>
            <form method = "post" action="my-events.php">
            <input type="submit" name="btnJoin" value="Join Event" class="button">
            <input type="hidden" name="hd_event_id" value="'. $event_id .'" />
            </form>
        </div>
    </div>';
}
function printCarouselIndicators(){
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
        <div class="f-container">
    ';
}
echo '
        </div>
    </main>';

include 'footer.php';
?>