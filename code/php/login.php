<html>

<head>
    <title>BornWalker--login</title>
</head>

<body>
    <h1>Login to BornWalker</h1>
    <form>
        <p>Email:
            <input type="text" name="userEmail">
        </p>
        <p>Password:
            <input type="password" name="userPassword">
        </p>
        <p>
            <input type="submit" value="Log in">
        </p>
        <h3>New member? <a href="register.php">Register now</a></h3>
    </form>
</body>
<?php
	if(isset($_GET['userEmail'])&&isset($_GET['userPassword']))
	{
		$mail=$_GET['userEmail'];
		$password=$_GET['userPassword'];
		@$conn=mysqli_connect("40.126.240.245","k10838a","password"); //connect database
		if(!$conn)
		die("<p>connect error</p>");
		@mysqli_select_db($conn,'bornWalkerMap') or die('database error:'.mysql_error());
		$log="SELECT * FROM user WHERE email='$mail'";
		$databaseQuery="SELECT userid FROM user WHERE email='$mail'";
		$sendDatabaseQuery = mysqli_query($conn, $databaseQuery);
		$resultOfDatabaseQuery = mysqli_fetch_row($sendDatabaseQuery)or die(location('ID or password does not exist.','login.php'));
		$errorDatabaseQuery = mysqli_query($conn,$log);
		$resultArrayPosition = mysqli_fetch_row($errorDatabaseQuery) or die('search error'.mysqli_error());
		if($resultArrayPosition[2]===$password) //check password
		{
			setcookies($resultOfDatabaseQuery[0]);
			sleep(2);
			location('Login success.','profile.php');
		}else
		{
			location('ID or password does not exist.','login.php');
		}
	}
	
	function setcookies($resultOfDatabaseQuery){
		setcookie('userid', $resultOfDatabaseQuery);
	}
	
	function location($_info,$_url) {
	if (!empty($_info)) {
		echo "<script type='text/javascript'>alert('$_info');location.href='$_url';</script>";
		exit();
	} else {
		header('Location:'.$_url);
	}
}
?>

</html>