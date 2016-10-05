<?php
//session_start();
//$conn = mysqli_connect("40.126.240.245", "k10838a", "password","bornWalkerMap");
$query = "select goal.goal_name from goal, user where user.userid = $_SESSION[user_id] and user.goal_ID = goal.goal_ID";
$userGoal_query = mysqli_query($conn, $query);

 while($run_mem = mysqli_fetch_array($userGoal_query)){
//                    $user_id = $run_mem['userid'];
                    //the get user function will get the username according to the id
//                    $username = $run_mem[''];
//                     $my_id = $_SESSION['user_id'];
     $_SESSION['userGoal'] = $run_mem['goal_name'];
     
                    }




?>

