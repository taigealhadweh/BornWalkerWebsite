<?php 
require_once("php/printXML.php");
//any page that has sessions needs this session_start()
//session_start();

$uvIndex = $_SESSION['uvIndex'];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="bootstrap-4.0.0-alpha.4/docs/favicon.ico">
        <link href="css/custom.css" rel="stylesheet">

        <title>BornWalker</title>

        <!-- Bootstrap core CSS -->
<!--        <link href="bootstrap-4.0.0-alpha.4/dist/css/bootstrap.min.css" rel="stylesheet">-->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="bootstrap-4.0.0-alpha.4/docs/examples/carousel/carousel.css" rel="stylesheet">
        <link href="css/weather-icons.min.css" rel="stylesheet">
        
        <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        
        <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/creative.min.css" rel="stylesheet">
        
    </head>

    <body style="background: #FF5F6D;
background: -webkit-linear-gradient(to left, #FF5F6D , #FFC371);
background: linear-gradient(to left, #FFEDBC , #ED4264)">
        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
        <script>
            window.jQuery || document.write('<script src="bootstrap-4.0.0-alpha.4/docs/assets/js/vendor/jquery.min.js"><\/script>')
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
        <script src="bootstrap-4.0.0-alpha.4/dist/js/bootstrap.min.js"></script>
        <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
        <script src="bootstrap-4.0.0-alpha.4/docs/assets/js/vendor/holder.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="bootstrap-4.0.0-alpha.4/docs/assets/js/ie10-viewport-bug-workaround.js"></script>

<!--
        <nav id="bootstrapNavbar" class="navbar navbar-static-top navbar-light bg-transparent">

            <a href="index.php" class="navbar-brand">BornWalker</a>
            <ul class="nav navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">BornWalker<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="html/mapRadius.php">Take a walk|</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">About us|</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Coming soon|</a>
                </li>
            </ul>
        </nav>
-->
        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">BornWalker</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    
                    <li>
                        <a href="#">About us</a>
                    </li>
                    <li>
                        <a href="#">Coming soon</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

        <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">Hey there!</h1>
<!--
            <div id="welcomeMessage" class="container">
            <p>Hey there! </p>
        </div>
-->

        <hr>
                <div id="temperatureAndUvContainer" class="container">
            <div id="weatherIconContainer" class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-2">
                    
                    <div>
                        <h2><i id="weatherIcon" class="wi" aria-hidden="true"></i></h2>
                    </div>
                </div>
                
                <div class="col-md-3" id="temperatureAndUv" align="center">
                    <h2><div id="currentTemperature">
                        </div></h2>  
                    <div><p> </p></div>
                    <div id="uvInformation" align="center">
                        <h2 align="center">UV index 
                            <?php print_r($uvIndex); ?>
                    <a href="php/environmentInformation.php" class="btn btn-link" role="button"><i class="fa fa-info-circle" aria-hidden="true"></i></a>  
                        </h2></div>
                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>

        <hr>
                <a href="php/listPlaces.php"  role="button" class="btn btn-primary btn-xl page-scroll"><h3>Let's go for a walk!</h3></a>
        
            </div>
        </div>
                </header>

        <script src="js/weatherRequest.js"></script>

    </body>

    </html>