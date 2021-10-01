<?php @session_start(); @ob_start();

  $islem = $_GET["islem"];
  $id = $_GET["id"];
  $ust_id = $_GET["ust_id"];
  $lang = $_GET["lang"];


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
            $d_menu = $veri["menu"];

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
        header("Location: admin.php?p=sayfalar");
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
      header("Location: admin.php?p=sayfalar");
      exit();
    }

  }
 

?>

<div class="wrapper-content "> 


<?php
  
  if($islem == "ekle"){
    ?>



    <div class="row">
    
      <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=sayfalar/sayfa_ekle" onsubmit="return false;" enctype="multipart/form-data">

      <div class="col-lg-9">

        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>YENİ SAYFA EKLE</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                
              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-edit"></i>
                <input class="form-control" placeholder="Sayfa Adı" type="text" name="baslik" id="baslik">
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
            <h5>SAYFA GÖRSELLERİ</h5>
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
            <h5>ÜST SAYFA</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container" style="text-align: center;">
              <div>
                   <div class="form-group">
                     <select class="form-control bottom15" name="ust_id" id="ust_id">
                        <option value="0">Anasayfa</option>
                       <?php
                        if($ustust == 5 or $ustust2 == 5){ //ÜRÜNLER İSE
                          $sayfa_kategori = $wo_db->query("SELECT * FROM sayfalar where ust_id=$ustust", PDO::FETCH_ASSOC);
                        }else{
                          $sayfa_kategori = $wo_db->query("SELECT * FROM sayfalar where ust_id=0", PDO::FETCH_ASSOC);
                        }
                         
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

                 <!--  <div class="form-group">
                     <select class="form-control bottom15" name="menu" id="menu">
                        <option value="0">Üst Menüde Göster</option>
                        <option value="1">Üst Menüde Gösterme</option>

                    </select>
                  </div> -->

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


        <div class="ibox float-e-margins" style="display: none;">
          <div class="ibox-title">
            <h5>ÖNE ÇIKARILAN GÖRSEL 2</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container" style="text-align: center;">
              <div>
                  
                 <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 90%;">
                    <img data-src="" alt="Öne Çıkarılan Görsel" src="assets/gorsel_yok.png"> </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                    <div> <span class="btn btn-default btn-file"><span class="fileinput-new">Görsel Seç</span><span class="fileinput-exists">Değiştir</span>
                      <input type="file" name="gorsel2" id="gorsel2">
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
    
      <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=sayfalar/sayfa_duzenle" onsubmit="return false;" enctype="multipart/form-data">
      <input type="hidden" name="id" id="id" value="<?=$_GET["id"];?>">
      <input type="hidden" name="dil_id" id="dil_id" value="<?=$dil_id;?>">
      <div class="col-lg-9">

        <?php


          $diller = $wo_db->query("select * from diller order by id ASC");
          foreach ($diller as $dill) {
            $lng  = $dill["dil"];
            ?>

              <a href="admin.php?p=sayfalar&islem=duzenle&id=<?=$id;?>&lang=<?=$lng;?>" style="margin-right: 10px; margin-bottom: 10px; padding:8px 5px; background-color: #ddd;">
                <img src="assets/lng/<?=$lng;?>.png">
              </a>

            <?
          }


        ?>

        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>SAYFA DÜZENLE - <?=$dil_baslik;?></h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                
              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-edit"></i>
                <input class="form-control" placeholder="Sayfa Adı" type="text" name="baslik" id="baslik" value="<?=$d_baslik;?>">
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
            <h5>SAYFA GÖRSELLERİ</h5>

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
                  <input class="form-control" placeholder="sayfa Görselleri" name="gorseller[]" id="gorseller[]" type="file" multiple="multiple">
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
            <h5>ÜST SAYFA</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container" style="text-align: center;">
              <div>
                   <div class="form-group">
                     <select class="form-control bottom15" name="ust_id" id="ust_id">
                       <option value="0">Anasayfa</option>
                       <?php

                         if($ustust == 5){ //ÜRÜNLER İSE
                          $sayfa_kategori = $wo_db->query("SELECT * FROM sayfalar where ust_id=$ustust", PDO::FETCH_ASSOC);
                        }else{
                          $sayfa_kategori = $wo_db->query("SELECT * FROM sayfalar where ust_id=0", PDO::FETCH_ASSOC);
                        }

                          if($sayfa_kategori->rowCount()){
                              foreach( $sayfa_kategori as $kat ){
                                if($d_ustid == $kat["id"]){
                                  echo '<option value="'.$kat["id"].'" selected>'.$kat["baslik"].'</option>';
                                }else{
                                  echo '<option value="'.$kat["id"].'">'.$kat["baslik"].'</option>';
                                }
                                
                              }
                          }

                       ?>



                    </select>
                  </div>

                  <!-- <div class="form-group">
                     <select class="form-control bottom15" name="menu" id="menu">
                        <option value="0" <?php if($d_menu == 0){echo 'selected';}else{} ?>>Üst Menüde Göster</option>
                        <option value="1" <?php if($d_menu == 1){echo 'selected';}else{} ?>>Üst Menüde Gösterme</option>

                    </select>
                  </div> -->

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


        <div class="ibox float-e-margins" style="display: none;">
          <div class="ibox-title">
            <h5>ÖNE ÇIKARILAN GÖRSEL 2</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container" style="text-align: center;">
              <div>
                  
                 <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 90%;">
                    <img data-src="" alt="Öne Çıkarılan Görsel" src="<?=$d_gorsel2;?>"> </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="width: 90%; max-height: 150px;"></div>
                    <div> <span class="btn btn-default btn-file"><span class="fileinput-new">Görsel Seç</span><span class="fileinput-exists">Değiştir</span>
                      <input type="file" name="gorsel2" id="gorsel2">
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
  }else if($islem == "alt_liste"){
?>
  


  
  <div class="row">

      <div class="col-lg-12">
        <a class="btn aqua btn-lgy" href="admin.php?p=sayfalar&islem=ekle&ust_id=<?=$ust_id;?>"><i class="fa fa-plus"> </i> Yeni Sayfa Ekle </a>
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5><?=$ust_baslik;?></h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                <table id="example" class="table  responsive nowrap table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Ana Sayfa</th>
                      <th>Sayfa Adı</th>
                      <th>İşlem</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Ana Sayfa</th>
                      <th>Sayfa Adı</th>
                      <th>İşlem</th>
                    </tr>
                  </tfoot>
                  <tbody>

                  <?php

                    $sayfalar = $wo_db->query("SELECT * FROM sayfalar WHERE ust_id='$ust_id' order by id DESC", PDO::FETCH_ASSOC);
                    if ($sayfalar->rowCount()){
                         foreach( $sayfalar as $row ){

                          if($row["kategori"] == "urun"){

                            echo '
                            <tr id="veri'.$row["id"].'">
                              <td id="tablo_yazi"><strong>'.sayfa_ad($row["ust_id"]).'</strong></td>
                              <td id="tablo_yazi"><a href="admin.php?p=urunler&islem=duzenle&id='.$row["id"].'">'.$row["baslik"].'</a></td>
                              <td id="tablo_yazi" style="width:40px; text-align: center;">
                                <a class="btn aqua" href="admin.php?p=urunler&islem=duzenle&id='.$row["id"].'"><i class="fa fa-edit"></i> Düzenle</a>
                                ';
                                ?>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#veri_sil" onclick="veri_sil('<?=$row["baslik"];?>','sayfa','<?=$row["id"];?>');"><i class="fa fa-close"></i> Sil</button>
                              <?
                              echo '</td>
                            </tr>
                          ';

                          }else{

                            echo '
                            <tr id="veri'.$row["id"].'">
                              <td id="tablo_yazi"><strong>'.sayfa_ad($row["ust_id"]).'</strong></td>
                              <td id="tablo_yazi"><a href="admin.php?p=sayfalar&islem=alt_liste&ust_id='.$row["id"].'">'.$row["baslik"].'</a></td>
                              <td id="tablo_yazi" style="width:40px; text-align: center;">
                                <a class="btn aqua" href="admin.php?p=sayfalar&islem=duzenle&id='.$row["id"].'"><i class="fa fa-edit"></i> Düzenle</a>
                                ';
                                ?>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#veri_sil" onclick="veri_sil('<?=$row["baslik"];?>','sayfa','<?=$row["id"];?>');"><i class="fa fa-close"></i> Sil</button>
                              <?
                              echo '</td>
                            </tr>
                          ';

                          }

                          

                              
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
  }else{
    ?>


    <div class="row">

      <div class="col-lg-12">
        <a class="btn aqua btn-lgy" href="admin.php?p=sayfalar&islem=ekle"><i class="fa fa-plus"> </i> Yeni Sayfa Ekle </a>
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>SAYFALAR</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                <table id="example" class="table  responsive nowrap table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Sayfa Adı</th>
                      <th>Alt Sayfalar</th>
                      <th>İşlem</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Sayfa Adı</th>
                      <th>Alt Sayfalar</th>
                      <th>İşlem</th>
                    </tr>
                  </tfoot>
                  <tbody>

                  <?php

                    $sayfalar = $wo_db->query("SELECT * FROM sayfalar WHERE ust_id=0 order by id DESC", PDO::FETCH_ASSOC);
                    if ($sayfalar->rowCount()){
                         foreach( $sayfalar as $row ){

                          echo '
                            <tr id="veri'.$row["id"].'">
                              <td id="tablo_yazi">'.$row["baslik"].'</td>
                              <td id="tablo_yazi"><a href="admin.php?p=sayfalar&islem=alt_liste&ust_id='.$row["id"].'">Alt Sayfaları Listele</a></td>
                              <td id="tablo_yazi" style="width:40px; text-align: center;">
                                <a class="btn aqua" href="admin.php?p=sayfalar&islem=duzenle&id='.$row["id"].'"><i class="fa fa-edit"></i> Düzenle</a>
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
       

