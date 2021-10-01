<?php

	if($_POST){

		$id 				= $_POST["id"];;

		$parola1 			= $_POST["parola1"];
		$parola2 			= $_POST["parola2"];


    	$adsoyad    = $_POST["adsoyad"];
        $email      = $_POST["email"];
        $aciklama   = $_POST["aciklama"];
        $twitter    = $_POST["twitter"];
        $facebook   = $_POST["facebook"];
        $instagram  = $_POST["instagram"];



		if($adsoyad == ""){
			uyari("Ad Soyad Alanını Boş Bırakmayınız");
			exit();
		}



		if($_FILES["gorsel"]["tmp_name"] == ""){

			$query = $wo_db->prepare("UPDATE user SET
				adsoyad = ?,
				email = ?,
				aciklama = ?,
				twitter = ?,
				facebook = ?,
				instagram = ? WHERE id = ?");

				$insert = $query->execute(array(
				     $adsoyad, $email, $aciklama, $twitter, $facebook, $instagram, $id
				));


		}else{

			$gorsel 	= @resim_yukle($_FILES["gorsel"]["tmp_name"],$_FILES["gorsel"]["name"],"../upload/duyuru");	

			$query = $wo_db->prepare("UPDATE user SET
			adsoyad = ?,
			email = ?,
			aciklama = ?,
			twitter = ?,
			facebook = ?,
			instagram = ?,
			gorsel = ? WHERE id = ?");

			$insert = $query->execute(array(
			     $adsoyad, $email, $aciklama, $twitter, $facebook, $instagram, $gorsel, $id
			));
		}
		



		if($parola1 != ""){

			if($parola1 == $parola2){

				$parola = md5($parola1);

				$pguncelle = $wo_db->query("update user set parola='$parola' where id='$id'");


			}else{
				hata("Yeni parolanız tekrarıyla eşleşmiyor !");
			}


		}




		

		if($insert){
			
			onay("Değişiklikler başarıyla kaydedildi.","profil");

		}else{
			hata("İşlem sırasında hata meydana geldi");
		}


	}else{

	}
?>