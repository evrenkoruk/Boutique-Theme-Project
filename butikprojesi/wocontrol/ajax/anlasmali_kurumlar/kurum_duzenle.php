<?php

	if($_POST){
		$id 		= $_POST["id"];
		$baslik 	= $_POST["baslik"];
		$icerik		= $_POST["icerik"];
		// $yazar 		= $_SESSION["admin_adsoyad"];

		if($baslik == ""){
			uyari("Kurum Adını Boş Bırakmayınız");
			exit();
		}



		if($_FILES["gorsel"]["tmp_name"] == ""){

			$query = $wo_db->prepare("UPDATE anlasmali_kurumlar SET
				baslik = ?,
				icerik = ? WHERE id = ?");

				$insert = $query->execute(array(
				     $baslik, $icerik, $id
				));


		}else{

			$gorsel 	= @resim_yukle($_FILES["gorsel"]["tmp_name"],$_FILES["gorsel"]["name"],"../upload/kurum");	

			$query = $wo_db->prepare("UPDATE anlasmali_kurumlar SET
			baslik = ?,
			icerik = ?,
			gorsel = ? WHERE id = ?");

			$insert = $query->execute(array(
			     $baslik, $icerik, $gorsel, $id
			));
		}
		


		


		

		if($insert){
			
			onay("Değişiklikler başarıyla kaydedildi.","anlasmali_kurumlar");


			$dosya_isim_sayi=count($_FILES['gorseller']['name']); 

			for($i=0;$i<$dosya_isim_sayi;$i++){ 
				
				if(!empty($_FILES['gorseller']['name'][$i])){ 

				// echo $_FILES['dosya']['name'][$i];
				$yoll = "../upload/kurum/".$id;
				$yuklenen = resim_yukle($_FILES["gorseller"]["tmp_name"][$i],$_FILES["gorseller"]["name"][$i],$yoll);

				$query = $wo_db->prepare("INSERT INTO gorseller SET
					yazi_id = ?,
					kategori = ?,
					gorsel = ?");

					$gorsel_yukle = $query->execute(array(
					     $id, 'kurum', $yuklenen
					));

					if($gorsel_yukle){
						// echo $i.'. Görsel Yüklendi <br>';
					}

				} 
			}

		}else{
			hata("İşlem sırasında hata meydana geldi");
		}


	}else{

	}
?>