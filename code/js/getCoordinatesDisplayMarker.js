jQuery(document).ready(function ($) {

    //Get data, and replace it on the form
    var geocoder;
    var map;
    var markersArray = [];
    var infos = [];

    geocoder = new google.maps.Geocoder();
    var myOptions = {
        zoom: 9,
        mapTypeId: google.maps.MapTypeId.TERRIAN
    }
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    var bounds = new google.maps.LatLngBounds();
    var encodedString;
    var stringArray = [];
    encodedString = document.getElementById("encodedString").value;
    stringArray = encodedString.split("****");

    var x;
    for (x = 0; x < stringArray.length; x = x + 1) {
        var addressDetails = [];
        var marker;
        addressDetails = stringArray[x].split("&&&");

        var lat = new google.maps.LatLng(addressDetails[1], addressDetails[2]);
        //alert(image + " " + addressDetails[1] );
        marker = new google.maps.Marker({
            map: map,
            position: lat,
            content: addressDetails[0]
        });
        markersArray.push(marker);
        google.maps.event.addListener(marker, 'click', function () {
            closeInfos();
            var info = new google.maps.InfoWindow({
                content: this.content
            });
            // where I have added .html to the marker object.
            //infowindow.setContent( marker.html);
            info.open(map, this);
            infos[0] = info;
        });
        bounds.extend(lat);
    }

    map.fitBounds(bounds);


    function closeInfos() {
        if (infos.length > 0) {
            infos[0].set("marker", null);
            infos[0].close();
            infos.length = 0;
        }
    }

});