<?php
	$file_name = $_GET["file"];
	$mime_type = 'application/force-download'; // this is important 
	header('Pragma: public'); 
	header('Expires: 0'); // We tell browser no to cache anything 
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	 header('Cache-Control: private',false); 
	header('Content-Type: '.$mime_type); // Content-Type is now set to application/force-download 
	header('Content-Disposition: attachment; filename="'.basename($file_name).'"'); 
	header('Content-Transfer-Encoding: binary'); 
	header('Connection: close'); readfile($file_name); // reads a file from start to end 
	die(0); // nothing else should be written to stream
?>