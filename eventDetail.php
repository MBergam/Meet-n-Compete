<?php
//session_start();
include 'header.php';
// get the id of event selected
if(isset($_GET['item']))
{
    $itemSelected = $_GET['item'];
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database",$username,$password);  
    //set the error code to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    printCarouselIndicators();
    //echo "Connected successfully<br>";
    //echo "Event Selected: ". $itemSelected;
    //echo '<button onclick="history.go(-1);">Back</button>';
    getItemDetail($conn,$itemSelected);
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
    ';
}
//SELECT `event_id`,`event_date`,`location`,`event_name`,`event_type`,`event_description`,`user_name`,`event_start_time`,`event_duration` FROM `events` 
function getItemDetail($conn, $itemID){
    
    $stmt = $conn->prepare('SELECT `event_id`, `event_marker_id`, `event_date`,`location`,`event_name`,`event_type`,`event_description`,`user_name`, `event_start_time`,`event_duration`
                          FROM  `events`
                          WHERE event_id =?');
    $stmt->bindValue(1,$itemID,PDO::PARAM_INT);
    $stmt->execute();
    if($stmt->rowCount() ==1 ){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        list($year, $month, $day) = explode("-", $row['event_date']);
        printEventDetails($conn, $row['event_id'], $row['event_marker_id'], monthConvert($month), $day, $row['location'], $row['event_name'], 
        $row['event_type'], $row['event_description'], $row['user_name'], $row['event_start_time'], $row['event_duration']);
    }
    else{
        echo "Data not found";
    }
}
function printEventDetails($conn, $event_id, $event_marker_id, $month, $day, $location, $event_name, $event_type, $event_description, $user_name, $event_start_time, $event_duration)
{
    $event_start_time = date("g:ia", strtotime($event_start_time));
    echo'
    <h1>'.$event_name.'</h1>
    <hr>
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
                    <h5>Type: '.$event_type.'</h5>
                    <h4>Location: '.$location.'</h4>
                    <p>Created by <a href="'.$user_name.'">'.$user_name.'</a></p>
                    <p>Description: '.$event_description.'</p>
                    '; 
                    
                    $rows = getJoinedMembers($conn, $event_id);
                    echo'
                    <h4>Members('.sizeof($rows).'):</h4>';
                    if(sizeof($rows)==0){
                        echo 'None';
                    }else{
                        foreach($rows as $row){
                            echo '<a href="'.$row['user_name'].'" class="margin-right membersJoined">'.$row['user_name'].'</a>';
                        }
                    }
                    echo '
                    <div id="buttonCont">
                        <script>
                            var isInEvent = false;
                            var membersJoined = document.getElementsByClassName("membersJoined");
                            for(member of membersJoined){
                                if(member.text === document.getElementById("site_user").text){
                                    isInEvent = true;
                                }
                            }
                            if(\''.$user_name.'\' === document.getElementById("site_user").text){
                                isInEvent = true;
                            }
                            
                            if(!isInEvent){
                                var backBtn = document.createElement(\'button\');
                                backBtn.className = "button";
                                backBtn.innerHTML = "Back";
                                //backBtn.onclick = "goBack()";
                                backBtn.id = "detail-backBtn";
                                

                                var btn = document.createElement(\'input\');
                                btn.className = "button";
                                btn.type = "submit";
                                btn.value = "Join Event";
                                btn.name = "btnJoin";

                                var joinEventHiddenIdToDB = document.createElement("input");
                                joinEventHiddenIdToDB.type = "hidden";
                                joinEventHiddenIdToDB.name = "hd_event_id";
                                joinEventHiddenIdToDB.value = \''.$event_id.'\';

                                var usernameHiddenToDB = document.createElement("input");
                                usernameHiddenToDB.type = "hidden";
                                usernameHiddenToDB.name = "hd_user_name";
                                usernameHiddenToDB.value = document.getElementById("site_user").text;

                                var form = document.createElement("form");
                                form.method = "post";
                                form.action = "my-events.php";
                                form.appendChild(backBtn);
                                form.appendChild(btn);
                                form.appendChild(joinEventHiddenIdToDB);
                                form.appendChild(usernameHiddenToDB);

                                var buttonCont = document.getElementById("buttonCont");
                                buttonCont.appendChild(form);
                                var isClicked = false;
                                goBack(isClicked);
                            }else{
                                var backBtn = document.createElement(\'button\');
                                backBtn.className = "button";
                                backBtn.innerHTML = "Back";
                                backBtn.id = "detail-backBtn";
                                

                                var buttonCont = document.getElementById("buttonCont");
                                buttonCont.appendChild(backBtn);
                                var isClicked = false;
                                goBack(isClicked);
                            }

                            //sets Back button onclick and only goes back one page only
                            function goBack(isClicked){
                                document.getElementById("detail-backBtn").onclick = function(){
                                    if(!isClicked){
                                        history.go(-1);
                                        isClicked = true;
                                    }
                                };
                            }
                        </script>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="map"></div>
    <script>
    myMap();
        function myMap() {
          var geocoder = new google.maps.Geocoder;

          geocoder.geocode({\'placeId\': \''.$event_marker_id.'\'}, function(results, status) {
            if (status !== \'OK\') {
                window.alert(\'Geocoder failed due to: \' + status);
                return;
            }

            var map = new google.maps.Map(document.getElementById("map"), {
                center: new google.maps.LatLng(47.658779, -117.426048), 
                zoom: 12
            });
            var marker = new google.maps.Marker({
                map: map,
                icon: {
                    url: "./img/blue-marker.png"
                }
            });
            
            map.setCenter(results[0].geometry.location);
      
            // Set the position of the marker using the place ID and location.
            marker.setPlace(
                {placeId: \''.$event_marker_id.'\', location: results[0].geometry.location});
      
            marker.setVisible(true);

            info = new google.maps.InfoWindow({
                content: \''.$location.'\'
            });

            marker.addListener(\'click\', function() {
                info.open(map, marker);
            });
          });

          
        }
    </script>
    ';
}
echo '
        </div>
    </main>';

//for when a user clicks join event on this page
if (isset($_POST['btnJoin'])) {

    $user_name = strip_tags($_POST['hd_user_name']);//remove html tags
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