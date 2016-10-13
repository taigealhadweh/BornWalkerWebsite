<?php
session_start();
$conn = mysqli_connect("40.126.240.245", "k10838a", "password","bornWalkerMap");
$query = "select timer from user where userid = $_SESSION[user_id]";
$userWalk_query = mysqli_query($conn, $query);

 while($run_mem = mysqli_fetch_array($userWalk_query)){
//                    $user_id = $run_mem['userid'];
                    //the get user function will get the username according to the id
//                    $username = $run_mem[''];
//                     $my_id = $_SESSION['user_id'];
     $_SESSION['userWalkTime'] = $run_mem['timer'];
     
                    }

?>