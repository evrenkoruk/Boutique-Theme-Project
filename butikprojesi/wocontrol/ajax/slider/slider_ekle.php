<?php

	if($_POST){

		$baslik 	= $_POST["baslik"];
		$aciklama 	= $_POST["aciklama"];
		$url		= $_POST["url"];


		if($_FILES["gorsel"]["tmp_name"] == ""){
			
			uyari("Slider eklemek için görsel seçmelisiniz");
			exit();


		}else{
			$gorsel 	= @resim_yukle($_FILES["gorsel"]["tmp_name"],$_FILES["gorsel"]["name"],"../upload/slider");	
		}

		if($baslik == ""){
			uyari("Başlık Alanını Boş Bırakmayınız");
			exit();
		}



		$query = $wo_db->prepare("INSERT INTO slider SET
		baslik = ?,
		aciklama = ?,
		url = ?,
		gorsel = ?");

		$insert = $query->execute(array(
		     $baslik, $aciklama, $url, $gorsel
		));

		if($insert){
			

		    $last_id = $wo_db->lastInsertId();

		    onay("Yeni Slider Görseliniz Başarıyla Yayınlandı","slider");

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