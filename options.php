<?php

include("authentication.php");

include("credentials.php");

if (isset($_POST['newun']) == true){
	$File = "credentials.php";
	$Handle = fopen($File, 'w');
	fwrite($Handle, "<?php\n");
	fwrite($Handle, '//Autogenerated by options.php, Version 0.0.2' . "\n");
	if ($user != $_POST['newun']) fwrite($Handle,'$user = "' . $_POST['newun'] . "\";\n");
	else fwrite($Handle,'$user = "' . $user . "\";\n");
	if ($_POST['newpw'] != '') fwrite($Handle,'$password = "'. $_POST['newpw'] .  "\";\n");
	else fwrite($Handle, '$password = "'. $password .  "\";\n");
	if ($_POST['root'] != '') fwrite($Handle, '$folder = "'.$_POST['root'] . "\";\n");
	else fwrite($Handle, '$folder = "'.$folder . "\";\n");
	fwrite($Handle, "?>\n");
	fclose($Handle);
	echo '<script type="text/javascript" language="Javascript"> alert("Saved Changes!") </script> ';
}  


?>
<html>
<head>
	<title>SKBase 0.0.2</title>
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<link href="css/bootstrap.css" type="text/css" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="header">
			<h2>SKBase <small>Filemanager</small></h2>
	</div>

    <div class="container">
	<div class="navigator">
		<ul class="nav nav-pills">
			<li><a href="index.php">Home</a></li>
			<li class="active"><a href="options.php">Admin</a></li>
			<li><a href="credits.php">Credits</a></li>
			<li><a href="index.php?action=logout">Logout</a></li>
		</ul>
	</div>
	</div>

<div class="container">
<div class="content">
<h2>SKBase Configuration Page</h2>
<p> On this page you can configure the settings for SKBase. <br>
You can also make changes in the "credentials.php" file instead of using this page!
</p>
<p> <b>Script-Version: 0.0.2</b></p>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<h3>Current Settings</h3>
<table style="margin:0; width: 500px;">
<tr><th>Property</th><th>Current Value</th><th>New Value</th>
<tr><td>Username: </td><td><?php include("credentials.php"); echo $user;?></td><td><input class="form-control" type="text" name="newun"></td>
<tr><td>Password: </td><td>*****</td><td><input class="form-control" type="password" name="newpw"></td></tr>
<tr><td>Root-Subfolder: </td><td> <?php include("credentials.php"); echo $folder;?></td><td><input  class="form-control" type="text" name="root"></td></tr>
<tr><td></td><td></td><td><button class="btn btn-default" type="submit">Save Changes</button></td></tr>
</table>


</form>
</div>
</div>
</body>
</html>
