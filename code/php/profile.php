<?php
include("insertUserGoal.php");
include("readUserGoal.php");
include("headerLoggedinPhp.php");
?>


<header>
    <?php include 'functions.php';?>
    <?php include 'connect.php';?>
            <div class="container1">
                
<!--Checks whether the user is logged in. If there is a user logged in, gets the corresponding user id and username-->
                <?php    
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
                    $username = $run_mem['name'];
                     $my_id = $_SESSION['user_id'];
                    }
                ?>
                
<!--                    Display the users name-->
                    <h2>Welcome <?php echo $username; ?>! </h2>
                
                
<!--                Searches for friend requests-->
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
                
                
<!--                User profile stats (goals and set new goal)-->
                <div class="container" id="userProfileStats">
                    <div class="row" id="userGoalContainer">
                        <div class="col-md-6 border-right" >
                                <h3>Your current goal:</h3>
<!--                            Displays the users current goal-->
                                <h4>Walk <?php echo $_SESSION['userGoal'] ?> times a week</h4> 
                
<!--                            Radio buttons to select the new goal-->
                                <form method="post" action="profile.php" name="userGoalInsert" id="userGoalInsert">
                                    <div class="" id="usersNewGoal">
                                        <div class="">
                                            <h3 id="goalHeading" >Set a new goal: How many times do you want to walk for?</h3>
                                                <div id="goalInput" class="row">
                                                    <div class="col-md-3">
                                                    </div>
                                                        <div class="col-md-6">
                                                            <div class="form-check">
                                                                <label class="form-check">
                                                                    <input class="form-check-input" type="radio" name="value" id="value" value="1"> 1</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <label class="form-check">
                                                                    <input class="form-check-input" type="radio" name="value" id="value" value="2"> 2</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <label class="form-check">
                                                                    <input class="form-check-input" type="radio" name="value" id="value" value="3" > 3</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <label class="form-check">
                                                                    <input class="form-check-input" type="radio" name="value" id="value" value="4"> 4</label>
                                                            </div> 
                                                            <div class="form-check">
                                                                <label class="form-check">
                                                                    <input class="form-check-input" type="radio" name="value" id="value" value="5"> 5</label>
                                                            </div> 
                                                            <div class="form-check">
                                                                <label class="form-check">
                                                                    <input class="form-check-input" type="radio" name="value" id="value" value="6"> 6</label>
                                                            </div> 
                                                            <div class="form-check">
                                                                <label class="form-check">
                                                                    <input class="form-check-input" type="radio" name="value" id="value" value="7"> 7</label>
                                                            </div> 
                                                             <button type="submit" class="btn btn-primary">Set goal</button>
                                                    </div>
                                                    <div class="col-md-3">
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                   
                            </form>
  
                            </div>
                        
<!--                        This is the part were the friends are displayed along with their goals-->
                        <div class="col-md-3 border-right">
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
                                        $from_query = mysqli_query($conn, "SELECT name from user where userid = $user");
                                        while($run_from = mysqli_fetch_array($from_query)){
                                            $from_username = $run_from['name'];
                                            $query = "select goal.goal_name from goal, user where user.userid = $user and user.goal_ID = goal.goal_ID";
                                            $userGoal_query = mysqli_query($conn, $query);

                                            while($run_mem = mysqli_fetch_array($userGoal_query)){
                                                $friendsGoal = $run_mem['goal_name'];
     
                                            }

                            //gets friends and shows the goals of friends
                                            if ($friendsGoal == 0){
                                                print_r("$from_username hasn't set a goal yet <br>" );
                                            }
                                            else{
                                                print_r("$from_username's goal: walk $friendsGoal times per week <br>"); 
                                            }
                                        }
                                    }
                            ?>

                                </h4>
                        
                        </div>
                        
                        <div class="col-md-3">
<!--                                Add friend search-->
                                <h3>Want to add a friend?</h3>
                                <form method="post" action="displayMembers.php" >
                                    <div class="form-check">
                                    <label class="form-check-input">
                                        <input class="form-control" type="text" name="friendUserNameSearch" id="friendUserNameSearch" style="background-color:rgba(255, 226, 223, 0.6);border:0px" placeholder="Search by username">
                                        </label>
                                    </div>
                                      <button type="submit" class="btn btn-primary">Find friends!</button>  
                                </form>
                            
                            
                            
<!--                            Shows all pending friend requests-->
                        <h2>Friend requests</h2>
                            <?php
                    
                            $conn = mysqli_connect("40.126.240.245", "k10838a", "password","bornWalkerMap");
                            $currentId = $_SESSION['user_id'];
                            $req_query = mysqli_query($conn, "SELECT from_request from frnd_req where to_request = $currentId");
                    
                            while($run_req = mysqli_fetch_array($req_query)) {
                                $from_request = $run_req['from_request'];
                                $from_query = mysqli_query($conn, "SELECT name from user where userid = $from_request");
                                while($run_from = mysqli_fetch_array($from_query)){
                                    $from_username = $run_from['name'];
                                    echo "<a href='friendRequest.php?user=$from_request' class='btn btn-primary btn-xl' style='display:block'>$from_username</a>";
                                }
                            }
                            ?>
                        
                        </div>
                    </div>
                </div>
            </div>

        
</header>
<?php include("footer.php"); ?>