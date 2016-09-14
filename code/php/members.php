<html>

<head>
    <title>Members</title>
    <link rel='stylesheet' href="../css/custom.css">
</head>

<body>
    <?php include 'functions.php';?>
        <?php include'header.php';?>


            <div class="container1">
                <h3>Members:</h3>

                <?php
           
    $conn = mysqli_connect("40.126.240.245", "k10838a", "password","bornWalkerMap");

$query = "SELECT * FROM user";
    $mem_query = mysqli_query($conn, $query);
    while($run_mem = mysqli_fetch_array($mem_query)){
        $user_id = $run_mem['userid'];
        //the get user function will get the username according to the id
        $username = $run_mem['name'];
        echo "<a href='profile.php?user=$user_id' class='box' style='display:block'> $username</a>";
    }
    
    


                    ?>
            </div>



</body>


</html>