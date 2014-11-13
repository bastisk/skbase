<?php
include("authentication.php");
include("credentials.php");
if (isset($_GET['delete'])){
	$myFile = $_GET['delete'];
	unlink($myFile);
	header("Location: ".$_SERVER["HTTP_REFERER"]);
}
if (isset($_GET['rmdir'])) {
	$myDir = $_GET['rmdir'];
	if (is_dir($myDir) && startsWith($myDir, $folder) && ($myDir != $folder)){
	rmdir_recursive($myDir);
	header("Location: ".$_SERVER["HTTP_REFERER"]);}
}
if (isset($_GET['mkdir'])) {
	$myDir = $_GET['mkdir'];
	if ($myDir == "abort"){ 
		echo '<script type="text/javascript">window.close();</script>';  die;
	}
	if (!is_dir($myDir)) mkdir($myDir);	
	echo '<script type="text/javascript">window.close();</script>';  
}

function rmdir_recursive($dir) {
    foreach(scandir($dir) as $file) {
        if ('.' === $file || '..' === $file) continue;
        if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
        else unlink("$dir/$file");
    }
    rmdir($dir);
}

function startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}

?>