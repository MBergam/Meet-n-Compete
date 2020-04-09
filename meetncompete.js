//https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=AIzaSyDS3p3iX3eIPWNLMuFQNrPRKWyE5un7dtY

//AIzaSyDS3p3iX3eIPWNLMuFQNrPRKWyE5un7dtY
//AIzaSyAHoreTH9KWnvppgnaECTPBPkjosVlvGh8 -- MAX'S KEY

//https://cors-anywhere.herokuapp.com/


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
    $("#search").click(getLatLong);
    $("a[role='menuitem']").click(dropdownTxtChange);
    //$('.checkbox').attr('checked', true);
    getLocation();
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

//If user blocks location or there was an error trying to access their location - then prompts for manual location
function error(err) {
    console.log(`${err.message}`);
    const div = document.createElement('div');
    div.id = 'manualLoc';
    div.className = 'allText';
    div.innerHTML = '<br></br>Enter a location: <input type = "text" class = "allText" id = "address" /><br></br><br></br>';

    document.getElementById('map').appendChild(div);
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

    //see what preferences are checked, and pass that info off to add markers later
    if (document.getElementById("basketball").checked) {
        bask_preqdata = {
            key: myKey,
            radius: radi,
            location: lati +  "," + longi,
            keyword: "basketball court"
        }

        var basketball_keyword = new Array("basketball", "court");

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", bask_preqdata, 
        //getting the data for the places to mark on the map
        function placeData(data) {
            gotPlaceData(data,basketball_keyword);
        }, 
        "json");
    }

    if (document.getElementById("baseball").checked) {
        base_reqdata = {
            key: myKey,
            radius: radi,
            location: lati +  "," + longi,
            keyword: "baseball field"
        }

        var baseball_keyword = new Array("baseball", "field");

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", base_reqdata, 
        function placeData(data) {
            gotPlaceData(data,baseball_keyword);
        },
        "json");
    }

    if (document.getElementById("soccer").checked) {
        soc_reqdata = {
            key: myKey,
            radius: radi,
            location: lati +  "," + longi,
            keyword: "soccer field"
        }

        var soccer_keyword = new Array("soccer", "field");

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", soc_reqdata,
        function placeData(data) {
            gotPlaceData(data,soccer_keyword);
        }, 
        "json");
    }
    if (document.getElementById("tennis").checked) {
        ten_reqdata = {
            key: myKey,
            radius: radi,
            location: lati +  "," + longi,
            keyword: "tennis"
        }

        var tennis_keyword = new Array("tennis", "court");

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", ten_reqdata, 
            function placeData(data) {
                gotPlaceData(data,tennis_keyword);
            }, 
        "json");

        tennis_reqdata = {
            key: myKey,
            radius: radi,
            location: lati +  "," + longi,
            keyword: "tennis court"
        }

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", tennis_reqdata, 
            function placeData(data) {
                gotPlaceData(data,tennis_keyword);
            }, 
        "json");
    }
    if (document.getElementById("volleyball").checked) {
        volley_reqdata = {
            key: myKey,
            radius: radi,
            location: lati +  "," + longi,
            keyword: "volleyball court"
        }

        var volleyball_keyword = new Array("volleyball", "court");

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", volley_reqdata, 
            function placeData(data) {
                gotPlaceData(data,volleyball_keyword);
            }, 
        "json");
    }
    if (document.getElementById("football").checked) {
        foot_reqdata = {
            key: myKey,
            radius: radi,
            location: lati +  "," + longi,
            keyword: "snowboarding"
        }

        var snowboarding_keyword = new Array("snowboarding", "215436t345");

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", foot_reqdata, 
            function placeData(data) {
                gotPlaceData(data,snowboarding_keyword);
            }, 
        "json");
    }
    if (document.getElementById("swimming").checked) {
        swim_reqdata = {
            key: myKey,
            radius: radi,
            location: lati +  "," + longi,
            keyword: "swimming pool"
        }

        var swimming_keyword = new Array("swimming", "pool");

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", swim_reqdata, 
            function placeData(data) {
                gotPlaceData(data ,swimming_keyword);
            }, 
        "json");
    }
    if (document.getElementById("skiing").checked) {
        ski_reqdata = {
            key: myKey,
            radius: radi,
            location: lati +  "," + longi,
            keyword: "skiing"
        }
        var skiing_keyword = new Array("skiing", "resort");

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", ski_reqdata, 
            function placeData(data) {
                gotPlaceData(data ,skiing_keyword);
            }, 
        "json");
    }
    if (document.getElementById("rugby").checked) {
        rug_reqdata = {
            key: myKey,
            radius: radi,
            location: lati +  "," + longi,
            keyword: "rugby field"
        }

        var rugby_keyword = new Array("rugby", "field");

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", rug_reqdata, 
            function placeData(data) {
                gotPlaceData(data ,rugby_keyword);
            }, 
        "json");
    }
    if (document.getElementById("bowling").checked) {
        bowl_reqdata = {
            key: myKey,
            radius: radi,
            location: lati +  "," + longi,
            keyword: "bowling alley"
        }

        var bowling_keyword = new Array("bowling", "alley");

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", bowl_reqdata, 
            function placeData(data) {
                gotPlaceData(data, bowling_keyword);
            }, 
        "json");
    }
    if (document.getElementById("weight_lifting").checked) {
        weight_reqdata = {
            key: myKey,
            radius: radi,
            location: lati +  "," + longi,
            keyword: "weight lifting"
        }

        var weight_lifting_keyword = new Array("weight", "lifting");

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", weight_reqdata, 
            function placeData(data) {
                gotPlaceData(data, weight_lifting_keyword);
            }, 
        "json");
    }
    if (document.getElementById("billiards").checked) {
        bill_reqdata = {
            key: myKey,
            radius: radi,
            location: lati +  "," + longi,
            keyword: "billiard table"
        }

        var billiards_keyword = new Array("billiard", "tables");

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", bill_reqdata, 
            function placeData(data) {
                gotPlaceData(data, billiards_keyword);
            }, 
        "json");
    }
    if (document.getElementById("climbing").checked) {
        climb_reqdata = {
            key: myKey,
            radius: radi,
            location: lati +  "," + longi,
            keyword: "climbing"
        }

        var climbing_keyword = new Array("climbing", "215436t345");

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", climb_reqdata, 
            function placeData(data) {
                gotPlaceData(data, climbing_keyword);
            }, 
        "json");
    }
    if (document.getElementById("golf").checked) {
        golf_reqdata = {
            key: myKey,
            radius: radi,
            location: lati +  "," + longi,
            keyword: "golf course"
        }

        var golf_keyword = new Array("golf", "course");

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", golf_reqdata, 
            function placeData(data) {
                gotPlaceData(data, golf_keyword);
            }, 
        "json");
    }
    if (document.getElementById("curling").checked) {
        curl_reqdata = {
            key: myKey,
            radius: radi,
            location: lati +  "," + longi,
            keyword: "curling sheet"
        }

        var curling_keyword = new Array("curling", "215436t345");

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", curl_reqdata, 
            function placeData(data) {
                gotPlaceData(data, curling_keyword);
            }, 
        "json");
    }
    if (document.getElementById("cricket").checked) {
        crick_reqdata = {
            key: myKey,
            radius: radi,
            location: lati +  "," + longi,
            keyword: "cricket field"
        }

        var cricket_keyword = new Array("cricket", "215436t345");

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", crick_reqdata, 
            function placeData(data) {
                gotPlaceData(data, cricket_keyword);
            }, 
        "json");
    }
    if (document.getElementById("skateboarding").checked) {
        skate_reqdata = {
            key: myKey,
            radius: radi,
            location: lati +  "," + longi,
            keyword: "skateboarding"
        }

        var skateboarding_keyword = new Array("skate", "park");

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", skate_reqdata, 
            function placeData(data) {
                gotPlaceData(data, skateboarding_keyword);
            }, 
        "json");
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
function addMarker(lati, longi, name, mdata, i) {
    //create marker
    var marker = new google.maps.Marker({
        position: {lat: lati, lng: longi},
        map: map
    });

    //intitialize info variable if this is the very first marker added to the map
    if (!info) {
        info = new google.maps.InfoWindow();
    }

    marker.addListener('click', function() {
        //close other marker that could have been clicked before
        info.close();
        

        infoDiv = document.createElement('div');
        infoDiv.id = "markerInfo";
        let img = document.createElement('img');
        img.className = 'photo markInfo';
        
        //set an image for a marker. If image, then use default.
        if (mdata[i]["photos"] != null) {
            img.src = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=250&photoreference=" + mdata[i]["photos"][0].photo_reference + "&key=" + myKey; 
        }else{
            img.src = "./img/no-image-available.png"; 
        }
        infoDiv.appendChild(img);

        var placesService = new google.maps.places.PlacesService(map);

        placesService.getDetails( {placeId: mdata[i].place_id}, function(results, status) {
            console.log(results);
            //Get user ratings
            let p = document.createElement('p');
            p.className = "allText markInfo";
            if(results.rating == null){
                p.innerText = name + "\n" + results.vicinity + "\nNo user ratings available. ";
            }else{
                p.innerText = name + "\n" + results.vicinity + "\nRating: " + results.rating + "/5 (" + results.user_ratings_total + " total)";
            }
            infoDiv.append(p);

            //Create 'See Reviews' button
            let reviewsButton = document.createElement("button");
            reviewsButton.className = "reviews markInfo button";
            reviewsButton.innerHTML = "See Reviews";

            reviewsButton.onclick = function(){ 
                window.open("https://search.google.com/local/reviews?placeid=" + mdata[i].place_id);
            };
            infoDiv.appendChild(reviewsButton);

            //Create 'Directions' button
            let directionsButton = document.createElement("button");
            directionsButton.className = "directions button markInfo";
            directionsButton.innerHTML = "Get Directions";
            directionsButton.onclick = function(){ 
                window.open("https://www.google.com/maps/dir/?api=1&origin=" + latNum + "," + lngNum + "&destination=" + mdata[i].name + "&destination_place_id=" + mdata[i].place_id, "_blank");
            };
            infoDiv.appendChild(directionsButton);

            //Create 'Create Event' button
            let createEventButton = document.createElement("button");
            createEventButton.className = "createEvent button markInfo";
            createEventButton.innerHTML = "Create Event";
            createEventButton.onclick = function(){ 
                //Guest User clicks on the Create Event
                if(document.getElementById('createEvtPopup') == null){
                    document.getElementById('promptAccountPopup').style.display = "block";
                    $('.carousel-indicators').hide();
                    document.getElementById('promptForAccount').innerHTML = "<b> Please create an account to create an event at " + results.name + "</b>";
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

// Validating Empty Field
function check_empty() {
    if (document.getElementById('name').value == "" || document.getElementById('email').value == "" || document.getElementById('msg').value == "") {
        alert("Fill All Fields !");
    } else {
        document.getElementById('form').submit();
    }
}

function dropdownTxtChange(evt){
    $("#sportText").html(evt.target.text);
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


//Callback function that extracts information from Google Nearby Search GET request API calls
function gotPlaceData(data, keyword) {
    //check all data to make sure that it is a proper location to play sports at
    data = validateLocations(data, keyword);

    //add all markers according to the nearby locations data 
    for (i = 0; i < data.length; i++) {
        let markLat = parseFloat(data[i]["geometry"]["location"].lat);
        let markLong = parseFloat(data[i]["geometry"]["location"].lng);
        let markName = data[i].name;

        addMarker(markLat, markLong, markName, data, i);
    }   
}

//Function to get the Latitude and Longitude from the user -- either through requesting their location or them typing one in manually
function getLatLong() {
    var tempRad = $("#radius").val();
    if(isNumber(tempRad) && tempRad.length >= 1){
        rad = parseInt(tempRad);
    }else{
        $("#radius").val(2);
    }
    if(latNum != null && lngNum != null){
        initMap(latNum, lngNum, rad);
    }else{
        let address = $("#address").val();
        let latreq = "https://maps.googleapis.com/maps/api/geocode/json?address=" + address 
        + "&key=" + myKey;
        $.get(latreq, gotInputAddress, "json");
    }
}

//Helper function called in getLatLong to ensure the user types in a valid number for radius
function isNumber(n) {
    return !isNaN(parseInt(n)) && isFinite(n) && !n.includes(".") && !n.includes("-");
}

//If a user types in an address/place to search for on the map, this function is called to find where that place is and initialize the map based off of it's location
function gotInputAddress(data) {
    if(data.results.length == 0){
        $("#manualLoc").html('<br></br>Enter a location (try again): <input type = "text" class = "allText" id = "address" /><br></br><br></br>'); 
        return;
    }
    $("#manualLoc").remove();
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
    for(var x = 0; x < data.results.length; x++){
        var store = false;
        //checks if location is a store or general contractor, if so then don't add it to valid locations
        for(var z = 0; z < data.results[x].types.length; z++){
            if(data.results[x].types[z].toUpperCase().includes("STORE") || (data.results[x].types[z].toUpperCase().includes("GENERAL_CONTRACTOR"))){
                store = true;
                z = data.results[x].types.length;
            }
        }
        if(!store){
            for(var z = 0; z < data.results[x].types.length; z++){
                //if the name of the location contains anything in the keyword array, then add it (Ex: place name is "Basketball Courts" but it's types are not within the dictionary -- this fixes it)
                if(data.results[x].name.toUpperCase().includes(keyword[0].toUpperCase()) || data.results[x].name.toUpperCase().includes(keyword[1].toUpperCase())){
                    newArray[count] = data.results[x];
                    count++;
                    z = data.results[x].types.length;
                }
                //check dictionary, add location to data if one of it's types match
                for(var y = 0; y < dictionary.length; y++){
                    if(data.results[x].types[z] == dictionary[y]){
                        newArray[count] = data.results[x];
                        count++;
                        z = data.results[x].types.length;
                    }
                }
            }
        }
    }
    return newArray;
}
