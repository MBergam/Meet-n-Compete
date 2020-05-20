//https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=AIzaSyDS3p3iX3eIPWNLMuFQNrPRKWyE5un7dtY

//AIzaSyDS3p3iX3eIPWNLMuFQNrPRKWyE5un7dtY
//AIzaSyAHoreTH9KWnvppgnaECTPBPkjosVlvGh8 -- MAX'S KEY

//Ajax call to ready the document
$(document).ready(start);

//global variables used in this file
var map;
var rad = 2;
var latNum = null;
var lngNum = null;
var info = null;
var myKey = "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4";

//Function called when the document is first loaded - gets the user's location either manually or by requesting permission
function start() {
    //if statement checks to see if user is on Home page or not. If not, this Javascript doesn't do anything
    if(document.getElementById('map') != null && document.getElementById('search') != null){
        $("a[role='menuitem']").click(dropdownTxtChange);
    
        getLocation();
        $("#search").click(getLatLong);
    }
}

//Asks user for permission to get their location
function getLocation(){
    var options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0
      };
    navigator.geolocation.getCurrentPosition(success, error, options);
}

//If user allows our site to access their location successfully
function success(pos) {
    var crd = pos.coords;
    console.log('Your current position is:');
    console.log(`Latitude: ${crd.latitude}`);
    latNum = crd.latitude;
    console.log(`Longitude: ${crd.longitude}`);
    lngNum = crd.longitude;
    console.log(`More or less ${crd.accuracy} meters.`);
    initMap(latNum, lngNum, rad);
}

//If user blocks location or there was an error trying to access their location - then user uses manual location above map
function error(err) {
    console.log(`${err.message}`);

    //intitalize map on Spokane Valley's location
    latNum = 47.6732;
    lngNum = -117.2394;
    initMap(latNum, lngNum, rad);
}

