<?php

	function onay($gelen,$url){

		echo '<div class="alert alert-success">'.$gelen.'</div>';

		if($url == ""){

		}else{
			?>
				<div class="modal-footer">
		          <button type="button" class="btn aqua" onclick="window.location ='admin.php?p=<?=$url;?>';">TAMAM</button>
		        </div>
			<?
		}


	}

	function uyari($gelen){

		echo '<div class="alert alert-warning"> <strong>Uyarı !</strong> '.$gelen.'</div>';
		echo '
		<div class="modal-footer">
          <button type="button" class="btn aqua" data-dismiss="modal">TAMAM</button>
        </div> 
		';
	}

	function hata($gelen){

		echo '<div class="alert alert-danger"> <strong>Hata !</strong> '.$gelen.'</div>';
		echo '
		<div class="modal-footer">
          <button type="button" class="btn aqua" data-dismiss="modal">TAMAM</button>
        </div> 
		';
		
	}

	
	function guncel_tarih(){

		date_default_timezone_set('Europe/Istanbul');
		echo date('d.m.Y H:i:s');
	}


	function wo_tarih($gelen){

		$gelen_parcala = explode(' ', $gelen);

		$tarih = $gelen_parcala[0];
		$saat  = $gelen_parcala[1];

		$tarih_parcala = explode('-', $tarih);

		$w_yil 	= $tarih_parcala[0];
		$w_ay 	= $tarih_parcala[1];
		$w_gun 	= $tarih_parcala[2];

		$saat_parcala = explode(':', $saat);

		$w_saat 	= $saat_parcala[0];
		$w_dakika 	= $saat_parcala[1];
		$w_saniye 	= $saat_parcala[2];

		// $wo_giden = $w_gun.'.'.$w_ay.'.'.$w_yil.' '.$w_saat.':'.$w_dakika;
		$wo_giden = $w_gun.'.'.$w_ay.'.'.$w_yil;

		return $wo_giden;

	}



	// Kısalt

	function icerik_kisalt($metin,$kisalt){

		$yazi = mb_substr(strip_tags($metin),0,$kisalt,'UTF-8');
		$metinsay = strlen(strip_tags($metin));
		
		if($metinsay < $kisalt){
			$bas = $yazi;
		}else{
			$bas = $yazi.'...';
		}
		
		return $bas;

	}

	


	function resim_yukle($kaynak,$resim_adi,$hedef_yer){

		$kaynak		= $kaynak; // Yüklenen dosyanın adı
		$klasor		= $hedef_yer."/"; // Hedef klasörümüz
		$resim_uz	= strtolower(strrchr($resim_adi,'.'));
		$resim_name = strtolower(substr(md5(uniqid(rand())), 0,10)).$resim_uz;
		
		
		if($resim_uz == ".jpg" || $resim_uz == ".jpeg" || $resim_uz == ".png" || $resim_uz == ".gif"){ // UZANTI bunlardan birise
		
			$yukle		= $klasor.basename($resim_name); // Resimi yol ve adı ile birlikte topluyoruz.
			
			if(@move_uploaded_file($kaynak,$yukle) ){
				$dosya		= $klasor.$resim_name;
				return $dosya;
			}


		} 
	}






	function gorsel_kontrol($gelen){
		
		if($gelen == ""){
			$gorsel = "assets/gorsel_yok.png";
		}else{
			$gorsel = $gelen;
		}

		return $gorsel;
	}



	function duyuru_kat($id){

		global $wo_db;

   		$duyuru_kat = $wo_db->prepare("SELECT * FROM duyuru_kategori WHERE id = :id");
       	$duyuruKontrol = $duyuru_kat->execute(array(
             "id" => $id
        ));

        $say = $duyuru_kat->rowCount();

        if($say > 0){

            foreach ($duyuru_kat as $duyuru) {
              $kategori_ad = $duyuru["kategori_ad"];
            }

        }else{
          $kategori_ad = "error";
        }

        return $kategori_ad;

	}


	function urun_kat($id){

		global $wo_db;

   		$duyuru_kat = $wo_db->prepare("SELECT * FROM urunler_kategori WHERE id = :id");
       	$duyuruKontrol = $duyuru_kat->execute(array(
             "id" => $id
        ));

        $say = $duyuru_kat->rowCount();

        if($say > 0){

            foreach ($duyuru_kat as $duyuru) {
              $kategori_ad = $duyuru["kategori_ad"];
            }

        }else{
          $kategori_ad = "error";
        }

        return $kategori_ad;

	}


	function dil_ad($id){

		global $wo_db;

   		$duyuru_kat = $wo_db->prepare("SELECT * FROM diller WHERE id = :id");
       	$duyuruKontrol = $duyuru_kat->execute(array(
             "id" => $id
        ));

        $say = $duyuru_kat->rowCount();

        if($say > 0){

            foreach ($duyuru_kat as $duyuru) {
              $kategori_ad = $duyuru["baslik"];
            }

        }else{
          $kategori_ad = "error";
        }

        return $kategori_ad;

	}


	function ilan_tip($id){

		global $wo_db;

   		$ilanlar_tip = $wo_db->prepare("SELECT * FROM ilanlar_tip WHERE id = :id");
       	$ilankontrol = $ilanlar_tip->execute(array(
             "id" => $id
        ));

        $say = $ilanlar_tip->rowCount();

        if($say > 0){

            foreach ($ilanlar_tip as $ilan) {
              $ilan_tip = $ilan["ilan_tip"];
            }

        }else{
          $ilan_tip = "error";
        }

        return $ilan_tip;

	}


	function sayfa_ad($id){

		global $wo_db;

		if($id == 0){

			$sayfa_ad = "-";

		}else{

			$ilanlar_tip = $wo_db->prepare("SELECT * FROM sayfalar WHERE id = :id");
	       	$ilankontrol = $ilanlar_tip->execute(array(
	             "id" => $id
	        ));

	        $say = $ilanlar_tip->rowCount();

	        if($say > 0){

	            foreach ($ilanlar_tip as $ilan) {
	              $sayfa_ad = $ilan["baslik"];
	            }

	        }else{
	          $sayfa_ad = "error";
	        }


		}

   		

        return $sayfa_ad;

	}



	function kategori_ad($id){

		global $wo_db;

		if($id == 0){

			$sayfa_ad = "-";

		}else{

			$ilanlar_tip = $wo_db->prepare("SELECT * FROM galeri_kategori WHERE id = :id");
	       	$ilankontrol = $ilanlar_tip->execute(array(
	             "id" => $id
	        ));

	        $say = $ilanlar_tip->rowCount();

	        if($say > 0){

	            foreach ($ilanlar_tip as $ilan) {
	              $sayfa_ad = $ilan["baslik"];
	            }

	        }else{
	          $sayfa_ad = "error";
	        }


		}

   		

        return $sayfa_ad;

	}



	// seo fonk

  function wo_seo($s) {
     $tr = array('!','’','”','“','"','%',"'",'`','&','+','?','ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',');
     $eng = array('','','','','','',"",'-','','','','s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','');
     $s = str_replace($tr,$eng,$s);
     $s = strtolower($s);
     $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
     $s = preg_replace('/\s+/', '-', $s);
     $s = preg_replace('|-+|', '-', $s);
     $s = preg_replace('/#/', '', $s);
     $s = str_replace('.', '', $s);
     $s = trim($s, '-');
     return $s;
  }
  

?>