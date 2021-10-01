<?php

	if($_POST){

		$id 		= $_POST["id"];
		$kategori_ad 		= $_POST["kategori_ad"];
		$gorsel 		= $_POST["gorsel"];
		$sira 		= $_POST["sira"];

		if($kategori_ad == ""){
			uyari("Kategori Adını Boş Bırakmayınız");
			exit();
		}


		if($_FILES["gorsel"]["tmp_name"] == ""){
			

		}else{
			$gorsel 	= @resim_yukle($_FILES["gorsel"]["tmp_name"],$_FILES["gorsel"]["name"],"../upload/slider");	
		}


		if($_FILES["gorsel"]["tmp_name"] == ""){

			$query = $wo_db->prepare("UPDATE urunler_kategori SET
				kategori_ad = ?,
				sira = ? WHERE id = ?");

				$insert = $query->execute(array(
				     $kategori_ad, $sira, $id
				));


		}else{	

			$query = $wo_db->prepare("UPDATE urunler_kategori SET
				kategori_ad = ?,
				gorsel = ?,
				sira = ? WHERE id = ?");

				$insert = $query->execute(array(
				     $kategori_ad, $gorsel, $sira, $id
				));

		}



		


		if($insert){

			onay("Değişiklikler başarıyla kaydedildi.","urunler_kategori");

		}else{
			hata("İşlem sırasında hata meydana geldi");
		}


	}else{

	}
?>