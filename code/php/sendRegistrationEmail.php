<?php
include("headerforphp.php");

?>
<!--This is inserting the user registrations details into the database-->
<?php
	if(isset($_POST['userName'])&&isset($_POST['userPassword'])&&isset($_POST['confirmUserPassword'])&&isset($_POST['userEmail']))
	{
		$name=checkUserName(ucfirst($_POST['userName']));
		$password=checkPassword($_POST['userPassword']);
		$conpassword=$_POST['confirmUserPassword'];
		$mail=checkemail($_POST['userEmail']);
	
		if($password===$conpassword)
		{
			$password = hash("sha256", $password);
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
			$reg="INSERT INTO user(name,password,email) VALUE('$name','$password','$mail')";
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

<!--This is for sending an email to the new users email account-->
<header>
<div class="container">
    <h2 id="successMessage">
<?php

require '../phpmailer/PHPMailerAutoload.php';

$userEmail = $_POST['userEmail'];
$userName = ucfirst($_POST['userName']);



$mail = new PHPMailer;

//$mail->SMTPDebug = 1;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'spaghettistructures@gmail.com';                 // SMTP username
$mail->Password = 'SStructures123';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('spaghettistructures@gmail.com', 'BornWalker');
$mail->addAddress("$userEmail", "$userName");     // Add a recipient
//$mail->addAddress('taigealhadweh@gmail.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'BornWalker registration';
$mail->Body    = "Thank you for registering with BornWalker! Your username is $userName. Login, set your walking goal, add your friends and have fun!";
$mail->AltBody = "Thank you for registering with BornWalker! Your username is $userName. Login, set your walking goal, add your friends and have fun!";

if(!$mail->send()) {
    echo "Oh no, something went wrong...Please try again! " ;
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    $messageError = 1;
} else {
    echo "Yayyy! Thanks for registering!";
    $messageError = 0;
}

?>
        </h2>
    </div>
    
    <form action="register.php" method="get">
    <input type="submit" value="Try again" class="btn btn-primary setGoal">
    </form>

    <form action="login.php" method="get">
    <input type="submit" value="Login" class="btn btn-primary setGoal">
    </form>
    
    
</header>


    
