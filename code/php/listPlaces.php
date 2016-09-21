<!DOCTYPE html>
<html>

<head>
    <title>Take a walk</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- this is for the size, so if mobile show mobile size and if ipad show ipad size etc -->
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <script type='text/javascript' src='../js/jquery-1.6.2.min.js'></script>
    <script type='text/javascript' src='../js/jquery-ui-1.8.14.custom.min.js'></script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- this is for the size, so if mobile show mobile size and if ipad show ipad size etc -->
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>BornWalker</title>
    <!-- Bootstrap -->
    <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        BODY {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            color: #000000;
            font-size: 13px;
        }
        
        #map {
            position: relative;
            top: 120px;
            left: 500px;
            border: 3px solid #73AD21;
            z-index: 0;
            padding-bottom: 40%;
        }
        
        #routePanel {
            position: absolute;
            top: 65px;
            /*            left: %;*/
            z-index: 0;
            background-color: #fff;
            /*            padding: 5px;*/
            /*            border: 1px solid transparent;*/
/*            font-family: 'Roboto', 'sans-serif';*/
            /*            line-height: 30px;*/
            padding-left: 500px;
            /*            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);*/
            outline: none;
            /*            width: 380px;*/
        }
        
        #walkingTimePanel {
            position: absolute;
            top: 65px;
            /*            left: 35%;*/
            z-index: 0;
            background-color: #fff;
            /*            padding: 5px;*/
/*                        border: 1px solid transparent;*/
            font-family: 'Helvetica Neue', 'sans-serif';
            /*            line-height: 30px;*/
            left: 30px;
            
