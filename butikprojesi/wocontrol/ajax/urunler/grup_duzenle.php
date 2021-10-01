<?php

	if($_POST){
		$id = $_POST["id"];
		$baslik 				= $_POST["baslik"];
		$kategori_id 			= $_POST["ust_id"];
		$altkategori_id 		= $_POST["altkat_id"];


		if($baslik == "" || $kategori_id == "" || $altkategori_id == ""){
			uyari("Boş alan bırkamayınız.");
			exit();
		}



		$query = $wo_db->prepare("UPDATE urun_gruplar SET
		kategori_id=?,
		altkategori_id=?,
		baslik=? WHERE id=?");

		$insert = $query->execute(array(
		     $kategori_id, $altkategori_id, $baslik, $id
		));
		

		if($insert){

		    $last_id = $wo_db->lastInsertId();

		    onay("Ürün grubu başarıyla düzenlendi.","urun_gruplar");

		}else{
			hata("İşlem sırasında hata meydana geldi");
		}


	}else{

	}
?>