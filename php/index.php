<?php
include 'header.php';
echo '
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
            <div class="row">
                <div class="col-lg-8">
                    <div id="map"></div>

                    <!-- Start Map demo -->
                    <script>
                        function myMap() {
                          var mapCanvas = document.getElementById("map");
                          var mapOptions = {
                            center: new google.maps.LatLng(47.658779, -117.426048), zoom: 10
                          };
                          var map = new google.maps.Map(mapCanvas, mapOptions);
                        }
                    </script>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4&callback=myMap"></script>
                    <!-- End Map demo -->

                    <div class="detail-container">
                        <div class="event-box">
                            <a href=""><img src="https://via.placeholder.com/200" alt=""></a>
                            <div class="title-box"><a href=""><h3>Event Title</h3></a></div>
                        </div>
                        <div class="event-box">
                            <a href=""><img src="https://via.placeholder.com/200" alt=""></a>
                            <div class="title-box"><a href=""><h3>Event Title</h3></a></div>
                        </div>
                        <div class="event-box">
                            <a href=""><img src="https://via.placeholder.com/200" alt=""></a>
                            <div class="title-box"><a href=""><h3>Event Title</h3></a></div>
                        </div>
                    </div>
                    <div class="button-box">
                        <a class="button" href="upcoming-events.php">Learn More</a>
                        <a class="button" href="">Create Event</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-container">
                        <h2>Preferences</h2>
                    </div>
                </div>
            </div>
        </div>
    </main>';

include 'footer.php';
?>