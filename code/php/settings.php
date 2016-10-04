<?php
include("headerLoggedinPhp.php");
session_start();
$userId = $_SESSION['user_id'];
print_r($userId);

?>
<header>
    <div class="header-content">
        <div class="header-content-inner">
            <h1 id="settingsHeading" style="font-size:60px">What would you like to change?</h1>
            
            <hr>
            
<!--               The change email button -->
            <h2><?php 
                echo "<a href='changeEmail.php?user=$userId' class='btn btn-primary btn-xl' style='display:block'>Change email</a>";?></h2>
            
<!--            the change password button-->
            <h2><?php 
                echo "<a href='changePassword.php?user=$userId' class='btn btn-primary btn-xl' style='display:block'>Change password</a>";?></h2>
            

            <hr>
            

        </div>
    </div>
    
</header>

<?php include("php/footer.php"); ?>