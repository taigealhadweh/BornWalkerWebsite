<?php
include("headerforphp.php");
?>

<?php

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
    <header>
        <div class="header-content">

                <div class="header-content-inner">
                    <form method="post" action="login.php" name="loginForm" id="loginForm">
                        <h1 id="homeHeading" style="font-size:75px">Please login</h1>
                        <hr>
                        <div class="row">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-2">
                                <label id="homeHeading" style="font-size:20px">Email</label>
                            </div>
                            <div class="col-md-6">
                            <input class="form-control" type="text" id="userEmail" name="userEmail" placeholder="Email address" style="background-color:rgba(255, 226, 223, 0.6);border:0px">
                            </div>
                            <div class="col-md-3">
                            </div>   
                        </div>
                        <div class="row">
                            <p> </p>
                        </div>
                        <div class="row">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-2">
                                <label style="font-size:20px">Password</label>
                            </div>
                            <div class="col-md-6">
                            <input class="form-control" type="password" name="userPassword" placeholder="Password" style="background-color:rgba(255, 226, 223, 0.6);border:0px">
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                        
                        <hr>
                        <div class="row">
                        <div class="class=col-sm-12">
                            <button type="submit" class="btn btn-primary btn-xl"><h3>Login   </h3></button>
                        </div>
                        </div>
                        <h3 >New member? <a href="register.php" role="button" class="btn btn-primary btn-xl">Register now</a></h3>

                    </form>
                </div>
        </div>       
    </header>

 <?php include("footer.php") ?>