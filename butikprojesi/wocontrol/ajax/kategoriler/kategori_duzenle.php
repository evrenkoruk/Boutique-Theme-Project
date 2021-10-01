<?php

	if($_POST){

		$id 		= $_POST["id"];
		$kategori_ad 		= $_POST["kategori_ad"];

		if($kategori_ad == ""){
			uyari("Kategori Adını Boş Bırakmayınız");
			exit();
		}


		$query = $wo_db->prepare("UPDATE duyuru_kategori SET
				kategori_ad = ? WHERE id = ?");

				$insert = $query->execute(array(
				     $kategori_ad, $id
				));


		if($insert){

			onay("Değişiklikler başarıyla kaydedildi.","kategoriler");

		}else{
			hata("İşlem sırasında hata meydana geldi");
		}


	}else{

	}
?>