//Function to intialize the Google map
function initMap(lati, longi, radi) {

    //convert miles to meters
    radi = (radi * 1609);

    //create map with appropriate zoom level
    var zoom = properZoom(radi);

    //add 2000 meters to radius to improve map display
    radi += 2000;

    //create google map w/ parameters
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: lati, lng: longi},
        zoom: zoom,
    });

    var service = new google.maps.places.PlacesService(map);
    //see what preferences are checked, and pass that info off to add markers later
    if (document.getElementById("basketball").checked) {
        bask_preqdata = {
            radius: radi,
            location: (new google.maps.LatLng(lati, longi)),
            keyword: "basketball court"
        }

        var basketball_keyword = new Array("basketball", "court");

        service.nearbySearch(bask_preqdata , function placeData(data, status) {
            gotPlaceData(data, status, basketball_keyword);
        });
    }

    if (document.getElementById("baseball").checked) {
        base_reqdata = {
            radius: radi,
            location: (new google.maps.LatLng(lati, longi)),
            keyword: "baseball field"
        }

        var baseball_keyword = new Array("baseball", "field");
        
        service.nearbySearch(base_reqdata, function placeData(data, status) {
            gotPlaceData(data, status, baseball_keyword);
        });

        /*$.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", base_reqdata, 
        function placeData(data) {
            gotPlaceData(data,baseball_keyword);
        },
        "json");*/
        //OLD way we would call API
    }

    if (document.getElementById("soccer").checked) {
        soc_reqdata = {
            radius: radi,
            location: (new google.maps.LatLng(lati, longi)),
            keyword: "soccer field"
        }

        var soccer_keyword = new Array("soccer", "field");

        
        service.nearbySearch(soc_reqdata, function placeData(data, status) {
            gotPlaceData(data, status, soccer_keyword);
        });
    }

    if (document.getElementById("tennis").checked) {
        tennis_reqdata = {
            radius: radi,
            location: (new google.maps.LatLng(lati, longi)),
            keyword: "tennis court"
        }

        var tennis_keyword = new Array("tennis", "court");

        
        service.nearbySearch(tennis_reqdata, function placeData(data, status) {
            gotPlaceData(data, status, tennis_keyword);
        });

    }

    if (document.getElementById("volleyball").checked) {
        volley_reqdata = {
            radius: radi,
            location: (new google.maps.LatLng(lati, longi)),
            keyword: "volleyball court"
        }

        var volleyball_keyword = new Array("volleyball", "court");
        
        service.nearbySearch(volley_reqdata, function placeData(data, status) {
            gotPlaceData(data, status, volleyball_keyword);
        });
    }
    
    if (document.getElementById("snowboarding").checked) {
        snow_reqdata = {
            radius: radi,
            location: (new google.maps.LatLng(lati, longi)),
            keyword: "snowboarding"
        }

        var snowboarding_keyword = new Array("snowboarding", "215436t345");
        
        service.nearbySearch(snow_reqdata, function placeData(data, status) {
            gotPlaceData(data, status, snowboarding_keyword);
        });

    }

    if (document.getElementById("football").checked) {
        foot_reqdata = {
            radius: radi,
            location: (new google.maps.LatLng(lati, longi)),
            keyword: "football field"
        }

        var football_keyword = new Array("football", "field");
        
        service.nearbySearch(foot_reqdata, function placeData(data, status) {
            gotPlaceData(data, status, football_keyword);
        });

    }

    if (document.getElementById("swimming").checked) {
        swim_reqdata = {
            radius: radi,
            location: (new google.maps.LatLng(lati, longi)),
            keyword: "swimming pool"
        }

        var swimming_keyword = new Array("swimming", "pool");

        service.nearbySearch(swim_reqdata, function placeData(data, status) {
            gotPlaceData(data, status, swimming_keyword);
        });

    }

    if (document.getElementById("skiing").checked) {
        ski_reqdata = {
            radius: radi,
            location: (new google.maps.LatLng(lati, longi)),
            keyword: "skiing"
        }

        var skiing_keyword = new Array("skiing", "resort");

        service.nearbySearch(ski_reqdata, function placeData(data, status) {
            gotPlaceData(data, status, skiing_keyword);
        });
    }

    if (document.getElementById("rugby").checked) {
        rug_reqdata = {
            radius: radi,
            location: (new google.maps.LatLng(lati, longi)),
            keyword: "rugby field"
        }

        var rugby_keyword = new Array("rugby", "field");
        
        service.nearbySearch(rug_reqdata, function placeData(data, status) {
            gotPlaceData(data, status, rugby_keyword);
        });
    }

    if (document.getElementById("bowling").checked) {
        bowl_reqdata = {
            radius: radi,
            location: (new google.maps.LatLng(lati, longi)),
            keyword: "bowling alley"
        }

        var bowling_keyword = new Array("bowling", "alley");
        
        service.nearbySearch(bowl_reqdata, function placeData(data, status) {
            gotPlaceData(data, status, bowling_keyword);
        });
    }

    if (document.getElementById("weightlifting").checked) {
        weight_reqdata = {
            radius: radi,
            location: (new google.maps.LatLng(lati, longi)),
            keyword: "weight lifting"
        }

        var weight_lifting_keyword = new Array("weight", "lifting");
        
        service.nearbySearch(weight_reqdata, function placeData(data, status) {
            gotPlaceData(data, status, weight_lifting_keyword);
        });
    }

    if (document.getElementById("billiards").checked) {
        bill_reqdata = {
            radius: radi,
            location: (new google.maps.LatLng(lati, longi)),
            keyword: "billiard table"
        }

        var billiards_keyword = new Array("billiard", "tables");

        service.nearbySearch(bill_reqdata , function placeData(data, status) {
            gotPlaceData(data, status, billiards_keyword);
        });

    }

    if (document.getElementById("climbing").checked) {
        climb_reqdata = {
            radius: radi,
            location: (new google.maps.LatLng(lati, longi)),
            keyword: "climbing"
        }

        var climbing_keyword = new Array("climbing", "215436t345");

        service.nearbySearch(climb_reqdata, function placeData(data, status) {
            gotPlaceData(data, status, climbing_keyword);
        });

    }

    if (document.getElementById("golf").checked) {
        golf_reqdata = {
            radius: radi,
            location: (new google.maps.LatLng(lati, longi)),
            keyword: "golf course"
        }

        var golf_keyword = new Array("golf", "course");

        service.nearbySearch(golf_reqdata, function placeData(data, status) {
            gotPlaceData(data, status, golf_keyword);
        });
    }
    if (document.getElementById("curling").checked) {
        curl_reqdata = {
            radius: radi,
            location: (new google.maps.LatLng(lati, longi)),
            keyword: "curling sheet"
        }

        var curling_keyword = new Array("curling", "215436t345");

        service.nearbySearch(curl_reqdata, function placeData(data, status) {
            gotPlaceData(data, status, curling_keyword);
        });
    }

    if (document.getElementById("cricket").checked) {
        crick_reqdata = {
            radius: radi,
            location: (new google.maps.LatLng(lati, longi)),
            keyword: "cricket field"
        }

        var cricket_keyword = new Array("cricket", "215436t345");

        service.nearbySearch(crick_reqdata, function placeData(data, status) {
            gotPlaceData(data, status, cricket_keyword);
        });
    }

    if (document.getElementById("skateboarding").checked) {
        skate_reqdata = {
            radius: radi,
            location: (new google.maps.LatLng(lati, longi)),
            keyword: "skateboarding"
        }

        var skateboarding_keyword = new Array("skate", "park");

        service.nearbySearch(skate_reqdata, function placeData(data, status) {
            gotPlaceData(data, status, skateboarding_keyword);
        });
    }

}

