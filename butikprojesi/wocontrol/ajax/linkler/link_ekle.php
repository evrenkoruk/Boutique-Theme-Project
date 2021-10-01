<?php

	if($_POST){

		$baslik 	= $_POST["baslik"];
		$link		= $_POST["link"];
		$sira		= $_POST["sira"];

		if($baslik == "" || $link == ""){
			uyari("Başlık ve Link Alanlarını Boş Bırakmayınız");
			exit();
		}



		$query = $wo_db->prepare("INSERT INTO linkler SET
		baslik = ?,
		link = ?,
		sira = ?");

		$insert = $query->execute(array(
		     $baslik, $link, $sira
		));
		

		if($insert){

		    $last_id = $wo_db->lastInsertId();

		    onay("Yeni Link Başarıyla Yayınlandı","linkler");

		}else{
			hata("İşlem sırasında hata meydana geldi");
		}


	}else{

	}
?>