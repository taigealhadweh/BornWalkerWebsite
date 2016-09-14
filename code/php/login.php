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
        if ($resultArray[1] === $password) //check password
        {
            

            // Authenticated, set session variables
            
            $_SESSION['username'] = $resultArray[0];
            $_SESSION['userPassword'] = $resultArray[1];
            $_SESSION['userEmail'] = $resultArray[2];
            $_SESSION['userPhone'] = $resultArray[3];
            $_SESSION['user_id'] = $resultArray[4];
            
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

        <title>BornWalker</title>

        <!-- Bootstrap core CSS -->
        <link href="../bootstrap-4.0.0-alpha.4/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../bootstrap-4.0.0-alpha.4/docs/examples/carousel/carousel.css" rel="stylesheet">
    </head>






    <body>

        <nav class="navbar navbar-static-top navbar-light bg-faded">
            <a href="#" class="navbar-brand">BornWalker</a>
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../html/mapRadius.php">Take a walk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
        </nav>

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



        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
        <script>
            window.jQuery || document.write('<script src="../bootstrap-4.0.0-alpha.4/docs/assets/js/vendor/jquery.min.js"><\/script>')
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
        <script src="../bootstrap-4.0.0-alpha.4/dist/js/bootstrap.min.js"></script>
        <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
        <script src="../bootstrap-4.0.0-alpha.4/docs/assets/js/vendor/holder.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../bootstrap-4.0.0-alpha.4/docs/assets/js/ie10-viewport-bug-workaround.js"></script>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    </body>

    </html>