<?php

	if($_POST){

		$baslik 		= $_POST["baslik"];

		if($baslik == ""){
			uyari("Lütfen Kategori Başlığı Giriniz");
			exit();
		}



		$query = $wo_db->prepare("INSERT INTO galeri_kategori SET
		baslik = ?");

		$insert = $query->execute(array(
		     $baslik
		));

		if($insert){
			

		    $last_id = $wo_db->lastInsertId();

		    onay("Yeni Kategoriniz Başarıyla Eklendi","galeri_kategori");

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