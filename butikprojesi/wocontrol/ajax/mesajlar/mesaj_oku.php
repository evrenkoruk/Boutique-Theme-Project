<?php
	
	if(@$_POST){

		$id = $_POST["mesaj_id"];

		 $kontrol = $wo_db->prepare("SELECT * FROM mesajlar WHERE id = :id");
	      $kontrol2 = $kontrol->execute(array(
	           "id" => $id
	      ));

	      $say = $kontrol->rowCount();

	      if($say > 0){

	      	
	          foreach($kontrol as $veri){

	            $icerik 	= $veri["icerik"];
	            $adsoyad 	= $veri["adsoyad"];
	            $telefon 	= $veri["telefon"];
	            $email 		= $veri["email"];
	            $okundu 	= $veri["okundu"];
	          }

	          if($okundu == 0){
	          	
	          	$query = $wo_db->prepare("UPDATE mesajlar SET
				okundu = ? WHERE id = ?");

				$upd = $query->execute(array(
				     "1", $id
				));
	          
	          }else{

	          }

	          echo $icerik;
	          echo '<hr>';
	          echo '<p><strong>AD SOYAD : </strong>'.$adsoyad.'</p>';
	          echo '<hr>';
	          echo '<p><strong>TELEFON : </strong>'.$telefon.'</p>';
	          echo '<hr>';
	          echo '<p><strong>E-MAİL : </strong>'.$email.'</p>';
	          


	      }else{

	      }


	}else{


	}

?>