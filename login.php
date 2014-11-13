<?php
session_start();
//error_reporting(0);
include("credentials.php");
$username_try = trim($_POST['username']);
$password_try = trim($_POST['password']); 
if (($password_try == $password) and ($username_try  = $user))
{
	$_SESSION['loggedin'] = true;
	header("Location: index.php");  
}
?>
<html>
<head>
	<title>SKBase 0.1.0</title>
	<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
	<link href="css/bootstrap.css" type="text/css" rel="stylesheet">
	<link href="css/sign.css" type="text/css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<form class="form-signin" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
			<h2 class="form-signin-heading">SKBase <small>Filemanager</small></h2>
			<input type="email" class="form-control" name="username" placeholder="Email address" required autofocus>
			<input type="password" class="form-control" name="password" placeholder="Password" required>
			<button class="btn bnt-lg btn-primary btn-block" type="submit">Sign In</button>
		</form>
	</div>
	<hr>
	<div class="footer">
		<div class="container">
			<p> SKBase V.0.1.0 by <a href="http://basti-sk.com" target="_blank"> Basti SK </a>, Nov. 2014</p>
		</div>
	</div>


</body>
</html>