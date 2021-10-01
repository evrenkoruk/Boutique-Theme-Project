<?php @session_start(); @ob_start();

  $islem = $_GET["islem"];
  $id = $_GET["id"];
  $lang = $_GET["lang"];
  $ust_id = 6;

  $ustSor = $wo_db->query("select * from sayfalar where id=$ust_id");
  foreach ($ustSor as $ustKontrol) {
    $ustust = $ustKontrol["ust_id"];
  }


  if($islem == "duzenle"){

   if($lang == ""){

      $dil_id       = 1;
      $dil_baslik   = "Türkçe";
      $dil          = "tr";

   }else{

     $diller = $wo_db->query("select * from diller where dil='$lang'");
      if($diller->rowCount()){

          foreach ($diller as $dill) {
            $dil_id       = $dill["id"];
            $dil_baslik   = $dill["baslik"];
            $dil          = $dill["dil"];
          }


      }else{

          $dil_id       = 1;
          $dil_baslik   = "Türkçe";
          $dil          = "tr";

      }

   }



     $kontrol = $wo_db->prepare("SELECT * FROM sayfalar WHERE id = :id");
      $kontrol2 = $kontrol->execute(array(
           "id" => $id
      ));

      $say = $kontrol->rowCount();

      if($say > 0){
          
          foreach($kontrol as $veri){

            $sayfa_icerik = $wo_db->query("select * from sayfa_icerikler where sayfa_id='$id' and dil='$dil_id'");
            foreach ($sayfa_icerik as $ss) {
              $d_baslik = $ss["baslik"];
              $d_icerik = $ss["icerik"];
            }

            $d_gorsel = $veri["gorsel"];
            $d_gorsel2 = $veri["gorsel2"];
            $d_ustid = $veri["ust_id"];
            $d_urunkat = $veri["urun_kat"];
            $d_menu = $veri["menu"];
            $d_urungrup = $veri["urun_grup"];
            $fiyat = $veri["fiyat"];
            $fiyat2 = $veri["fiyat2"];
            $shopier_url = $veri["shopier_url"];

             $ustSor = $wo_db->query("select * from sayfalar where id=$d_ustid");
            foreach ($ustSor as $ustKontrol) {
              $ustust = $ustKontrol["ust_id"];
            }

             $ustSor2 = $wo_db->query("select * from sayfalar where id=$ustust");
            foreach ($ustSor2 as $ustKontrol) {
              $ustust2 = $ustKontrol["ust_id"];
            }

          }

          if($d_gorsel == ""){

            $d_gorsel = "assets/gorsel_yok.png";

          }else{

          }

          if($d_gorsel2 == ""){

            $d_gorsel2 = "assets/gorsel_yok.png";

          }else{

          }

      }else{
        header("Location: admin.php?p=urunler");
        exit();
      }

  }


  if($islem == "alt_liste"){

   $kontrol = $wo_db->prepare("SELECT * FROM sayfalar WHERE id = :id or ust_id = :ust_id");
    $kontrol2 = $kontrol->execute(array(
         "id" => $ust_id,
         "ust_id" => $ust_id
    ));

    $say = $kontrol->rowCount();

    if($say > 0){

      foreach($kontrol as $veri){

            $ust_baslik = sayfa_ad($ust_id);

          }

    }else{
      header("Location: admin.php?p=urunler");
      exit();
    }

  }
 

?>

<div class="wrapper-content "> 


