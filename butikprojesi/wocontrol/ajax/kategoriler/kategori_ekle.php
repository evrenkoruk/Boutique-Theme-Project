<?php

	if($_POST){

		$kategori_ad 		= $_POST["kategori_ad"];

		if($kategori_ad == ""){
			uyari("Kategori Adını Boş Bırakmayınız");
			exit();
		}



		$query = $wo_db->prepare("INSERT INTO duyuru_kategori SET
		kategori_ad = ?");

		$insert = $query->execute(array(
		     $kategori_ad
		));
		

		if($insert){

		    $last_id = $wo_db->lastInsertId();

		    onay("Yeni Kategoriniz Başarıyla Eklendi","kategoriler");

		}else{
			hata("İşlem sırasında hata meydana geldi");
		}


	}else{

	}
?>