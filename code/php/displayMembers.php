<?php
include("headerLoggedinPhp.php");
?>


<header>
<?php include 'functions.php'; ?>

    <?php include 'connect.php'; ?>

    <div>
        <h2>
            Members:
        </h2>

    </div>
<?php
if (isset($_POST['friendUserNameSearch'])) {
//       session_startt();
    $friendUserName = $_POST['friendUserNameSearch'];
//       print_r($friendUserName);
    $conn = mysqli_connect("40.126.240.245", "k10838a", "password", "bornWalkerMap");
    $query = "select * from user where name = '$friendUserName'";

    $searchUserQuery = mysqli_query($conn, $query);

    while ($run_mem = mysqli_fetch_array($searchUserQuery)) {
        $friendsName = $run_mem['name'];
        $friendsUserId = $run_mem['userid'];

        print_r($friendsName);
        print_r($friendsUserId);
        echo "<a href='friendRequest.php?user=$friendsUserId' class='btn btn-primary btn-xl' style='display:block'>$friendsName</a>";
    }
} else {
    echo "There is no member available.";
}
?>




</header>
    <?php include("footer.php"); ?>