<?php

	if($_POST){

		$soru 		= $_POST["soru"];
		$cevap		= $_POST["cevap"];
		$sira		= $_POST["sira"];

		if($soru == "" || $cevap == ""){
			uyari("Soru ve Cevap Alanlarını Boş Bırakmayınız");
			exit();
		}



		$query = $wo_db->prepare("INSERT INTO sss SET
		soru = ?,
		cevap = ?,
		sira = ?");

		$insert = $query->execute(array(
		     $soru, $cevap, $sira
		));
		

		if($insert){

		    $last_id = $wo_db->lastInsertId();

		    onay("Yeni Soru ve Cevabınız Başarıyla Yayınlandı","sss");

		}else{
			hata("İşlem sırasında hata meydana geldi");
		}


	}else{

	}
?>