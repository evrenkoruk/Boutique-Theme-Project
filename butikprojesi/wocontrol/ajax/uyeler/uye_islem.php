<?php
	
	if(@$_POST){

		$id = $_POST["uye_id"];
		$islem = $_POST["islem"];

		if($islem == "aktif"){
			$yayin = 1;
		}else{
			$yayin = 0;
		}

		$query = $wo_db->prepare("UPDATE uyeler SET aktif = ? WHERE id = ?");

		$insert = $query->execute(array(
		     $yayin, $id
		));


		if($insert){
			echo 'ok';
		}else{

		}


	}else{


	}


?>