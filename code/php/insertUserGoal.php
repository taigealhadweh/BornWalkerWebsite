<?php
   if(isset($_POST['quant'][2]))
   {
       session_start();
       $value = $_POST['quant'][2];
       $conn = mysqli_connect("40.126.240.245", "k10838a", "password","bornWalkerMap");
       $query = "update user set goal_ID = $value where userid = $_SESSION[user_id]";
       mysqli_query($conn, $query);
   }
     
?>