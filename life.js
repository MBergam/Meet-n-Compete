//https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=AIzaSyDS3p3iX3eIPWNLMuFQNrPRKWyE5un7dtY

//AIzaSyDS3p3iX3eIPWNLMuFQNrPRKWyE5un7dtY

//https://cors-anywhere.herokuapp.com/

$(document).ready(start);

var map;
var rad = 3000;
var latNum = null;
var lngNum = null;
var tableCount;
var results;
var resCount = 0;

function start() {
    $("#search").click(getLatLon);
    //$('.checkbox').attr('checked', true);
    getLocation();
}

function success(pos) {
    var crd = pos.coords;
    console.log('Your current position is:');
    console.log(`Latitude : ${crd.latitude}`);
    latNum = crd.latitude;
    console.log(`Longitude: ${crd.longitude}`);
    lngNum = crd.longitude;
    console.log(`More or less ${crd.accuracy} meters.`);
    initMap(latNum, lngNum, rad);
}

function error(err) {
    console.log(`${err.message}`);
    const div = document.createElement('div');
    div.id = 'manualLoc';
    div.className = 'allText';
    div.innerHTML = '<br></br>Enter a location: <input type = "text" class = "allText" id = "address" /><br></br><br></br>';

    document.getElementById('map').appendChild(div);
}

function getLocation(){
    var options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0
      };
    navigator.geolocation.getCurrentPosition(success, error, options);
}
  
