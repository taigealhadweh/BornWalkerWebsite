<?php
session_start();
include("headerforphp.php");
// Unset all of the session variables.
$_SESSION = array();


// Finally, destroy the session.
session_destroy();
?>

<header>
    <div class="header-content">
        <div class="header-content-inner">
            <h1 style="font-size:75px">Come back soon!</h1>
        </div>
    </div>
</header>

<?php include("footer.php") ?>