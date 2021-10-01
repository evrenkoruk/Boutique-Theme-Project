<?php

	if($_POST){

		$baslik 				= $_POST["baslik"];
		$kategori_id 			= $_POST["ust_id"];
		$altkategori_id 		= $_POST["altkat_id"];


		if($baslik == "" || $kategori_id == "" || $altkategori_id == ""){
			uyari("Boş alan bırkamayınız.");
			exit();
		}



		$query = $wo_db->prepare("INSERT INTO urun_gruplar SET
		kategori_id=?,
		altkategori_id=?,
		baslik=?");

		$insert = $query->execute(array(
		     $kategori_id, $altkategori_id, $baslik
		));
		

		if($insert){

		    $last_id = $wo_db->lastInsertId();

		    onay("Yeni Ürün Grubu Başarıyla Eklendi","urun_gruplar");

		}else{
			hata("İşlem sırasında hata meydana geldi");
		}


	}else{

	}
?>