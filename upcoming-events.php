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
    if($_SESSION['preference'] == "all" || !isset($_SESSION['preference'])){
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
    echo '<!-- layout each event !-->
            <script>
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
                    var container = document.getElementById("upcoming-events-cont");
                    container.appendChild(event_container);
                </script>
            ';
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
        <div class="f-container" id="upcoming-events-cont">
    ';
}
echo '
        </div>
    </main>';

include 'footer.php';
?>