<?php

	if($_POST){
		$id 		= $_POST["id"];
		$baslik 	= $_POST["baslik"];
		$icerik		= $_POST["icerik"];
		// $yazar 		= $_SESSION["admin_adsoyad"];

		if($baslik == ""){
			uyari("Başlık Alanını Boş Bırakmayınız");
			exit();
		}



		if($_FILES["gorsel"]["tmp_name"] == ""){

			$query = $wo_db->prepare("UPDATE haberler SET
				baslik = ?,
				icerik = ? WHERE id = ?");

				$insert = $query->execute(array(
				     $baslik, $icerik, $id
				));


		}else{

			$gorsel 	= @resim_yukle($_FILES["gorsel"]["tmp_name"],$_FILES["gorsel"]["name"],"../upload/haber");	

			$query = $wo_db->prepare("UPDATE haberler SET
			baslik = ?,
			icerik = ?,
			gorsel = ? WHERE id = ?");

			$insert = $query->execute(array(
			     $baslik, $icerik, $gorsel, $id
			));
		}
		


		


		

		if($insert){
			
			onay("Değişiklikler başarıyla kaydedildi.","haberler");
			
			if(file_exists('../upload/haber/'.$id)){

			}else{
				$yol = '../upload/haber/'.$id;
				mkdir($yol,'0777');
				@chmod($yol,0777);
			}
			


			$dosya_isim_sayi=count($_FILES['gorseller']['name']); 

			for($i=0;$i<$dosya_isim_sayi;$i++){ 
				
				if(!empty($_FILES['gorseller']['name'][$i])){ 

				// echo $_FILES['dosya']['name'][$i];
				$yoll = "../upload/haber/".$id;
				$yuklenen = resim_yukle($_FILES["gorseller"]["tmp_name"][$i],$_FILES["gorseller"]["name"][$i],$yoll);

				$query = $wo_db->prepare("INSERT INTO gorseller SET
					yazi_id = ?,
					kategori = ?,
					gorsel = ?");

					$gorsel_yukle = $query->execute(array(
					     $id, 'haber', $yuklenen
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