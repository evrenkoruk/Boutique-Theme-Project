<?php

	if(@$_POST){

		$id = $_POST["gorsel_id"];

		$gorsel_kontrol = $wo_db->prepare("SELECT * FROM gorseller WHERE id = :id");
	      $kontrol2 = $gorsel_kontrol->execute(array(
	           "id" => $id
	      ));

	      $say = $gorsel_kontrol->rowCount();

	       if($say > 0){

	       		$query = $wo_db->prepare("DELETE FROM gorseller WHERE id = :id");
				$delete = $query->execute(array(
				   'id' => $id
				));

				if($query){
					echo 'ok';
				}else{

				}


	       }else{

	       		

	       }


	}else{


	}


?>