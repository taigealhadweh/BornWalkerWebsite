<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="bootstrap-4.0.0-alpha.4/docs/favicon.ico">

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
        <link href="css/custom.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- add comment -->
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBdzH3HmpWqyn5qFr2fAjxL-GAUXwVDsw0&libraries=geometry"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOhKItk8j4WXYO_DDxfL7XT4JiUlrA0bI&libraries=places" async defer></script>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/weatherRequest.js"></script>
        <script src="js/showListofPlaces.js"></script>
    </head>

    <body style = "background: #FF5F6D;
          background: -webkit-linear-gradient(to left, #FF5F6D , #FFC371);
          background: linear-gradient(to right, #FF5F6D , #FFC371)">

        <!-- navbar code should be same on all pages -->
        <nav id="mainNav" class="navbar navbar-default navbar-top">
            <div>
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand page-scroll" href="index.php">BornWalker</a>
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

        <div class="row" id="containerRow">
            <div class="col-lg-4 .col-md-4" id="walkingTimePanel" style="background-color:rgba(255, 226, 223, 0)">
                <div>Walking time(minutes):</div>
                <input type="text" id="walkingTime" placeholder="Enter a walking time"  class="form-control" style="background-color:rgba(255, 226, 223, 0.6);border:0px">
                <div class="dropdown">
                    <button id="dropPoi" onclick="myFunction()" class="dropbtn">Select place of interest</button>
                    <div id="myDropdown" class="dropdown-content">
                        <a href="javascript: ifCheckToilet = true; ifCheckCafe = false; ifCheckPlayground = false; changeButtonToilet();">Toilet</a>
                        <a href="javascript: ifCheckCafe = true; ifCheckToilet = false; ifCheckPlayground = false; changeButtonCafe();">Cafe</a>
                        <a href="javascript: ifCheckPlayground = true; ifCheckCafe = false; ifCheckToilet = false; changeButtonPlayground();">Playground</a>
                    </div>
                </div>

                <input type="submit" class="btn btn-primary" id="submit" value="Show places!">
                <br>

                <div id="list">
                    <!--                    can we set this dynamically?-->
                    <h3>List of places</h3>
                    <ul id="places" class="nav nav-pills nav-stacked"></ul>
                </div>
                <label for="start">Start</label>
                <input class="form-control" type="text" id="start" placeholder="You are here" style="background-color:rgba(255, 226, 223, 0.6);border:0px">

                <label for="end">End</label>
                <input class="form-control" type="text" id="end" placeholder="Pick a marker or enter an address" style="background-color:rgba(255, 226, 223, 0.6);border:0px">
                <input type="submit" id="route" class="btn btn-primary" value="Route">
            </div>
            <div class="col-lg-7" id="map" style="border:0px"></div>
        </div>
    </body>
</html>