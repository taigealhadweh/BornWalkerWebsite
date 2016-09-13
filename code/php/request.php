<?php
require_once("functions.php");
//require_once("db-const.php");
session_start();
if (logged_in() == false) {
	redirect_to("login.php");
}

$requesteeId = $_SESSION['user_id'];

$conn = mysqli_connect("40.126.240.245", "k10838a", "password","bornWalkerMap");
if (!$conn) {
            die("<p>connect error</p>");
        }

$requestQuery = "INSERT INTO requests (requester, requeste) VALUES ($_SESSION[user_id], $requesteeId)";

    print_r($requestQuery);
    
mysqli_query($conn, $requestQuery);
//mysqli_query($conn, "INSERT INTO requests (requestee, requester) VALUES ('".htmlspecialchars($requesteeId"' , '".htmlspecialchars($_SESSION['user_id'])."')"); 
             
             

?>