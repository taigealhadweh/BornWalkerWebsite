<?php
include("headerforphp.php");
?>
    <header>
            <div class="header-content">

                <div class="header-content-inner">
                    <form method="post" action="sendRegistrationEmail.php">
                        <h1 id="homeHeading" style="font-size:75px">Please register</h1>
                        <hr>
                        <div class="row">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-3">
                                <label id="homeHeading" style="font-size:25px">Username</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" name="userName" id="userName" class="form-control" placeholder="Enter a username" style="background-color:rgba(255, 226, 223, 0.6);border:0px">
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-3">
                                <label id="homeHeading" style="font-size:25px">Password</label>
                            </div>
                            <div class="col-md-5">
                            <input type="password" name="userPassword" id="userPassword" class="form-control" placeholder="Set a password" style="background-color:rgba(255, 226, 223, 0.6);border:0px">
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label id="homeHeading" style="font-size:25px">Confirm password</label>
                            </div>
                            <div class="col-md-5">
                            <input type="password" name="confirmUserPassword" id="confirmUserPassword" class="form-control" style="background-color:rgba(255, 226, 223, 0.6);border:0px" placeholder="Confirm password">
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-3" >
                                <label id="homeHeading" style="font-size:25px">Email</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" name="userEmail" id="userEmail" class="form-control" style="background-color:rgba(255, 226, 223, 0.6);border:0px" placeholder="Enter a valid email address">
                            </div>
                            
                            <div class="col-md-3">
                            </div>
                        </div>
<!--
                        <div class="row">
                            <label class="col-sm-12 col-form-label">Phone:</label>
                            <input type="text" name="pv">
                        </div>
-->
                    <hr>    
                    <div class="row">
                            <div class="col-sm-12">
                            <button type="submit"  class="btn btn-primary btn-xl"><h3>Register</h3></button>
                            </div>
                        </div>
                        <h3>Already registered? <a href="login.php" role="button" class="btn btn-primary btn-xl">Login here</a></h3>
                    </form>
                </div>
        </div>
    </header>
    <?php include("footer.php") ?>