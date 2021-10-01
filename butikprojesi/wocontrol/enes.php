<?php @session_start(); @ob_start();  include("system/config.php"); include("system/wofonk.php");
	
	$sayfalar = $wo_db->query("select * from sayfalar");
	foreach ($sayfalar as $sayfa) {

		$id 		= $sayfa["id"];
		$ust_id 	= $sayfa["ust_id"];

		$guncelle = $wo_db->query("update sayfa_icerikler set ust_id='$ust_id' where sayfa_id='$id'");

	}



?>