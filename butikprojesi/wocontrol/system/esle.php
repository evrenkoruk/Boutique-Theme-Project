<meta charset="utf-8">
<?php
include 'config.php';



 // $haberler = $db->query("SELECT * FROM duyuru order by id DESC");
	// foreach ($haberler as $haber) {

	// 	$baslik = $haber["baslik"];
	// 	$icerik = $haber["icerik"];
	// 	$tarih = $haber["tarih"];
	// 	$hit = $haber["okunma"];

	// 	$tparcala = explode(".", $tarih);
	// 	$ntarih = $tparcala[2].'-'.$tparcala[1].'-'.$tparcala[0].' 00:00:00';



	// 	$query = $db->prepare("INSERT INTO duyurular SET
	// 	kategori_id=?,
	// 	baslik = ?,
	// 	icerik = ?,
	// 	tarih = ?,
	// 	yazar = ?,
	// 	hit = ?");

	// 	$insert = $query->execute(array(
	// 	     "1",$baslik, $icerik, $ntarih, "Enes Doğru",$hit
	// 	));


	// 	if($insert){
	// 		echo $baslik.'- EKLENDİ<br>';
	// 	}

	// }





 // $haberler = $db->query("SELECT * FROM haber order by id DESC");
	// foreach ($haberler as $haber) {

	// 	$baslik = $haber["baslik"];
	// 	$icerik = $haber["icerik"];
	// 	$tarih = $haber["tarih"];
	// 	$hit = $haber["okunma"];

	// 	$tparcala = explode(".", $tarih);
	// 	$ntarih = $tparcala[2].'-'.$tparcala[1].'-'.$tparcala[0].' 00:00:00';



	// 	$query = $db->prepare("INSERT INTO haberler SET
	// 	baslik = ?,
	// 	icerik = ?,
	// 	tarih = ?,
	// 	yazar = ?,
	// 	hit = ?");

	// 	$insert = $query->execute(array(
	// 	     $baslik, $icerik, $ntarih, "Enes Doğru",$hit
	// 	));


	// 	if($insert){
	// 		echo $baslik.'- EKLENDİ<br>';
	// 	}

	// }


 $haberler = $wo_db->query("SELECT * FROM yonetimkurulu order by id DESC");
	foreach ($haberler as $haber) {

		$baslik = $haber["baslik"];
		$icerik = $haber["icerik"];
		$tarih = $haber["tarih"];
		$hit = $haber["okunma"];

		$tparcala = explode(".", $tarih);
		$ntarih = $tparcala[2].'-'.$tparcala[1].'-'.$tparcala[0].' 00:00:00';



		$query = $wo_db->prepare("INSERT INTO duyurular SET
		kategori_id=?,
		baslik = ?,
		icerik = ?,
		tarih = ?,
		yazar = ?,
		hit = ?");

		$insert = $query->execute(array(
		     "3",$baslik, $icerik, $ntarih, "Enes Doğru",$hit
		));


		if($insert){
			echo $baslik.'- EKLENDİ<br>';
		}

	}







?>

    
 
