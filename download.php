<?PHP
	error_reporting(E_ERROR | E_PARSE);
	require "config.php";

	$file 		= $_GET['file'];
	force_download(end(explode("/", $file)), file_get_contents($file));