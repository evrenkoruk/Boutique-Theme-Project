<?php @session_start(); @ob_start();  include("system/config.php"); include("system/wofonk.php");

     $id 		= $_GET["id"];

     $adresKontrol = $wo_db->query("select * from urun_gruplar where altkategori_id=$id");
     if($adresKontrol->rowCount() > 0){
          ?>
               <option value="">Alt Kategori Seçiniz</option>
          <?
          foreach ($adresKontrol as $ilce) {
          $ilce_id       = $ilce["id"];
          $ilce_baslik   = $ilce["baslik"];

          ?>

               <option value="<?=$ilce_id;?>"><?=$ilce_baslik;?></option>

          <?
          }
     }else{

          ?>
               <option value="0">Kayıtlı Grup Bulunamadı</option>
          <?
     }


?>