/*                        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);*/
            outline: none;
        }
        
        
        
        
        
        #placeList {
            align-content: left;
            top: 0;
            border: 3px solid black;
        }
        
        .dropbtn {
            background-color: #4CAF50;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        
        .dropbtn:hover,
        .dropbtn:focus {
            background-color: #3e8e41;
        }
        
        .dropdown {
            position: relative;
            display: inline-block;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        }
        
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        
        .dropdown a:hover {
            background-color: #f1f1f1
        }
        
        .show {
            display: block;
        }
    </style>
    <!-- add comment -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBdzH3HmpWqyn5qFr2fAjxL-GAUXwVDsw0&libraries=geometry"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOhKItk8j4WXYO_DDxfL7XT4JiUlrA0bI&libraries=places" async defer></script>
    <script type='text/javascript'>
        var geocoder;
        var map;
        var geo;
        var MAXIMUM_AGE = 200; // miliseconds
        var TIMEOUT = 300000;
        var HIGHACCURACY = true;
        var mapMarker;
        var markersArray = [];
        var infos = [];
        var radius;
        var walkingTime;
        var infoWindow;
        var service;
        var startLocLatlng;
        var placesList;
        var directionsDisplay;
        var ifCheckCafe;
        var ifCheckToilet;
        var ifCheckPlayground;
        //jQuery(document).ready(function ($) {

        //Get data, and replace it on the form
        /*
        var geocoder;
        var map;
        var geo;
        var MAXIMUM_AGE = 200; // miliseconds
        var TIMEOUT = 300000;
        var HIGHACCURACY = true;
        var mapMarker;
        var markersArray = [];
        var infos = [];
        var radius;
        var walkingTime;
        var infoWindow;
        var service;
        var startLocLatlng;
        var placesList;
        var placesArray = [];
        */


        google.maps.event.addDomListener(window, "load", initMap);

        ////////-----function: 1------///////////////		
        function getGeoLocation() {
            try {
                if (!!navigator.geolocation) return navigator.geolocation;
                else return undefined;
            } catch (e) {
                return undefined;
            }
        }


        ////////---fuction: 2---initiate map, then show current location////////        
        function initMap(position) {

            var latlng = getCurrentLoc(position);

            geocoder = new google.maps.Geocoder();




            if (map) {
                map.panTo(latlng);
                mapMarker.setPosition(latlng);
            } else {
                var myOptions = {
                    zoom: 14,
                    center: latlng,

                    // mapTypeID --
                    // ROADMAP displays the default road map view
                    // SATELLITE displays Google Earth satellite images
                    // HYBRID displays a mixture of normal and satellite views
                    // TERRAIN displays a physical map based on terrain information.
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };

                map = new google.maps.Map(document.getElementById("map"), myOptions);

                map.setTilt(0); // turns off default 45-deg view


                ////show marker on current location/////
                mapMarker = new google.maps.Marker({
                    animation: google.maps.Animation.DROP,
                    position: latlng,
                    content: "You are here"
                });


                ////show user current location in 'start' box///
                geocoder.geocode({
                    'latLng': latlng
                }, function (results, status) {

                    if (status == google.maps.GeocoderStatus.OK) {

                        if (results[1]) {

                            document.getElementById("start").value = results[1].formatted_address;

                        } else {

                            alert("No results found");

                        }

                    }

                });


                ////show click-on info window of current location marker////
                google.maps.event.addListener(mapMarker, "click", function () {

                    closeInfos();

                    var info = new google.maps.InfoWindow({
                        content: this.content
                    });

                    info.open(map, this);

                    infos[0] = info;

                    geocoder.geocode({
                        'latLng': latlng
                    }, function (results, status) {

                        if (status == google.maps.GeocoderStatus.OK) {

                            if (results[1]) {

                                document.getElementById("start").value = results[1].formatted_address;

                            } else {

                                alert("No results found");

                            }

                        }

                    });
                });

                mapMarker.setMap(map);
            }

            infoWindow = new google.maps.InfoWindow();
            service = new google.maps.places.PlacesService(map);
            placesList = document.getElementById("places");

            document.getElementById("submit").addEventListener("click", function () {

                clearOverlays();
                directionsDisplay.setDirections({
                    routes: []
                });

                //performSearchToilet();
                //performSearchCafe();
                //performSearchPlayground();


                if (ifCheckToilet) {
                    performSearchToilet();
                    //document.getElementById("dropPoi").value="Toilet";

                }
                if (ifCheckPlayground) {
                    performSearchPlayground();
                }
                if (ifCheckCafe) {
                    performSearchCafe();
                }

            });

            directionMap();
            startLocAuto();
            endLocAuto();
        }

        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function (event) {
            if (!event.target.matches(".dropbtn")) {

                var dropdowns = document.getElementsByClassName("dropdown-content");
                var j;
                for (j = 0; j < dropdowns.length; j++) {
                    var openDropdown = dropdowns[j];
                    if (openDropdown.classList.contains("show")) {
                        openDropdown.classList.remove("show");
                    }
                }
            }
        }

        // clear all markers on the map
        function clearOverlays() {

            for (var i = 0; i < markersArray.length; i++) {
                markersArray[i].setMap(null);
            }

            markersArray.length = 0;
            document.getElementById("places").innerHTML = "";

        }

        // get places data from google places
        function performSearchCafe() {

            var request = {

                bounds: map.getBounds(),
                //keyword: "cafe"
                type: 'cafe'


            };

            service.radarSearch(request, callback);

        }

        function performSearchToilet() {

            var request = {

                bounds: map.getBounds(),
                keyword: 'toilet'

            };

            service.radarSearch(request, callback);

        }

        function performSearchPlayground() {

            var request = {

                bounds: map.getBounds(),
                keyword: 'playground'

            };

            service.radarSearch(request, callback);

        }



        function callback(results, status) {
            if (status !== google.maps.places.PlacesServiceStatus.OK) {
                console.error(status);
                return;
            }

            for (var i = 0, result; result = results[i]; i++) {
                addMarker(result);
            }
        }

        // get current location
        function getCurrentLoc(position) {
            var lat = position.coords.latitude;

            var lon = position.coords.longitude;

            var latlng = new google.maps.LatLng(lat, lon);

            return latlng;
        }

        // add place markers
        function addMarker(place) {
            geocoder = new google.maps.Geocoder();

            var address = document.getElementById("start").value;

            var marker;

            var index;

            walkingTime = document.getElementById("walkingTime").value;

            radius = parseInt(walkingTime) * 80;

            geocoder.geocode({
                'address': address
            }, function (results, status) {

                if (status == 'OK') {
                    var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();
                    startLocLatlng = new google.maps.LatLng(latitude, longitude);

                    var openOrNot;

                    if (google.maps.geometry.spherical.computeDistanceBetween(startLocLatlng, place.geometry.location) <= radius) {
                        marker = new google.maps.Marker({
                            animation: google.maps.Animation.DROP,
                            map: map,
                            position: place.geometry.location,
                            /*
                                icon: {
                            url: 'http://maps.gstatic.com/mapfiles/circle.png',
                            anchor: new google.maps.Point(10, 10),
                            scaledSize: new google.maps.Size(10, 17)
                            }
                            */

                        });

                        markersArray.push(marker);
                        var thisMarker = markersArray.indexOf(marker);

                        //put place names into the list
                        service.getDetails(place, function (result, status) {
                            if (status !== google.maps.places.PlacesServiceStatus.OK) {
                                console.error(status);
                                return;
                            }


                            placesList.innerHTML += '<li><a href="javascript:activeList(' + thisMarker + ');"><strong>' + result.name + '</strong></a></li>';

                            google.maps.event.addListener(marker, 'click', function () {
                                service.getDetails(place, function (result, status) {
                                    if (status !== google.maps.places.PlacesServiceStatus.OK) {
                                        console.error(status);
                                        return;
                                    }

                                    if (result.opening_hours.open_now == true) {
                                        openOrNot = " (open)";
                                    } else {
                                        openOrNot = " (closed)";
                                    }

                                    infoWindow.setContent('<div><strong>' + result.name + '</strong>' + openOrNot + '<br>' + result.formatted_address + '</div>');
                                    infoWindow.open(map, marker);
                                    document.getElementById("end").value = result.formatted_address;
                                });
                            });




                        });
                    }
                }
            });

        }




        function directionMap() {
            var directionsService = new google.maps.DirectionsService;
            directionsDisplay = new google.maps.DirectionsRenderer;

            directionsDisplay.setMap(map);

            var onChangeHandler = function () {
                calculateAndDisplayRoute(directionsService, directionsDisplay);
            };

            document.getElementById("route").addEventListener("click", function () {
                calculateAndDisplayRoute(directionsService, directionsDisplay);
            });

            document.getElementById("start").addEventListener("change", onChangeHandler);

            document.getElementById("end").addEventListener("change", onChangeHandler);
        }

        ////////---function: 6---calculte route///////////////////
        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
            directionsService.route({

                origin: document.getElementById("start").value, ///////route start point
                destination: document.getElementById("end").value, ///////route end point
                travelMode: "WALKING"
            }, function (response, status) {

                if (status === "OK") {
                    directionsDisplay.setDirections(response);
                }
            });
        }

        ////////---function: 7---end location box address autocomplete////////
        function endLocAuto() {

            var input = (document.getElementById("end"));

            var types = "address"; ///user input type: address

            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.bindTo("bounds", map);

            var infowindow = new google.maps.InfoWindow();

            var marker = new google.maps.Marker({

                map: map,

                anchorPoint: new google.maps.Point(0, -29)

            });

            autocomplete.addListener("place_changed", function () {

                infowindow.close();

                marker.setVisible(false);

                var place = autocomplete.getPlace();

                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }

                // If the place has a geometry, then present it on a map.

                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                marker.setIcon( /** @type {google.maps.Icon} */ ({
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));

                marker.setPosition(place.geometry.location);

                marker.setVisible(true);

                var address = '';

                if (place.address_components) {
                    address = [

                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                        ].join(' ');
                }

                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                infowindow.open(map, marker);

            });

        }

        ////////---function: 8---start location box address autocomplete////////
        function startLocAuto() {

            var input = (document.getElementById("start"));

            var types = "address"; ///user input type: address

            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.bindTo("bounds", map);

            var infowindow = new google.maps.InfoWindow();

            var marker = new google.maps.Marker({

                map: map,

                anchorPoint: new google.maps.Point(0, -29)

            });

            autocomplete.addListener("place_changed", function () {

                infowindow.close();

                marker.setVisible(false);

                var place = autocomplete.getPlace();

                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }

                // If the place has a geometry, then present it on a map.

                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                marker.setIcon( /** @type {google.maps.Icon} */ ({
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));

                marker.setPosition(place.geometry.location);

                marker.setVisible(true);

                var address = '';

                if (place.address_components) {
                    address = [

                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                        ].join(' ');
                }

                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                infowindow.open(map, marker);

            });

        }


        ////////---function: 9---error management////////        
        function geo_error(error) {
            stopWatching();

            switch (error.code) {
            case error.TIMEOUT:
                alert('Geolocation Timeout');
                break;
            case error.POSITION_UNAVAILABLE:
                alert('Geolocation Position unavailable');
                break;
            case error.PERMISSION_DENIED:
                alert('Geolocation Permission denied');
                break;
            default:
                alert('Geolocation returned an unknown error code: ' + error.code);
            }
        }

        ////////---function: 10---////////
        function stopWatching() {
            if (watchID) geo.clearWatch(watchID);
            watchID = null;
        }

        ////////---function: 11---////////
        function startWatching() {
            watchID = geo.watchPosition(initMap, geo_error, {
                enableHighAccuracy: HIGHACCURACY,
                maximumAge: MAXIMUM_AGE,
                timeout: TIMEOUT
            });
        }

        ////////---function: 12---////////
        window.onload = function () {
            if ((geo = getGeoLocation())) {
                startWatching();
            } else {
                alert('Geolocation not supported.')
            }
        }

        ////////---function: 13---////////
        function closeInfos() {
            if (infos.length > 0) {
                infos[0].set("mapMarker", null);
                infos[0].close();
                infos.length = 0;
            }
        }

        //});

        function activeList(x) {

            google.maps.event.trigger(markersArray[x], "click");

            return false;
        }

        function changeButtonToilet() {
            document.getElementById("dropPoi").innerHTML = "Toilet";
        }

        function changeButtonCafe() {
            document.getElementById("dropPoi").innerHTML = "Cafe";
        }

        function changeButtonPlayground() {
            document.getElementById("dropPoi").innerHTML = "Playground";
        }
    </script>


