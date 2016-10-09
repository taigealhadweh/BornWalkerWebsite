<?php

$con=mysqli_connect("40.126.240.245", "k10838a", "password","bornWalkerMap");

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$userid = $_POST['userid'];
$timer = $_POST['timer'];   

$sql = "UPDATE bornWalkerMap.user SET timer = '$timer' WHERE userid = '$userid'";

if (!mysqli_query($con,$sql))
{
    die('Error: ' . mysqli_error($con));
}

mysqli_close($con);

?>