//Finds appropriate zoom level
function properZoom(radi){
    var zoom;
    if(radi >= 0 && radi <= 1128){
        zoom = 14;
    }else if(radi > 1128 && radi <= 2256){
        zoom = 13;
    }else if(radi > 2256 && radi <= 4513){
        zoom = 12;
    }else if(radi > 4513 && radi <= 9027){
        zoom = 11;
    }else if(radi > 9027 && radi <= 18055){
        zoom = 10;
    }else if(radi > 18055 && radi <= 36111){
        zoom = 9;
    }else if(radi > 36111 && radi <= 50000){
        zoom = 8;
    }else{
        zoom = 7;
    }
    return zoom;
}

//Adds a marker to map
function addMarker(LatLng, name, mdata, i) {
    //intitialize info variable if this is the very first marker added to the map
    if (!info) {
        info = new google.maps.InfoWindow();
    }

    var marker;
    var hasEvent = false;

    //Database call to find events with the same place_id as the location data
    //If so, a blue marker will indicate that the location has an event
    $.ajax({
        url: "event-data.php",
        data: {
            "place_id": mdata[i].place_id
        },
        success: function(response) {
            //no place_ids found in database
            if(response.includes("[]")){
                marker = new google.maps.Marker({
                    position: LatLng,
                    map: map
                });
            }
            //place_id found in database -- event found -- makes a blue marker to indicate
            else{
                marker = new google.maps.Marker({
                    position: LatLng,
                    map: map,
                    icon: {
                        url: "./img/blue-marker.png"
                    }
                });
                hasEvent = true;
            }
            //calls function to add the marker handler which basically sets up the info window interaction on the marker's click
            addMarkerHandler(marker, info, mdata, name, i, hasEvent);
        },
        error: function(xhr) {
            console.log(xhr);
        }
    });
    
}

