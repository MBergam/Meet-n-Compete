<?php
include 'header.php';
include 'config.php';
include 'submitEvent.php';
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
                            <li>
                                <label class="label-container">Baseball
                                    <input type="checkbox" checked="checked" id="baseball">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="label-container">Basketball
                                    <input type="checkbox" id="basketball">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="label-container">Billiards
                                    <input type="checkbox" id="billiards">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="label-container">Bowling
                                    <input type="checkbox" id="bowling">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="label-container">Climbing
                                    <input type="checkbox" id="climbing">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="label-container">Cricket
                                    <input type="checkbox" id="cricket">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="label-container">Curling
                                    <input type="checkbox" id="curling">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="label-container">Football
                                    <input type="checkbox" id="football">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="label-container">Golf
                                    <input type="checkbox" id="golf">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="label-container">Rugby
                                    <input type="checkbox" id="rugby">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="label-container">Skateboarding
                                    <input type="checkbox" id="skateboarding">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="label-container">Skiing
                                    <input type="checkbox" id="skiing">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="label-container">Snowboarding
                                    <input type="checkbox" id="snowboarding">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="label-container">Soccer
                                    <input type="checkbox" id="soccer">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="label-container">Swimming
                                    <input type="checkbox" id="swimming">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="label-container">Tennis
                                    <input type="checkbox" id="tennis">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="label-container">Volleyball
                                    <input type="checkbox" id="volleyball">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="label-container">Weightlifting
                                    <input type="checkbox" id="weightlifting">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                            Radius: <input type = "text" class = "allText" id = "radius" value="2" required minlength="1" maxlength="2" size="4" <p> miles</p>
                            </li>
                        </ul>
                    
                    </div>
                </div>
            </div>
        </div>
        
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
            <textarea id="evtName" name="eventName" placeholder="Event Name (Optional)"></textarea>
            <div class="dropdown" id="dropdownSports">
                <input type="hidden" name="sportTextToDB" id="sportTextToDB" value=""></input>
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
        <section id="about-us">
            <div class="container box padding-inside">
                <div class="title-container">
                    <h1>About Us</h1>
                    <hr>
                </div>
                <p>As many people have experienced, finding people to organize pick up games with can be difficult. 
                    Often a person will head over to a local park just to find out that the park is already being used, 
                    there aren’t enough people, or the people that are there are all different ages.</p>
                <p>This project will help bring a solution to these problems, allowing users to view events and locations via a map, 
                    while also being able to create events of their own for others to see and join.</p>
                <p>Meet-N-Compete will provide an online means to help people organize pick-up games and reduce the difficulties and confusion that usually accompany.</p>
            </div>
        </section>

        <section>
            <div id="upcoming-events" class="container box">
                <div class="title-container">
                    <h1>Upcoming Events</h1>
                    <hr>
                </div>

                <div class="f-container">
                    <div class="event-container">
                        <div class="date-container">
                            <p><span class="month">Mar</span>
                                <span class="day">1</span></p>
                        </div>
                        <div class="detail">
                            <h3>Name of Events</h3>
                            <h4>Glass Park, Spokane, WA</h4>
                            <button class="button">More...</button>
                            <button class="button">Join Event</button>
                        </div>
                    </div>
                    <div class="event-container">
                        <div class="date-container">
                            <p><span class="month">Mar</span>
                                <span class="day">1</span></p>
                        </div>
                        <div class="detail">
                            <h3>Name of Events</h3>
                            <h4>Glass Park, Spokane, WA</h4>
                            <button class="button">More...</button>
                            <button class="button">Join Event</button>
                        </div>
                    </div>
                    <div class="event-container">
                        <div class="date-container">
                            <p><span class="month">Mar</span>
                                <span class="day">1</span></p>
                        </div>
                        <div class="detail">
                            <h3>Name of Events</h3>
                            <h4>Glass Park, Spokane, WA</h4>
                            <button class="button">More...</button>
                            <button class="button">Join Event</button>
                        </div>
                    </div>
                    <div class="event-container">
                        <div class="date-container">
                            <p><span class="month">Mar</span>
                                <span class="day">1</span></p>
                        </div>
                        <div class="detail">
                            <h3>Name of Events</h3>
                            <h4>Glass Park, Spokane, WA</h4>
                            <button class="button">More...</button>
                            <button class="button">Join Event</button>
                        </div>
                    </div>
                </div>
                <div class="button-box">
                    <a class="button" href="">View More</a>
                </div>
            </div>
        </section>
    </main>

<?php
include 'footer.php';
?>