</head>

<body>

    <!-- navbar code should be same on all pages -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only"> Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Need to resize the logo to fit in line with the navbar -->
                <!-- <a href="" class="navbar-left"><img src=""></a> -->
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../index.html">Home</a></li>
                    <li class="active"><a href="mapRadius.php">Take a walk</a></li>
                    <li><a href="../php/profile.php">Profile</a></li>
                    <li><a href="../php/login.php">Login</a></li>

                </ul>
            </div>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    <div class="container">
        <div class="row" id="containerRow">
            <div class="col-lg-4" id="walkingTimePanel"> <h4>Walking time(minutes):</h4>
                <input type="text" id="walkingTime" placeholder="Enter a walking time">
                
             
                
               
                <br>
<!--                Bootstrap dropdown menu-->
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Place of interest
                    <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="javascript: ifCheckToilet = true; ifCheckCafe = false; ifCheckPlayground = false; changeButtonToilet();">Toilet</a></li>
                        <li><a href="javascript: ifCheckCafe = true; ifCheckToilet = false; ifCheckPlayground = false; changeButtonCafe();">Cafe</a></li>
                        <li><a href="javascript: ifCheckPlayground = true; ifCheckCafe = false; ifCheckToilet = false; changeButtonPlayground();">Playground</a></li>
                    
                    </ul>
                
                
                </div>
                
                <div class="dropdown">
                    <button id="dropPoi" onclick="myFunction()" class="dropbtn">Select place of interest</button>
                    <div id="myDropdown" class="dropdown-content">
                        <a href="javascript: ifCheckToilet = true; ifCheckCafe = false; ifCheckPlayground = false; changeButtonToilet();">Toilet</a>
                        <a href="javascript: ifCheckCafe = true; ifCheckToilet = false; ifCheckPlayground = false; changeButtonCafe();">Cafe</a>
                        <a href="javascript: ifCheckPlayground = true; ifCheckCafe = false; ifCheckToilet = false; changeButtonPlayground();">Playground</a>
                    </div>
                </div>
            
            
                
                <input type="submit" class="btn btn-primary" id="submit" value="Show places!">

                <br>
                
                <div id="placeList">
