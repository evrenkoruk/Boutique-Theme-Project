<?php

	if($_POST){

		$id 		= $_POST["id"];
		$baslik 	= $_POST["baslik"];
		$tarih 		= $_POST["dtp_input2"];
		$saat 		= $_POST["dtp_input3"];
		$icerik		= $_POST["icerik"];
		$adres		= $_POST["adres"];
		// $yazar 		= $_SESSION["admin_adsoyad"];

		$etkinlik_tarih = $tarih.' '.$saat.':00';


		if($baslik == ""){
			uyari("Başlık Alanını Boş Bırakmayınız");
			exit();
		}



		if($_FILES["gorsel"]["tmp_name"] == ""){

			$query = $wo_db->prepare("UPDATE etkinlikler SET
				adres = ?,
				tarih = ?,
				baslik = ?,
				icerik = ? WHERE id = ?");

				$insert = $query->execute(array(
				     $adres, $etkinlik_tarih, $baslik, $icerik, $id
				));


		}else{

			$gorsel 	= @resim_yukle($_FILES["gorsel"]["tmp_name"],$_FILES["gorsel"]["name"],"../upload/etkinlik");	

			$query = $wo_db->prepare("UPDATE etkinlikler SET
				adres = ?,
				tarih = ?,
				baslik = ?,
				icerik = ?,
				gorsel = ? WHERE id = ?");

				$insert = $query->execute(array(
				     $adres, $etkinlik_tarih, $baslik, $icerik, $gorsel, $id
				));

		}
		


		


		

		if($insert){
			
			onay("Değişiklikler başarıyla kaydedildi.","etkinlikler");


			$dosya_isim_sayi=count($_FILES['gorseller']['name']); 

			for($i=0;$i<$dosya_isim_sayi;$i++){ 
				
				if(!empty($_FILES['gorseller']['name'][$i])){ 

				// echo $_FILES['dosya']['name'][$i];
				$yoll = "../upload/etkinlik/".$id;
				$yuklenen = resim_yukle($_FILES["gorseller"]["tmp_name"][$i],$_FILES["gorseller"]["name"][$i],$yoll);

				$query = $wo_db->prepare("INSERT INTO gorseller SET
					yazi_id = ?,
					kategori = ?,
					gorsel = ?");

					$gorsel_yukle = $query->execute(array(
					     $id, 'etkinlik', $yuklenen
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