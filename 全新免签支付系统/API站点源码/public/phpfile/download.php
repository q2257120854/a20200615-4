<?php
	error_reporting(0);
	$file = $_GET['file'];
	$name = $_GET['name'];
	header("Content-Type: application/force-download");
	header("Content-Disposition: attachment; filename=$name");
	if(!$_GET['t'] or $_GET['t']==0){
		readfile('http://'.$file);
		exit;
	}else if($_GET['t']==1){
		readfile('https://'.$file);
		exit;
	}
?>