<?php
include ('credentials.php');
include('authentication.php');
if (isset($_GET['dir']) == false) header("Location: index.php?dir=$folder");

//Part of SKBase - the simple Web Filemanager
//Autor: Sebastian Kiepsch
//Version: 0.0.2
?>
<html>
<head>
	<title>SKBase 0.1.0</title>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
   	<script type="text/javascript">
		function mkdirectory(){
			Directory = document.getElementById("InputSubDir").value;
			if (Directory != null)
			return "delete.php?mkdir=<?php if(isset($_GET['dir']))echo $_GET['dir'];?>" + '/' + Directory;
			else return "delete.php?mkdir=abort";
		}
	</script>
	<script src="js/sortable.js"></script>
	<script src="js/dropzone.js"></script>
	<script type="text/javascript">
	Dropzone.options.myAwesomeDropzone = {
          init: function() {
                this.on("success", function(file, messageOrDataFromServer, myEvent) {
                      window.setTimeout(function() { window.location.href = "files.php"; }, 1000);
                });
          }

	</script>
	
	<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<link href="css/bootstrap.css" type="text/css" rel="stylesheet">
	<link href="css/dropzone.css" type="text/css" rel="stylesheet">
</head>
<body>
	<div class="header">
			<h2>SKBase <small>Filemanager</small></h2>
	</div>

    <div class="container">
	<div class="navigator">
		<ul class="nav nav-pills">
			<li class="active"><a href="index.php">Home</a></li>
			<li><a href="options.php">Admin</a></li>
			<li><a href="credits.php">Credits</a></li>
			<li><a href="index.php?action=logout">Logout</a></li>
		</ul>
	</div>
	</div>

	<div class="container">

		  <ol class="breadcrumb">
			  <?php
			  $curdir = $_GET['dir'];
			  $ds = '/';
			  $link;
			  $subparts = explode($ds, $curdir);
			  for ($i = 0; $i <= count($subparts); $i++){
				  if($i != 0) $link = $link . '/' . $subparts[$i];
				  else $link = $subparts[$i];
				  echo '<li><a href="index.php?dir=' . $link . '">' .$subparts[$i] . '</a></li>';
			  };
			  ?>
		  </ol>
				 <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#newFolder">
									New Folder
				 </button>
				 <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#Uploader">
                 									Upload
                 </button>
	</div>
    <div class="modal fade" id="newFolder">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="newFolderModalLabel">Create a  new folder </h4>
                </div>
                <div class="modal-body">
                    <form role="form" class="form-inline" action=" location.reload();">
                        <p>Please enter a new directory name and click on "Create Folder".</p>
                        <div class="form-group">
                            <label class="sr-only" for="InputSubDir">Subdirectory</label>
                            <input type="text" class="form-control" id="InputSubDir" placeholder="Enter subdirectory">
                        </div>
                        <button type="submit" class="btn btn-primary" data-dismiss="modal" onClick=" window.open(mkdirectory()); location.reload();" >Create Folder</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="Uploader">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" onClick="location.reload();"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="newFolderModalLabel">Upload </h4>
                    </div>
                    <div class="modal-body">
						<form  id="upload" class="dropzone" action="<?php echo 'upload.php?dir=' . $_GET['dir']?>" id="my-awesome-dropzone">
						  <div class="fallback">
                            <input name="file" type="file" multiple />
                          </div>
										Either Drop Files in this box or click to upload.
						</form>
                    </div>
                    <div class="modal-footer">
                   	 <button class="btn btn-primary" data-dismiss="modal" onClick="location.reload();" >Save</button>
                    </div>
                </div>
            </div>
        </div>

	<div class="container">
	<div class="content">
	<table class="table table-striped sortable">
		<thead>
			<tr>
				<th>File</th>
				<th>Size</th>
				<th>Type</th>
				<th>Options</th>
			</tr>
		</thead>
	<?php
	//include("authentication.php");
	include("credentials.php");
	//Checking Login
	if ((isset($_GET['action'])) == true)
		if ($_GET['action'] == "logout"){
			session_destroy();
			header("Location: login.php"); 
		}
	//Always setup dir parameter
	//if (isset($_GET['dir']) == false) header("Location: index.php?dir=$folder");
	//Displaying Directory Items.
	$curdir = $folder;
	if (isset($_GET['dir']) == true) $folder = $_GET['dir'];
	if ($handle = opendir('./' . $folder)) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				$sizzer = filesize($folder . '/' . $file);
				$path = $folder . '/' . $file;
				$link = '<a class="btn btn-default btn-sm" data-toggle="tooltip" title="Download File" href="' . $folder . '/' . $file . '" target=\"_blank\">
                           <span class="glyphicon glyphicon-download-alt"></span>
                         </a>';
				$typer = filetype($folder . '/' . $file);
				$deleter = '<a class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete File"href="delete.php?delete=' . $path . '">
							<span class="glyphicon glyphicon-remove-circle"></span>
						   </a>
				';
				if ($typer != "dir")
				echo '<tr><td><span class="glyphicon glyphicon-file"></span> <a href="' . $folder . '/' . $file . '" target=\"_blank\">' . $file . '</td><td>' . human_filesize($sizzer) . 'B </td><td>' . $typer . ' </td><td>' . $link . ' ' . $deleter . ' </td></tr>';
				else echo'<tr><td><span class="glyphicon glyphicon-folder-open"></span> <a href="index.php?dir=' . $folder . '/' . $file . '">' . $file . '</a></td><td> </td><td>'  . $typer . '</td><td>
				<a class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete Folder" href="delete.php?rmdir=' . $_GET['dir'] . '/' . $file . '">
                	<span class="glyphicon glyphicon-remove-circle"></span>
                </a></td></tr>';
			}
		}
	closedir($handle);
	}
	function human_filesize($bytes, $decimals = 2) {
      $sz = 'BKMGTP';
      $factor = floor((strlen($bytes) - 1) / 3);
      return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }
	?>
	</table>
    </div>
    </div>

	<hr>
	<div class="footer">
		<div class="container">
			<p> SKBase V.0.1.0 by <a href="http://basti-sk.com" target="_blank"> Basti SK </a>, Nov. 2014</p>
		</div>
	</div>
	</div>

</body>
</html>