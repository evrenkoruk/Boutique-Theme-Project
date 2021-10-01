<?php
	if($_POST){

		$id 		= $_POST["id"];
		$baslik 	= $_POST["baslik"];
		$link		= $_POST["link"];
		$sira		= $_POST["sira"];


		if($baslik == "" || $link == ""){
			uyari("Başlık ve Link Alanlarını Boş Bırakmayınız");
			exit();
		}


		$query = $wo_db->prepare("UPDATE linkler SET
				baslik = ?,
				link = ?,
				sira = ? WHERE id = ?");

				$insert = $query->execute(array(
				     $baslik, $link, $sira, $id
				));


		if($insert){

			onay("Değişiklikler başarıyla kaydedildi.","linkler");

		}else{
			hata("İşlem sırasında hata meydana geldi");
		}


	}else{

	}
?>