<?php
require_once("php/printXML.php");
//any page that has sessions needs this session_start()
//session_start();

$uvIndex = $_SESSION['uvIndex'];

include("php/header.php");
?>

<header>
    <div class="header-content">
        <div class="header-content-inner">
            <div class="row">
                <p> </p>
            </div>
            <div class="row">
                <p> </p>
            </div>
            
            <h1 id="homeHeading" style="font-size:75px"><div id="uvInformation" align="center">
                            <h1 align="center">Current UV index 
                                <?php print_r($uvIndex); ?>  
                            </div></h1>
            <hr>
            <div id="temperatureAndUvContainer" class="container">
                <div id="weatherIconContainer" class="row">
                    <div class="col-md-0">
                    </div>
                    <div class="col-md-3">
                        <p>----- UV index 1-2 -----</p>
                    </div>
                    <div class="col-md-3">
                        <p>Low</p>
                    </div>
                    <div class="col-md-5">
                        <p>Protection is generally not needed</p>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-0">
                    </div>
                </div>
                <div id="weatherIconContainer" class="row">
                    <div class="col-md-0">
                    </div>
                    <div class="col-md-3">
                        <p>----- UV index 3-5 -----</p>
                    </div>
                    <div class="col-md-3">
                        <p>Moderate</p>
                    </div>
                    <div class="col-md-5">
                        <p>Slop on sunscreen</p>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-0">
                    </div>
                </div>
                <div id="weatherIconContainer" class="row">
                    <div class="col-md-0">
                    </div>
                    <div class="col-md-3">
                        <p>----- UV index 6-7 -----</p>
                    </div>
                    <div class="col-md-3">
                        <p>High</p>
                    </div>
                    <div class="col-md-5">
                        <p>Slip on sun-protecting clothing</p>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-0">
                    </div>
                </div>
                <div id="weatherIconContainer" class="row">
                    <div class="col-md-0">
                    </div>
                    <div class="col-md-3">
                        <p>----- UV index 8-10 -----</p>
                    </div>
                    <div class="col-md-3">
                        <p>Very high</p>
                    </div>
                    <div class="col-md-5">
                        <p>Put on SPF30+ sunscreen, a fancy hat, and sunglasses</p>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-0">
                    </div>
                </div>
                <div id="weatherIconContainer" class="row">
                    <div class="col-md-0">
                    </div>
                    <div class="col-md-3">
                        <p>----- UV index 11+ -----</p>
                    </div>
                    <div class="col-md-3">
                        <p>Extreme</p>
                    </div>
                    <div class="col-md-5">
                        <p>Stay at home!</p>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-0">
                    </div>
                </div>
            </div>

            <hr>
            <a href="goForWalk.php"  role="button" class="btn btn-primary btn-xl page-scroll"><h3>Plan a walk now</h3></a>

        </div>
    </div>
</header>

<?php include("php/footer.php"); ?>