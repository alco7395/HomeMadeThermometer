<?php
	include_once 'dbconfig.php';
	$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
	
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
?>