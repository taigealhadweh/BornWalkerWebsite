<html>

<head>
    <title>BornWalker</title>
</head>

<body>
    <form>
        <h1>Register to BornWalker</h1></br>
        <p>Please fill the fields below to complete your registration</p>
        <p>Name:
            <input type="text" name="userName">
        </p>
        <p>Password:
            <input type="password" name="pwv">
        </p>
        <p>Confirm password:
            <input type="password" name="cpwv">
        </p>
        <p>Email:
            <input type="text" name="mailv">
        </p>
        <p>Phone:
            <input type="text" name="pv">
        </p>
        <p>
            <input type="submit" value="Register">
        </p>
        <h3>Already registered?&nbsp<a href="login.php">Login here</a></h3>
    </form>
</body>
<?php
	if(isset($_GET['userName'])&&isset($_GET['pwv'])&&isset($_GET['cpwv'])&&isset($_GET['mailv'])&&isset($_GET['pv']))
	{
		$name=$_GET['userName'];
		$password=$_GET['pwv'];
		$conpassword=$_GET['cpwv'];
		$mail=checkemail($_GET['mailv']);
		$phone=$_GET['pv'];
	
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
		if (!preg_match('/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/',$_string)) {
			location('Incorrect E-mail format.','register.php');
		}
	return $_string;
}

?>

</html>