//adds marker handler (info box on click)
function addMarkerHandler(marker, info, mdata, name, i, hasEvent) {
    marker.addListener('click', function() {
        //close other marker that could have been clicked before
        info.close();
        
        infoDiv = document.createElement('div');
        infoDiv.id = "markerInfo";
        let img = document.createElement('img');
        img.className = 'photo markInfo';
        
        //set an image for a marker. If no image, then use default.
        if (mdata[i]["photos"] != null) {
            img.src = mdata[i]["photos"][0].getUrl({maxWidth: 250, maxHeight: 250}); 
        }else{
            img.src = "./img/no-image-available.png"; 
        }
        infoDiv.appendChild(img);

        var placesService = new google.maps.places.PlacesService(map);

        placesService.getDetails( {placeId: mdata[i].place_id}, function(results, status) {
            //Get user ratings
            let p = document.createElement('p');
            p.className = "markInfo placeInfo";

            //Create 'Directions' link
            let directionsLink = document.createElement('p');
            directionsLink.id = "directionsLink";
            directionsLink.className = "hyperLink allText markInfo";
            directionsLink.innerHTML = "Get Directions";
            directionsLink.onclick = function(){ 
                window.open("https://www.google.com/maps/dir/?api=1&origin=" + latNum + "," + lngNum + "&destination=" + mdata[i].name + "&destination_place_id=" + mdata[i].place_id, "_blank");
            };

            p.innerText = name + "\n" + results.vicinity + " ";

            p.appendChild(directionsLink);

            //Get user ratings
            let p2 = document.createElement('p');
            p2.className = "markInfo placeInfo";

            //Create 'See Reviews' link
            let reviewsLink = document.createElement('p');
            reviewsLink.id = "reviewsLink";
            reviewsLink.className = "hyperLink allText markInfo";
            reviewsLink.innerHTML = "See Reviews";
            reviewsLink.onclick = function(){ 
                window.open("https://search.google.com/local/reviews?placeid=" + mdata[i].place_id);
            };

            //Show reviews preview
            if(results.rating == null){
                p2.innerText += "No user ratings available. ";
            }else{
                p2.innerText += "Rating: " + results.rating + "/5 (" + results.user_ratings_total + " total) ";
            }
            
            p2.appendChild(reviewsLink);
            infoDiv.append(p);
            infoDiv.append(p2);

            //If the marker has an event attached to it, set up the 'See Events' button
            if(hasEvent){
                //Create 'See Events' button
                let seeEventsButton = document.createElement("button");
                seeEventsButton.className = "seeEvents button button-small font-small markInfo";
                seeEventsButton.innerHTML = "See Events";
                seeEventsButton.onclick = function(){ 
                    //Guest User clicks on See Events
                    if(document.getElementById('createEvtPopup') == null){
                        //Prompt user to login/signup for an account
                        document.getElementById('promptAccountPopup').style.display = "block";
                        $('.carousel-indicators').hide();
                        document.getElementById('promptForAccount').innerHTML = "<b>Login or signup for an account to see and join events</b>";
                    }
                    //Registered User clicks on See Events
                    else{
                        //Remove previously created event list from popup if needed
                        $('.see-event-container').remove();

                        $.ajax({
                            url: "event-data.php",
                            data: {
                                //passing in 'seeEvents' parameter makes the database query specifically for showing a list of events later on
                                "place_id": mdata[i].place_id,
                                "seeEvents": "true"
                            },
                            success: function(response) {
                                var json = JSON.parse(response);
                                
                                //sort json data from earliest to latest date, put it into the orderedResponse variable
                                orderedResponse = json.sort(function(a,b){
                                                                return Date.parse(a.event_date) > Date.parse(b.event_date);
                                                            });

                                //go through every event from the results and add them to the list of events in the popup window
                                for(var x = 0; x < orderedResponse.length; x++){
                                    //calls printEvent, which is used to create the list of events in the popup window
                                    printEvent(orderedResponse[x], results, x+1); 
                                }

                                //show the 'See Events' popup after the events are added to it
                                document.getElementById('seeEventsPopup').style.display = "block";
                                $('.carousel-indicators').hide();
                                
                                //at the top of the popup window, show the name of the location
                                document.getElementById('seeEventsLocation').innerHTML = "<b><u> Events at " + results.name + "</u></b>";
                            },
                            error: function(xhr) {
                                console.log(xhr);
                            }
                        });

                    }
                };

            infoDiv.appendChild(seeEventsButton);
            }

            //Create 'Create Event' button
            let createEventButton = document.createElement("button");
            createEventButton.className = "createEvent button button-small font-small float-right markInfo";
            createEventButton.innerHTML = "Create Event";
            createEventButton.onclick = function(){ 
                //Guest User clicks on the Create Event
                if(document.getElementById('createEvtPopup') == null){
                    document.getElementById('promptAccountPopup').style.display = "block";
                    $('.carousel-indicators').hide();
                    document.getElementById('promptForAccount').innerHTML = "<b>Login or signup for an account to create events</b>";
                }
                //Registered User clicks on the Create Event
                else{
                    document.getElementById('createEvtPopup').style.display = "block";
                    $('.carousel-indicators').hide();
                    document.getElementById('createEvtLocation').innerHTML = "<b>" + results.name + "</b>";
                    var slider = document.getElementById("myRange");
                    var output = document.getElementById("sliderVal");
                    output.innerHTML = slider.value + " minutes"; // Display the default slider value
    
                    // Update the current slider value (each time you drag the slider handle)
                    slider.oninput = function() {
                        output.innerHTML = this.value + " minutes";
                    }

                    //Setting all the hidden inputs to the correct value to pass to DB
                    document.getElementById('createEvtLocationToDB').value = results.name;
                    //document.getElementById('myRangeToDB').value = slider.value; //for sending to DB

                    //console.log(document.getElementById('evtTimeToDB').value);
                    document.getElementById('evtTimeToDB').value = document.getElementById('evtTime').value;
                    //console.log(document.getElementById('evtTimeToDB').value);

                    var place_id_element = document.createElement('INPUT');
                    place_id_element.id = "place_id";
                    place_id_element.type = "hidden";
                    place_id_element.name = "place_id";
                    place_id_element.value = mdata[i].place_id;

                    let sendBtn = document.getElementById("submitBtn");
                    sendBtn.appendChild(place_id_element);

                    sendBtn.onclick = check_empty;
                }
            };
            infoDiv.appendChild(createEventButton);

            //Set the content of the InfoWindow to the clicked on marker and open it
            let pla = document.getElementById("mInfo");
            pla.appendChild(infoDiv);
            info.setContent(infoDiv);
            info.open(map, marker);
        });
    });
}

