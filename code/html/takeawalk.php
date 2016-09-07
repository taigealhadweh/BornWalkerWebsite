<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- this is for the size, so if mobile show mobile size and if ipad show ipad size etc -->
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>BornWalker</title>
    <!-- Bootstrap -->
    <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->;
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type='text/javascript' src='../js/jquery-1.6.2.min.js'></script>
    <script type='text/javascript' src='../js/jquery-ui-1.8.14.custom.min.js'></script>
    <style>
        BODY {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            color: #000000;
            font-size: 13px;
        }
        
        #map_canvas {
            width: 100%;
            height: 100%;
            z-index: 0;
        }
        
        #floating-panel {
            position: absolute;
            top: 100px;
            left: 25%;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
            text-align: center;
            font-family: 'Roboto', 'sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }
    </style>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBdzH3HmpWqyn5qFr2fAjxL-GAUXwVDsw0&sensor=false"></script>
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


            function getGeoLocation() {
                try {
                    if (!!navigator.geolocation) return navigator.geolocation;
                    else return undefined;
                } catch (e) {
                    return undefined;
                }
            }


            function getUserLocation(position) {

                document.getElementById("start").innerHTML = latlng;
            }


            function show_map(position) {
                var lat = position.coords.latitude;
                var lon = position.coords.longitude;
                var latlng = new google.maps.LatLng(lat, lon);


                if (map) {
                    map.panTo(latlng);
                    mapMarker.setPosition(latlng);
                } else {
                    var myOptions = {
                        zoom: 18,
                        center: latlng,

                        // mapTypeID --
                        // ROADMAP displays the default road map view
                        // SATELLITE displays Google Earth satellite images
                        // HYBRID displays a mixture of normal and satellite views
                        // TERRAIN displays a physical map based on terrain information.
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                    map.setTilt(0); // turns off the annoying default 45-deg view

                    mapMarker = new google.maps.Marker({
                        position: latlng,
                        title: "You are here."
                    });
                    mapMarker.setMap(map);
                }
                locFromDatabase();
                document.getElementById("start").innerHTML = latlng;
                initMap();

            }

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

            function stopWatching() {
                if (watchID) geo.clearWatch(watchID);
                watchID = null;
            }

            function startWatching() {
                watchID = geo.watchPosition(show_map, geo_error, {
                    enableHighAccuracy: HIGHACCURACY,
                    maximumAge: MAXIMUM_AGE,
                    timeout: TIMEOUT
                });
            }

            window.onload = function () {
                if ((geo = getGeoLocation())) {
                    startWatching();
                } else {
                    alert('Geolocation not supported.')
                }
            }

            function locFromDatabase() {
                geocoder = new google.maps.Geocoder();
                var encodedString;
                var databaseLocationArray = [];
                encodedString = document.getElementById("encodedString").value;
                databaseLocationArray = encodedString.split("****");

                var x;
                for (x = 0; x < databaseLocationArray.length; x = x + 1) {
                    var addressDetails = [];
                    var databsemarker;
                    addressDetails = databaseLocationArray[x].split("&&&");
                    var lat = new google.maps.LatLng(addressDetails[1], addressDetails[2]);
                    //alert(image + " " + addressDetails[1] );
                    databsemarker = new google.maps.Marker({
                        map: map,
                        position: lat,
                        content: addressDetails[0]

                    });

                    markersArray.push(databsemarker);
                    google.maps.event.addListener(databsemarker, 'click', function () {
                        closeInfos();
                        var info = new google.maps.InfoWindow({
                            content: this.content
                        });
                        info.open(map, this);

                        infos[0] = info;
                    });
                }
            }


            function initMap() {
                var directionsService = new google.maps.DirectionsService;
                var directionsDisplay = new google.maps.DirectionsRenderer;
                /*  var map = new google.maps.Map(document.getElementById('map'), {
                   zoom: 16,
                   center: {lat: -37.8776209, lng: 145.04413679999993}
                 }); */
                directionsDisplay.setMap(map);

                var onChangeHandler = function () {
                    calculateAndDisplayRoute(directionsService, directionsDisplay);
                };
                document.getElementById('submit').addEventListener('click', function () {
                    calculateAndDisplayRoute(directionsService, directionsDisplay);
                });
                document.getElementById('start').addEventListener('change', onChangeHandler);
                document.getElementById('end').addEventListener('change', onChangeHandler);
            }

            function calculateAndDisplayRoute(directionsService, directionsDisplay) {
                directionsService.route({
                    origin: document.getElementById('latlng').value,
                    destination: document.getElementById('end').value,
                    travelMode: 'WALKING'
                }, function (response, status) {
                    if (status === 'OK') {
                        directionsDisplay.setDirections(response);
                    } else {
                        window.alert('Directions request failed due to ' + status);
                    }
                });
            }

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
                <a href="" class="navbar-left"><img src=""></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../index.html">Home</a></li>
                    <li class="active"><a href="takeawalk.html">Take a walk</a></li>
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


    <div id='input'>
        <?php
	
	
	
        //Connect to the MySQL database that is holding your data, replace the x's with your data
        mysql_connect("40.126.240.245", "k10838a", "password") or
         die("Could not connect: " . mysql_error());
        mysql_select_db("bornWalkerMap");
 
        // Initialize your first couple variables
        $encodedString = ""; //This is the string that will hold all your location data
        $x = 0; //This is a trigger to keep the string tidy
 
        // Now we do a simple query to the database
        $result = mysql_query("SELECT * FROM `big-ten`");
 
        // Multiple rows are returned
        while ($row = mysql_fetch_array($result, MYSQL_NUM))
        {
         //   This is to keep an empty first or last line from forming, when the string is split
            if ( $x == 0 )
            {
                 $separator = "";
            }
            else
            {
             //    Each row in the database is separated in the string by four *'s
                 $separator = "****";
            }
            //Saving to the String, each variable is separated by three &'s
            $encodedString = $encodedString.$separator.
            "<p class='content'><b>Lat:</b> ".$row[1].
            "<br><b>Long:</b> ".$row[2].
            "<br><b>Name: </b>".$row[3].
            "<br><b>Address: </b>".$row[4].
			"<br><b>Division: </b>".$row[5].
            "</p>&&&".$row[1]."&&&".$row[2];
            $x = $x + 1;
        }        
		
	?>

            <input type="hidden" id="encodedString" name="encodedString" value="<?php echo $encodedString; ?>" />
    </div>
    <div id="map_canvas"></div>



    <div id="floating-panel">
        <p>Start:
            <input type="text" id="start">
            <!-- can I use geowatch position instead of input? -->
        </p>
        <p>End:
            <input type="text" id="end">
        </p>
        <input type="submit" id="submit" value="Route">
    </div>


</body>

</html>