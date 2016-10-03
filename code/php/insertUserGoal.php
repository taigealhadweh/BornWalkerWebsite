<?php

   if(isset($_POST['value']))
   {
       session_start();
       $value = $_POST['value'];
       $conn = mysqli_connect("40.126.240.245", "k10838a", "password","bornWalkerMap");
       $query = "update user set goal_ID = $value where userid = $_SESSION[user_id]";
       mysqli_query($conn, $query);
   }
     
?>