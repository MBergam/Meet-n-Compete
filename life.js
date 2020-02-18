//https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=AIzaSyDS3p3iX3eIPWNLMuFQNrPRKWyE5un7dtY

//AIzaSyDS3p3iX3eIPWNLMuFQNrPRKWyE5un7dtY

//new key
//AIzaSyAHoreTH9KWnvppgnaECTPBPkjosVlvGh8
//https://cors-anywhere.herokuapp.com/ to help fix CORS error (or use chrome extension)

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
    $('.checkbox').attr('checked', true);
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
        preqdata = {
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
            radius: radi,
            location: lati +  "," + longi,
            keyword: "basketball court"
        }

        var basketball_keyword = new Array("basketball", "court");

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", preqdata, 
        //getting the data for the places to mark on the map
            function gotplacedata(data) {
                console.log(basketball_keyword);
                console.log(data);

                data = checkData(data, basketball_keyword);
                console.log(data);
            
                for (i = 0; i < data.length; i++) {
                    let markLat = parseFloat(data[i]["geometry"]["location"].lat);
                    let markLong = parseFloat(data[i]["geometry"]["location"].lng);
                    let markName = data[i].name;
            
                    /*if (google.maps.geometry.spherical.computeDistanceBetween((data["results"][i]["geometry"]["location"]), rad.getCenter()) > rad.getRadius()) {
                        console.log("ga");
                    } else {
                        addMarker(markLat, markLong, markName); 
                    }*/
                    addMarker(markLat, markLong, markName);
                    
                    //$.get("https://cors-anywhere.herokuapp.com/https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=" + latNum + "," + lngNum + "&destinations=" + markLat + "," + markLong + "&key=AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
                    //getTime, "json");
                    
                }
                
            }, 
        "json");
    }

    if (document.getElementById("baseball").checked) {
        breqdata = {
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
            radius: radi,
            location: lati +  "," + longi,
            keyword: "baseball field"
        }

        var baseball_keyword = new Array("baseball", "field");

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", breqdata, 
            function gotplacedata(data) {
                console.log(baseball_keyword);
                console.log(data);
                data = checkData(data, baseball_keyword);
                console.log(data);
            
                for (i = 0; i < data.length; i++) {
                    let markLat = parseFloat(data[i]["geometry"]["location"].lat);
                    let markLong = parseFloat(data[i]["geometry"]["location"].lng);
                    let markName = data[i].name;
            
                    /*if (google.maps.geometry.spherical.computeDistanceBetween((data["results"][i]["geometry"]["location"]), rad.getCenter()) > rad.getRadius()) {
                        console.log("ga");
                    } else {
                        addMarker(markLat, markLong, markName); 
                    }*/
                    addMarker(markLat, markLong, markName);
                    
                    //$.get("https://cors-anywhere.herokuapp.com/https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=" + latNum + "," + lngNum + "&destinations=" + markLat + "," + markLong + "&key=AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
                    //getTime, "json");
                    
                }
                
            }, 
        "json");
    }

    if (document.getElementById("soccer").checked) {
        wreqdata = {
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
            radius: radi,
            location: lati +  "," + longi,
            keyword: "soccer"
        }

        var soccer_keyword = new Array("soccer", "field");

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", wreqdata,
            function gotplacedata(data) {
                console.log(soccer_keyword);
                console.log(data);
                data = checkData(data, soccer_keyword);
                console.log(data);
            
                for (i = 0; i < data.length; i++) {
                    let markLat = parseFloat(data[i]["geometry"]["location"].lat);
                    let markLong = parseFloat(data[i]["geometry"]["location"].lng);
                    let markName = data[i].name;
            
                    /*if (google.maps.geometry.spherical.computeDistanceBetween((data["results"][i]["geometry"]["location"]), rad.getCenter()) > rad.getRadius()) {
                        console.log("ga");
                    } else {
                        addMarker(markLat, markLong, markName); 
                    }*/
                    addMarker(markLat, markLong, markName);
                    
                    //$.get("https://cors-anywhere.herokuapp.com/https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=" + latNum + "," + lngNum + "&destinations=" + markLat + "," + markLong + "&key=AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
                    //getTime, "json");
                    
                }
                
            }, 
        "json");
    }
    if (document.getElementById("tennis").checked) {
        mreqdata = {
            key: "AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
            radius: radi,
            location: lati +  "," + longi,
            keyword: "tennis court"
        }

        var tennis_keyword = new Array("tennis", "court");

        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", mreqdata, 
            function gotplacedata(data) {
                console.log(tennis_keyword);
                console.log(data);
                data = checkData(data, tennis_keyword);
                console.log(data);
            
                for (i = 0; i < data.length; i++) {
                    let markLat = parseFloat(data[i]["geometry"]["location"].lat);
                    let markLong = parseFloat(data[i]["geometry"]["location"].lng);
                    let markName = data[i].name;
            
                    /*if (google.maps.geometry.spherical.computeDistanceBetween((data["results"][i]["geometry"]["location"]), rad.getCenter()) > rad.getRadius()) {
                        console.log("ga");
                    } else {
                        addMarker(markLat, markLong, markName); 
                    }*/
                    addMarker(markLat, markLong, markName);
                    
                    //$.get("https://cors-anywhere.herokuapp.com/https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=" + latNum + "," + lngNum + "&destinations=" + markLat + "," + markLong + "&key=AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4",
                    //getTime, "json");
                    
                }
                
            }, 
        "json");
    
    
}

