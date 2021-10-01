<?php
	
	if(@$_POST){

		$id = $_POST["uye_id"];

		 $kontrol = $wo_db->prepare("SELECT * FROM uyeler WHERE id = :id");
	      $kontrol2 = $kontrol->execute(array(
	           "id" => $id
	      ));

	      $say = $kontrol->rowCount();

	      if($say > 0){

	      	
	          foreach($kontrol as $veri){

	            $ad 		= $veri["ad"];
	            $soyad 		= $veri["soyad"];
	            $email 		= $veri["email"];
	            $telefon 	= $veri["telefon"];
	            $tbb_sicil 	= $veri["tbb_sicil"];
	            $baro_sicil = $veri["baro_sicil"];
	            $baro 		= $veri["baro"];
	            $tarih 		= $veri["tarih"];
	            $aktif	 	= $veri["aktif"];

	          }

	          if($aktif == 0){
	          	$aktif = "Onay Bekliyor";
	          }else{
	          	$aktif = "Aktif";
	          }

	          echo '<p><strong>AD SOYAD : </strong>'.$ad.' '.$soyad.'</p>';
	          echo '<hr>';
	          echo '<p><strong>TELEFON : </strong>'.$telefon.'</p>';
	          echo '<hr>';
	          echo '<p><strong>E-MAİL : </strong>'.$email.'</p>';
	          echo '<hr>';
	          echo '<p><strong>TBB SİCİL : </strong>'.$tbb_sicil.'</p>';
	          echo '<hr>';
	          echo '<p><strong>BARO SİCİL : </strong>'.$baro_sicil.'</p>';
	          echo '<hr>';
	          echo '<p><strong>BARO : </strong>'.$baro.' Barosu</p>';
	          echo '<hr>';
	          echo '<p><strong>ÜYELİK TARİHİ : </strong>'.$tarih.'</p>';
	          echo '<hr>';
	          echo '<p><strong>ÜYELİK DURUMU : </strong>'.$aktif.'</p>';
	          


	      }else{

	      }


	}else{


	}

?>