//this function is used to convert a month from a number to a String. It's used when a user clicks on the 'See Events' button to show all events at a specific location
function convertMonth(month){
    switch (month){
        case "01":
            return "Jan";
        case "02":
            return "Feb";
        case "03":
            return "Mar";
        case "04":
            return "Apr";
        case "05":
            return "May";
        case "06":
            return "Jun";
        case "07":
            return "Jul";
        case "08":
            return "Aug";
        case "09":
            return "Sep";
        case "10":
            return "Oct";
        case "11":
            return "Nov";
        case "12":
            return "Dec";
        default:
    }
}

//Used to create the list of events in the popup window
//This function does the exact code from upcoming-events.php's printEvent, but is translated to javascript and is created dynamically instead of at the beginning of page load
//HTML Code of what is being created in printEvent is shown below
/*<div class="event-container">
        <div class="date-container">
            <p><span class="month">'.$month.'</span>
                <span class="day">'.$day.'</span></p>
        </div>
        <div class="detail">
            <h3>'.$event_name.'</h3>
            <h4>'.$location.'</h4>
            <a href="'.$url.'" class="button">Learn More</a>
            <form method = "post" action="my-events.php">
            <input type="submit" name="btnJoin" value="Join Event" class="button">
            <input type="hidden" name="hd_event_id" value="'. $event_id .'" />
            </form>
        </div>
    </div>
*/
function printEvent(response, results, x){
    var event_container = document.createElement('div');
    event_container.className = "event-container see-event-container";

    var date_container = document.createElement('div');
    date_container.className = "date-container";

    var p = document.createElement('p');

    var month = convertMonth(response.event_date.substring(5, 7));

    p.innerHTML = "<span class='month'>" + month
    + "</span><span class='day'>" + response.event_date.substring(8, response.event_date.length)  + "</span>";

    var detail = document.createElement('div');
    detail.className = "detail";

    var h3 = document.createElement('h3');
    h3.id = "header3_" + x;
    if(response.event_name == ""){
        h3.innerText = "Event " + x;
    }else{
        h3.innerText = response.event_name;
    }
    
    var h4 = document.createElement('h4');
    h4.innerText = "Type: " + response.event_type;

    var createdBy = document.createElement('p');
    createdBy.innerHTML = "Created by <a href="+ response.user_name + ">" + response.user_name + "</a>";

    var a1 = document.createElement('a');
    a1.className = "button";
    a1.innerText = "Learn More";
    a1.href = "eventDetail.php?item=" + encodeURIComponent(response.event_id);

    var joinEventContainer = document.createElement('form');
    joinEventContainer.method = "post";
    joinEventContainer.action = "my-events.php";

    var joinEventBtn = document.createElement("input");
    joinEventBtn.type = "button";
    joinEventBtn.name = "btnJoin";
    joinEventBtn.value = "Join Event";
    joinEventBtn.className = "button joinEvtButton float-right";
    joinEventBtn.onclick = function(){
        if(response.user_name === document.getElementById("site_user").text){
            joinEventBtn.remove();
            var joinedEventBtn = document.createElement("p");
            //joinedEventBtn.type = "button";
            joinedEventBtn.innerHTML = "Your Event";
            joinedEventBtn.className = "joinedEventBtn float-right";

            joinEventContainer.appendChild(joinedEventBtn);
        }else{
            //take away join event button if user is on there
            $.ajax({
                url: "event-users.php",
                data: {
                    "event_id": response.event_id,
                    "user_id": document.getElementById("site_user").text
                },
                success: function(response) {
                    //username found in database on event_id
                    if(!response.includes("[]")){
                        joinEventBtn.remove();
                        var joinedEventBtn = document.createElement("p");
                        //joinedEventBtn.type = "button";
                        joinedEventBtn.innerHTML = "Already Joined";
                        joinedEventBtn.className = "joinedEventBtn float-right";

                        joinEventContainer.appendChild(joinedEventBtn);
                        //$("#header3_" + x).html($("#header3_" + x).html() + "<span style='color: #B899DF;'> (Joined)</span>");
                    }
                    //User can join event because they have not joined it yet
                    else{
                        joinEventBtn.type = "submit";
                        joinEventBtn.onclick = function(){};
                        joinEventBtn.click();
                    }
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        }
    };

    var joinEventHiddenIdToDB = document.createElement("input");
    joinEventHiddenIdToDB.type = "hidden";
    joinEventHiddenIdToDB.name = "hd_event_id";
    joinEventHiddenIdToDB.value = response.event_id;

    joinEventContainer.appendChild(a1);
    joinEventContainer.appendChild(joinEventBtn);
    joinEventContainer.appendChild(joinEventHiddenIdToDB);

    date_container.appendChild(p);
    detail.appendChild(h3);
    detail.appendChild(h4);
    detail.appendChild(createdBy);
    detail.appendChild(joinEventContainer);
    event_container.appendChild(date_container);
    event_container.appendChild(detail);

    //Put the event_container inside of the 'See Events' popup window, so it now displays on the page
    let popup = document.getElementById("seeEvents");
    popup.appendChild(event_container);
}

// Validating Empty Field
function check_empty() {
    
    //validateEvent shows what the user input needs to look like
    if(validateEvent()){
        document.getElementById('myRangeToDB').value = document.getElementById("myRange").value; //for sending event duration to DB
        //document.getElementById('evtTimeToDB').value = (document.getElementById("evtTime").value).replace(/[a-z]/gi, '') //for sending event start time to db as a Time object hh:mm:ss
        //document.getElementById('evtTimeToDB').value = document.getElementById("evtTime").value //for sending event start time as a 12hr time with am/pm to db as a varchar 

        //For sending event start time to db as 24hr time hh:mm
        var time = document.getElementById("evtTime").value;
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

        document.getElementById('evtTimeToDB').value = time //for sending event start time to db as a varchar
        document.getElementById('datepickerToDB').value = moment(document.getElementById("datepicker").value).format("YYYY-MM-DD"); //for sending event date to db

        //submit the event data to the database. To do so, the submit button must be type of submit now.
        let sendBtn = document.getElementById("submitBtn");
        sendBtn.type = "submit";

        //click the button to send data off to database
        sendBtn.click();
    }
}

//validateEvent displays errors of form on create event
function validateEvent(){
    //remove all other errors if they have occured before (errors will show after this, this just makes it so that the errors aren't displayed multiple times)
    $(".createEventError").remove();
    var returnValue = true;
    var correctDate = false;

    //this checks to see if the date input is a correct date. If not, an error is displayed to the user in html.
    var date = moment(document.getElementById("datepicker").value).format("YYYY-MM-DD");
    if(date == "Invalid date" || !moment(date).isSameOrAfter(Date.now(), 'day')){
        var dateError = document.createElement('p');
        dateError.innerHTML = "Date incorrect. Enter a valid date";
        dateError.style = "color:red";
        dateError.id = "dateError";
        dateError.className = "createEventError";

        var eventDate = document.getElementById("eventDate");
        eventDate.appendChild(dateError);
        returnValue = false;
    }
    if(moment(date).isAfter(Date.now(), 'day')){
        correctDate = true;
    }

    //this checks to see if the time input is a correct time. If not, an error is displayed to the user in html.
    if(!validTime(document.getElementById("evtTime").value, correctDate)){
        var timeError = document.createElement('p');
        timeError.innerHTML = "Enter a valid time that is 30 min or later";
        timeError.style = "color:red";
        timeError.id = "timeError";
        timeError.className = "createEventError";

        var eventTime = document.getElementById("eventTime");
        eventTime.appendChild(timeError);
        returnValue = false;
    }

    //this checks to see if the sport is a correct sport. If not, an error is displayed to the user in html.
    if($("#sportText").text() == "Select Sport" || !validSport($("#sportText").text())){
        var sportError = document.createElement('p');
        sportError.innerHTML = "Please select a sport";
        sportError.style = "color:red";
        sportError.id = "sportError";
        sportError.className = "createEventError";

        var sportDropdown = document.getElementById("dropdownSports");
        sportDropdown.appendChild(sportError);
        returnValue = false;
    }

    //this checks whether the event name is empty or not. If not, an error is displayed to the user in html.
    if(document.getElementById("evtName").value === ""){
        var nameError = document.createElement('p');
        nameError.innerHTML = "Enter an event name";
        nameError.style = "color:red";
        nameError.id = "nameError";
        nameError.className = "createEventError";

        var sportDropdown = document.getElementById("eventNameDiv");
        sportDropdown.appendChild(nameError);
        returnValue = false;
    }


    return returnValue;
}

//Checks if the sport selected is a valid sport (basically sees if user inspected element and changed the value), then displays error in validateEvent
function validSport(text){
    var sports = new Array("Baseball", "Basketball","Billiards (Pool)", "Bowling","Climbing","Cricket","Curling","Football","Golf/Discgolf","Rugby", "Skateboarding", "Skiing", "Snowboarding", 
    "Soccer", "Swimming", "Tennis/Table Tennis", "Volleyball", "Weightlifting");

    for(var x = 0; x < sports.length; x++){
        if(text === sports[x]){
            return true;
        }
    }
    return false;
}

//Checks if the time is a valid time for creating an event -- is it 30 mins or later than the current time
function validTime(text, date){
    if(text.length == 6){
        if(text.substring(1,2) == ":" && (text.substring(4,6) == "pm" || text.substring(4,6) == "am")){
            if(isNumber(text.substring(0,1)) && isNumber(text.substring(2,4))){
                if(date){
                    return true;
                }
                var userInputTime = moment(text, 'h:mma');
                var newDateObj = moment(new Date()).add(30, 'm').toDate();
                var timeToCompare = moment(newDateObj.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true }), 'h:mma');

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
                var userInputTime = moment(text, 'h:mma');
                var newDateObj = moment(new Date()).add(30, 'm').toDate();
                var timeToCompare = moment(newDateObj.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true }), 'h:mma');

                if(userInputTime.isAfter(timeToCompare)){
                    return true;
                }
            }
        }
    }
    return false;
}

