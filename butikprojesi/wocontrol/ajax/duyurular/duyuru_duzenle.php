<?php

	if($_POST){

		$kategori_id 	= $_POST["kategori_id"];
		$id 			= $_POST["id"];
		$baslik 		= $_POST["baslik"];
		$icerik			= $_POST["icerik"];
		// $yazar 		= $_SESSION["admin_adsoyad"];

		$seo_title        = $_POST["seo_title"];
        $seo_keywords     = $_POST["seo_keywords"];
        $seo_description  = $_POST["seo_description"];

        $seo = wo_seo($baslik);

        if($_SESSION["yetki"] == 1){
        	$durum = 1;
        }else{
        	$durum = 0;
        }

		if($baslik == ""){
			uyari("Başlık Alanını Boş Bırakmayınız");
			exit();
		}



		if($_FILES["gorsel"]["tmp_name"] == ""){

			$query = $wo_db->prepare("UPDATE duyurular SET
				dil = ?,
				baslik = ?,
				icerik = ?,
				seo = ?,
				seo_title = ?,
				seo_keywords = ?,
				seo_description = ?,
				durum = ? WHERE id = ?");

				$insert = $query->execute(array(
				     $kategori_id, $baslik, $icerik, $seo, $seo_title, $seo_keywords, $seo_description, $durum, $id
				));


		}else{

			$gorsel 	= @resim_yukle($_FILES["gorsel"]["tmp_name"],$_FILES["gorsel"]["name"],"../upload/duyuru");	

			$query = $wo_db->prepare("UPDATE duyurular SET
			dil = ?,
			baslik = ?,
			icerik = ?,
			seo = ?,
			seo_title = ?,
			seo_keywords = ?,
			seo_description = ?,
			gorsel = ?,
			durum = ? WHERE id = ?");

			$insert = $query->execute(array(
			     $kategori_id, $baslik, $icerik, $seo, $seo_title, $seo_keywords, $seo_description, $gorsel, $durum, $id
			));
		}
		


		


		

		if($insert){
			
			if($_SESSION["admin_id"] == 1){
		    	onay("Değişiklikler başarıyla kaydedildi.","duyurular");
		    }else{
		    	onay("Değişiklikler yönetici onayından sonra yayınlanacaktır.","duyurular");
		    }

			if(file_exists('../upload/duyuru/'.$id)){

			}else{
				$yol = '../upload/duyuru/'.$id;
				mkdir($yol,'0777');
				@chmod($yol,0777);
			}

			$dosya_isim_sayi=count($_FILES['gorseller']['name']); 

			for($i=0;$i<$dosya_isim_sayi;$i++){ 
				
				if(!empty($_FILES['gorseller']['name'][$i])){ 

				// echo $_FILES['dosya']['name'][$i];
				$yoll = "../upload/duyuru/".$id;
				$yuklenen = resim_yukle($_FILES["gorseller"]["tmp_name"][$i],$_FILES["gorseller"]["name"][$i],$yoll);

				$query = $wo_db->prepare("INSERT INTO gorseller SET
					yazi_id = ?,
					kategori = ?,
					gorsel = ?");

					$gorsel_yukle = $query->execute(array(
					     $id, 'duyuru', $yuklenen
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