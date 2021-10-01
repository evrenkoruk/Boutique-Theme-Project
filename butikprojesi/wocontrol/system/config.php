<?php
	
	$host 		= "localhost";
	$database 	= "ksenyabutik_wo";
	$user 		= "ksenyabutik_wo";
	$password 	= "evren.123123";


	try {

	     $wo_db = new PDO("mysql:host=$host;dbname=$database;charset=utf8", "$user", "$password");
	     $wo_db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");

	} catch ( PDOException $e ){

	     print $e->getMessage();
	     
	}






?>