<?php
ini_set('upload_max_filesize', '200M');
ini_set('post_max_size', '200M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);
include('authentication.php');
include('credentials.php');
$ds          = DIRECTORY_SEPARATOR; 

if (!is_dir($_GET['dir']) && (startsWith($_GET['dir'], $folder)) == false) exit;
$storeFolder = $_GET['dir'];
if (!empty($_FILES)) {
	$tempFile = $_FILES['file']['tmp_name'];         
	$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds; 
	$targetFile =  $targetPath. $_FILES['file']['name'];  
	move_uploaded_file($tempFile,$targetFile);
	@chmod( $targetFile, 0755 );
}
function startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}
?>
