<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['userEmail']) && isset($_POST['userPassword'])) {
        $mail = $_POST['userEmail'];
        $password = $_POST['userPassword'];
        $conn = mysqli_connect("40.126.240.245", "k10838a", "password","bornWalkerMap"); //connect database
        if (!$conn) {
            die("<p>connect error</p>");
        }
        $userQuery = "SELECT * FROM user WHERE email='$mail'";
        $databaseQuery = "SELECT userid FROM user";
        $sendDatabaseQuery = mysqli_query($conn, $userQuery);
        $resultOfDatabaseQuery = mysqli_fetch_row($sendDatabaseQuery) or die(location('ID or password does not exist.', 'login.php'));
        $errorDatabaseQuery = mysqli_query($conn, $userQuery);
        //this gets the position of each element so that we can check the password at element 2
        $resultArray = mysqli_fetch_row($errorDatabaseQuery) or die('search error' . mysqli_error());
        if ($resultArray[2] === $password) //check password
        {
            //these print_r are for testing purposes
//            print_r("PASSWORD OK<br>");
//            print_r("POST=$_POST<br>");
//            print_r("SESSION=$_SESSION<br>");
//            printArray("resultArray", $resultArray);

            // Authenticated, set session variables
            $_SESSION['user_id'] = $resultArray[0];
            $_SESSION['username'] = $resultArray[1];
            $_SESSION['userPassword'] = $resultArray[2];
            $_SESSION['userEmail'] = $resultArray[3];
            $_SESSION['userPhone'] = $resultArray[4];
            
            // printArray("_SESSION", $_SESSION);

            redirect_to("profile.php");
        } else {
            //location('ID or password does not exist.', 'login.php');
        }
    }
}

function printArray($name, $array) {
    echo "$name<br>";
    foreach ($array as $key => $value) {
        echo "Key: $key; Value: $value<br>";
    }
}

function redirect_to($location)
{
    if (!headers_sent($file, $line))
    {
        header("Location: " . $location);
    } else {
        printf("<script>location.href='%s';</script>", rawurlencode($location));
        # or deal with the problem
    }
    printf('<a href="%s">Moved</a>', rawurlencode($location));
    exit;
}


function location($_info,$_url) {
    if (!empty($_info)) {
        echo "<script type='text/javascript'>alert('$_info');location.href='$_url';</script>";
        exit();
    } else {
        header('Location:'.$_url);
    }
}


?>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- this is for the size, so if mobile show mobile size and if ipad show ipad size etc -->
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>BornWalker</title>
        <!-- Bootstrap -->
        <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/custom.css" rel="stylesheet">


        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>

    <body>

        <div class="container">
            <div class="row-fluid">
                <div class="column-padding">
                    <form method="post" action="login.php" name="loginForm" id="loginForm">
                        <h1>Please login</h1>
                        <div class="span 3">
                            <label class="col-sm-2 col-form-label">Email:</label>
                            <input type="text" id="userEmail" name="userEmail">
                        </div>
                        <div class="span 3">
                            <label class="col-sm-2 col-form-label">Password:</label>
                            <input type="password" name="userPassword">
                        </div>
                        <div class="span 3">
                            <label class="col-sm-2 col-form-label">
                                <input type="submit" value="Log in">
                            </label>
                        </div>

                        <h3>New member? <a href="register.php">Register now</a></h3>

                    </form>
                </div>
            </div>
        </div>

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
                        <li><a href="../index.html">Home</a></li>
                        <li><a href="../html/mapRadius.php">Take a walk</a></li>
                        <li><a href="profile.php">Profile</a></li>
                        <li class="active"><a href="login.php">Login</a></li>

                    </ul>
                </div>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    </body>

    </html>