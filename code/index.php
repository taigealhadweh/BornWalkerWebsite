<?php
require_once("php/printXML.php");
//any page that has sessions needs this session_start()
//session_start();

$uvIndex = $_SESSION['uvIndex'];

include("php/functions.php");
if (logged_in()== true) {
			include("php/headerLoggedin.php");
		} else {
			include("php/header.php");
		}
//include("php/header.php");
?>

<header>
    <div class="header-content">
        <div class="header-content-inner">
            <h1 id="homeHeading" style="font-size:75px">Hey there!</h1>
            <hr>
            <div id="temperatureAndUvContainer" class="container">
                <div id="weatherIconContainer" class="row">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-1">

                        <div>
                            <h2><i id="weatherIcon" class="wi" aria-hidden="true"></i></h2>
                        </div>
                    </div>

                    <div class="col-md-4" id="temperatureAndUv" align="center">
                        <h2 style="color:rgba(255, 218, 185, 1)">Currently</h2>
                        
                        <h2><div id="currentTemperature">
                            </div></h2>  
                        
                        <div id="uvInformation" align="center">
                            <h2 align="center">UV index 
                                <?php print_r($uvIndex); ?>
                                <a href="uvInfo.php" class="btn btn-link btn-lg" role="button"><i class="fa fa-info-circle" aria-hidden="true" style="color:rgba(239, 119, 127, 1)"></i></a>  
                            </h2></div>
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
            </div>

            <hr>
            <a href="goForWalk.php"  role="button" class="btn btn-primary btn-xl page-scroll"><h3>Plan a walk now</h3></a>

        </div>
    </div>
    
</header>

<?php include("php/footer.php"); ?>