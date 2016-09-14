<html>

<head>
    <title>Requests</title>
    <link rel='stylesheet' href="../css/custom.css">
</head>

<body>
    <?php include 'connect.php';?>
        <?php include 'functions.php';?>
            <?php include 'header.php';?>


                <div class="container">
                    <h3>Requests: </h3>
                    <?php
                    session_start();
                    $conn = mysqli_connect("40.126.240.245", "k10838a", "password","bornWalkerMap");
                    $currentId = $_SESSION['user_id'];
                    $req_query = mysqli_query($conn, "SELECT from_request from frnd_req where to_request = $currentId");
                    
                    while($run_req = mysqli_fetch_array($req_query)) {
                        $from_request = $run_req['from_request'];
//                        print_R($from_request);
                        
                        $from_query = mysqli_query($conn, "SELECT name from user where userid = $from_request");
                        while($run_from = mysqli_fetch_array($from_query)){
                            $from_username = $run_from['name'];
                            echo "<a href='profile.php?user=$from_request' class='box' style='display:block'>$from_username</a>";
                        }
                    }
                    ?>
                </div>

</body>


</html>