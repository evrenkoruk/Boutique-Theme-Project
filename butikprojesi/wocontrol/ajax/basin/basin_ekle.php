<?php

	if($_POST){

		$baslik 	= $_POST["baslik"];
		$tarih		= $_POST["dtp_input2"];

		$tarih = $tarih.' 00:00:00';

		if($_FILES["gorsel"]["tmp_name"] == ""){
			
			uyari("Basın haberi eklemek için görsel seçmelisiniz");
			exit();


		}else{
			$gorsel 	= @resim_yukle($_FILES["gorsel"]["tmp_name"],$_FILES["gorsel"]["name"],"../upload/basin");	
		}

		if($baslik == ""){
			uyari("Başlık Alanını Boş Bırakmayınız");
			exit();
		}



		$query = $wo_db->prepare("INSERT INTO basin SET
		baslik = ?,
		gorsel = ?,
		tarih= ?");

		$insert = $query->execute(array(
		     $baslik, $gorsel, $tarih
		));

		if($insert){
			

		    $last_id = $wo_db->lastInsertId();

		    onay("Yeni Basın Görseliniz Başarıyla Yayınlandı","basin");


		}else{
			hata("İşlem sırasında hata meydana geldi");
		}


	}else{

	}
?>