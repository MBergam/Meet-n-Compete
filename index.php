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
                <div class="col-lg-8" id="mInfo">
                    <div id="map"></div>

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
                        <a class="button" href="">Learn More</a>
                        <a class="button" href="">Create Event</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-container">
                        <h2>Preferences</h2>
                        Basketball <input type = "checkbox" id="basketball" class="checkbox"/> <br></br>
                        Baseball <input type = "checkbox" id="baseball" class="checkbox"/> <br></br>
                        Soccer <input type = "checkbox" id="soccer" class="checkbox"/> <br></br>
                        Tennis/Table Tennis <input type = "checkbox" id="tennis" class="checkbox"/><br></br>
                        Football <input type = "checkbox" id="football" class="checkbox"/><br></br>
                        Volleyball <input type = "checkbox" id="volleyball" class="checkbox"/><br></br>
                        Snowboarding <input type = "checkbox" id="snowboarding" class="checkbox"/><br></br>
                        Swimming <input type = "checkbox" id="swimming" class="checkbox"/><br></br>
                        Skiing <input type = "checkbox" id="skiing" class="checkbox"/><br></br>
                        Rugby <input type = "checkbox" id="rugby" class="checkbox"/><br></br>
                        Bowling <input type = "checkbox" id="bowling" class="checkbox"/><br></br>
                        Weight lifting <input type = "checkbox" id="weight_lifting" class="checkbox"/><br></br>
                        Billiards (Pool) <input type = "checkbox" id="billiards" class="checkbox"/> <br></br>
                        Climbing <input type = "checkbox" id="climbing" class="checkbox"/><br></br>
                        Golf/Discgolf <input type = "checkbox" id="golf" class="checkbox"/><br></br>
                        Curling <input type = "checkbox" id="curling" class="checkbox"/><br></br>
                        Cricket <input type = "checkbox" id="cricket" class="checkbox"/><br></br>
                        Skateboarding <input type = "checkbox" id="skateboarding" class="checkbox"/><br></br>
                        Radius: <input type = "text" class = "allText" id = "radius" value="2" required minlength="1" maxlength="2" size="4" <p> miles</p><br>
                        <button id="search">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </main>';

include 'footer.php';
?>
