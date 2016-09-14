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
    <link rel='stylesheet' href="../css/custom.css">



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

    <?php include 'connect.php';?>
        <?php include 'functions.php';?>



            <div class="container">
                <h3>Friends : </h3>

                <?php
                    session_start();
                    $conn = mysqli_connect("40.126.240.245", "k10838a", "password","bornWalkerMap");
                    $currentId = $_SESSION['user_id'];
                     
                    $frnd_query = mysqli_query($conn, "SELECT user_one, user_two from frnds where user_one = $currentId OR user_two = $currentId");
                    while ($run_frnd = mysqli_fetch_array($frnd_query)){
                     
                        $user_one = $run_frnd['user_one'];
                        $user_two = $run_frnd['user_two'];
                        if($user_one == $currentId){
                            $user = $user_two;
                        } else{
                            $user = $user_one;
                        } 
                        
                       // print_r($user);                        
                       
                        
                        $from_query = mysqli_query($conn, "SELECT name from user where userid = $user");
                        while($run_from = mysqli_fetch_array($from_query)){
                            $from_username = $run_from['name'];
                            echo "<a href='profile.php?user=$from_request' class='box' style='display:block'>$from_username</a>";
                        }
                        echo "<a href='profile.php?user=$user' class='box' style='display:block'>$username</a>";
                    }
                    
                    
                    ?>
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