<?php
define("_PRE","ohio");
	$ipaddr = $_SERVER['HTTP_HOST'];
	/* MAIN DB */
	define("_DB_NAME","db_risk");
	define("_DB_USER","root");
	define("_DB_PASS","");
	define("_DB_SERVER",$ipaddr);
	
	// Check connection
	$conn = new mysqli(_DB_SERVER,_DB_USER,_DB_PASS,_DB_NAME);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
?>