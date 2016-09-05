<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- this is for the size, so if mobile show mobile size and if ipad show ipad size etc -->
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>BornWalker</title>
    <!-- Bootstrap -->
    <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="container">
        <div class="row-fluid">
            <div class="column-padding">

                <form>
                    <h1>BornWalker Registration</h1>
                    <div class="span 3">
                        <p>Name:
                            <input type="text" name="userName">
                        </p>
                    </div>
                    <div class="span 3">
                        <p>Password:
                            <input type="password" name="pwv">
                        </p>
                    </div>
                    <div class="span 3">
                        <p>Confirm password:
                            <input type="password" name="cpwv">
                        </p>
                    </div>
                    <div class="span 3">
                        <p>Email:
                            <input type="text" name="mailv">
                        </p>
                    </div>
                    <div class="span 3">
                        <p>Phone:
                            <input type="text" name="pv">
                        </p>
                    </div>
                    <div class="span 3">
                        <p>
                            <input type="submit" value="Register">
                        </p>
                    </div>
                    <h3>Already registered?&nbsp<a href="login.php">Login here</a></h3>
                </form>
            </div>
        </div>
    </div>
    <!-- navbar code should be same on all pages -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only"> Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Need to resize the logo to fit in line with the navbar -->
                <!-- <a href="" class="navbar-left"><img src=""></a> -->
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../index.html">Home</a></li>
                    <li><a href="../html/takeawalk.html">Take a walk</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li class="active"><a href="login.php">Login</a></li>

                </ul>
            </div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>



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