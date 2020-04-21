<?php
session_start();
include 'header.php';
// get the id of event selected
if(isset($_GET['user_name']))
{
    $userID = $_GET['user_name'];
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
            </div>
            <!-- Loop list of current events -->
            <br>
            <h2>Current events:</h2>
            <hr>
    ';
}
//SELECT `event_id`,`event_date`,`location`,`event_name`,`event_type`,`event_description`,`user_name`,`event_start_time`,`event_duration` FROM `events` 
function getEvents($conn, $userID){
    
    $stmt = $conn->prepare('SELECT `event_id`,`event_date`,`location`,`event_name`,`event_type`,`event_description`,`user_name`,`event_start_time`,`event_duration`
                          FROM  `events`
                          WHERE user_name =?');
    $stmt->bindValue(1,$userID,PDO::PARAM_STR_CHAR);
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
        list($year, $month, $day) = explode("-", $row['event_date']);
        if($current_date < $row['event_date']){
            $count_current++;
            printCurrentEvent($row['event_id'], $row['event_date'], monthConvert($month), $day, $row['location'], $row['event_name'], 
                              $row['event_type'], $row['event_description'], $row['user_name'], $row['event_start_time'], $row['event_duration']);
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
                              $row['event_type'], $row['event_description'], $row['user_name'], $row['event_start_time'], $row['event_duration']);
        }
        //printCurrentEvent($row['event_id'], monthConvert($month), $day, $row['location'], $row['event_name'], 
        //$row['event_type'], $row['event_description'], $row['user_name'], $row['event_start_time'], $row['event_duration']);
    }
}
function printCurrentEvent($event_id, $event_date, $month, $day, $location, $event_name, $event_type, $event_description, $user_name, $event_start_time, $event_duration)
{
    $url = "eventDetail.php?item=" . urlencode($event_id);
    echo'
    <div class="row">
        <div class="col-md-6">
            <div class="detail-img"><img src="img/'.$event_type.'.jpg" alt=""></div>
        </div>
        <div class="col-md-6" id="eventDetail">
            <div class="event-container">
                <div class="date-container">
                    <p><span class="month">'.$month.'</span>-
                        <span class="day">'.$day.'</span></p>
                    <p><span class="month">'.$event_start_time.'</span>-
                        <span class="month">'.$event_duration.'&prime;</span></p>
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
                        <a href="'.$url.'" class="button button-small">View</a>
                        <button class="button button-small" data-toggle="modal" data-target="#editModal">Edit</button>
                        <button class="button button-small" data-toggle="modal" data-target="#deleteModal">Delete</button>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModal">Edit Event</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="#" id="createEventForm" method="post" name="createEventForm">
                                <h2 id="contact">'.$event_name.'</h2>
                                <hr>
                                <p id="createEvtLocation">'.$location.'</p>
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="sportText" data-toggle="dropdown">'.$event_type.'</button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                    <li role="presentation"><a role="menuitem" tabindex="-1">Baseball</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1">Basketball</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1">Billiards (Pool)</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1">Bowling</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1">Climbing</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1">Cricket</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1">Curling</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1">Football</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1">Golf/Discgolf</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1">Rugby</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1">Skateboarding</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1">Skiing </a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1">Snowboarding</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1">Soccer</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1">Swimming</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1">Tennis/Table Tennis</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1">Volleyball</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1">Weightlifting</a></li>
                                    </ul>
                                </div>
                                <p>Enter Time: <input type = "text" id ="evtTime" name="evtTime" placeholder="'.$event_start_time.'"></p>
                                <script>
                                    var j = jQuery.noConflict();
                                    j( function() {
                                        var dateToday = new Date();
                                        j( "#evtTime" ).timepicker({
                                            \'step\': 5,
                                            \'scrollDefault\': \'now\'
                                        });
                                    } );
                                </script>
                                <p>Enter Date: <input type = "text" id = "datepicker" placeholder="'.$event_date.'"></p>
                                <script>
                                    var j = jQuery.noConflict();
                                    j( function() {
                                        j( "#datepicker" ).datepicker({
                                            minDate: 0,
                                            maxDate: "+1m"
                                        });
                                    } );
                                </script>
                                <div class="slidecontainer">
                                    <p id="createEvtLength">Length: </p>
                                    <input type="range" min="15" max="120" value="30" class="slider" id="myRange">
                                </div>
                                <p id="sliderVal"></p>
                                <textarea id="desc" name="description" placeholder="Description (Optional)">'.$event_description.'</textarea>
                                <a href="javascript:%20check_empty()" id="submit">Edit</a>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete Event</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Do you want to delete the event '.$event_name.'</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Delete event</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    ';
}
function printPastEvent($event_id, $month, $day, $location, $event_name, $event_type, $event_description, $user_name, $event_start_time, $event_duration)
{
    $url = "eventDetail.php?item=" . urlencode($event_id);
    echo'
    <div class="row">
        <div class="col-md-6">
            <div class="detail-img"><img src="img/'.$event_type.'.jpg" alt=""></div>
        </div>
        <div class="col-md-6" id="eventDetail">
            <div class="event-container">
                <div class="date-container">
                    <p><span class="month">'.$month.'</span>-
                        <span class="day">'.$day.'</span></p>
                    <p><span class="month">'.$event_start_time.'</span>-
                        <span class="month">'.$event_duration.'&prime;</span></p>
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
                        <a href="'.$url.'" class="button">View</a>
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