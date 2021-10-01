<?php

	if(@$_POST){


		$id = $_POST["id"];
		$veri = $_POST["veri"];


		

		if($veri == "haber"){ // HABER SİL
			

			$veri_kontrol = $wo_db->prepare("SELECT * FROM haberler WHERE id = :id");
		    $kontrol2 = $veri_kontrol->execute(array(
		        "id" => $id
		     ));

	      	$say = $veri_kontrol->rowCount();

	       if($say > 0){

	       		$query = $wo_db->prepare("DELETE FROM haberler WHERE id = :id");
				$delete = $query->execute(array(
				   'id' => $id
				));

				if($query){
					echo 'ok';
				}else{

				}
	        } // SAY KONTROL




		}else if($veri == "duyuru"){ // DUYURU SİL


			$veri_kontrol = $wo_db->prepare("SELECT * FROM duyurular WHERE id = :id");
		    $kontrol2 = $veri_kontrol->execute(array(
		        "id" => $id
		     ));

	      	$say = $veri_kontrol->rowCount();

	       if($say > 0){

	       		$query = $wo_db->prepare("DELETE FROM duyurular WHERE id = :id");
				$delete = $query->execute(array(
				   'id' => $id
				));

				if($query){
					echo 'ok';
				}else{

				}
	        } // SAY KONTROL







		}else if($veri == "urun"){ // ÜRÜN SİL


			$veri_kontrol = $wo_db->prepare("SELECT * FROM urunler WHERE id = :id");
		    $kontrol2 = $veri_kontrol->execute(array(
		        "id" => $id
		     ));

	      	$say = $veri_kontrol->rowCount();

	       if($say > 0){

	       		$query = $wo_db->prepare("DELETE FROM urunler WHERE id = :id");
				$delete = $query->execute(array(
				   'id' => $id
				));

				if($query){
					echo 'ok';
				}else{

				}
	        } // SAY KONTROL







		}else if($veri == "etkinlik"){ // ETKİNLİK SİL



			$veri_kontrol = $wo_db->prepare("SELECT * FROM etkinlikler WHERE id = :id");
		    $kontrol2 = $veri_kontrol->execute(array(
		        "id" => $id
		     ));

	      	$say = $veri_kontrol->rowCount();

	       if($say > 0){

	       		$query = $wo_db->prepare("DELETE FROM etkinlikler WHERE id = :id");
				$delete = $query->execute(array(
				   'id' => $id
				));

				if($query){
					echo 'ok';
				}else{

				}
	        } // SAY KONTROL




		}else if($veri == "slider"){ // SLİDER SİL



			$veri_kontrol = $wo_db->prepare("SELECT * FROM slider WHERE id = :id");
		    $kontrol2 = $veri_kontrol->execute(array(
		        "id" => $id
		     ));

	      	$say = $veri_kontrol->rowCount();

	       if($say > 0){

	       		$query = $wo_db->prepare("DELETE FROM slider WHERE id = :id");
				$delete = $query->execute(array(
				   'id' => $id
				));

				if($query){
					echo 'ok';
				}else{

				}
	        } // SAY KONTROL




		}else if($veri == "anlasmali_kurumlar"){ // ANLAŞMALI KURUM SİL



			$veri_kontrol = $wo_db->prepare("SELECT * FROM anlasmali_kurumlar WHERE id = :id");
		    $kontrol2 = $veri_kontrol->execute(array(
		        "id" => $id
		     ));

	      	$say = $veri_kontrol->rowCount();

	       if($say > 0){

	       		$query = $wo_db->prepare("DELETE FROM anlasmali_kurumlar WHERE id = :id");
				$delete = $query->execute(array(
				   'id' => $id
				));

				if($query){
					echo 'ok';
				}else{

				}
	        } // SAY KONTROL




		}else if($veri == "sorular"){ // sorular SİL



			$veri_kontrol = $wo_db->prepare("SELECT * FROM sorular WHERE id = :id");
		    $kontrol2 = $veri_kontrol->execute(array(
		        "id" => $id
		     ));

	      	$say = $veri_kontrol->rowCount();

	       if($say > 0){

	       		$query = $wo_db->prepare("DELETE FROM sorular WHERE id = :id");
				$delete = $query->execute(array(
				   'id' => $id
				));

				if($query){
					echo 'ok';
				}else{

				}
	        } // SAY KONTROL




		}else if($veri == "ilanlar"){ // İLAN SİL



			$veri_kontrol = $wo_db->prepare("SELECT * FROM ilanlar WHERE id = :id");
		    $kontrol2 = $veri_kontrol->execute(array(
		        "id" => $id
		     ));

	      	$say = $veri_kontrol->rowCount();

	       if($say > 0){

	       		$query = $wo_db->prepare("DELETE FROM ilanlar WHERE id = :id");
				$delete = $query->execute(array(
				   'id' => $id
				));

				if($query){
					echo 'ok';
				}else{

				}
	        } // SAY KONTROL




		}else if($veri == "mesajlar"){ // MESAJ SİL



			$veri_kontrol = $wo_db->prepare("SELECT * FROM mesajlar WHERE id = :id");
		    $kontrol2 = $veri_kontrol->execute(array(
		        "id" => $id
		     ));

	      	$say = $veri_kontrol->rowCount();

	       if($say > 0){

	       		$query = $wo_db->prepare("DELETE FROM mesajlar WHERE id = :id");
				$delete = $query->execute(array(
				   'id' => $id
				));

				if($query){
					echo 'ok';
				}else{

				}
	        } // SAY KONTROL




		}else if($veri == "sayfa"){ // SAYFA SİL



			$veri_kontrol = $wo_db->prepare("SELECT * FROM sayfalar WHERE id = :id");
		    $kontrol2 = $veri_kontrol->execute(array(
		        "id" => $id
		     ));

	      	$say = $veri_kontrol->rowCount();

	       if($say > 0){

	       		$query = $wo_db->prepare("DELETE FROM sayfalar WHERE id = :id");
				$delete = $query->execute(array(
				   'id' => $id
				));

				if($query){
					echo 'ok';
				}else{

				}
	        } // SAY KONTROL




		}else if($veri == "linkler"){ // LİNK SİL



			$veri_kontrol = $wo_db->prepare("SELECT * FROM linkler WHERE id = :id");
		    $kontrol2 = $veri_kontrol->execute(array(
		        "id" => $id
		     ));

	      	$say = $veri_kontrol->rowCount();

	       if($say > 0){

	       		$query = $wo_db->prepare("DELETE FROM linkler WHERE id = :id");
				$delete = $query->execute(array(
				   'id' => $id
				));

				if($query){
					echo 'ok';
				}else{

				}
	        } // SAY KONTROL




		}else if($veri == "basin"){ // BASIN SİL



			$veri_kontrol = $wo_db->prepare("SELECT * FROM basin WHERE id = :id");
		    $kontrol2 = $veri_kontrol->execute(array(
		        "id" => $id
		     ));

	      	$say = $veri_kontrol->rowCount();

	       if($say > 0){

	       		$query = $wo_db->prepare("DELETE FROM basin WHERE id = :id");
				$delete = $query->execute(array(
				   'id' => $id
				));

				if($query){
					echo 'ok';
				}else{

				}
	        } // SAY KONTROL




		}else if($veri == "uyeler"){ // ÜYE SİL



			$veri_kontrol = $wo_db->prepare("SELECT * FROM uyeler WHERE id = :id");
		    $kontrol2 = $veri_kontrol->execute(array(
		        "id" => $id
		     ));

	      	$say = $veri_kontrol->rowCount();

	       if($say > 0){

	       		$query = $wo_db->prepare("DELETE FROM uyeler WHERE id = :id");
				$delete = $query->execute(array(
				   'id' => $id
				));

				if($query){
					echo 'ok';
				}else{

				}
	        } // SAY KONTROL




		}else if($veri == "kategori"){ // ÜYE SİL



			$veri_kontrol = $wo_db->prepare("SELECT * FROM duyuru_kategori WHERE id = :id");
		    $kontrol2 = $veri_kontrol->execute(array(
		        "id" => $id
		     ));

	      	$say = $veri_kontrol->rowCount();

	       if($say > 0){

	       		$query = $wo_db->prepare("DELETE FROM duyuru_kategori WHERE id = :id");
				$delete = $query->execute(array(
				   'id' => $id
				));

				if($query){
					echo 'ok';
				}else{

				}
	        } // SAY KONTROL




		}else if($veri == "urunler_kategori"){ // ÜYE SİL



			$veri_kontrol = $wo_db->prepare("SELECT * FROM urunler_kategori WHERE id = :id");
		    $kontrol2 = $veri_kontrol->execute(array(
		        "id" => $id
		     ));

	      	$say = $veri_kontrol->rowCount();

	       if($say > 0){

	       		$query = $wo_db->prepare("DELETE FROM urunler_kategori WHERE id = :id");
				$delete = $query->execute(array(
				   'id' => $id
				));

				if($query){
					echo 'ok';
				}else{

				}
	        } // SAY KONTROL




		}else if($veri == "galeri_kategori"){ // ÜYE SİL



			$veri_kontrol = $wo_db->prepare("SELECT * FROM galeri_kategori WHERE id = :id");
		    $kontrol2 = $veri_kontrol->execute(array(
		        "id" => $id
		     ));

	      	$say = $veri_kontrol->rowCount();

	       if($say > 0){

	       		$query = $wo_db->prepare("DELETE FROM galeri_kategori WHERE id = :id");
				$delete = $query->execute(array(
				   'id' => $id
				));

				if($query){
					echo 'ok';
				}else{

				}
	        } // SAY KONTROL




		}else{


			



		}




		


	



	} // POST




?>