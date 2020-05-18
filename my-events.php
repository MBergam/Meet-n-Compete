<?php
include 'header.php';

$printNoEventMessage = true;// to print a message when there is no event to show
// Check for login to display this page
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
                          WHERE user_name =?
                          ORDER BY `event_date`, `event_start_time`');
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
                printPastEvent($conn, $row['event_id'], monthConvert($month), $day, $row['location'], $row['event_name'], 
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
            printJoinEvents($conn, $row['event_id'], $row['event_date'], monthConvert($month), $day, $row['location'], $row['event_name'], 
                            $row['event_type'], $row['event_description'], $row['user_name'], $row['event_start_time'], $row['event_duration']);    
        }
    }
}

// Leave Event handling
if(isset($_POST['btnLeaveEvent'])){
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare('DELETE FROM `event_users` 
                                WHERE `event_id` = ?
                                AND `user_name` = ?');
        $stmt->bindValue(1,$_POST['hd_event_id'],PDO::PARAM_INT);
        $stmt->bindValue(2,$_SESSION['username'],PDO::PARAM_STR_CHAR);
        $stmt->execute();
        // Notification handle
        $notification = new Notification($con, $userID);
        $rows = getJoinedMembers($conn, $_POST['hd_event_id']);
        
        //send notification to all member
        foreach($rows as $row){
            $message = "Member ".$userID." has left the event " .$row['event_name']. ".";
            $notification->insertEventNotification($row['user_name'], $message);
            sendEmail($row['email'],"Leaving Event",$message);
        }
        // send notification to creator of that event
        $message = "Member ".$userID." has left the event " .$row['event_name']. ".";
        $notification->insertEventNotification($row['creator'], $message);
        $email = getEmail($conn, $row['creator']);
        sendEmail($email,"Leaving Event",$message);
        // send notification to user that had left event
        $message = "You have left the event " .$_POST['hd_event_name']. ".";
        $notification->insertEventNotification($userID, $message);
        $email = getEmail($conn, $userID);
        sendEmail($email,"Leaving Event",$message);
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
        
        // Notification handle
        $notification = new Notification($con, $userID);
        $rows = getJoinedMembers($conn, $_POST['hd_event_id']);
        //send notification to all member
        foreach($rows as $row){
            $message = "The event " .$row['event_name']. " that you joined was deleted.";
            $notification->insertEventNotification($row['user_name'], $message);
            sendEmail($row['email'],"Deleting Event",$message);
        }
        // send notification to creator
        $message = "You had deleted the event " .$_POST['hd_event_name']. ".";
        $notification->insertEventNotification($userID, $message);
        $email = getEmail($conn, $row['creator']);
        
        sendEmail($email,"Deleting Event",$message);

        $stmt = $conn->prepare('DELETE FROM `events` 
                                WHERE `event_id` = ?');
        $stmt->bindValue(1,$_POST['hd_event_id'],PDO::PARAM_INT);
        $stmt->execute();

        $stmt2 = $conn->prepare('DELETE FROM `event_users` 
                                WHERE `event_id` = ?');
        $stmt2->bindValue(1,$_POST['hd_event_id'],PDO::PARAM_INT);
        $stmt2->execute();
        
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
        $stmt->bindValue(1,$_POST['datepickerToDB'],PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST['preferences'],PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST['description'],PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST['evtTimeToDB'],PDO::PARAM_STR);
        $stmt->bindValue(5,$_POST['duration'],PDO::PARAM_INT);
        $stmt->bindValue(6,$_POST['hd_event_id'],PDO::PARAM_INT);
        $stmt->execute();
        // Notification handle
        $notification = new Notification($con, $userID);
        $rows = getJoinedMembers($conn, $_POST['hd_event_id']);
        //send notification to all member
        foreach($rows as $row){
            $message = "The event " .$row['event_name']. " that you joined was edited.";
            $notification->insertEventNotification($row['user_name'], $message);
            sendEmail($row['email'],"Editing Event",$message);
        }
        // send notification to creator
        $message = "You had edited the event " .$_POST['hd_event_name']. ".";
        $notification->insertEventNotification($userID, $message);
        
        $email = getEmail($conn, $row['creator']);
        sendEmail($email,"Editing Event",$message);
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
function printJoinEvents($conn, $event_id, $event_date, $month, $day, $location, $event_name, $event_type, $event_description, $user_name, $event_start_time, $event_duration)
{
    $url = "eventDetail.php?item=" . urlencode($event_id);
    $event_start_time = date("g:ia", strtotime($event_start_time));
    echo'
    <div class="row">
        <div class="col-md-6">
            <div class="detail-img"><img src="img/'.strtolower($event_type).'.jpg" alt=""></div>
        </div>
        <div class="col-md-6" id="eventDetail">
            <div class="event-container">
                <div class="date-container">
                    <p><span class="month">'.$month.'</span>-
                        <span class="day">'.$day.'</span></p>
                    <p><span class="month">'.$event_start_time.'</span>-
                        <span class="month">'.$event_duration.' min</span></p>
                </div>

                <div class="detail">
                    <h3>'.$event_name.'</h3>
                    <h5>Type: '.$event_type.'</h5>
                    <h4>Location: '.$location.'</h4>
                    <p>Created by <a href="'.$user_name.'">'.$user_name.'</a></p>
                    '; 
                    if(strlen($event_description) > 100){
                        echo '<p>Description: '.substr($event_description,0,50).'... <a href="'.$url.'">Read more</a></p>';
                    }else{
                        echo '<p>Description: '.$event_description.'</p>';
                    }
                    
                    $rows = getJoinedMembers($conn, $event_id);
                    echo'
                    <h4>Members('.sizeof($rows).'):</h4>';
                    if(sizeof($rows)==0){
                        echo 'None';
                    }else{
                        foreach($rows as $row){
                            echo '<a href="'.$row['user_name'].'" class="margin-right">'.$row['user_name'].'</a>';
                        }
                    }
                    echo '
                    <div class="button-container">
                        <a href="'.$url.'" class="button button-small">View</a>
                        <button class="button button-small" data-toggle="modal" data-target="#leaveModal'.$event_id.'">Leave</button>
                    </div>

                    <!-- Leave Modal -->
                    <div class="modal fade" id="leaveModal'.$event_id.'" tabindex="-1" role="dialog" aria-labelledby="leaveModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="leaveModal">Leave Event</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Do you want to leave the event <span class="capitalize">'.$event_name.'</span></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                
                                <form action="my-events.php" method="post">
                                    <input type="hidden" name="hd_event_id" value="'. $event_id .'" />
                                    <input type="hidden" name="hd_event_name" value="'. $event_name .'" />
                                    <input type="submit" name="btnLeaveEvent" value="Leave Event" class="btn btn-primary">
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

function printCurrentEvent($conn, $event_id, $event_date, $month, $day, $location, $event_name, $event_type, $event_description, $user_name, $event_start_time, $event_duration)
{            
    $url = "eventDetail.php?item=" . urlencode($event_id);
    $event_start_time = date("g:ia", strtotime($event_start_time));
    echo'
    <div class="row">
        <div class="col-md-6">
            <div class="detail-img"><img src="img/'.strtolower($event_type).'.jpg" alt=""></div>
        </div>
        <div class="col-md-6" id="eventDetail">
            <div class="event-container">
                <div class="date-container">
                    <p><span class="month">'.$month.'</span>-
                        <span class="day">'.$day.'</span></p>
                    
                    <p><span class="month">'.$event_start_time.'</span>-
                        <span class="month">'.$event_duration.' min</span></p>
                </div>

                <div class="detail">
                    <h3>'.$event_name.'</h3>
                    <h5>Type: '.$event_type.'</h5>
                    <h4>Location: '.$location.'</h4>
                    <p>Created by <a href="'.$user_name.'">'.$user_name.'</a></p>
                    '; 
                    if(strlen($event_description) > 100){
                        echo '<p>Description: '.substr($event_description,0,50).'... <a href="'.$url.'">Read more</a></p>';
                    }else{
                        echo '<p>Description: '.$event_description.'</p>';
                    }
                    
                    $rows = getJoinedMembers($conn, $event_id);
                    echo'
                    <h4>Members('.sizeof($rows).'):</h4>';
                    if(sizeof($rows)==0){
                        echo 'None';
                    }else{
                        foreach($rows as $row){
                            echo '<a href="'.$row['user_name'].'" class="margin-right">'.$row['user_name'].'</a>';
                        }
                    }
                    echo '
                    <div class="button-container">
                        <a href="'.$url.'" class="button button-small">View</a>
                        <button class="button button-small" data-toggle="modal" data-target="#editModal'.$event_id.'">Edit</button>
                        <button class="button button-small" data-toggle="modal" data-target="#deleteModal'.$event_id.'">Delete</button>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal'.$event_id.'" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModal">Edit Event</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body center-align">
                                <form action="my-events.php" id="createEventForm" method="post">
                                <h2 id="contact" class="capitalize">'.$event_name.'</h2>
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
                                <input type="hidden" name="evtTimeToDB" id="evtTimeToDB'.$event_id.'" value=""></input>
                                <p id="eventTime">Enter Time: <input type = "text" id ="evtTime'.$event_id.'" name="evtTime" value="'.$event_start_time.'"></p>
                                <script>
                                    var j = jQuery.noConflict();
                                    j( function() {
                                        var dateToday = new Date();
                                        j( "#evtTime'.$event_id.'" ).timepicker({
                                            step: 5,
                                            \'scrollDefault\': \'now\'
                                        });
                                    } );
                                   
                                </script>
                                <input type="hidden" name="datepickerToDB" id="datepickerToDB'.$event_id.'" value=""></input>
                                <p id="eventDate">Enter Date: <input type = "text" id = "datepicker'.$event_id.'" name="datepicker" value="'.$event_date.'"></p>
                                <script>
                                    var j = jQuery.noConflict();
                                    j( function() {
                                        j( "#datepicker'.$event_id.'" ).datepicker({
                                            minDate: 0,
                                            maxDate: "+1m"
                                        });
                                    } );
                                </script>
                                <div class="slidecontainer">
                                    <p id="createEvtLength">Length: </p>
                                    <input type="range" name="duration" min="15" max="120" value="'.$event_duration.'" class="slider" id="myRange'.$event_id.'">
                                </div>
                                <p id="sliderVal'.$event_id.'"></p>
                                <script>
                                    var slider = document.getElementById("myRange'.$event_id.'");
                                    var output = document.getElementById("sliderVal'.$event_id.'");
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
                                <input type="hidden" name="hd_event_name" value="'. $event_name .'" />
                                <script>
                                function validateEdit(event_id){
                                    //remove all other errors if they have occured before (errors will show after this, this just makes it so that the errors arent displayed multiple times)
                                    $(".editEventError").remove();
                                    var returnValue = true;
                                    var correctDate = false;

                                    //this checks to see if the date input is a correct date. If not, an error is displayed to the user in html.
                                    var date = moment(document.getElementById("datepicker"+event_id).value).format("YYYY-MM-DD");
                                    if(date == "Invalid date" || !moment(date).isSameOrAfter(Date.now(), \'day\')){
                                        var dateError = document.createElement(\'p\');
                                        dateError.innerHTML = "Date incorrect. Enter a valid date";
                                        dateError.style = "color:red";
                                        dateError.id = "dateError";
                                        dateError.className = "editEventError";

                                        var eventDate = document.getElementById("eventDate");
                                        eventDate.appendChild(dateError);
                                        returnValue = false;
                                    }
                                    if(moment(date).isAfter(Date.now(), \'day\')){
                                        correctDate = true;
                                    }

                                    //this checks to see if the time input is a correct time. If not, an error is displayed to the user in html.
                                    if(!validEditTime(document.getElementById("evtTime"+event_id).value, correctDate)){
                                        var timeError = document.createElement(\'p\');
                                        timeError.innerHTML = "Time must be 15 min or later";
                                        timeError.style = "color:red";
                                        timeError.id = "timeError";
                                        timeError.className = "editEventError";

                                        var eventTime = document.getElementById("eventTime");
                                        eventTime.appendChild(timeError);
                                        returnValue = false;
                                    }

                                    return returnValue;
                                }

                                //Checks if the time is a valid time for creating an event -- is it 30 mins or later than the current time
                                function validEditTime(text, date){
                                    if(text.length == 6){
                                        if(text.substring(1,2) == ":" && (text.substring(4,6) == "pm" || text.substring(4,6) == "am")){
                                            if(isNumber(text.substring(0,1)) && isNumber(text.substring(2,4))){
                                                if(date){
                                                    return true;
                                                }
                                                var userInputTime = moment(text, \'h:mma\');
                                                var newDateObj = moment(new Date()).add(15, \'m\').toDate();
                                                var timeToCompare = moment(newDateObj.toLocaleString(\'en-US\', { hour: \'numeric\', minute: \'numeric\', hour12: true }), \'h:mma\');

                                                if(userInputTime.isAfter(timeToCompare)){
                                                    return true;
                                                }
                                            }
                                        }
                                    }
                                    if(text.length == 7){
                                        if(text.substring(2,3) == ":" && (text.substring(5,7) == "pm" || text.substring(5,7) == "am")){
                                            if(isNumber(text.substring(0,2)) && isNumber(text.substring(3,5))){
                                                if(date){
                                                    return true;
                                                }
                                                var userInputTime = moment(text, \'h:mma\');
                                                var newDateObj = moment(new Date()).add(15, \'m\').toDate();
                                                var timeToCompare = moment(newDateObj.toLocaleString(\'en-US\', { hour: \'numeric\', minute: \'numeric\', hour12: true }), \'h:mma\');

                                                if(userInputTime.isAfter(timeToCompare)){
                                                    return true;
                                                }
                                            }
                                        }
                                    }
                                    return false;
                                }
                                function checkValues(event_id){
                                    //validateEdit shows what the user input needs to look like
                                    if(validateEdit(event_id)){
                                        //For sending event start time to db as 24hr time hh:mm
                                        
                                        var time = document.getElementById("evtTime"+event_id).value;
                                        if (time.includes("pm")) {
                                            if (time.length > 6) {//10pm or later
                                                var hour = (parseInt(time.substring(0,2))) + 12;
                                                //if hour is 24, then change it back to the original value (happens when time is 12 pm)
                                                if(hour >= 24){
                                                    hour -= 12;
                                                }
                                                var hourstring = hour.toString();
                                                var mins = time.substring(2,5);
                                                time = hourstring + mins
                                            } else {//earlier than 10pm
                                                var hour = (parseInt(time.substring(0,1))) + 12;
                                                var hourstring = hour.toString();
                                                var mins = time.substring(1,4);
                                                time = hourstring + mins
                                            }
                                        } else { //any AM time
                                            var hour = (parseInt(time.substring(0,2)));
                                            if(hour == 12){
                                                hour -= 12;
                                            }
                                            var hourstring = hour.toString();
                                            var mins = time.substring(2,5);
                                            time = hourstring + mins
                                        }

                                        document.getElementById("evtTimeToDB"+event_id).value = time 
                                        document.getElementById("datepickerToDB"+event_id).value = moment(document.getElementById("datepicker"+event_id).value).format("YYYY-MM-DD"); //for sending event date to db

                                        //submit the event data to the database. To do so, the submit button must be type of submit now.
                                        let sendBtn = document.getElementById("editBtn");
                                        sendBtn.type = "submit";

                                        //click the button to send data off to database
                                        sendBtn.click();
                                    }
                                }
                               
                                </script>
                                <input onclick="checkValues('.$event_id.')" name="submitBtn" id="editBtn" value="Edit" class="btn btn-primary">
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal'.$event_id.'" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete Event</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Do you want to delete the event <span class="capitalize">'.$event_name.'</span></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                <form action="my-events.php" method="post">
                                    <input type="hidden" name="hd_event_id" value="'. $event_id .'" />
                                    <input type="hidden" name="hd_event_name" value="'. $event_name .'" />
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
function printPastEvent($conn, $event_id, $month, $day, $location, $event_name, $event_type, $event_description, $user_name, $event_start_time, $event_duration)
{
    $url = "eventDetail.php?item=" . urlencode($event_id);
    $event_start_time = date("g:ia", strtotime($event_start_time));
    echo'
    <div class="row">
        <div class="col-md-6">
            <div class="detail-img"><img src="img/'.strtolower($event_type).'.jpg" alt=""></div>
        </div>
        <div class="col-md-6" id="eventDetail">
            <div class="event-container">
                <div class="date-container">
                    <p><span class="month">'.$month.'</span>-
                        <span class="day">'.$day.'</span></p>
                    <p><span class="month">'.$event_start_time.'</span>-
                        <span class="month">'.$event_duration.' min</span></p>
                </div>

                <div class="detail">
                    <h3>'.$event_name.'</h3>
                    <h5>Type: '.$event_type.'</h5>
                    <h4>Location: '.$location.'</h4>
                    <p>Created by <a href="'.$user_name.'">'.$user_name.'</a></p>
                    '; 
                    if(strlen($event_description) > 100){
                        echo '<p>Description: '.substr($event_description,0,50).'... <a href="'.$url.'">Read more</a></p>';
                    }else{
                        echo '<p>Description: '.$event_description.'</p>';
                    }

                    $rows = getJoinedMembers($conn, $event_id);
                    echo'
                    <h4>Members('.sizeof($rows).'):</h4>';
                    if(sizeof($rows)==0){
                        echo 'None';
                    }else{
                        foreach($rows as $row){
                            echo '<a href="'.$row['user_name'].'" class="margin-right">'.$row['user_name'].'</a>';
                        }
                    }
                    echo '
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

//for when a user clicks join event from upcoming events page or from home page
if (isset($_POST['btnJoin'])) {

    $user_name = $_SESSION['username'];
    $event_id = strip_tags($_POST['hd_event_id']);//remove html tags
    $event_join_date = date("Y-m-d"); //get current date

    $join_already_check = mysqli_query($con, "select * from event_users where user_name = '$user_name' and event_id = '$event_id'");
    $creator_check = mysqli_query($con, "select * from events where user_name = '$user_name' and event_id = '$event_id'");
    $check_num_rows = mysqli_num_rows($join_already_check);
    $creator_check_num_rows = mysqli_num_rows($creator_check);
    if($check_num_rows > 0){
       // notify the user that they have already joined this event
       //echo '<script>alert("You already joined this event!!!");</script>'; 
       echo '<div id="promptAccountPopup">
                <!-- Popup Div Starts Here -->
                <div id="popupAccount">
                    <form action="#" id="createEventForm" method="post" name="createEventForm">
                    <a class="boxclose" id="boxclose" onclick= "div_hide()"></a>
                    <p id="promptForAccount"></p>
                    </form>
                </div>
            </div>
            <!-- Popup Div Ends Here -->
            <script>
            document.getElementById(\'promptAccountPopup\').style.display = "block";
            document.getElementById(\'promptForAccount\').innerHTML = "<b>You already joined this event!</b>";</script>';
    }else if ($creator_check_num_rows > 0){
        // notify the user that they are creators of this event
        echo '<div id="promptAccountPopup">
                <!-- Popup Div Starts Here -->
                <div id="popupAccount">
                    <form action="#" id="createEventForm" method="post" name="createEventForm">
                    <a class="boxclose" id="boxclose" onclick= "div_hide()"></a>
                    <p id="promptForAccount"></p>
                    </form>
                </div>
            </div>
            <!-- Popup Div Ends Here -->
            <script>
            document.getElementById(\'promptAccountPopup\').style.display = "block";
            document.getElementById(\'promptForAccount\').innerHTML = "<b>You cannot join an event that was created by you!</b>";</script>';
    } else {
        $query = mysqli_query($con, "insert into event_users values('$event_id', '$user_name', '$event_join_date')");
        // Redirect to my-events.php page
        $location = 'Location: my-events.php';
        header($location);
        die();
    }

}

include 'footer.php';
?>