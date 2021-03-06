<html>

<head>
    <script type='text/javascript' src='jquery-1.6.2.min.js'></script>
    <script type='text/javascript' src='jquery-ui-1.8.14.custom.min.js'></script>
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


            function locFromDatabase()

            {

                geocoder = new google.maps.Geocoder();

                /* var myOptions = {

                      zoom: 16,

                      mapTypeId: google.maps.MapTypeId.ROADMAP

                    }

                var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                map = new google.maps.Map(document.getElementById("map_canvas"), myOptions); */



                //var bounds = new google.maps.LatLngBounds();

                var encodedString;

                var databaseLocationArray = [];

                encodedString = document.getElementById("encodedString").value;

                databaseLocationArray = encodedString.split("****");



                var x;

                for (x = 0; x < databaseLocationArray.length; x = x + 1)

                {

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

                        // where I have added .html to the marker object.

                        //infowindow.setContent( marker.html);

                        info.open(map, this);

                        infos[0] = info;

                    });

                    //bounds.extend(lat);

                } //map.fitBounds(bounds);

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
        $result = mysql_query("SELECT * FROM Cafe");
 
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
            "</p>&&&".$row[1]."&&&".$row[2];
            $x = $x + 1;
        }        
		
	?>

            <input type="hidden" id="encodedString" name="encodedString" value="<?php echo $encodedString; ?>" />
    </div>
    <div id="map_canvas"></div>
</body>

</html>