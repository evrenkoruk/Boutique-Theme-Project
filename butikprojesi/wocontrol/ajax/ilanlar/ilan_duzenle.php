<?php

	if($_POST){

		$id 		= $_POST["id"];
		$ilantip 	= $_POST["ilan_tip"];
        $baslik 	= $_POST["baslik"];
        $adsoyad 	= $_POST["adsoyad"];
        $telefon 	= $_POST["telefon"];
        $email 		= $_POST["email"];
        $icerik 	= nl2br($_POST["icerik"]);
        $tarih 		= $_POST["tarih"];
        $yayin 		= $_POST["yayin"];


		if($baslik == "" || $adsoyad == "" || $email == ""){
			uyari("Başlık, AdSoyad ve Email alanlarını Boş Bırakmayınız");
			exit();
		}


		$query = $wo_db->prepare("UPDATE ilanlar SET
				ilan_tip = ?,
				baslik = ?,
				adsoyad = ?,
				telefon = ?,
				email = ?,
				icerik = ? WHERE id = ?");

				$insert = $query->execute(array(
				     $ilantip, $baslik, $adsoyad, $telefon, $email, $icerik, $id
				));


		if($insert){

			onay("Değişiklikler başarıyla kaydedildi.","ilanlar");

		}else{
			hata("İşlem sırasında hata meydana geldi");
		}


	}else{

	}
?>