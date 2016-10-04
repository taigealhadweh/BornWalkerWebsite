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
<!--            the change username button-->
            <h2>
                <?php 
                echo "<a href='changeUsername.php?user=$userId' class='btn btn-primary btn-xl' style='display:block'>Change username</a>";?>
            </h2>
            
<!--               The change email button -->
            <h2>Change email</h2>
            
<!--            the change password button-->
            <h2>Change password</h2>
            

            <hr>
            

        </div>
    </div>
    
</header>

<?php include("php/footer.php"); ?>