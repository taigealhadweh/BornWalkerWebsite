<?php
include("headerforphp.php");
?>


<?php
	if(isset($_GET['userName'])&&isset($_GET['pwv'])&&isset($_GET['cpwv'])&&isset($_GET['mailv']))
	{
		$name=checkUserName($_GET['userName']);
		$password=checkPassword($_GET['pwv']);
		$conpassword=$_GET['cpwv'];
		$mail=checkemail($_GET['mailv']);
	
		if($password===$conpassword)
		{
			@$conn=mysqli_connect("40.126.240.245","k10838a","password");
			if(!$conn)
			die("<p>connect error</p>");
			@mysqli_select_db($conn,'bornWalkerMap') or die('database error:'.mysql_error());
			$check="SELECT * FROM user WHERE email='$mail'";
			$result=@mysqli_query($conn,$check);
			if(!!$row=mysqli_fetch_array($result))
			{
				location('This E-mail had been used.','register.php');
			}
			$reg="INSERT INTO user(name,password,email,phone) VALUE('$name','$password','$mail',$phone)";
			@mysqli_query($conn,$reg) or die('add error'.mysql_error());
			
			
		}
        else
        {
            location('Password does not match the confirmed password. Please try again :)','register.php');
        }
        
		
	}
	
	/**
	 * location() pop up a alert and get in a web address.
	 * @param string $_info the text of alert.
	 * @param string $_url the page address will jump to.
	 */
	function location($_info,$_url) {
		if (!empty($_info)) {
			echo "<script type='text/javascript'>alert('$_info');location.href='$_url';</script>";
			exit();
		} else {
			header('Location:'.$_url);
		}
	}
	
	/**
	 * checkemail() check the format of this email
	 * @param string $_string the email entered by user.
	 * @return string $_string the checked email address.
	 */
	function checkemail($_string) {
		if (!preg_match('/^[a-zA-Z0-9]+[-_]*@[a-z0-9]+(\.[a-z0-9A-Z]+)+.[a-z0-9]{1,4}$/',$_string)) {
			location('Invalid email address, please try again :)','register.php');
		}
	return $_string;
        
    }
    
    /**
	 * checkUserName() check the format of this user name
	 * @param string $_string the user name entered by user.
	 * @return string $_string the checked user name.
	 */
    function checkUserName($_string) {
		if (!preg_match('/^[\w]+$/',$_string)) {
			location('User name can not begin with a space. Please try again :)','register.php');
		}
	return $_string;
    }
    
    /**
	 * checkPassword() check the format of this user name
	 * @param string $_string the password entered by user.
	 * @return string $_string the checked password.
	 */
    function checkPassword($_string) {
		if (!preg_match('/^[\w]+$/',$_string)) {
			location('Password can not be blank. Please try again :)','register.php');
		}
	return $_string;
    }
?>

    <header>
            <div class="header-content">

                <div class="header-content-inner">
                    <form>
                        <h1 id="homeHeading" style="font-size:75px">Please register</h1>
                        <hr>
                        <div class="row">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-3">
                                <label id="homeHeading" style="font-size:25px">Username</label>
                            </div>
                            <div class="col-md-5">
                            <input type="text" name="userName" class="form-control" placeholder="Enter a username" style="background-color:rgba(255, 226, 223, 0.6);border:0px">
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
                            <input type="password" name="pwv" class="form-control" placeholder="Set a password" style="background-color:rgba(255, 226, 223, 0.6);border:0px">
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label id="homeHeading" style="font-size:25px">Confirm password</label>
                            </div>
                            <div class="col-md-5">
                            <input type="password" name="cpwv" class="form-control" style="background-color:rgba(255, 226, 223, 0.6);border:0px" placeholder="Confirm password">
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
                            <input type="text" name="mailv" class="form-control" style="background-color:rgba(255, 226, 223, 0.6);border:0px" placeholder="Enter a valid email address">
                            </div>
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