<!--                    can we set this dynamically?-->
                    <h3>List of places</h3>
                    <ul id="places" class="nav nav-pills nav-stacked"></ul>
                </div>
                <label for="start">Start</label>
                <input class="form-control" type="text" id="start" placeholder="You are here">

                <label for="end">End</label>
                <input class="form-control" type="text" id="end" placeholder="Pick a marker or enter an address">
                
                 <input type="submit" id="route" class="btn btn-primary" value="Route">

            </div>
            </div>
       

            <div class="col-md-8">
                <div class="fixed-container" id="map">

                </div>

            </div>
        
     </div>


    <!--

    <div class="form-group" id="walkingTimePanel">
        <div class="col-lg-8">
            Walking time (minutes):
            <input type="text" id="walkingTime" placeholder="Enter a walking time">

            <input type="submit" id="submit">
        </div>
    </div>


    <div id="routePanel" class="form-group">
        <div class="col-md-4">
            <label for="start">Start</label>
            <input class="form-control" type="text" id="start" placeholder="You are here">
        </div>
        <div class="col-md-4">
            <label for="end">End</label>
            <input class="form-control" type="text" id="end" placeholder="Pick a marker or enter an address">
        </div>
        <input type="submit" id="route" value="Route">
    </div>


    <div id="map"></div>
    
    
    <div id="list" class="col-md-2">
        <ul id="places" class="nav nav-pills nav-stacked"></ul>
    </div>
    
    
   <div class="dropdown">
<button id="dropPoi" onclick="myFunction()" class="dropbtn">Dropdown</button>
  <div id="myDropdown" class="dropdown-content">
    <a href="javascript: ifCheckToilet = true; ifCheckCafe = false; ifCheckPlayground = false; changeButtonToilet();">Toilet</a>
    <a href="javascript: ifCheckCafe = true; ifCheckToilet = false; ifCheckPlayground = false; changeButtonCafe();">Cafe</a>
    <a href="javascript: ifCheckPlayground = true; ifCheckCafe = false; ifCheckToilet = false; changeButtonPlayground();">Playground</a>
  </div>
</div>
-->


    <!--
    <div class="checkBox" id="checkBox">
        <div class="col-lg-8">
            Toilet<input type="checkbox" id="checkToilet">
            Cafe<input type="checkbox" id="checkCafe">
            Playground/Park<input type="checkbox" id="checkPlayground">


        </div>
    </div>
-->



</body>

</html>