<?php
include 'header.php';
include 'config.php';
include 'submitEvent.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $results = getPreferences($conn);
}
catch (PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
$conn = null;
?>
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
        <article id="search-bar">
            <form>
                <div class="text-box">
                    <i class="fas fa-search-location"></i>
                    <input type="text" id="location" name="location" placeholder="Enter a location" />
                </div>
                <a class="button" type="submit" id="search">Search</a>
            </form>
        </article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8" id="mInfo">
                    <div id="map"></div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-container">
                        <h2 class ="w3-light-grey">Preferences</h2>
                        <ul class="w3-card w3-light-grey w3-ul">
                            <?php
                                foreach($results as $row){
                                    echo '
                                    <li>
                                        <label class="label-container">'.$row['preference'].'
                                            <input type="checkbox" id="'.strtolower($row['preference']).'">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>';
                                }
                            ?>
                            <script>
                                $("#basketball").prop('checked', true);
                            </script>
                            <li>
                            Radius: <input type = "text" class = "allText" id = "radius" value="2" required minlength="1" maxlength="2" size="4" <p> miles</p>
                            </li>
                        </ul>
                    
                    </div>
                </div>
            </div>
        </div>
        
        <?php if(isset($_SESSION['username'])){ ?>
        <div id="createEvtPopup">
            <!-- Popup Div Starts Here -->
            <div class="popupContact" id="popupCreateEvt">
            <!-- Create New Event -->
            <form action="#" id="createEventForm" method="post" name="createEventForm">
            <a class="boxclose" id="createEvt_boxclose" onclick= "div_hide()"></a>
            <h2 id="contact">Create Event</h2>
            <hr>
            <input type="hidden" name="createEvtLocationToDB" id="createEvtLocationToDB" value="Event Location"></input>
            <p class="eventLocation" id="createEvtLocation">Event location</p>
            <div id="eventNameDiv">
            <textarea id="evtName" name="eventName" maxlength="22" placeholder="Event Name (Required)"></textarea>
            </div>
            <div class="dropdown" id="dropdownSports">
                <input type="hidden" name="sportTextToDB" id="sportTextToDB" value=""></input>
                <button class="btn btn-default dropdown-toggle" type="button" name="sportText" id="sportText" data-toggle="dropdown">Select Sport</button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                <?php
                    foreach($results as $row){
                        echo '<li role="presentation"><a role="menuitem" tabindex="-1">'.$row['preference'].'</a></li>';
                        echo '<li role="presentation" class="divider"></li>';
                    }
                ?>
                </ul>
            </div>
            <input type="hidden" name="evtTimeToDB" id="evtTimeToDB" value=""></input>
            <p id="eventTime">Enter Time: <input type = "text" id ="evtTime" name="evtTime"></p>
            <script>
                var j = jQuery.noConflict();
                j( function() {
                    var dateToday = new Date();
                    j( "#evtTime" ).timepicker({
                        'step': 5,
                        'scrollDefault': moment(new Date()).add(40, 'm').toDate()
                     });
                });
            </script>
            <input type="hidden" name="datepickerToDB" id="datepickerToDB" value=""></input>
            <p id="eventDate">Enter Date: <input type = "text" name = "datepicker" id = "datepicker"></p>
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
                <input type="hidden" name="myRangeToDB" id="myRangeToDB" value=""></input>
                <input type="range" min="15" max="120" value="30" class="slider" id="myRange">
            </div>
            <p id="sliderVal"></p>
            <textarea id="desc" name="description" placeholder="Description (Optional)"></textarea>
            <input name="submitBtn" id="submitBtn" value="Send">
            </form>
            </div>
        </div>
        <?php } ?>
        <div id="seeEventsPopup">
            <!-- Popup Div Starts Here -->
            <div class="popupContact" id="popupSeeEvts">
            <div id="seeEvents" class="f-container">
            <a class="boxclose" id="seeEvts_boxclose" onclick= "hideEvents()"></a>
            <h4 class="eventLocation" id="seeEventsLocation">Event location</h4>
            </div>
            </div>
        </div>
        <!-- Popup Div Ends Here -->

        <div id="promptAccountPopup">
            <!-- Popup Div Starts Here -->
            <div id="popupAccount">
            <form action="#" id="createEventForm" method="post" name="createEventForm">
            <a class="boxclose" id="boxclose" onclick= "div_hide()"></a>
            <p id="promptForAccount"></p>
            <a href="register.php" class="loginSignup button" id="redirectButton">Login/Signup</a>
            </form>
            </div>
        </div>
        <!-- Popup Div Ends Here -->
        
        <section>
            <div id="upcoming-events" class="container box">
                <div class="title-container">
                    <h1>Upcoming Events</h1>
                    <hr>
                </div>

                <div class="f-container">
                    <!-- get list of upcoming events to show -->
                    <?php 
                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        getEvents($conn);
                    }
                    catch (PDOException $e)
                    {
                        echo "Connection failed: " . $e->getMessage();
                    }
                    $conn = null;

                    // Get list of event from events table
                    function getEvents($conn){
                        $stmt = $conn->query('SELECT `event_id`,`event_date`,`location`,`event_name`,`event_type`,`user_name` FROM `events` ORDER BY `event_date`, `event_start_time`');
                        if($stmt->rowCount() > 0){
                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            $current_date = date("Y-m-d");
                            $count_current = 0;
                            foreach ($results as $row){
                                if($current_date <= $row['event_date'] && $count_current < 4){
                                    $count_current++;
                                    list($year, $month, $day) = explode("-", $row['event_date']);
                                    printEvent($row['event_id'], monthConvert($month), $day, $row['location'], $row['event_name'], $row['event_type'], $row['user_name'] );
                                }
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
                    ?>
                </div>
                <div class="button-box">
                    <a class="button" href="upcoming-events.php">View More</a>
                </div>
            </div>
        </section>
    </main>

<?php
include 'footer.php';
?>