function dropdownTxtChange(evt){
    $("#sportText").html(evt.target.text);

    //setting value so it can be passed to db
    let typeOfSport = $("#sportText").html();
    document.getElementById('sportTextToDB').value = typeOfSport; //for sending type of sport to DB
}

//Function to Hide Popup
function div_hide(){
    //Guest User clicks on the close button
    if(document.getElementById('createEvtPopup') == null){
        document.getElementById('promptAccountPopup').style.display = "none";
    }
    //Registered User clicks on the close button
    else{
        document.getElementById('createEvtPopup').style.display = "none";
    }
    $('.carousel-indicators').show();
}

//Function to hide 'See Events' Popup
function hideEvents(){
    $('#seeEventsPopup').hide();
    $('.carousel-indicators').show();
}


//Callback function that extracts information from Google Nearby Search GET request API calls
function gotPlaceData(data, status, keyword) {
    data = validateLocations(data, keyword);
    
    if (status == google.maps.places.PlacesServiceStatus.OK) {
        for (var i = 0; i < data.length; i++) {
            let markLatLng = data[i]["geometry"]["location"];
            let markName = data[i].name;

            addMarker(markLatLng, markName, data, i);
        }
    }
    
    /* OLD WAY
    //check all data to make sure that it is a proper location to play sports at
    data = validateLocations(data, keyword);

    //add all markers according to the nearby locations data 
    for (i = 0; i < data.length; i++) {
        let markLat = parseFloat(data[i]["geometry"]["location"].lat);
        let markLong = parseFloat(data[i]["geometry"]["location"].lng);
        let markName = data[i].name;

        addMarker(markLat, markLong, markName, data, i);
    }*/
    
    

}

