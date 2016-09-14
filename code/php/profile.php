<html>

<head>
    <title>Profile</title>
    <link rel='stylesheet' href="../css/custom.css">
</head>

<body>

    <?php include 'functions.php';?>
        <?php include'header.php';?>
            <?php include 'connect.php';?>


                <div class="container1">
                    <h3>Your profile</h3>

                    <?php 
                    session_start();
                    if (isset($_GET['user']) && !empty($_GET['user'])) {
                        $user = $_GET['user'];
                       
                    } else {
                        $user = $_SESSION['user_id'];
                    }
                    
                      $conn = mysqli_connect("40.126.240.245", "k10838a", "password","bornWalkerMap");

                    $query = "SELECT name FROM user where userid = '$user'";
                    
                    $mem_query = mysqli_query($conn, $query);
                    
                    while($run_mem = mysqli_fetch_array($mem_query)){
//                    $user_id = $run_mem['userid'];
                    //the get user function will get the username according to the id
                    $username = $run_mem['name'];
                     $my_id = $_SESSION['user_id'];
                    }
                    ?>

                        <h3><?php echo $username; ?></h3>
                        <?php
                    if($user != $my_id){
                       $check_frnd_query = mysqli_query($conn, "SELECT id from frnds where (user_one= $my_id AND user_two= $user) OR (user_one= $user AND user_two= $my_id)");
                        if(mysqli_num_rows($check_frnd_query) == 1){
                            echo "<a href='#' class='box'>Already friends</a> | <a href='#'> Unfriend $username</a>";
                            
                        } else {
                            $from_query = mysqli_query($conn, "SELECT id from frnd_req WHERE (from_request = $user AND to_request = $my_id)");
                            $to_query = mysqli_query($conn, "SELECT id from frnd_req WHERE (from_request = $my_id AND to_request = $user)");
                            
                            if (mysqli_num_rows($from_query) == 1) {
                                echo "<a href='#' class='box'>Accept</a> | <a href='' class='box'>Ignore</a>";
                            } else if (mysqli_num_rows($to_query) == 1){
                                echo "<a href='#' class='box'>Cancel Request</a>";
                                
                            } else {
                                echo "<a href='actions.php?action=send&user=$user' class='box'>Send friend request</a>";
                            }
                        }
                    }
                    ?>

                </div>



</body>


</html>