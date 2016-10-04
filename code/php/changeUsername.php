<?php
include("headerLoggedinPhp.php");
session_start();
$userId = $_SESSION['user_id'];
$userName = $_SESSION['name'];

?>
<header>
    <div class="header-content">
        <div class="header-content-inner">
            
            

        </div>
    </div>
    
</header>

<?php include("php/footer.php"); ?>