<?php 
require_once("printXML.php");
//any page that has sessions needs this session_start()
session_start();

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
        <link rel="icon" href="../bootstrap-4.0.0-alpha.4/docs/favicon.ico">
        <link href="../css/custom.css" rel="stylesheet">

        <title>BornWalker</title>

        <!-- Bootstrap core CSS -->
        <link href="../bootstrap-4.0.0-alpha.4/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../bootstrap-4.0.0-alpha.4/docs/examples/carousel/carousel.css" rel="stylesheet">
        <link href="../css/weather-icons.min.css" rel="stylesheet">
    </head>

    <body style="background: #FF5F6D;
background: -webkit-linear-gradient(to left, #FF5F6D , #FFC371);
background: linear-gradient(to left, #DCAFA6 , #ED4264)">
        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
        <script>
            window.jQuery || document.write('<script src="bootstrap-4.0.0-alpha.4/docs/assets/js/vendor/jquery.min.js"><\/script>')
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
        <script src="../bootstrap-4.0.0-alpha.4/dist/js/bootstrap.min.js"></script>
        <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
        <script src="../bootstrap-4.0.0-alpha.4/docs/assets/js/vendor/holder.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../bootstrap-4.0.0-alpha.4/docs/assets/js/ie10-viewport-bug-workaround.js"></script>

        <nav id="bootstrapNavbar" class="navbar navbar-static-top navbar-light bg-transparent">

            <a href="index.php" class="navbar-brand">BornWalker</a>
            <ul class="nav navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home|<span class="sr-only">(current)</span></a>
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



        <div id="uvInformation">
            Current UV index:
            <?php print_r($uvIndex); ?>


        </div>
        
        <img src="http://www.bom.gov.au/images/uv/uv-panel-exp.png">

        <script src="js/weatherRequest.js"></script>

    </body>

    </html>