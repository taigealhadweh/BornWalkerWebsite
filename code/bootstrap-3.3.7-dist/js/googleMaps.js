    function init() {
        if (navigator.geolocation) {

            navigator.geolocation.getCurrentPosition(function (position) {
                    var coords = position.coords;

                    var latlng = new google.maps.LatLng(coords.latitude, coords.longitude);
                    var myOptions = {
                        zoom: 16,
                        center: latlng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };

                    var map = new google.maps.Map(document.getElementById("map"), myOptions);

                    var marker = new google.maps.Marker({
                        position: latlng,
                        map: map
                    });

                    var infoWindow = new google.maps.InfoWindow({
                        content: "Current Location：<br/>longitude：" + latlng.lat() + "<br/>latitude：" + latlng.lng() //提示窗体内的提示信息
                    });

                    infoWindow.open(map, marker);


                },
                function (error) {

                    switch (error.code) {
                    case 1:
                        alert("Location serves deined.");
                        break;
                    case 2:
                        alert("can not get location information");
                        break;
                    case 3:
                        alert("overtime.");
                        break;
                    default:
                        alert("unknow error");
                        break;
                    }
                });
        } else {
            alert("你的浏览器不支持HTML5来获取地理位置信息。");
        }


    }

