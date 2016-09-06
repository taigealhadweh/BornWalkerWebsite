<html>
	<head>
	<script type='text/javascript' src='jquery-1.6.2.min.js'></script>
	<script type='text/javascript' src='jquery-ui-1.8.14.custom.min.js'></script>
	<style>

		BODY {font-family : Verdana,Arial,Helvetica,sans-serif; color: #000000; font-size : 13px ; }
		
		#map_canvas { width:100%; height: 100%; z-index: 0; }
        #floating-panel {
        position: absolute;
        top: 10px;
        left: 5%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
        #walkingTimePanel {
       position: absolute;
       top: 10px;
       left: 25%;
       z-index: 5;
       background-color: #fff;
       padding: 5px;
       border: 1px solid #999;
       text-align: center;
       font-family: 'Roboto','sans-serif';
       line-height: 30px;
       padding-left: 10px;
     }
	</style>
        <!-- add comment -->
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBdzH3HmpWqyn5qFr2fAjxL-GAUXwVDsw0&sensor=false" /></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBdzH3HmpWqyn5qFr2fAjxL-GAUXwVDsw0&libraries=geometry&sensor=false"></script>
    <script type='text/javascript'>
    
	   
	jQuery(document).ready( function($){
	
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
        
		
		
        function getGeoLocation() {
            try {
                if( !! navigator.geolocation ) return navigator.geolocation;
                else return undefined;
            } catch(e) {
                return undefined;
            }
        }
        
        
        function show_map(position) {
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;
            var latlng = new google.maps.LatLng(lat, lon);

            if(map) {
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
                    title:"You are here."
                });
                mapMarker.setMap(map);
                
                //walkingTime = "120";
                
                
                //radius = parseInt(walkingTime) * 80;
                
                document.getElementById('submit').addEventListener('click', function() {clearOverlays(); show_loc(position);});
                
                
            }
            
            initMap();
            
            
            
            
        }
        
        
        ///////////////////////////////////////////////////
        
        function clearOverlays() 
        {
            for (var i = 0; i < markersArray.length; i++ ) 
            {
                markersArray[i].setMap(null);
            }
            markersArray.length = 0;
        }
       
        
        
        function show_loc(position) {
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;
            var latlng = new google.maps.LatLng(lat, lon);
                      
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
                
                //if within radius, show marker
                if (google.maps.geometry.spherical.computeDistanceBetween(lat,latlng) <= radius)
                    {
                        databsemarker = new google.maps.Marker
                        ({

                            map: map,

                            position: lat,

                            content: addressDetails[3] + "<br>" + addressDetails[4] + "</br>"

                        }); 
                    
                        markersArray.push(databsemarker);
                    
                        google.maps.event.addListener( databsemarker, 'click', function () {

                            
                            //clearEndInput();
                            
                            closeInfos();

                            var info = new google.maps.InfoWindow({content: this.content});

                            info.open(map,this);

                            infos[0]=info;
                            
                            var fullAdd = this.content;
                            
                            var firstHalfAdd = fullAdd.split("<br>");
                            
                            var endAdd = firstHalfAdd[1].split("</br>");
                            
                            document.getElementById("end").value = endAdd[0];
                            
                            

                        });
                
                    }


            
            }
            
            
        }
        
        
        
        /*
        //clear previous user input
        function clearEndInput()
        {   
            document.getElementById("end").value = "";
        }
        */
        
        
        function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
       /*  var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: {lat: -37.8776209, lng: 145.04413679999993}
        }); */
        directionsDisplay.setMap(map);

        var onChangeHandler = function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        };
		document.getElementById('submit').addEventListener('click', function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        });
        document.getElementById('start').addEventListener('change', onChangeHandler);
        document.getElementById('end').addEventListener('change', onChangeHandler);
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        directionsService.route({
          origin: document.getElementById('start').value,///////route start point
          destination: document.getElementById('end').value,///////route end point
          travelMode: 'WALKING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
        
        
        function geo_error(error) {
            stopWatching();
            switch(error.code) {
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
            if(watchID) geo.clearWatch(watchID);
            watchID = null;
        }

        function startWatching() {
            watchID = geo.watchPosition(show_map, geo_error, {
                enableHighAccuracy: HIGHACCURACY,
                maximumAge: MAXIMUM_AGE,
                timeout: TIMEOUT
            });
        }

         window.onload = function() {
            if((geo = getGeoLocation())) {
                startWatching();
            } else {
                alert('Geolocation not supported.')
            }
        } 
		


           
       
				
		
		function closeInfos(){
	   if(infos.length > 0){
		  infos[0].set("databsemarker",null);
		  infos[0].close();
		  infos.length = 0;
	   }
}

	

    
    
    
    }
	);

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
            "</p>&&&".$row[1]."&&&".$row[2]."&&&".$row[3]."&&&".$row[4];
            $x = $x + 1;
            
        }        
		
	?>
				
	 <input type="hidden" id="encodedString" name="encodedString" value="<?php echo $encodedString; ?>" />
			</div>
	<div id="map_canvas"></div>
    
    
    <div id="walkingTimePanel">
        <p>Walking time (minutes):<input type="text" id="walkingTime" value="0"></p>
        <br>
        <input type="submit" id="submit">
    </div>
    <div id="floating-panel">
      <p>Start:<input type="text" id="start"></p>
	  <p>End:<input type="text" id="end"></p>
	  <input type="submit" id="submit" value="Route">
    </div>
        
	</body>
</html>