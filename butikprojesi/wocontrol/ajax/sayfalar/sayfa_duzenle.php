<?php

	if($_POST){

		$id 			= $_POST["id"];
		$baslik 		= $_POST["baslik"];
		$icerik			= $_POST["icerik"];
		$ust_id			= $_POST["ust_id"];
		$menu			= $_POST["menu"];
		$dil_id			= $_POST["dil_id"];
		$siralar		= $_POST["basliklar"];
		$cnt			= count($siralar);


		if($baslik == ""){
			uyari("Başlık Alanını Boş Bırakmayınız");
			exit();
		}



				

		if($_FILES["gorsel"]["tmp_name"] == ""){

			

		}else{

			$gorsel 	= @resim_yukle($_FILES["gorsel"]["tmp_name"],$_FILES["gorsel"]["name"],"../upload/sayfa");

			$query = $wo_db->prepare("UPDATE sayfalar SET
			gorsel = ? WHERE id = ?");

			$insert = $query->execute(array(
			     $gorsel, $id
			));

		}
		


		if($_FILES["gorsel2"]["tmp_name"] == ""){

			

		}else{
			$gorsel2 	= @resim_yukle($_FILES["gorsel2"]["tmp_name"],$_FILES["gorsel2"]["name"],"../upload/sayfa");

			$query = $wo_db->prepare("UPDATE sayfalar SET
			gorsel2 = ? WHERE id = ?");

			$insert = $query->execute(array(
			     $gorsel2, $id
			));

		}


		if($dil_id == 1){
			$query = $wo_db->prepare("UPDATE sayfalar SET
			baslik = ?,
			icerik = ? WHERE id = ?");

			$insert = $query->execute(array(
			     $baslik, $icerik, $id
			));
		}

		$query = $wo_db->prepare("UPDATE sayfalar SET
			ust_id = ?,
			menu = ? WHERE id = ?");

			$insert = $query->execute(array(
			     $ust_id, $menu, $id
			));



			$query = $wo_db->prepare("UPDATE sayfa_icerikler SET
			baslik = ?,
			ust_id = ?,
			icerik = ? WHERE sayfa_id = ? AND dil = ?");

			$insert = $query->execute(array(
			     $baslik, $ust_id, $icerik, $id, $dil_id
			));
		

		

		if($insert){
			
			onay("Değişiklikler başarıyla kaydedildi.","sayfalar&islem=alt_liste&ust_id=$ust_id");


			if(file_exists('../upload/sayfa/'.$id)){

			}else{
				$yol = '../upload/sayfa/'.$id;
				mkdir($yol,'0777');
				@chmod($yol,0777);
			}
			
			$dosya_isim_sayi=count($_FILES['gorseller']['name']); 

			for($i=0;$i<$dosya_isim_sayi;$i++){ 
				
				if(!empty($_FILES['gorseller']['name'][$i])){ 

				// echo $_FILES['dosya']['name'][$i];
				$yoll = "../upload/sayfa/".$id;
				$yuklenen = resim_yukle($_FILES["gorseller"]["tmp_name"][$i],$_FILES["gorseller"]["name"][$i],$yoll);

				$query = $wo_db->prepare("INSERT INTO gorseller SET
					yazi_id = ?,
					kategori = ?,
					gorsel = ?");

					$gorsel_yukle = $query->execute(array(
					     $id, 'sayfa', $yuklenen
					));

					if($gorsel_yukle){
						// echo $i.'. Görsel Yüklendi <br>';
					}

				} 
			}


			foreach($siralar as $id=>$sira){
				@$wo_db->query("UPDATE gorseller SET gbaslik='".$sira."' WHERE id=".$id);
			}

		}else{
			hata("İşlem sırasında hata meydana geldi");
		}


		



	}else{

	}
?>