function initMap(lati, longi, radi) {
    $(".markInfo").remove();
    
    //set table count to 1 so that values will be enetered in below the title of the tab;le each time
    tableCount = 1;

    //create map with appropriate zoom level
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
    }

    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: lati, lng: longi},
        zoom: zoom,
    });

    radi += 2000;

    //see what essentials are checked, and pass that info off to add markers
    if (document.getElementById("basketball").checked) {
        bask_preqdata = {
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
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
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
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
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
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
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
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
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
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
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
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
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
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
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
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
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
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
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
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
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
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
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
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
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
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
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
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
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
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
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
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
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
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
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
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

    //circle to mark radius - was not working as expected so I use the zoom level to show appropriate radius
    /*
    rad = new google.maps.Circle({
        center: new google.maps.LatLng(lati, longi),
        radius: radi,
        map: map
    });*/
}

/*function addMarker(lati, longi, name) {
    
    var marker = new google.maps.Marker({
        position: {lat: lati, lng: longi},
        map: map
    });
    //add different types of markers here
    var info = new google.maps.InfoWindow({
        content: name
    });
    marker.addListener('click', function(){
        info.open(map, marker);
    });
    
}*/

function addMarker(lati, longi, name, mdata, i) {
    var marker = new google.maps.Marker({
        position: {lat: lati, lng: longi},
        map: map
    });

    var info = new google.maps.InfoWindow({
        content: name
    });
    console.log(mdata);
    marker.addListener('click', function(){
        $(".markInfo").remove();
        info.open(map, marker);

        if (mdata[i]["photos"] != null) {
            let photos = document.getElementsByClassName("photo");
            for(var x = 0; x < photos.length; x++){
                var toCompare = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=" + mdata[i]["photos"][0].photo_reference + "&key=AIzaSyAHoreTH9KWnvppgnaECTPBPkjosVlvGh8";
                if(toCompare == photos[x].src){
                    return;
                }
            }
            let img = document.createElement('img');
            img.className = 'photo markInfo';

            img.src = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=" + mdata[i]["photos"][0].photo_reference + "&key=AIzaSyAHoreTH9KWnvppgnaECTPBPkjosVlvGh8";
            let div = document.getElementById("markerInfo");
            div.appendChild(img);
            //document.body.appendChild(div);
            
            
        }
        
        let directionsButton = document.createElement("button");
        directionsButton.className = "directions markInfo";
        directionsButton.innerHTML = "Get Directions";

        directionsButton.onclick = function(){ 
            window.open("https://www.google.com/maps/dir/?api=1&destination=" + mdata[i].name + "&destination_place_id=" + mdata[i].place_id, "_blank");
        };
        infoDiv.appendChild(directionsButton);
        document.body.appendChild(div);

        var placesService = new google.maps.places.PlacesService(map);

        placesService.getDetails(
            {placeId: mdata[i].place_id},
            function(results, status) {
                let p = document.createElement('p');
                p.className = "allText markInfo";
                p.innerText = name + "\n" + results.vicinity + "\nRating: " + results.rating + "/5 (" + results.user_ratings_total + " total)";

                let div = document.getElementById("markerInfo");
                div.append(p);
                console.log(status);
                console.log(results); 
            }
        );
    });

}

function gotPlaceData(data, keyword) {
    data = checkData(data, keyword);
    console.log(data);
    for (i = 0; i < data.length; i++) {
        let markLat = parseFloat(data[i]["geometry"]["location"].lat);
        let markLong = parseFloat(data[i]["geometry"]["location"].lng);
        let markName = data[i].name;

        addMarker(markLat, markLong, markName, data, i);
    }
    
}

function getLatLon() {
    if(latNum != null && lngNum != null){
        initMap(latNum, lngNum, rad);
    }else{
        let address = $("#address").val();
        let latreq = "https://maps.googleapis.com/maps/api/geocode/json?address=" + address 
        + "&key=AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4";
        $.get(latreq, gotData, "json");
    }    
}


function gotData(data) {
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
function checkData(data, keyword){
    var dictionary = new Array("bar", "bowling_alley","campground", "church","gym","park","primary_school","school","secondary_school","university");

    var count = 0;
    var newArray;

    for(var x = 0; x < data.results.length; x++){
        var store = false;
        for(var z = 0; z < data.results[x].types.length; z++){
            if((data.results[x].types[z].length > 5 && data.results[x].types[z].toUpperCase().includes("STORE")) || (data.results[x].types[z].toUpperCase().includes("GENERAL_CONTRACTOR"))){
                store = true;
                z = data.results[x].types.length;
            }
        }
        if(!store){
            for(var z = 0; z < data.results[x].types.length; z++){
                if(data.results[x].name.toUpperCase().includes(keyword[0].toUpperCase()) || data.results[x].name.toUpperCase().includes(keyword[1].toUpperCase())){
                    count++;
                    z = data.results[x].types.length;
                }
                for(var y = 0; y < dictionary.length; y++){
                    if(data.results[x].types[z] == dictionary[y]){
                        count++;
                        z = data.results[x].types.length;
                    }
                }
            }
        }
    }

    newArray = new Array(count);
    count = 0;

    for(var x = 0; x < data.results.length; x++){
        var store = false;
        for(var z = 0; z < data.results[x].types.length; z++){
            if(data.results[x].types[z].length > 5 && data.results[x].types[z].toUpperCase().includes("STORE") || (data.results[x].types[z].toUpperCase().includes("GENERAL_CONTRACTOR"))){
                store = true;
                z = data.results[x].types.length;
            }
        }
        if(!store){
            for(var z = 0; z < data.results[x].types.length; z++){
                if(data.results[x].name.toUpperCase().includes(keyword[0].toUpperCase()) || data.results[x].name.toUpperCase().includes(keyword[1].toUpperCase())){
                    newArray[count] = data.results[x];
                    count++;
                    z = data.results[x].types.length;
                }
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

//getting and adding the travel time for each marker
function getTime(data) {
    //console.log(data);
    if (resCount >= results.length) {
        resCount = 0;
    }
    
    var tab = document.getElementById("travel");

    if (results[resCount] != null) {
        var row = tab.insertRow(tableCount);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);

        //data.destination_addresses[0];
        //console.log(resCount);
        
        cell1.innerHTML = results[resCount].name;
        cell2.innerHTML = data["rows"][0]["elements"][0]["duration"]["text"];
        tableCount++;
        resCount++;
    }
    
}
