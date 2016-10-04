<?php
include 'functions.php';
session_start();

$action = $_GET['action'];
//print_r($action);
$user = $_GET['user'];
$loggedInUser = $_SESSION['user_id'];
//print_r($user);

$conn = mysqli_connect("40.126.240.245", "k10838a", "password","bornWalkerMap");

//for some reason if i call this variable $my_id, it wont load the header thing
//note to self, check logic on other pages
$currentId = $_SESSION['user_id'];
//print_r($my_id);

if($action == 'send') {
        mysqli_query($conn, "INSERT INTO frnd_req (from_request, to_request) VALUES ($currentId, $user)");
}

if($action == 'cancel') {
    mysqli_query($conn, "DELETE FROM frnd_req WHERE from_request=$currentId AND to_request=$user");
}

if($action == 'accept'){
    mysqli_query($conn, "DELETE FROM frnd_req WHERE from_request=$user AND to_request=$currentId");
    mysqli_query($conn, "INSERT INTO frnds (user_one, user_two) VALUES ($user, $currentId)");

}

if($action == 'unfriend'){
    mysqli_query($conn, "DELETE from frnds where (user_one=$currentId AND user_two=$user) OR (user_one=$user AND user_two=$currentId)");
}

header("Location: profile.php?user=".$loggedInUser);



?>