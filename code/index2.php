<?php 
require_once("php/printXML.php");
//any page that has sessions needs this session_start()
session_start();

$uvIndex = $_SESSION['uvIndex'];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- this is for the size, so if mobile show mobile size and if ipad show ipad size etc -->
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>BornWalker</title>
        <!-- Bootstrap -->
        <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">


        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>

    <body style="background-image:url(kid.jpg); background-position: center">

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
                        <li class="active"><a href="index.html">Home</a></li>
                        <li><a href="html/mapRadius.php">Take a walk</a></li>
                        <li><a href="php/profile.php">Profile</a></li>
                        <li><a href="php/login.php">Login</a></li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

        <div class="heading2">
            <h2>Welcome to BornWalker!</h2>
        </div>

        <div class="heading3">
            <h3>Start out by clicking the take a walk button or login!</h3>
        </div>

        <div class="container">
            <div class="row">

                <div class="column-padding">

                    <div class="col-md-4">
                        <div class="tableContainer">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Current weather (C)</th>
                                        <th>Weather in an hour(C)</th>
                                        <th>Weather tonight (C)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="weatherData">
                                        <td id="currentTemperature"></td>
                                        <td id="hourlyWeather"></td>
                                        <td id="tonightWeather"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="col-md-4">

                    </div>

                    <div class="col-md-4">
                        <div class="tableContainer">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Current uv index</th>
                                        <th>Suggestion</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="uvIndexData">

                                        <td id="currentUvIndex">
                                            <?php print_r($uvIndex); ?>
                                        </td>
                                        <td id="suggestion"></td>
                                        <td id=""></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="feedback">
            <p id="feedback">Air quality data</p>
        </div>

        <div id='map' style='width: 900px; height: 500px'>
        </div>


        <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCJkV_BpG5v_oYj6iRIcvdNOwRnCW2ns90&sensor=true"></script>

        <script>
            var map = new google.maps.Map(document.getElementById('map'), {
                center: new google.maps.LatLng(-37.8141, 144.9633),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                zoom: 10
            });

            var t = new Date().getTime();
            var waqiMapOverlay = new google.maps.ImageMapType({
                getTileUrl: function (coord, zoom) {
                    return 'http://tiles.aqicn.org/tiles/usepa-aqi/' + zoom + "/" + coord.x + "/" + coord.y + ".png?token=31b17dfbc63f0593ce946fd22f6bacf9282da418";
                },
                name: "Air  Quality",
            });

            map.overlayMapTypes.insertAt(0, waqiMapOverlay);
        </script>



        <script src="js/weatherRequest.js"></script>





    </body>

    </html>