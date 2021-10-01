<?php

	if($_POST){

		$baslik 	= $_POST["baslik"];
		$icerik		= $_POST["icerik"];
		$yazar 		= $_SESSION["admin_adsoyad"];

		if($_FILES["gorsel"]["tmp_name"] == ""){
			$gorsel = "";
		}else{
			$gorsel 	= @resim_yukle($_FILES["gorsel"]["tmp_name"],$_FILES["gorsel"]["name"],"../upload/kurum");	
		}
		


		if($baslik == ""){
			uyari("Kurum Adını Boş Bırakmayınız");
			exit();
		}



		$query = $wo_db->prepare("INSERT INTO anlasmali_kurumlar SET
		baslik = ?,
		icerik = ?,
		gorsel = ?,
		yazar  = ?");

		$insert = $query->execute(array(
		     $baslik, $icerik, $gorsel, $yazar
		));

		if($insert){
			

		    $last_id = $wo_db->lastInsertId();

		    onay("Anlaşmalı Kurum Başarıyla Yayınlandı","anlasmali_kurumlar");

		    $yol = '../upload/kurum/'.$last_id;
			mkdir($yol,'0777');
			@chmod($yol,0777);

			$dosya_isim_sayi=count($_FILES['gorseller']['name']); 

			for($i=0;$i<$dosya_isim_sayi;$i++){ 
				
				if(!empty($_FILES['gorseller']['name'][$i])){ 

				// echo $_FILES['dosya']['name'][$i];
				$yoll = "../upload/kurum/".$last_id;
				$yuklenen = resim_yukle($_FILES["gorseller"]["tmp_name"][$i],$_FILES["gorseller"]["name"][$i],$yoll);

				$query = $wo_db->prepare("INSERT INTO gorseller SET
					yazi_id = ?,
					kategori = ?,
					gorsel = ?");

					$gorsel_yukle = $query->execute(array(
					     $last_id, 'kurum', $yuklenen
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