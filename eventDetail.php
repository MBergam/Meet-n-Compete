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
        printEventDetails($row['event_id'], $row['event_marker_id'], monthConvert($month), $day, $row['location'], $row['event_name'], 
        $row['event_type'], $row['event_description'], $row['user_name'], $row['event_start_time'], $row['event_duration']);
    }
    else{
        echo "Data not found";
    }
}
function printEventDetails($event_id, $event_marker_id, $month, $day, $location, $event_name, $event_type, $event_description, $user_name, $event_start_time, $event_duration)
{
    echo'
    <h1>'.$event_name.'</h1>
    <hr>
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
                        
                        <button class="button" onclick="history.go(-1);">Back</button>
                        <button class="button">Join Event</button>
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

include 'footer.php';
?>