function getLatLon() {

    /*
    //create new table every search
    $('#travel').remove();
    let table = document.createElement('table');
    table.id = "travel";

    document.getElementById("tableDiv").appendChild(table); 

    table = document.getElementById("travel");
    var row = table.insertRow(0);
    var destination = row.insertCell(0);
    var time = row.insertCell(1);

    destination.innerHTML = "<th><b>Destination</b></th>";
    time.innerHTML = "<th><b>Travel Time</b></th>";
    */

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
    //handle radius here as well
    latNum = parseFloat(data["results"][0]["geometry"]["location"].lat);
    lngNum = parseFloat(data["results"][0]["geometry"]["location"].lng);
    //create map
    initMap(latNum, lngNum, rad);
}

//Made by Eric - filters out markers that are not associated with a sport
function checkData(data, keyword){
    var dictionary = new Array("bowling_alley","campground", "church","gym","park","primary_school","school","secondary_school","stadium","university");

    var count = 0;
    var newArray;

    for(var x = 0; x < data.results.length; x++){
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

    newArray = new Array(count);
    count = 0;

    for(var x = 0; x < data.results.length; x++){
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
    return newArray;
}

function addMarker(lati, longi, name, mdata) {
    
    var pic;
    
    if (mdata["results"][0]["photos"] != null) {
        console.log("hi");
        $.get("https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=" + mdata["results"][0]["photos"][0].photo_reference + "&key=AIzaSyAHoreTH9KWnvppgnaECTPBPkjosVlvGh8", getPic);
        
        //$.get("https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=CmRaAAAA3FyWD-lX8jnskDFxzwFoGMYAH0ogm43Xq4k2PcpgvHPW8J5BKzHzQ6Zo5R8W8xmjhO6sKJ9aJK8bS7CjUETbtB8OBwV0tjUW27cZ5sxXdVwXil2wkPFC4MytzERWGCwCEhA8u40Q7oXNrDrt7DaqIUcBGhSMcJwLmXfWGIjV2x3cXbo_6WplHw&key=AIzaSyAHoreTH9KWnvppgnaECTPBPkjosVlvGh8", getPic, "json");
        //CmRaAAAA3FyWD-lX8jnskDFxzwFoGMYAH0ogm43Xq4k2PcpgvHPW8J5BKzHzQ6Zo5R8W8xmjhO6sKJ9aJK8bS7CjUETbtB8OBwV0tjUW27cZ5sxXdVwXil2wkPFC4MytzERWGCwCEhA8u40Q7oXNrDrt7DaqIUcBGhSMcJwLmXfWGIjV2x3cXbo_6WplHw
    }
    




    var marker = new google.maps.Marker({
        position: {lat: lati, lng: longi},
        map: map
    });
    //let var pic = 
    
    //let var infoContent;
    
    var info = new google.maps.InfoWindow({
        content: name
    });
    marker.addListener('click', function(){
        info.open(map, marker);
    });
    
}
function getPic(data) {
    console.log("please log this");
}

//getting and adding the travel time for each marker
function getTime(data) {
    //console.log(data);
   /* if (resCount >= results.length) {
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
    }*/
    
}
