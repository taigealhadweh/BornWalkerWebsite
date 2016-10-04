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
        <div class="container">
            <div class="row-fluid">
                <div class="column-padding">

                    <form>
                        <h1>BornWalker Registration</h1>
                        <div class="row">
                            <label class="col-sm-12 col-form-label">Name:</label>
                            <input type="text" name="userName">
                        </div>
                        <div class="row">
                            <label class="col-sm-12 col-form-label">Password:</label>
                            <input type="password" name="pwv">
                        </div>
                        <div class="row">
                            <label class="col-sm-12 col-form-label">Confirm password:</label>
                            <input type="password" name="cpwv">
                        </div>
                        <div class="row">
                            <label class="col-sm-12 col-form-label">Email:</label>
                            <input type="text" name="mailv">
                        </div>
<!--
                        <div class="row">
                            <label class="col-sm-12 col-form-label">Phone:</label>
                            <input type="text" name="pv">
                        </div>
-->
                        <div class="row">
                            <label class="col-form-label"></label>
                            <input type="submit" value="Register">
                        </div>
                        <h3>Already registered?&nbsp<a href="login.php">Login here</a></h3>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <?php include("footer.php") ?>