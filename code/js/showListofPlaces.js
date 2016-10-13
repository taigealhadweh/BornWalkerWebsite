/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


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
//var icon;
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
        if (!!navigator.geolocation)
            return navigator.geolocation;
        else
            return undefined;
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
        google.maps.event.addListenerOnce(map, 'idle', function () {
            clickButton();
        });

        map.setTilt(0); // turns off default 45-deg view


        ////show marker on current location/////
        mapMarker = new google.maps.Marker({
            animation: google.maps.Animation.DROP,
            position: latlng,
            icon: "https://bornwalker.me/placeholder.png",
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

//        clearOverlays();
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

//function performSearch() {
//    clearOverlays();
//    directionsDisplay.setDirections({
//        routes: []
//    });
//
//    if (ifCheckToilet) {
//        performSearchToilet();
//    }
//    if (ifCheckPlayground) {
//        performSearchPlayground();
//    }
//    if (ifCheckCafe) {
//        performSearchCafe();
//    }
//}

//function eventFire(el, etype) {
//    if (el.fireEvent) {
//        el.fireEvent('on' + etype);
//    } else {
//        var evObj = document.createEvent('Events');
//        evObj.initEvent(etype, true, false);
//        el.dispatchEvent(evObj);
//    }
//}

function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

function checkDropDownValue(dropDownValue) {
    switch (dropDownValue) {
        case "Restroom":
//            document.getElementById("myDropdown").classList.toggle("show");
            document.getElementById('forToilet').click();
            break;
        case "Cafe":
//            document.getElementById("myDropdown").classList.toggle("show");
            document.getElementById('forCafe').click();
            break;
        case "Playground":
//            document.getElementById("myDropdown").classList.toggle("show");
            document.getElementById('forPlayground').click();
            break;
    }
}

function clickButton() {
    document.getElementById('submit').click();
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
    document.getElementById("places").innerHTML = "No result match your search<br/><br/><br/>";

}

// get places data from google places
function performSearchCafe() {
    directionsDisplay.setDirections({
        routes: []
    });
    clearOverlays();
    var request = {
        bounds: map.getBounds(),
        //keyword: "cafe"
        type: 'cafe'


    };

    service.radarSearch(request, callback);

}

function performSearchToilet() {
    directionsDisplay.setDirections({
        routes: []
    });
    clearOverlays();
    var request = {
        bounds: map.getBounds(),
        keyword: 'toilet'

    };

    service.radarSearch(request, callback);
}

function performSearchPlayground() {
    directionsDisplay.setDirections({
        routes: []
    });
    clearOverlays();
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
                    
                     icon: "https://bornwalker.me/purple.png"
//                    {
//                     url: '../icon/homeMarker.png',
//                     anchor: new google.maps.Point(10, 10),
//                     scaledSize: new google.maps.Size(10, 17)
//                     }
                     
                     

                });

                markersArray.push(marker);
                var thisMarker = markersArray.indexOf(marker);

                //put place names into the list

                placesList.innerHTML = "";
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
                           // console.log(result);
//                            console.log(result.keys("opening_hours"),("open_now"));
                            //if (result["opening_hours"] !== "" || result["opening_hours"] !== null) {
//                            if (typeof(result.opening_hours.open_now) !== "undefined") {
                            if (result.hasOwnProperty("opening_hours")) {
                                console.log(result.opening_hours.open_now);
                                if (result.opening_hours.open_now === true) {
                                    // if (result.opening_hours.open_now === true) {
                                    openOrNot = " (Open)";
                                } else {
                                    openOrNot = " (Closed)";
                                }
                            } else {
                                openOrNot = "";
                            }
                            // }

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
        marker.setIcon(/** @type {google.maps.Icon} */ ({
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
        marker.setIcon(/** @type {google.maps.Icon} */ ({
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
    if (watchID)
        geo.clearWatch(watchID);
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
        console.log("Geolocation not supported");
        // alert('Geolocation not supported.')
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

function changeButtonPlayground() {
    document.getElementById("dropPoi").innerHTML = "Playground <i class='fa fa-sort-desc' aria-hidden='true'></i>";
//    performSearch();
}

function changeButtonCafe() {
    document.getElementById("dropPoi").innerHTML = "Cafe <i class='fa fa-sort-desc' aria-hidden='true'></i>";
//    performSearch();
}

function changeButtonToilet() {
    document.getElementById("dropPoi").innerHTML = "Restroom <i class='fa fa-sort-desc' aria-hidden='true'></i>";
//    performSearch();
}