<?php
  
  if($islem == "ekle"){
    ?>



    <div class="row">
    
      <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=urunler/urun_ekle" onsubmit="return false;" enctype="multipart/form-data">

      <div class="col-lg-9">

        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>YENİ ÜRÜN EKLE</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                
              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-edit"></i>
                <input class="form-control" placeholder="Ürün Adı" type="text" name="baslik" id="baslik">
                </div>
              </div>

              <div class="form-group">
                <textarea name="icerik" id="icerik" class="ckeditor"></textarea>
              </div>

              </div>
            </div>
          </div>
        </div>

        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>ÜRÜN GÖRSELLERİ</h5>
          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>

                <div class="form-group">
                  <div class="input-icon">
                  <i class="fa fa-upload"></i>
                  <input class="form-control" placeholder="Sayfa Görselleri" name="gorseller[]" id="gorseller[]" type="file" multiple="multiple">
                  </div> 
                </div>

              </div>
            </div>
          </div>
        </div>




      </div>

      <div class="col-lg-3">




        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>KATEGORİ</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container" style="text-align: center;">
              <div>
                   <div class="form-group" style="text-align: left;">
                    <label>Ürün Kategorisi</label>
                     <select class="form-control bottom10" name="ust_id" id="ust_id" onchange="kat_cek(this);">
                      <option value="">Ürün Kategorisi Seçiniz</option>
                       <?php
                        $sayfa_kategori = $wo_db->query("SELECT * FROM sayfalar where ust_id=5", PDO::FETCH_ASSOC);
                         
                          if($sayfa_kategori->rowCount()){
                              foreach( $sayfa_kategori as $wos ){
                                if($_GET["ust_id"] == $wos["id"]){
                                  echo '<option value="'.$wos["id"].'" selected>'.$wos["baslik"].'</option>';
                                }else{
                                  echo '<option value="'.$wos["id"].'">'.$wos["baslik"].'</option>';
                                }
                              }
                          }

                       ?>

                    </select>


                  </div>

                 <div class="form-group" style="text-align: left;">
                  <label>Alt Kategori</label>
                     <select class="form-control" name="altkat_id" id="altkat_id" onchange="grup_cek(this);">
                      <option value="">Ürün Kategorisi Seçiniz</option>
                    </select>
                </div>

                <div class="form-group" style="text-align: left; display: none;">
                  <label>Ürün Grubu</label>
                     <select class="form-control" name="urun_grup" id="urun_grup">
                      <option value="0">Ürün Grubu Seçiniz</option>
                    </select>
                </div>


                <div class="form-group" style="text-align: left;">
                  <label>Ürün Fiyatı</label>
                  <div class="input-icon">
                  <i class="fa fa-edit"></i>
                  <input class="form-control" placeholder="0.00" type="text" name="fiyat" id="fiyat">
                  </div>

                  <div class="form-group" style="text-align: left;">
                  <label>Ürün Fiyatı (Üstü Çizili)</label>
                  <div class="input-icon">
                  <i class="fa fa-edit"></i>
                  <input class="form-control" placeholder="0.00" type="text" name="fiyat2" id="fiyat2">
                  </div>
              </div>

              <div class="form-group" style="text-align: left;">
                  <label>Shopier URL</label>
                  <div class="input-icon">
                  <i class="fa fa-edit"></i>
                  <input class="form-control" placeholder="https://www.shopier.com/6138191" type="text" name="shopier_url" id="shopier_url">
                  </div>
              </div>

            </div>
          </div>
        </div>


        <div class="ibox float-e-margins" style="margin-top:15px;">
          <div class="ibox-title">
            <h5>ÖNE ÇIKARILAN GÖRSEL</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container" style="text-align: center;">
              <div>
                  
                 <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 90%;">
                    <img data-src="" alt="Öne Çıkarılan Görsel" src="assets/gorsel_yok.png"> </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                    <div> <span class="btn btn-default btn-file"><span class="fileinput-new">Görsel Seç</span><span class="fileinput-exists">Değiştir</span>
                      <input type="file" name="gorsel" id="gorsel">
                      </span> <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Sil</a> </div>
                  </div>



              </div>
            </div>
          </div>
        </div>




        <div class="ibox float-e-margins">
          <div class="ibox-content collapse in">
            <div class="widgets-container" style="text-align: center;">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#kaydet" onclick="AjaxFormS('forms','form_status');">
                  <i class="fa fa-check"></i>&nbsp;Değişiklikleri Kaydet
                </button>
                
            </div>
          </div>
        </div>
      </div>

    </form>




    </div>









    <?
  }else if($islem == "duzenle"){
    ?>





    <div class="row">
    
      <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=urunler/urun_duzenle" onsubmit="return false;" enctype="multipart/form-data">
      <input type="hidden" name="id" id="id" value="<?=$_GET["id"];?>">
      <input type="hidden" name="dil_id" id="dil_id" value="<?=$dil_id;?>">
      <div class="col-lg-9">

        <?php


          $diller = $wo_db->query("select * from diller order by id ASC");
          foreach ($diller as $dill) {
            $lng  = $dill["dil"];
            ?>

              <a href="admin.php?p=urunler&islem=duzenle&id=<?=$id;?>&lang=<?=$lng;?>" style="margin-right: 10px; margin-bottom: 10px; padding:8px 5px; background-color: #ddd;">
                <img src="assets/lng/<?=$lng;?>.png">
              </a>

            <?
          }


        ?>

        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>ÜRÜN DÜZENLE - <?=$dil_baslik;?></h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                
              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-edit"></i>
                <input class="form-control" placeholder="Ürün Adı" type="text" name="baslik" id="baslik" value="<?=$d_baslik;?>">
                </div>
              </div>

              <div class="form-group">
                <textarea name="icerik" id="icerik" class="ckeditor"><?=$d_icerik;?></textarea>
              </div>

              </div>
            </div>
          </div>
        </div>

        


        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>ÜRÜN GÖRSELLERİ</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container" style="overflow: hidden;">
              <div>


                  
                  <div class="row">
                  <?php

                    $gorseller = $wo_db->query("SELECT * FROM gorseller WHERE yazi_id='$id' and kategori='sayfa' order by id DESC", PDO::FETCH_ASSOC);
                    if ( $gorseller->rowCount()){
                         foreach( $gorseller as $row ){


                          echo '
                          <div class="col-lg-3" id="gorsel'.$row["id"].'">
                            <section class="panel">
                              <div class="panel-body" style="min-height: 160px;">
                                <img src="'.$row["gorsel"].'" style="width: 99%; margin-bottom:10px; height: 130px;">

                                  <input type="text" placeholder="Başlık" name="basliklar['.$row["id"].']" value="'.$row["gbaslik"].'" style="width: 40%; margin-bottom:10px;">
                                <br>

                                <a href="javascript:;" class="btn btn-xs btn-danger" style="bottom: 16px; position: absolute;" onclick="gorsel_sil('.$row["id"].')"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i> Görseli Sil</a>
                              </div>
                            </section>
                          </div>

                                    
                            
                          ';

                              
                         }
                    }else{
                      echo 'sayfaya ait görsel bulunamadı';
                    }

                  ?>
                </div>

              </div>
            </div>
          </div>

          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                <div class="form-group">
                  <div class="input-icon">
                  <i class="fa fa-upload"></i>
                  <input class="form-control" placeholder="Ürün Görselleri" name="gorseller[]" id="gorseller[]" type="file" multiple="multiple">
                  </div> 
                </div>

              </div>
            </div>
          </div>
        </div>




      </div>

      <div class="col-lg-3">


        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>KATEGORİ</h5>
          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container" style="text-align: center;">
              <div>
                   <div class="form-group" style="text-align: left;">
                    <label>Ürün Kategorisi</label>
                     <select class="form-control bottom10" name="ust_id" id="ust_id" onchange="kat_cek(this);">
                      <option value="">Ürün Kategorisi Seçiniz</option>
                       <?php
                         $sayfa_kategori = $wo_db->query("SELECT * FROM sayfalar where ust_id=5", PDO::FETCH_ASSOC);
                         
                          if($sayfa_kategori->rowCount()){
                              foreach( $sayfa_kategori as $wos ){
                                if($d_urunkat == $wos["id"]){
                                  echo '<option value="'.$wos["id"].'" selected>'.$wos["baslik"].'</option>';
                                }else{
                                  echo '<option value="'.$wos["id"].'">'.$wos["baslik"].'</option>';
                                }
                              }
                          }

                       ?>

                    </select>


                  </div>

                 <div class="form-group" style="text-align: left;">
                  <label>Alt Kategori</label>
                     <select class="form-control" name="altkat_id" id="altkat_id">
                      <option value="">Ürün Kategorisi Seçiniz</option>
                      <?php

                        $adresKontrol = $wo_db->query("select * from sayfalar where ust_id=$d_urunkat");
                         if($adresKontrol->rowCount() > 0){
                              ?>
                                   <option value="">Alt Kategori Seçiniz</option>
                              <?
                              foreach ($adresKontrol as $ilce) {
                              $ilce_id       = $ilce["id"];
                              $ilce_baslik   = $ilce["baslik"];

                              if($ilce_id == $d_ustid){
                                ?>

                                   <option value="<?=$ilce_id;?>" selected><?=$ilce_baslik;?></option>

                              <?
                               }else{
                                ?>

                                   <option value="<?=$ilce_id;?>"><?=$ilce_baslik;?></option>

                              <?

                                }


                            }
                         }

                      ?>
                    </select>

                </div>


                <div class="form-group" style="text-align: left; display: none;">
                  <label>Ürün Grubu</label>
                     <select class="form-control" name="urun_grup" id="urun_grup">
                      <?php

                        $adresKontrol = $wo_db->query("select * from urun_gruplar where altkategori_id=$d_ustid");
                         if($adresKontrol->rowCount() > 0){
                              ?>
                                   <option value="0">Alt Kategori Seçiniz</option>
                              <?
                              foreach ($adresKontrol as $ilce) {
                              $ilce_id       = $ilce["id"];
                              $ilce_baslik   = $ilce["baslik"];

                              if($ilce_id == $d_urungrup){
                                ?>

                                   <option value="<?=$ilce_id;?>" selected><?=$ilce_baslik;?></option>

                              <?
                               }else{
                                ?>

                                   <option value="<?=$ilce_id;?>"><?=$ilce_baslik;?></option>

                              <?

                                }


                            }
                         }

                      ?>
                    </select>
                </div>




                <div class="form-group" style="text-align: left;">
                  <label>Ürün Fiyatı</label>
                  <div class="input-icon">
                  <i class="fa fa-edit"></i>
                  <input class="form-control" placeholder="0.00" type="text" name="fiyat" id="fiyat" value="<?=$fiyat;?>">
                  </div>
              </div>

              <div class="form-group" style="text-align: left;">
                  <label>Ürün Fiyatı (Üstü Çizili)</label>
                  <div class="input-icon">
                  <i class="fa fa-edit"></i>
                  <input class="form-control" placeholder="0.00" type="text" name="fiyat2" id="fiyat2">
                  </div>

              <div class="form-group" style="text-align: left;">
                  <label>Shopier URL</label>
                  <div class="input-icon">
                  <i class="fa fa-edit"></i>
                  <input class="form-control" placeholder="https://www.shopier.com/6138191" type="text" name="shopier_url" id="shopier_url" value="<?=$shopier_url;?>">
                  </div>
              </div>


            </div>
          </div>
        </div>

        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>ÖNE ÇIKARILAN GÖRSEL</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container" style="text-align: center;">
              <div>
                  
                 <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 90%;">
                    <img data-src="" alt="Öne Çıkarılan Görsel" src="<?=$d_gorsel;?>"> </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="width: 90%; max-height: 150px;"></div>
                    <div> <span class="btn btn-default btn-file"><span class="fileinput-new">Görsel Seç</span><span class="fileinput-exists">Değiştir</span>
                      <input type="file" name="gorsel" id="gorsel">
                      </span> <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Sil</a> </div>
                  </div>



              </div>
            </div>
          </div>
        </div>


        


        <div class="ibox float-e-margins">
          <div class="ibox-content collapse in">
            <div class="widgets-container" style="text-align: center;">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#kaydet" onclick="AjaxFormS('forms','form_status');">
                  <i class="fa fa-check"></i>&nbsp;Değişiklikleri Kaydet
                </button>
                
            </div>
          </div>
        </div>
      </div>

    </form>




    </div>

















    <?
  }else{

  $ust_id = 59;

    ?>



<div class="row">

      <div class="col-lg-12">
        <a class="btn aqua btn-lgy" href="admin.php?p=urunler&islem=ekle"><i class="fa fa-plus"> </i> Yeni Ürün Ekle </a>
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>ÜRÜNLER</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                <table id="example" class="table  responsive nowrap table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Görsel</th>
                      <th>Ürün Adı</th>
                      <th>Kategori</th>
                      <th>İşlem</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Görsel</th>
                      <th>Ürün Adı</th>
                      <th>Kategori</th>
                      <th>İşlem</th>
                    </tr>
                  </tfoot>
                  <tbody>

                  <?php

                    $sayfalar = $wo_db->query("SELECT * FROM sayfalar WHERE kategori='urun' order by id DESC", PDO::FETCH_ASSOC);
                    if ($sayfalar->rowCount()){
                         foreach( $sayfalar as $row ){

                          echo '
                            <tr id="veri'.$row["id"].'">
                              <td class="tablo_gorsel" style="width:120px;"><img src="'.gorsel_kontrol($row["gorsel"]).'" style="width: 90px; height: 70px;"></td>
                              <td id="tablo_yazi">'.$row["baslik"].'</td>
                              <td id="tablo_yazi">'.sayfa_ad($row["ust_id"]).'</td>
                              <td id="tablo_yazi" style="width:40px; text-align: center;">
                                <a class="btn aqua" href="admin.php?p=urunler&islem=duzenle&id='.$row["id"].'"><i class="fa fa-edit"></i> Düzenle</a>
                                ';
                                ?>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#veri_sil" onclick="veri_sil('<?=$row["baslik"];?>','sayfa','<?=$row["id"];?>');"><i class="fa fa-close"></i> Sil</button>
                              <?
                              echo '</td>
                            </tr>
                          ';

                              
                         }
                    }

                  ?>

                    



                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    




    <?
  }

