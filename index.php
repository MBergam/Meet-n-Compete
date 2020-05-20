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
                <button class="btn btn-light dropdown-toggle" type="button" name="sportText" id="sportText" data-toggle="dropdown">Select Sport</button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="sportText">
                <?php
                    foreach($results as $row){
                        echo '<li role="presentation"><a class="dropdown-item" role="menuitem" tabindex="-1">'.$row['preference'].'</a></li>';
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

        <!-- embedded youtube tutorial video-->
        <section class="youtubevid">
        <iframe width="750" height="385" src="https://www.youtube.com/embed/WitE0XJnML4" frameborder="0" class="youtubevid" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </section>

        
        <section>
            <div id="upcoming-events" class="container box">
                <div class="title-container">
                    <h1>Upcoming Events</h1>
                    <hr>
                </div>

                <div class="f-container" id="upcoming-events-container">
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
                        echo '<script>
                                    var event_container = document.createElement(\'div\');
                                    event_container.className = "event-container";

                                    var date_container = document.createElement(\'div\');
                                    date_container.className = "date-container";

                                    var p = document.createElement(\'p\');

                                    p.innerHTML = "<span class=\'month\'>" + "'.$month.'"
                                    + "</span><span class=\'day\'>" + "'.$day.'"  + "</span>";

                                    var detail = document.createElement(\'div\');
                                    detail.className = "detail";
                                
                                    var h3 = document.createElement(\'h3\');
                                    h3.innerText = "'.$event_name.'";
                                    
                                    var h5 = document.createElement(\'h5\');
                                    h5.innerText = "Type: " + "'.$event_type.'";

                                    var h4 = document.createElement(\'h5\');
                                    h4.innerText = "Location: " + "'.$location.'";
                                
                                    var createdBy = document.createElement(\'p\');
                                    createdBy.innerHTML = "Created by <a href="+ "'.$user_name.'"+ ">" + "'.$user_name.'" + "</a>";
                                
                                    var a1 = document.createElement(\'a\');
                                    a1.href = "eventDetail.php?item=" + encodeURIComponent('.$event_id.');
                                    a1.className = "button";
                                    a1.innerText = "Learn More";
                                
                                    var joinEventContainer'.$event_id.' = document.createElement(\'form\');
                                    joinEventContainer'.$event_id.'.method = "post";
                                    joinEventContainer'.$event_id.'.action = "my-events.php";
                                
                                    var joinEventBtn'.$event_id.' = document.createElement("input");
                                    joinEventBtn'.$event_id.'.type = "button";
                                    joinEventBtn'.$event_id.'.name = "btnJoin";
                                    joinEventBtn'.$event_id.'.value = "Join Event";
                                    joinEventBtn'.$event_id.'.className = "button float-right";
                                    if(document.getElementById("site_user") !== null){
                                            joinEventBtn'.$event_id.'.onclick = function(){
                                                if(\''.$user_name.'\' === document.getElementById("site_user").text){
                                                    joinEventBtn'.$event_id.'.remove();
                                                    var joinedEventBtn'.$event_id.' = document.createElement("p");
                                                    joinedEventBtn'.$event_id.'.innerHTML = "Your Event";
                                                    joinedEventBtn'.$event_id.'.className = "joinedEventBtn float-right";
                                        
                                                    joinEventContainer'.$event_id.'.appendChild(joinedEventBtn'.$event_id.');
                                                }else{
                                                    //take away join event button if user is on there
                                                    $.ajax({
                                                        url: "event-users.php",
                                                        data: {
                                                            "event_id": '.$event_id.',
                                                            "user_id": document.getElementById("site_user").text
                                                        },
                                                        success: function(data) {
                                                            //username found in database on event_id
                                                            if(!data.includes("[]")){
                                                                joinEventBtn'.$event_id.'.remove();
                                                                var joinedEventBtn'.$event_id.' = document.createElement("p");
                                                                
                                                                joinedEventBtn'.$event_id.'.innerHTML = "Already Joined";
                                                                joinedEventBtn'.$event_id.'.className = "joinedEventBtn float-right";
                                        
                                                                joinEventContainer'.$event_id.'.appendChild(joinedEventBtn'.$event_id.');
                                                            }
                                                            //User can join event because they have not joined it yet
                                                            else{
                                                                joinEventBtn'.$event_id.'.type = "submit";
                                                                joinEventBtn'.$event_id.'.onclick = function(){};
                                                                joinEventBtn'.$event_id.'.click();
                                                            }
                                                        },
                                                        error: function(xhr) {
                                                            console.log(xhr);
                                                        }
                                                    });
                                                }
                                            };
                                    }else{
                                        joinEventBtn'.$event_id.'.type = "submit";
                                    }
                                
                                    var joinEventHiddenIdToDB'.$event_id.' = document.createElement("input");
                                    joinEventHiddenIdToDB'.$event_id.'.type = "hidden";
                                    joinEventHiddenIdToDB'.$event_id.'.name = "hd_event_id";
                                    joinEventHiddenIdToDB'.$event_id.'.value = '.$event_id.';
                                
                                    joinEventContainer'.$event_id.'.appendChild(a1);
                                    joinEventContainer'.$event_id.'.appendChild(joinEventBtn'.$event_id.');
                                    joinEventContainer'.$event_id.'.appendChild(joinEventHiddenIdToDB'.$event_id.');
                                
                                    date_container.appendChild(p);
                                    detail.appendChild(h3);
                                    detail.appendChild(h5);
                                    detail.appendChild(h4);
                                    detail.appendChild(createdBy);
                                    detail.appendChild(joinEventContainer'.$event_id.');
                                    event_container.appendChild(date_container);
                                    event_container.appendChild(detail);
                                
                                    //Put the event_container inside of the upcoming events container, so it now displays on the page
                                    var container = document.getElementById("upcoming-events-container");
                                    container.appendChild(event_container);
                                </script>
                            ';
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
