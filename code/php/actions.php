<?php
include 'functions.php';
session_start();

$action = $_GET['action'];
//print_r($action);
$user = $_GET['user'];
//print_r($user);

$conn = mysqli_connect("40.126.240.245", "k10838a", "password","bornWalkerMap");

//for some reason if i call this variable $my_id, it wont load the header thing
//note to self, check logic on other pages
$currentId = $_SESSION['user_id'];
//print_r($my_id);

if($action == 'send') {
        mysqli_query($conn, "INSERT INTO frnd_req (from_request, to_request) VALUES ($currentId, $user)");
}

header("Location: profile.php?user=".$user);



?>