//Function to get the Latitude and Longitude from the user -- either through requesting their location or them typing one in manually
function getLatLong() {
    var tempRad = $("#radius").val();
    if(isNumber(tempRad) && tempRad.length >= 1){
        rad = parseInt(tempRad);
    }else{
        $("#radius").val(2);
    }

    //get location of input address
    getLocationInput();
}

//gets the location of input address
function getLocationInput(){
    let address = $("#location").val();
    if(address !== ""){
        let latreq = "https://maps.googleapis.com/maps/api/geocode/json?address=" + address 
        + "&key=" + myKey;
        $.get(latreq, gotInputAddress, "json");
    }else{
        initMap(latNum, lngNum, rad);
    }
}

//Helper function called in getLatLong to ensure the user types in a valid number for radius
function isNumber(n) {
    return !isNaN(parseInt(n)) && isFinite(n) && !n.includes(".") && !n.includes("-");
}

//If a user types in an address/place to search for on the map, this function is called to find where that place is and create the map based off of it's location
function gotInputAddress(data) {
    if(data.results.length == 0){
        $("#location").attr("placeholder", 'Enter a location'); 
        $("#location").val("");
        //initMap(latNum, lngNum, rad);
        return;
    }
    latNum = parseFloat(data["results"][0]["geometry"]["location"].lat);
    lngNum = parseFloat(data["results"][0]["geometry"]["location"].lng);
    //create map
    initMap(latNum, lngNum, rad);
}

