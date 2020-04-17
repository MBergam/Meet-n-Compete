<?php
//session_start();
include 'header.php';
// get the id of event selected
if(isset($_GET['user_id']))
{
    $userID = $_GET['user_id'];
} else {
    // For testing only
    $userID = 1;
}
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
    //set the error code to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    printCarouselIndicators();
    //echo "Connected successfully<br>";
    //echo "Event Selected: ". $itemSelected;
    //echo '<button onclick="history.go(-1);">Back</button>';
    getEvents($conn,$userID);
}
catch (PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
$conn = null;
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
        <div class="container">
            <div class="title-container">
                <h1>My events</h1>
                <hr>
                <a class="button" href="">Create Event</a>
            </div>
            <!-- Loop list of current events -->
            <br>
            <h2>Current events:</h2>
            <hr>
    ';
}
//SELECT `event_id`,`event_time`,`location`,`event_name`,`event_type`,`event_description`,`user_id`,`ImgFullSize`,`Start`,`End` FROM `events` 
function getEvents($conn, $userID){
    
    $stmt = $conn->prepare('SELECT `event_id`,`event_time`,`location`,`event_name`,`event_type`,`event_description`,`user_id`,`ImgFullSize`,`Start`,`End`
                          FROM  `events`
                          WHERE user_id =?');
    $stmt->bindValue(1,$userID,PDO::PARAM_INT);
    $stmt->execute();
    if($stmt->rowCount() > 0){
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else {
        $results = null;
    }
    $current_date = date("Y-m-d");
    $count_current = 0;
    $count_past = 0;
    foreach ($results as $row){
        list($year, $month, $day) = explode("-", $row['event_time']);
        if($current_date < $row['event_time']){
            $count_current++;
            printCurrentEvent($row['event_id'], monthConvert($month), $day, $row['location'], $row['event_name'], 
                              $row['event_type'], $row['event_description'], $row['user_id'], $row['ImgFullSize'], $row['Start'], $row['End']);
        }
        else{
            if($count_current == 0){ //print if there is no current events
                echo'<p>There is no current event to show</p>';
            }
            if($count_past == 0){ //to print the title only one time
                echo'
                <h2>Past events:</h2>
                <hr>';
            }
            $count_past++;
            printPastEvent($row['event_id'], monthConvert($month), $day, $row['location'], $row['event_name'], 
                              $row['event_type'], $row['event_description'], $row['user_id'], $row['ImgFullSize'], $row['Start'], $row['End']);
        }
        //printCurrentEvent($row['event_id'], monthConvert($month), $day, $row['location'], $row['event_name'], 
        //$row['event_type'], $row['event_description'], $row['user_id'], $row['ImgFullSize'], $row['Start'], $row['End']);
    }
}
function printCurrentEvent($event_id, $month, $day, $location, $event_name, $event_type, $event_description, $user_id, $ImgFullSize, $Start, $End)
{
    echo'
    <div class="row">
        <div class="col-md-6">
            <img src="img/'.$ImgFullSize.'" alt="">
        </div>
        <div class="col-md-6" id="eventDetail">
            <div class="event-container">
                <div class="date-container">
                    <p><span class="month">'.$month.'</span>-
                        <span class="day">'.$day.'</span></p>
                    <p><span class="month">'.$Start.'</span>-
                        <span class="month">'.$End.'</span></p>
                </div>

                <div class="detail">
                    <h3>'.$event_type.'</h3>
                    <h4>'.$location.'</h4>
                    <p>'.$event_description.'</p>
                    <h4>Member:</h4>
                    <a href="">User 1</a>
                    <a href="">User 2</a>
                    <a href="">User 3</a>
                    <div class="button-container">
                        <button class="button button-small">View</button>
                        <button class="button button-small">Edit</button>
                        <button class="button button-small">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    ';
}
function printPastEvent($event_id, $month, $day, $location, $event_name, $event_type, $event_description, $user_id, $ImgFullSize, $Start, $End)
{
    echo'
    <div class="row">
        <div class="col-md-6">
            <img src="img/'.$ImgFullSize.'" alt="">
        </div>
        <div class="col-md-6" id="eventDetail">
            <div class="event-container">
                <div class="date-container">
                    <p><span class="month">'.$month.'</span>-
                        <span class="day">'.$day.'</span></p>
                    <p><span class="month">'.$Start.'</span>-
                        <span class="month">'.$End.'</span></p>
                </div>

                <div class="detail">
                    <h3>'.$event_type.'</h3>
                    <h4>'.$location.'</h4>
                    <p>'.$event_description.'</p>
                    <h4>Member:</h4>
                    <a href="">User 1</a>
                    <a href="">User 2</a>
                    <a href="">User 3</a>
                    <div class="button-container">
                        <button class="button">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    ';
}
echo '
        </div>
    </main>';
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
include 'footer.php';
?>