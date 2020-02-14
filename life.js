//https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=AIzaSyDS3p3iX3eIPWNLMuFQNrPRKWyE5un7dtY

//AIzaSyDS3p3iX3eIPWNLMuFQNrPRKWyE5un7dtY

//new key
//AIzaSyAHoreTH9KWnvppgnaECTPBPkjosVlvGh8

$(document).ready(start);

var map;
var rad = 2000;
var latNum = null;
var lngNum = null;
var tableCount;
var results;
var resCount = 0;


function start() {
    getLocation();
    

    $("#search").click(getLatLon);
    $('.checkbox').attr('checked', true);
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
    console.warn("ERROR(${err.code}): ${err.message}");
    getLatLon();
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
    radi += 3000;

    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: lati, lng: longi},
        zoom: zoom,
    });


    //see what essentials are checked, and pass that info off to add markers
    if (document.getElementById("basketball").checked) {
        preqdata = {
            key: "AIzaSyAHoreTH9KWnvppgnaECTPBPkjosVlvGh8",
            radius: radi,
            location: lati +  "," + longi,
            keyword: "basketball"
        }
        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", preqdata, gotplacedata, "json");
        //$.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", preqdata, gotplacedata, "json");
    }

    if (document.getElementById("football").checked) {
        breqdata = {
            key: "AIzaSyAHoreTH9KWnvppgnaECTPBPkjosVlvGh8",
            radius: radi,
            location: lati +  "," + longi,
            keyword: "football"
        }
        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", breqdata, gotplacedata, "json");
        //$.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", breqdata, gotplacedata, "json");
    }

    if (document.getElementById("soccer").checked) {
        wreqdata = {
            key: "AIzaSyAHoreTH9KWnvppgnaECTPBPkjosVlvGh8", 
            radius: radi,
            location: lati +  "," + longi,
            keyword: "soccer"
        }
        $.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", wreqdata, gotplacedata, "json");
        //$.get("https://cors-anywhere.herokuapp.com/https://maps.googleapis.com/maps/api/place/nearbysearch/json?", wreqdata, gotplacedata, "json");
    }
    /*if (document.getElementById("baseball").checked) {
        mreqdata = {
            key: "AIzaSyAHoreTH9KWnvppgnaECTPBPkjosVlvGh8",
            radius: radi,
            location: lati +  "," + longi,
            type: "baseball"
        }
        //baseball is being stupid
        $.get("https://cors-anywhere.herokuapp.com/https://maps.googleapis.com/maps/api/place/nearbysearch/json?", mreqdata, gotplacedata, "json");
        //$.get("https://maps.googleapis.com/maps/api/place/nearbysearch/json?", mreqdata, gotplacedata, "json");
    }*/

    //circle to mark radius - was not working as expected so I use the zoom level to show appropriate radius
    /*
    rad = new google.maps.Circle({
        center: new google.maps.LatLng(lati, longi),
        radius: radi,
        map: map
    });*/
    
    
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
        console.log(address);
        let latreq = "https://maps.googleapis.com/maps/api/geocode/json?address=" + address 
        + "&key=AIzaSyAHoreTH9KWnvppgnaECTPBPkjosVlvGh8";
        $.get(latreq, gotData, "json");
    }
}
    



function gotData(data) {
    console.log(data);
        $("#latlng").html("Latitude:" + parseFloat(data["results"][0]["geometry"]["location"].lat) + 
        "&Tab;" + "&Tab;" +  "Longitude:" + parseFloat(data["results"][0]["geometry"]["location"].lng) + "</br ");
    
    let radi = parseInt($("#radius").val());
    latNum = parseFloat(data["results"][0]["geometry"]["location"].lat);
    lngNum = parseFloat(data["results"][0]["geometry"]["location"].lng)
   
    //create map
    initMap(latNum, lngNum, radi);

}

//getting the data for the places to mark on the map
function gotplacedata(data) {
    console.log(data);
    results = data.results;
    
    //console.log(data["results"][0]["photos"][0].photo_reference);
    

    for (i = 0; i < data["results"].length; i++) {
        let markLat = parseFloat(data["results"][i]["geometry"]["location"].lat);
        let markLong = parseFloat(data["results"][i]["geometry"]["location"].lng);
        let markName = data["results"][i].name;

        /*if (google.maps.geometry.spherical.computeDistanceBetween((data["results"][i]["geometry"]["location"]), rad.getCenter()) > rad.getRadius()) {
            console.log("ga");
        } else {
            addMarker(markLat, markLong, markName); 
        }*/
        $.get("https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=CmRaAAAA3FyWD-lX8jnskDFxzwFoGMYAH0ogm43Xq4k2PcpgvHPW8J5BKzHzQ6Zo5R8W8xmjhO6sKJ9aJK8bS7CjUETbtB8OBwV0tjUW27cZ5sxXdVwXil2wkPFC4MytzERWGCwCEhA8u40Q7oXNrDrt7DaqIUcBGhSMcJwLmXfWGIjV2x3cXbo_6WplHw&key=AIzaSyAHoreTH9KWnvppgnaECTPBPkjosVlvGh8", getPic, "json");
        addMarker(markLat, markLong, markName, data);
        
        $.get("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=" + latNum + "," + lngNum + "&destinations=" + markLat + "," + markLong + "&key=AIzaSyAHoreTH9KWnvppgnaECTPBPkjosVlvGh8",
         getTime, "json");
        
    }
    
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