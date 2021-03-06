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
            left: 30px;
            border: 3px solid #73AD21;
            width: 95%;
            padding-bottom: 40%;
        }
        
        #routePanel {
            position: absolute;
            top: 65px;
            /*            left: %;*/
            z-index: 5;
            background-color: #fff;
            /*            padding: 5px;*/
            /*            border: 1px solid transparent;*/
            font-family: 'Roboto', 'sans-serif';
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
            z-index: 6;
            background-color: #fff;
            /*            padding: 5px;*/
            /*            border: 1px solid transparent;*/
            font-family: 'Roboto', 'sans-serif';
            /*            line-height: 30px;*/
            left: 30px;
            /*            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);*/
            outline: none;
        }
        
        #walkingTime {
            display: inline;
        }
    </style>
    <!-- add comment -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBdzH3HmpWqyn5qFr2fAjxL-GAUXwVDsw0&libraries=geometry"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOhKItk8j4WXYO_DDxfL7XT4JiUlrA0bI&libraries=places" async defer></script>
    <script type='text/javascript'>
        jQuery(document).ready(function ($) {

            //Get data, and replace it on the form
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


            google.maps.event.addDomListener(window, "load", show_map);

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
            function show_map(position) {

                var lat = position.coords.latitude;

                var lon = position.coords.longitude;

                var latlng = new google.maps.LatLng(lat, lon);

                geocoder = new google.maps.Geocoder();

                if (map) {
                    map.panTo(latlng);
                    mapMarker.setPosition(latlng);
                } else {
                    var myOptions = {
                        zoom: 17,
                        center: latlng,

                        // mapTypeID --
                        // ROADMAP displays the default road map view
                        // SATELLITE displays Google Earth satellite images
                        // HYBRID displays a mixture of normal and satellite views
                        // TERRAIN displays a physical map based on terrain information.
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };

                    map = new google.maps.Map(document.getElementById("map"), myOptions);

                    map.setTilt(0); // turns off the annoying default 45-deg view


                    ////show marker on current location/////
                    mapMarker = new google.maps.Marker({
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
                    //testAuto();

                    document.getElementById("submit").addEventListener("click", function () {
                        clearOverlays();
                        show_loc(position);
                    });
                }


                initMap();
                startLocAuto();
                endLocAuto();
            }

            ////////---function: 3---clear previous markers from database. only keep current location marker///////
            function clearOverlays() {

                for (var i = 0; i < markersArray.length; i++) {
                    markersArray[i].setMap(null);
                }

                markersArray.length = 0;
            }

            ////////---function: 4---show markers from database////////      
            function show_loc(position) {
                //////current location////////////////
                var lat = position.coords.latitude;

                var lon = position.coords.longitude;

                var latlng = new google.maps.LatLng(lat, lon);

                /////location from database//////
                geocoder = new google.maps.Geocoder();

                var encodedString;

                var databaseLocationArray = [];

                encodedString = document.getElementById("encodedString").value;

                databaseLocationArray = encodedString.split("****");


                walkingTime = document.getElementById("walkingTime").value;


                radius = parseInt(walkingTime) * 80;

                var x;

                for (x = 0; x < databaseLocationArray.length; x = x + 1)

                {

                    var addressDetails = [];

                    var databsemarker;

                    addressDetails = databaseLocationArray[x].split("&&&");


                    var lat = new google.maps.LatLng(addressDetails[1], addressDetails[2]);

                    ////////////if within radius, show marker
                    if (google.maps.geometry.spherical.computeDistanceBetween(lat, latlng) <= radius) {
                        databsemarker = new google.maps.Marker({

                            map: map,

                            position: lat,

                            content: addressDetails[3] + "<br>" + addressDetails[4] + "</br>"

                        });

                        markersArray.push(databsemarker);

                        ////pop out click-on info window////
                        google.maps.event.addListener(databsemarker, "click", function () {

                            closeInfos();

                            var info = new google.maps.InfoWindow({
                                content: this.content
                            });

                            info.open(map, this);

                            infos[0] = info;

                            ///show address to 'end' box when click on marker///
                            var fullAdd = this.content;

                            var firstHalfAdd = fullAdd.split("<br>");

                            var endAdd = firstHalfAdd[1].split("</br>");

                            document.getElementById("end").value = endAdd[0];

                        });

                    }

                }

            }

            ////////---function: 5---set up map for calculating route////////
            function initMap() {
                var directionsService = new google.maps.DirectionsService;
                var directionsDisplay = new google.maps.DirectionsRenderer;

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
                watchID = geo.watchPosition(show_map, geo_error, {
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
                    infos[0].set("databsemarker", null);
                    infos[0].close();
                    infos.length = 0;
                }
            }

        });
    </script>


</head>

<body>

    <nav class="navbar navbar-static-top navbar-light bg-faded">
        <a href="#" class="navbar-brand">BornWalker</a>
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../html/mapRadius.php">Take a walk</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../php/profile.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../php/login.php">Login</a>
            </li>
        </ul>
    </nav>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>






    <div id="input">
        <?php
	
        //Connect to the MySQL database
        mysql_connect("40.126.240.245", "k10838a", "password") or
         die("Could not connect: " . mysql_error());
        mysql_select_db("bornWalkerMap");
 
        // Initialize the first couple variables
        $encodedString = ""; //hold location data
        $x = 0; //trigger to keep the string tidy
 
        $result = mysql_query("SELECT * FROM Cafe");
 
        while ($row = mysql_fetch_array($result, MYSQL_NUM))
        {
         //keep an empty first or last line from forming, when the string is split
            if ( $x == 0 )
            {
                 $separator = "";
            }
            else
            {
             //Each row in the database is separated in the string by four *'s
                 $separator = "****";
            }
            
            //Saving to the String, each variable is separated by three &'s
            $encodedString = $encodedString.$separator.
            "<p class='content'><b>Lat:</b> ".$row[1].
            "<br><b>Long:</b> ".$row[2].
            "<br><b>Name: </b>".$row[3].
            "<br><b>Address: </b>".$row[4].
            "</p>&&&".$row[1]."&&&".$row[2]."&&&".$row[3]."&&&".$row[4];
            $x = $x + 1;
            
        }        
		
	?>

            <input type="hidden" id="encodedString" name="encodedString" value="<?php echo $encodedString; ?>" />
    </div>

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






</body>

</html>