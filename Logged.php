<?php
include 'header.php';
include 'config.php';
include 'submitEvent.php';

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
                        Baseball <input type = "checkbox" id="baseball" class="checkbox"/> <br></br>
                        Basketball <input type = "checkbox" id="basketball" class="checkbox"/> <br></br>
                        Billiards (Pool) <input type = "checkbox" id="billiards" class="checkbox"/> <br></br>
                        Bowling <input type = "checkbox" id="bowling" class="checkbox"/><br></br>
                        Climbing <input type = "checkbox" id="climbing" class="checkbox"/><br></br>
                        Cricket <input type = "checkbox" id="cricket" class="checkbox"/><br></br>
                        Curling <input type = "checkbox" id="curling" class="checkbox"/><br></br>
                        Football <input type = "checkbox" id="football" class="checkbox"/><br></br>
                        Golf/Discgolf <input type = "checkbox" id="golf" class="checkbox"/><br></br>
                        Rugby <input type = "checkbox" id="rugby" class="checkbox"/><br></br>
                        Skateboarding <input type = "checkbox" id="skateboarding" class="checkbox"/><br></br>
                        Skiing <input type = "checkbox" id="skiing" class="checkbox"/><br></br>
                        Snowboarding <input type = "checkbox" id="snowboarding" class="checkbox"/><br></br>
                        Soccer <input type = "checkbox" id="soccer" class="checkbox"/> <br></br>
                        Swimming <input type = "checkbox" id="swimming" class="checkbox"/><br></br>
                        Tennis/Table Tennis <input type = "checkbox" id="tennis" class="checkbox"/><br></br>
                        Volleyball <input type = "checkbox" id="volleyball" class="checkbox"/><br></br>
                        Weightlifting <input type = "checkbox" id="weight_lifting" class="checkbox"/><br></br>               
                        Radius: <input type = "text" class = "allText" id = "radius" value="2" required minlength="1" maxlength="2" size="4" <p> miles</p>
                        <a id="search" class="button">Search</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="createEvtPopup">
            <!-- Popup Div Starts Here -->
            <div id="popupContact">
            <!-- Create New Event -->
            <form action="#" id="createEventForm" method="post" name="createEventForm">
            <a class="boxclose" id="boxclose" onclick= "div_hide()"></a>
            <h2 id="contact">Create Event</h2>
            <hr>
            <p id="createEvtLocation">Event location</p>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" name="sportText" id="sportText" data-toggle="dropdown">Select Sport</button>
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
            <p>Enter Time: <input type = "text" name="evtTime" id ="evtTime" name="evtTime"></p>
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
            <p>Enter Date: <input type = "text" name = "datepicker" id = "datepicker"></p>
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
            <textarea id="desc" name="description" placeholder="Description (Optional)"></textarea>
            <button href="javascript:%20check_empty()" name="submitBtn" id="submit">Send</button>
            </form>
            </div>
        </div>
        <!-- Popup Div Ends Here -->
    </main>';



include 'footer.php';
?>
