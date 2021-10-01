<?php

	if($_POST){

		$baslik 	= $_POST["baslik"];
		$tarih 		= $_POST["dtp_input2"];
		$saat 		= $_POST["dtp_input3"];
		$icerik		= $_POST["icerik"];
		$adres		= $_POST["adres"];
		$yazar 		= $_SESSION["admin_adsoyad"];

		$etkinlik_tarih = $tarih.' '.$saat.':00';


		if($_FILES["gorsel"]["tmp_name"] == ""){
			$gorsel = "";
		}else{
			$gorsel 	= @resim_yukle($_FILES["gorsel"]["tmp_name"],$_FILES["gorsel"]["name"],"../upload/etkinlik");	
		}

		if($baslik == ""){
			uyari("Başlık Alanını Boş Bırakmayınız");
			exit();
		}



		$query = $wo_db->prepare("INSERT INTO etkinlikler SET
		adres = ?,
		tarih = ?,
		baslik = ?,
		icerik = ?,
		gorsel = ?,
		yazar  = ?");

		$insert = $query->execute(array(
		     $adres, $etkinlik_tarih, $baslik, $icerik, $gorsel, $yazar
		));

		if($insert){
			

		    $last_id = $wo_db->lastInsertId();

		    onay("Etkinliğiniz Başarıyla Yayınlandı","etkinlikler");

		 //    $yol = '../upload/etkinlik/'.$last_id;
			// mkdir($yol,'0777');
			// @chmod($yol,0777);

			// $dosya_isim_sayi=count($_FILES['gorseller']['name']); 

			// for($i=0;$i<$dosya_isim_sayi;$i++){ 
				
			// 	if(!empty($_FILES['gorseller']['name'][$i])){ 

			// 	// echo $_FILES['dosya']['name'][$i];
			// 	$yoll = "../upload/etkinlik/".$last_id;
			// 	$yuklenen = resim_yukle($_FILES["gorseller"]["tmp_name"][$i],$_FILES["gorseller"]["name"][$i],$yoll);

			// 	$query = $wo_db->prepare("INSERT INTO gorseller SET
			// 		yazi_id = ?,
			// 		kategori = ?,
			// 		gorsel = ?");

			// 		$gorsel_yukle = $query->execute(array(
			// 		     $last_id, 'etkinlik', $yuklenen
			// 		));

			// 		if($gorsel_yukle){
			// 			// echo $i.'. Görsel Yüklendi <br>';
			// 		}

			// 	} 
			// }

		}else{
			hata("İşlem sırasında hata meydana geldi");
		}


	}else{

	}
?>