<?php

	if($_POST){

		$baslik 		= $_POST["baslik"];
		$icerik			= $_POST["icerik"];
		$ust_id			= $_POST["ust_id"];
		$menu			= $_POST["menu"];


		if($_FILES["gorsel"]["tmp_name"] == ""){
			$gorsel = "";
		}else{
			$gorsel 	= @resim_yukle($_FILES["gorsel"]["tmp_name"],$_FILES["gorsel"]["name"],"../upload/sayfa");	
		}

		if($_FILES["gorsel2"]["tmp_name"] == ""){
			$gorsel2 	= "";
		}else{
			$gorsel2 	= @resim_yukle($_FILES["gorsel2"]["tmp_name"],$_FILES["gorsel2"]["name"],"../upload/sayfa");	
		}
		
		

		if($baslik == ""){
			uyari("Başlık Alanını Boş Bırakmayınız");
			exit();
		}



		$query = $wo_db->prepare("INSERT INTO sayfalar SET
		baslik = ?,
		icerik = ?,
		ust_id = ?");

		$insert = $query->execute(array(
		     $baslik, $icerik, $ust_id
		));

		if($insert){
			

		    $last_id = $wo_db->lastInsertId();


		    $query = $wo_db->prepare("UPDATE sayfalar SET
				gorsel = ?,
				gorsel2 = ? WHERE id = ?");

				$insert = $query->execute(array(
				     $gorsel, $gorsel2, $last_id
				));


			$diller = $wo_db->query("select * from diller");
			foreach ($diller as $dil) {
				$dil_id = $dil["id"];

				$query = $wo_db->prepare("INSERT INTO sayfa_icerikler SET
				baslik = ?,
				icerik = ?,
				sayfa_id = ?,
				ust_id = ?,
				dil = ?");

				$insert = $query->execute(array(
				     $baslik, $icerik, $last_id, $ust_id, $dil_id
				));

			}



		    onay("Sayfanız Başarıyla Oluşturuldu","sayfalar&islem=alt_liste&ust_id=$ust_id");

		    $yol = '../upload/sayfa/'.$last_id;
			@mkdir($yol,'0777');
			@chmod($yol,0777);

			$dosya_isim_sayi=count($_FILES['gorseller']['name']); 

			for($i=0;$i<$dosya_isim_sayi;$i++){ 
				
				if(!empty($_FILES['gorseller']['name'][$i])){ 

				// echo $_FILES['dosya']['name'][$i];
				$yoll = "../upload/sayfa/".$last_id;
				$yuklenen = resim_yukle($_FILES["gorseller"]["tmp_name"][$i],$_FILES["gorseller"]["name"][$i],$yoll);

				$query = $wo_db->prepare("INSERT INTO gorseller SET
					yazi_id = ?,
					kategori = ?,
					gorsel = ?");

					$gorsel_yukle = $query->execute(array(
					     $last_id, 'sayfa', $yuklenen
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