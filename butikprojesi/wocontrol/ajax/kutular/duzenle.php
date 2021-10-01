<?php

	if($_POST){

		$id 		= $_POST["id"];
		$baslik = $_POST["baslik"];
        $aciklama = $_POST["aciklama"];
        $url = $_POST["url"];
        $gorsel = $_POST["gorsel"];

		if($_FILES["gorsel"]["tmp_name"] == ""){


		}else{
			$gorsel 	= @resim_yukle($_FILES["gorsel"]["tmp_name"],$_FILES["gorsel"]["name"],"../upload/slider");	
		}


		if($_FILES["gorsel"]["tmp_name"] == ""){

			$query = $wo_db->prepare("UPDATE kutular SET
				baslik = ?,
				aciklama = ?,
				url = ? WHERE id = ?");

				$insert = $query->execute(array(
				     $baslik, $aciklama, $url, $id
				));


		}else{	

			$query = $wo_db->prepare("UPDATE kutular SET
				baslik = ?,
				aciklama = ?,
				url = ?,
				gorsel = ? WHERE id = ?");

				$insert = $query->execute(array(
				     $baslik, $aciklama, $url, $gorsel, $id
				));

		}


		if($insert){
			
			onay("Değişiklikler başarıyla kaydedildi.","kutular");

		}else{
			hata("İşlem sırasında hata meydana geldi");
		}


	}else{

	}
?>