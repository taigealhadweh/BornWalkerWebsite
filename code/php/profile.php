<?php 
require_once("functions.php");
//require_once("db-const.php");
session_start();
if (logged_in() == false) {
	redirect_to("login.php");
}

$userName = $_SESSION['username'];
$userEmail = $_SESSION['userEmail'];
$userPhone = $_SESSION['userPhone'];

$conn = mysqli_connect("40.126.240.245", "k10838a", "password","bornWalkerMap");
if (!$conn) {
            die("<p>connect error</p>");
        }
//print_r($conn);
$userQuery = "SELECT * FROM user WHERE userid <> $_SESSION[user_id]";
print_r($userQuery);

$users = mysql_query($conn, $userQuery)
//    print_r($users);
    while($row = mysqli_fetch_assoc($users)){
        echo $row['user'] ; 
    }

?>