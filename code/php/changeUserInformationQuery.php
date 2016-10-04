<?php

   if(isset($_POST['newPassword']))
   {
       session_start();
       $newPassword = $_POST['newPassword'];
       $conn = mysqli_connect("40.126.240.245", "k10838a", "password","bornWalkerMap");
       $query = "update user set password = $newPassword where userid = $_SESSION[user_id];";
       mysqli_query($conn, $query);
   }

if(isset($_POST['newEmail']))
   {
       session_start();
       $newEmail = $_POST['newEmail'];
       $conn = mysqli_connect("40.126.240.245", "k10838a", "password","bornWalkerMap");
       $query = "update user set email = $newEmail where userid = $_SESSION[user_id]";
       mysqli_query($conn, $query);
   }
     
?>









