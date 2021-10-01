<?php

	if($_POST){

		$kategori_id 	= $_POST["kategori_id"];
		$baslik 		= $_POST["baslik"];
		$icerik			= $_POST["icerik"];

		$yazar 			= $_SESSION["admin_adsoyad"];
		$yazar_id		= $_SESSION["admin_id"];

        $seo_title        = $_POST["seo_title"];
        $seo_keywords     = $_POST["seo_keywords"];
        $seo_description  = $_POST["seo_description"];

        $seo = wo_seo($baslik);


         if($_SESSION["yetki"] == 1){
        	$durum = 1;
        }else{
        	$durum = 0;
        }


		if($_FILES["gorsel"]["tmp_name"] == ""){
			$gorsel = "";
		}else{
			$gorsel 	= @resim_yukle($_FILES["gorsel"]["tmp_name"],$_FILES["gorsel"]["name"],"../upload/duyuru");	
		}
		


		if($baslik == ""){
			uyari("Başlık Alanını Boş Bırakmayınız");
			exit();
		}



		$query = $wo_db->prepare("INSERT INTO duyurular SET
		dil = ?,
		baslik = ?,
		icerik = ?,
		gorsel = ?,
		yazar  = ?,
		yazar_id = ?,
		seo = ?,
		seo_title = ?,
		seo_keywords = ?,
		seo_description = ?,
		durum = ?");

		$insert = $query->execute(array(
		     $kategori_id, $baslik, $icerik, $gorsel, $yazar, $yazar_id, $seo, $seo_title, $seo_keywords, $seo_description, $durum
		));

		if($insert){
			

		    $last_id = $wo_db->lastInsertId();

		    if($yazar_id == 1){
		    	onay("Yazı Başarıyla Yayınlandı","duyurular");
		    }else{
		    	onay("Yazınız yönetici onayından sonra yayınlanacaktır.","duyurular");
		    }

		    

		    $yol = '../upload/duyuru/'.$last_id;
			mkdir($yol,'0777');
			@chmod($yol,0777);

			$dosya_isim_sayi=count($_FILES['gorseller']['name']); 

			for($i=0;$i<$dosya_isim_sayi;$i++){ 
				
				if(!empty($_FILES['gorseller']['name'][$i])){ 

				// echo $_FILES['dosya']['name'][$i];
				$yoll = "../upload/duyuru/".$last_id;
				$yuklenen = resim_yukle($_FILES["gorseller"]["tmp_name"][$i],$_FILES["gorseller"]["name"][$i],$yoll);

				$query = $wo_db->prepare("INSERT INTO gorseller SET
					yazi_id = ?,
					kategori = ?,
					gorsel = ?");

					$gorsel_yukle = $query->execute(array(
					     $last_id, 'duyuru', $yuklenen
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