//Filters out markers that are not associated with a sport
function validateLocations(data, keyword){
    
    //set dictionary to types of locations that can be accepted
    var dictionary = new Array("bar", "bowling_alley","campground", "church","gym","park","primary_school","school","secondary_school","university");

    var count = 0;

    //initialize array of valid locations
    var newArray = new Array();

    //same code as previous loops, just adds the location this time
    for(var x = 0; x < data.length; x++){
        var store = false;
        //checks if location is a store or general contractor, if so then don't add it to valid locations
        for(var z = 0; z < data[x].types.length; z++){
            if(data[x].types[z].toUpperCase().includes("STORE") || (data[x].types[z].toUpperCase().includes("GENERAL_CONTRACTOR"))){
                store = true;
                z = data[x].types.length;
            }
        }
        if(!store){
            for(var z = 0; z < data[x].types.length; z++){
                //if the name of the location contains anything in the keyword array, then add it (Ex: place name is "Basketball Courts" but it's types are not within the dictionary -- this fixes it)
                if(data[x].name.toUpperCase().includes(keyword[0].toUpperCase()) || data[x].name.toUpperCase().includes(keyword[1].toUpperCase())){
                    newArray[count] = data[x];
                    count++;
                    z = data[x].types.length;
                }
                //check dictionary, add location to data if one of it's types match
                for(var y = 0; y < dictionary.length; y++){
                    if(data[x].types[z] == dictionary[y]){
                        newArray[count] = data[x];
                        count++;
                        z = data[x].types.length;
                    }
                }
            }
        }
    }
    return newArray;
}

function hideLogin(){
    $(".login_form").hide();
    $(".signup_form").show();
}
function hideSignup(){
    $(".login_form").show();
    $(".signup_form").hide();
}