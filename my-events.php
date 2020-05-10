<?php
include 'header.php';
include 'common-functions.php';

$printNoEventMessage = true;// to print a message when there is no event to show
if(isset($_SESSION['username']))
{
    $userID = $_SESSION['username'];
}
else{
    header("Location: register.php");
}
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
    //set the error code to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    printCarouselIndicators();
    //echo "Connected successfully<br>";
    //echo "Event Selected: ". $itemSelected;
    //echo '<button onclick="history.go(-1);">Back</button>';
    getJointEvent($conn,$userID);
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
        $current_date = date("Y-m-d");
        $count_current = 0;
        $count_past = 0;
        foreach ($results as $row){
            list($year, $month, $day) = explode("-", $row['event_date']);
            if($current_date <= $row['event_date']){
                $count_current++;
                printCurrentEvent($conn, $row['event_id'], $row['event_date'], monthConvert($month), $day, $row['location'], $row['event_name'], 
                                $row['event_type'], $row['event_description'], $row['user_name'], $row['event_start_time'], $row['event_duration']);
            }
        }
        foreach ($results as $row){
            list($year, $month, $day) = explode("-", $row['event_date']);
            if($current_date > $row['event_date']){
                if($count_current == 0){ //print if there is no current events
                    $count_current++;    //increase current event number to make sure this message only show one times.
                    global $printNoEventMessage;
                    if($printNoEventMessage){
                        printNoEventMessage();
                        $printNoEventMessage = false;
                    }
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
        }
    }
    else {
        global $printNoEventMessage;
        if($printNoEventMessage){
            printNoEventMessage();
            $printNoEventMessage = false;
        }
    }
    
}
function getJointEvent($conn, $userID){
    
    $stmt = $conn->prepare('SELECT `event_id`,`user_name`,`event_join_date`
                          FROM  `event_users`
                          WHERE user_name =?');
    $stmt->bindValue(1,$userID,PDO::PARAM_STR_CHAR);
    $stmt->execute();
    if($stmt->rowCount() > 0){
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $row){
            getEvent($conn, $row['event_id']);
        }
    }
    else {
        global $printNoEventMessage;
        $printNoEventMessage = true;
    }
}
function getEvent($conn, $event_id){
    
    $stmt = $conn->prepare('SELECT `event_id`,`event_date`,`location`,`event_name`,`event_type`,`event_description`,`user_name`,`event_start_time`,`event_duration`
                          FROM  `events`
                          WHERE event_id =?');
    $stmt->bindValue(1,$event_id,PDO::PARAM_STR_CHAR);
    $stmt->execute();
    if($stmt->rowCount() ==1 ){
        $row = $stmt->fetch(PDO::FETCH_ASSOC); 
        $current_date = date("Y-m-d");
        list($year, $month, $day) = explode("-", $row['event_date']);
        if($current_date <= $row['event_date'] && $row['user_name'] != $_SESSION['username']){
            global $printNoEventMessage;
            $printNoEventMessage = false; // set flag to true to do not show the no event message
            printJoinEvents($row['event_id'], $row['event_date'], monthConvert($month), $day, $row['location'], $row['event_name'], 
                            $row['event_type'], $row['event_description'], $row['user_name'], $row['event_start_time'], $row['event_duration']);    
        }
    }
}


// Cancel Event handling
if(isset($_POST['btnCancelEvent'])){
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare('DELETE FROM `event_users` 
                                WHERE `event_id` = ?
                                AND `user_name` = ?');
        $stmt->bindValue(1,$_POST['hd_event_id'],PDO::PARAM_INT);
        $stmt->bindValue(2,$_SESSION['username'],PDO::PARAM_STR_CHAR);
        $stmt->execute();
    }
    catch (PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
    $location = 'Location: my-events.php';
    header($location);
    die();
}
// Delete Event handling
if(isset($_POST['btnDeleteEvent'])){
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare('DELETE FROM `events` 
                                WHERE `event_id` = ?');
        $stmt->bindValue(1,$_POST['hd_event_id'],PDO::PARAM_INT);
        $stmt->execute();
        $notification = new Notification($con, $userID);
        $notification->insertEventNotification($row['user_name'], "comment");
    }
    catch (PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
    $location = 'Location: my-events.php';
    header($location);
    die();
}
// Edit Event handling
if(isset($_POST['submitBtn'])){
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare('UPDATE `events` SET `event_date` = ?,`event_type` = ?, `event_description`= ?, 
                                        `event_start_time` = ?, `event_duration` = ?
                                WHERE `event_id` = ?');
        $stmt->bindValue(1,$_POST['datepicker'],PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST['preferences'],PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST['description'],PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST['evtTime'],PDO::PARAM_STR);
        $stmt->bindValue(5,$_POST['duration'],PDO::PARAM_INT);
        $stmt->bindValue(6,$_POST['hd_event_id'],PDO::PARAM_INT);
        $stmt->execute();
        $notification = new Notification($con, $userID);
        $rows = getJoinedMembers($conn, $_POST['hd_event_id']);
        foreach($rows as $row){
            $message = "The event " .$row['event_name']. " that you joined was edited";
            $notification->insertEventNotification($row['user_name'], $message);
        }
    }
    catch (PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
    $location = 'Location: my-events.php';
    header($location);
    die();
}
// Layout Joined Events
function printJoinEvents($event_id, $event_date, $month, $day, $location, $event_name, $event_type, $event_description, $user_name, $event_start_time, $event_duration)
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
                    <h3>'.$event_name.'</h3>
                    <h4>'.$location.'</h4>
                    <p>'.$event_description.'</p>
                    <h4>Members:</h4>
                    <a href="">User 1</a>
                    <a href="">User 2</a>
                    <a href="">User 3</a>
                    <div class="button-container">
                        <a href="'.$url.'" class="button button-small">View</a>
                        <button class="button button-small" data-toggle="modal" data-target="#cancelModal">Cancel</button>
                    </div>

                    <!-- Cancel Modal -->
                    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cancelModal">Cancel Event</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Do you want to cancel the event '.$event_name.'</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                
                                <form action="my-events.php" method="post">
                                    <input type="hidden" name="hd_event_id" value="'. $event_id .'" />
                                    <input type="submit" name="btnCancelEvent" value="Cancel Event" class="btn btn-primary">
                                </form>
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
// get All Preferences from database
function getPreferences($conn){
    $stmt = $conn->query('SELECT `preference` FROM `preferences`');
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}
// get joined members from event_id
function getJoinedMembers($conn, $event_id){
    $stmt = $conn->prepare('SELECT event_users.user_name, events.event_name FROM event_users INNER JOIN events
                            ON event_users.event_id = events.event_id
                            WHERE event_users.event_id = ?');
    $stmt->bindValue(1,$event_id,PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}
function printCurrentEvent($conn, $event_id, $event_date, $month, $day, $location, $event_name, $event_type, $event_description, $user_name, $event_start_time, $event_duration)
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
                    <h3>'.$event_name.'</h3>
                    <h4>Location: '.$location.'</h4>
                    <p>Create by <a href="">'.$user_name.'</a></p>
                    
                    <p>'.substr($event_description,0,100).'... <a href="'.$url.'">Read more</a></p>
                    <h4>Members:</h4>';
                    $rows = getJoinedMembers($conn, $event_id);
                    foreach($rows as $row){
                        echo '<a href="">'.$row['user_name'].'</a>';
                    }
                    echo '
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
                                <form action="my-events.php" id="createEventForm" method="post">
                                <h2 id="contact">'.$event_name.'</h2>
                                <hr>
                                <p id="createEvtLocation">'.$location.'</p>
                                <select name="preferences" id="preferences">';
                                    $results = getPreferences($conn);
                                    foreach($results as $row){
                                        if($row['preference'] == $event_type){
                                            echo '<option value="'.$row['preference'].'" selected>'.$row['preference'].'</option>';
                                        }else{
                                            echo '<option value="'.$row['preference'].'">'.$row['preference'].'</option>';
                                        }
                                    }
                                    echo '
                                </select>
                                <p>Enter Time: <input type = "text" id ="evtTime" name="evtTime" value="'.$event_start_time.'"></p>
                                <script>
                                    var j = jQuery.noConflict();
                                    j( function() {
                                        var dateToday = new Date();
                                        j( "#evtTime" ).timepicker({
                                            step: 15,
                                            \'scrollDefault\': \'now\',
                                            \'timeFormat\': \'H:i\',
                                        });
                                    } );
                                    
                                </script>
                                <p>Enter Date: <input type = "text" id = "datepicker" name="datepicker" value="'.$event_date.'"></p>
                                <script>
                                    var j = jQuery.noConflict();
                                    j( function() {
                                        j( "#datepicker" ).datepicker({
                                            minDate: 0,
                                            maxDate: "+1m",
                                            dateFormat: "yy-mm-dd"
                                        });
                                    } );
                                </script>
                                <div class="slidecontainer">
                                    <p id="createEvtLength">Length: </p>
                                    <input type="range" name="duration" min="15" max="120" value="'.$event_duration.'" class="slider" id="myRange">
                                </div>
                                <p id="sliderVal"></p>
                                <script>
                                    var slider = document.getElementById("myRange");
                                    var output = document.getElementById("sliderVal");
                                    output.innerHTML = slider.value + " minutes"; // Display the default slider value
                                    // Update the current slider value (each time you drag the slider handle)
                                    slider.oninput = function() {
                                        output.innerHTML = this.value + " minutes";
                                    }
                                </script>
                                <p style="margin:0">Description:</p>
                                <textarea id="desc" name="description" placeholder="Description (Optional)">'.$event_description.'</textarea>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="hidden" name="hd_event_id" value="'. $event_id .'" />
                                <input type="submit" name="submitBtn" value="Edit" class="btn btn-primary">
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

                                <form action="my-events.php" method="post">
                                    <input type="hidden" name="hd_event_id" value="'. $event_id .'" />
                                    <input type="submit" name="btnDeleteEvent" value="Delete Event" class="btn btn-primary">
                                </form>
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
                    <h3>'.$event_name.'</h3>
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

//for when a user clicks join event from upcoming events page
if (isset($_POST['btnJoin'])) {

    $user_name = $_SESSION['username'];
    $event_id = strip_tags($_POST['hd_event_id']);//remove html tags
    $event_join_date = date("Y-m-d"); //get current date

    $join_already_check = mysqli_query($con, "select * from event_users where user_name = '$user_name' and event_id = '$event_id'");
    $check_num_rows = mysqli_num_rows($join_already_check);
    if($check_num_rows > 0){

       //NOTE: may need to add code here to notify the user that they have already joined this event
    } else {
        $query = mysqli_query($con, "insert into event_users values('$event_id', '$user_name', '$event_join_date')");
    }

}
include 'footer.php';
?>