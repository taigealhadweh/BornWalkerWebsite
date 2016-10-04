<?php
include("headerLoggedinPhp.php");
session_start();
$userId = $_SESSION['user_id'];
$userName = $_SESSION['name'];

?>
<header>
    <div class="header-content">
        <div class="header-content-inner">
            <h1>Change email</h1>
            <form method="post" action="changeUserInformationQuery.php">
            
            <hr>
            
            <input class="form-control" type="text" id="newPassword" name="newEmail" placeholder="New email" style="background-color:rgba(255, 226, 223, 0.6);border:0px">
                <button type="submit" class="btn btn-primary">Change email</button>  
                
                </form>
                    
            

        </div>
    </div>
    
</header>

<?php include("php/footer.php"); ?>