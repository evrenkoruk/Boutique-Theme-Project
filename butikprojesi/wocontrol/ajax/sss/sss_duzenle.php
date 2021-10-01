<?php

	if($_POST){

		$id 		= $_POST["id"];
		$soru 		= $_POST["soru"];
		$cevap		= $_POST["cevap"];
		$sira		= $_POST["sira"];


		if($soru == "" || $cevap == ""){
			uyari("Soru ve Cevap Alanlarını Boş Bırakmayınız");
			exit();
		}


		$query = $wo_db->prepare("UPDATE sss SET
				soru = ?,
				cevap = ?,
				sira = ? WHERE id = ?");

				$insert = $query->execute(array(
				     $soru, $cevap, $sira, $id
				));


		if($insert){

			onay("Değişiklikler başarıyla kaydedildi.","sss");

		}else{
			hata("İşlem sırasında hata meydana geldi");
		}


	}else{

	}
?>