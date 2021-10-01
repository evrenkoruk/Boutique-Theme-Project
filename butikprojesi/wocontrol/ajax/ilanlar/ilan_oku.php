<?php
	
	if(@$_POST){

		$id = $_POST["ilan_id"];

		 $kontrol = $wo_db->prepare("SELECT * FROM ilanlar WHERE id = :id");
	      $kontrol2 = $kontrol->execute(array(
	           "id" => $id
	      ));

	      $say = $kontrol->rowCount();

	      if($say > 0){
	          
	          foreach($kontrol as $veri){

	            $baslik 	= $veri["baslik"];
	            $icerik 	= $veri["icerik"];
	            $adsoyad 	= $veri["adsoyad"];
	            $telefon 	= $veri["telefon"];
	            $email 		= $veri["email"];
	            $konuk 		= $veri["konuk"];

	            $rtarih 		= $veri["rtarih"];
	            $rsaat	 		= $veri["rsaat"];

	          }

	          echo $icerik;
	          echo '<hr>';
	          echo '<p><strong>AD SOYAD : </strong>'.$adsoyad.'</p>';
	          echo '<hr>';
	          echo '<p><strong>TELEFON : </strong>'.$telefon.'</p>';
	          echo '<hr>';
	          echo '<p><strong>E-MAİL : </strong>'.$email.'</p>';
	          echo '<hr>';
	          echo '<p><strong>KONUK SAYISI : </strong>'.$konuk.'</p>';
	          echo '<hr>';
	          echo '<p><strong>REZERVASYON TARİHİ : </strong>'.$rtarih.' - '.$rsaat.'</p>';
	          


	      }else{

	      }


	}else{


	}

?>