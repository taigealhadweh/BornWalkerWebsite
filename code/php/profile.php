<?php


include("headerforphp.php");
$userGoal = 7;

?>


<header>

   

    <?php include 'functions.php';?>

        <?php include 'connect.php';?>


            <div class="container1">
                

                <?php 
                
                    session_start();
                    if (logged_in() == false) {
	                  redirect_to("login.php");
                    }
                    if (isset($_GET['user']) && !empty($_GET['user'])) {
                        $user = $_GET['user'];
                       
                    } else {
                        $user = $_SESSION['user_id'];
                    }
                    
                      $conn = mysqli_connect("40.126.240.245", "k10838a", "password","bornWalkerMap");

                    $query = "SELECT name FROM user where userid = '$user'";
                    
                    $mem_query = mysqli_query($conn, $query);
                    
                    while($run_mem = mysqli_fetch_array($mem_query)){
//                    $user_id = $run_mem['userid'];
                    //the get user function will get the username according to the id
                    $username = $run_mem['name'];
                     $my_id = $_SESSION['user_id'];
                    }
                    ?>
<!--                    Display the users name-->
                    <h2>Welcome <?php echo $username; ?>! </h2>
                    <?php
                    if($user != $my_id){
                       $check_frnd_query = mysqli_query($conn, "SELECT id from frnds where (user_one= $my_id AND user_two= $user) OR (user_one= $user AND user_two= $my_id)");
                        if(mysqli_num_rows($check_frnd_query) == 1){
                            echo "<a href='#' class='box'>Already friends</a> | <a href='actions.php?action=unfriend&user=$user' class='box'> Unfriend $username</a>";
                            
                        } else {
                            $from_query = mysqli_query($conn, "SELECT id from frnd_req WHERE (from_request = $user AND to_request = $my_id)");
                            $to_query = mysqli_query($conn, "SELECT id from frnd_req WHERE (from_request = $my_id AND to_request = $user)");
                            
                            if (mysqli_num_rows($from_query) == 1) {
                                echo "<a href='actions.php?action=accept&user=$user' class='box'>Accept</a> | <a href='' class='box'>Ignore</a>";
                            } else if (mysqli_num_rows($to_query) == 1){
                                echo "<a href='actions.php?action=cancel&user=$user' class='box'>Cancel Request</a>";
                                
                            } else {
                                echo "<a href='actions.php?action=send&user=$user' class='box'>Send friend request</a>";
                            }
                        }
                    }
                    ?>
                <div class="container" id="userProfileStats">
                    <div class="row" id="userGoalContainer">
                        <div class="col-md-6">
                                <h3>Your current goal:</h3>
<!--                            this will have to be gotten via php and passed into a session variable-->
                                <h4>Walk <?php echo $userGoal ?> times a week</h4> 
                
                                <h3>Set a new goal:</h3>
                                <h4>How many times a week do you want to go for a walk?</h4>
                            </div>
                        <div class="col-md-3">
                            <h2>Friends activity</h2>
                 
                            <h4>
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
//                            echo "<a href='profile.php?user=$user' class='btn btn-primary btn-xl' style='display:block'>$from_username's goal: </a>";
                            //gets friends and shows the goals of friends with progress bar
                            print_r("$from_username's goal: <br>");
                            
                        }
//                        echo "<a href='profile.php?user=$user' class='box' style='display:block'>$username</a>";
                    }
                    
                    
                    ?>
                                </h4>
                        
                        </div>
                        
                        <div class="col-md-3">
                        <h2>Friend requests</h2>
                            <?php
                    
                    $conn = mysqli_connect("40.126.240.245", "k10838a", "password","bornWalkerMap");
                    $currentId = $_SESSION['user_id'];
                    $req_query = mysqli_query($conn, "SELECT from_request from frnd_req where to_request = $currentId");
                    
                    while($run_req = mysqli_fetch_array($req_query)) {
                        $from_request = $run_req['from_request'];
//                        print_R($from_request);
                        
                        $from_query = mysqli_query($conn, "SELECT name from user where userid = $from_request");
                        while($run_from = mysqli_fetch_array($from_query)){
                            $from_username = $run_from['name'];
                            echo "<a href='profile.php?user=$from_request' class='btn btn-primary btn-xl' style='display:block'>$from_username</a>";
                        }
                    }
                    ?>
                        
                        </div>
                    </div>
                </div>
            </div>

        
</header>
<?php include("footer.php"); ?>