?>




</div>
       

<script type="text/javascript">

  function kat_cek(id){

    var gelen = id.value;

    $.ajax({
        url:'altkategoriler.php?id='+gelen, // serileştirilen değerleri ajax.php dosyasına
        type:'GET', // post metodu ile 
        success:function(e){ // gonderme işlemi başarılı ise e değişkeni ile gelen değerleri aldı
          $("#altkat_id").html(""); // div elemanını her gönderme işleminde boşalttı ve gelen verileri içine attı
          $("#altkat_id").html(e); // div elemanını her gönderme işleminde boşalttı ve gelen verileri içine attı
          
          // if(e == ""){
          //  $("#tarifebildirim").hide();

          // }else{

          //  $("#tarifebildirim").html("Kayıtlı Tarife("+e+" TL) Uygulama Ücretine Eklendi");
          //  $("#tarifebildirim").show(300);
            
          // }
          


        }
      });

  }



  function grup_cek(id){

    var gelen = id.value;

    $.ajax({
        url:'urungruplar.php?id='+gelen, // serileştirilen değerleri ajax.php dosyasına
        type:'GET', // post metodu ile 
        success:function(e){ // gonderme işlemi başarılı ise e değişkeni ile gelen değerleri aldı
          $("#urun_grup").html(""); // div elemanını her gönderme işleminde boşalttı ve gelen verileri içine attı
          $("#urun_grup").html(e); // div elemanını her gönderme işleminde boşalttı ve gelen verileri içine attı
          
          // if(e == ""){
          //  $("#tarifebildirim").hide();

          // }else{

          //  $("#tarifebildirim").html("Kayıtlı Tarife("+e+" TL) Uygulama Ücretine Eklendi");
          //  $("#tarifebildirim").show(300);
            
          // }
          


        }
      });

  }

</script>
