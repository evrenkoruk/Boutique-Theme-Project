<?php
	
	if(@$_POST){

		$id = $_POST["ilan_id"];
		$islem = $_POST["islem"];

		if($islem == "yayinla"){
			$yayin = 1;
		}else{
			$yayin = 2;
		}

		$query = $wo_db->prepare("UPDATE ilanlar SET yayin = ? WHERE id = ?");

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