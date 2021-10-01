<?php

	if($_POST){

		$kategori_ad = $_POST["kategori_ad"];
		$sira 		= $_POST["sira"];

		if($kategori_ad == ""){
			uyari("Kategori Adını Boş Bırakmayınız");
			exit();
		}

		if($_FILES["gorsel"]["tmp_name"] == ""){
			
			$gorsel = "";


		}else{
			$gorsel 	= @resim_yukle($_FILES["gorsel"]["tmp_name"],$_FILES["gorsel"]["name"],"../upload/slider");	
		}



		$query = $wo_db->prepare("INSERT INTO urunler_kategori SET
		kategori_ad = ?,
		gorsel = ?,
		sira = ?");

		$insert = $query->execute(array(
		     $kategori_ad, $gorsel, $sira
		));
		

		if($insert){

		    $last_id = $wo_db->lastInsertId();

		    onay("Yeni Kategoriniz Başarıyla Eklendi","urunler_kategori");

		}else{
			hata("İşlem sırasında hata meydana geldi");
		}


	}else{

	}
?>