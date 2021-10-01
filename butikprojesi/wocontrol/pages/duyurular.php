<?php @session_start(); @ob_start();

  $islem = @$_GET["islem"];
  $id = @$_GET["id"];

  if($islem == "duzenle"){

     $kontrol = $wo_db->prepare("SELECT * FROM duyurular WHERE id = :id");
      $kontrol2 = $kontrol->execute(array(
           "id" => $id
      ));

      $say = $kontrol->rowCount();

      if($say > 0){
          
          foreach($kontrol as $veri){

            $d_baslik = $veri["baslik"];
            $d_icerik = $veri["icerik"];
            $d_gorsel = $veri["gorsel"];
            $d_kategori = $veri["dil"];

            $seo              = $veri["seo"];
            $seo_title        = $veri["seo_title"];
            $seo_keywords     = $veri["seo_keywords"];
            $seo_description  = $veri["seo_description"];

          }

          if($d_gorsel == ""){

            $d_gorsel = "assets/gorsel_yok.png";

          }else{

          }


      }else{
        header("Location: admin.php?p=duyurular");
        exit();
      }

  }
 

?>

<div class="wrapper-content "> 


<?php
  
  if($islem == "ekle"){
    ?>



    <div class="row">
    
      <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=duyurular/duyuru_ekle" onsubmit="return false;" enctype="multipart/form-data">

      <div class="col-lg-9">

        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>YAZI EKLE</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                
              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-edit"></i>
                <input class="form-control" placeholder="Yazı Başlığı" type="text" name="baslik" id="baslik">
                </div>
              </div>

              <div class="form-group">
                <textarea name="icerik" id="icerik" class="ckeditor"></textarea>
              </div>

               <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-edit"></i>
                <input class="form-control" placeholder="Seo Title" type="text" name="seo_title" id="seo_title">
                </div>
              </div>

              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-edit"></i>
                <input class="form-control" placeholder="Seo Keywords" type="text" name="seo_keywords" id="seo_keywords">
                </div>
              </div>

              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-edit"></i>
                <input class="form-control" placeholder="Seo Description" type="text" name="seo_description" id="seo_description">
                </div>
              </div>



              </div>
            </div>
          </div>
        </div>

        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>YAZI GÖRSELLERİ</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>

                <div class="form-group">
                  <div class="input-icon">
                  <i class="fa fa-upload"></i>
                  <input class="form-control" placeholder="Yazı Görselleri" name="gorseller[]" id="gorseller[]" type="file" multiple="multiple">
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
          <div class="ibox-title">
            <h5>YAZI DİLİNİ SEÇİNİZ</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container" style="text-align: center;">
              <div>
                   <div class="form-group">
                     <select class="form-control bottom15" name="kategori_id" id="kategori_id">
                       
                       <?php

                         $duyuru_kategori = $wo_db->query("SELECT * FROM diller order by id ASC", PDO::FETCH_ASSOC);
                          if($duyuru_kategori->rowCount()){
                              foreach( $duyuru_kategori as $kat ){
                                echo '<option value="'.$kat["id"].'">'.$kat["baslik"].'</option>';
                              }
                          }

                       ?>



                    </select>
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
    
      <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=duyurular/duyuru_duzenle" onsubmit="return false;" enctype="multipart/form-data">
      <input type="hidden" name="id" id="id" value="<?=$_GET["id"];?>">
      <div class="col-lg-9">

        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>YAZI DÜZENLE</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                
              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-edit"></i>
                <input class="form-control" placeholder="Yazı Başlığı" type="text" name="baslik" id="baslik" value="<?=$d_baslik;?>">
                </div>
              </div>

              <div class="form-group">
                <textarea name="icerik" id="icerik" class="ckeditor"><?=$d_icerik;?></textarea>
              </div>

              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-edit"></i>
                <input class="form-control" placeholder="Seo Title" type="text" name="seo_title" id="seo_title" value="<?=$seo_title;?>">
                </div>
              </div>

              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-edit"></i>
                <input class="form-control" placeholder="Seo Keywords" type="text" name="seo_keywords" id="seo_keywords" value="<?=$seo_keywords;?>">
                </div>
              </div>

              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-edit"></i>
                <input class="form-control" placeholder="Seo Description" type="text" name="seo_description" id="seo_description" value="<?=$seo_description;?>">
                </div>
              </div>

              </div>
            </div>
          </div>
        </div>

        


        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>YAZI GÖRSELLERİ</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container" style="overflow: hidden;">
              <div>
                  
                  <div class="row">
                  <?php

                    $gorseller = $wo_db->query("SELECT * FROM gorseller WHERE yazi_id='$id' and kategori='duyuru' order by id DESC", PDO::FETCH_ASSOC);
                    if ( $gorseller->rowCount()){
                         foreach( $gorseller as $row ){


                          echo '
                          <div class="col-lg-3" id="gorsel'.$row["id"].'">
                            <section class="panel">
                              <div class="panel-body" style="min-height: 160px;">
                                <img src="'.$row["gorsel"].'" style="width: 99%; margin-bottom:10px;">
                                <a href="javascript:;" class="btn btn-xs btn-danger" style="bottom: 16px; position: absolute;" onclick="gorsel_sil('.$row["id"].')"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i> Görseli Sil</a>
                              </div>
                            </section>
                          </div>

                                    
                            
                          ';

                              
                         }
                    }else{
                      echo 'Yazıya ait görsel bulunamadı';
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
                  <input class="form-control" placeholder="Yazı Görselleri" name="gorseller[]" id="gorseller[]" type="file" multiple="multiple">
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
          <div class="ibox-title">
            <h5>YAZI DİLİNİ SEÇİNİZ</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container" style="text-align: center;">
              <div>
                   <div class="form-group">
                     <select class="form-control bottom15" name="kategori_id" id="kategori_id">
                       
                       <?php

                         $duyuru_kategori = $wo_db->query("SELECT * FROM diller order by id ASC", PDO::FETCH_ASSOC);
                          if($duyuru_kategori->rowCount()){
                              foreach( $duyuru_kategori as $kat ){
                                if($d_kategori == $kat["id"]){
                                  echo '<option value="'.$kat["id"].'" selected>'.$kat["baslik"].'</option>';
                                }else{
                                  echo '<option value="'.$kat["id"].'">'.$kat["baslik"].'</option>';
                                }
                                
                              }
                          }

                       ?>



                    </select>
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
    ?>






    <div class="row">

      <div class="col-lg-12">
        <a class="btn aqua btn-lgy" href="admin.php?p=duyurular&islem=ekle"><i class="fa fa-plus"> </i> Yeni Yazı Ekle </a>
        <a class="btn aqua btn-lgy" href="admin.php?p=kategoriler"><i class="fa fa-list"> </i> Kategoriler</a>


        <?php


            if($_SESSION["yetki"] == 1){
              ?>



                <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>ONAY BEKLEYEN YAZILAR</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                <table id="example2" class="table  responsive nowrap table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th style="max-width: 95px;">Görsel</th>
                      <th>Yazı Başlığı</th>
                      <th>Kategori</th>
                      <th>Tarih</th>
                      <th>Yazar</th>
                      <th>Durum</th>
                      <th>İşlem</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Görsel</th>
                      <th>Yazı Başlığı</th>
                      <th>Kategori</th>
                      <th>Tarih</th>
                      <th>Yazar</th>
                      <th>Durum</th>
                      <th>İşlem</th>
                    </tr>
                  </tfoot>
                  <tbody>

                  <?php

                  $yazar_id = $_SESSION["admin_id"];

                  $duyurular = $wo_db->query("SELECT * FROM duyurular where durum='0' order by tarih DESC", PDO::FETCH_ASSOC);

                    
                    if ($duyurular->rowCount()){
                         foreach( $duyurular as $row ){

                          $durum = $row["durum"];

                          if($durum == 1){
                            $durum_yaz = '<font style="color: green;">YAYINDA</font>';
                          }else{
                            $durum_yaz = '<font style="color: orange;">ONAY BEKLİYOR</font>';
                          }

                            $kategori_adi = duyuru_kat($row["kategori_id"]);

                          echo '
                            <tr id="veri'.$row["id"].'">
                              <td class="tablo_gorsel"><img src="'.gorsel_kontrol($row["gorsel"]).'" style="width: 90px; height: 70px;" title="'.$row["baslik"].'"></td>
                              <td id="tablo_yazi" title="'.$row["baslik"].'">'.icerik_kisalt($row["baslik"],40).'</td>
                              <td id="tablo_yazi">'.$kategori_adi.'</td>
                              <td id="tablo_yazi">'.wo_tarih($row["tarih"]).'</td>
                              <td id="tablo_yazi">'.$row["yazar"].'</td>
                              <td id="tablo_yazi">'.$durum_yaz.'</td>
                              <td id="tablo_yazi" style="width:40px; text-align: center;">
                                <a class="btn aqua" href="admin.php?p=duyurular&islem=duzenle&id='.$row["id"].'"><i class="fa fa-edit"></i> Düzenle</a>
                                ';
                                ?>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#veri_sil" onclick="veri_sil('<?=$row["baslik"];?>','duyuru','<?=$row["id"];?>');"><i class="fa fa-close"></i> Sil</button>
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



              <?
            }



        ?>


        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>YAZILAR</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                <table id="example" class="table  responsive nowrap table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th style="max-width: 95px;">Görsel</th>
                      <th>Yazı Başlığı</th>
                      <th>Dil</th>
                      <th>Tarih</th>
                      <th>Yazar</th>
                      <th>Durum</th>
                      <th>İşlem</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Görsel</th>
                      <th>Yazı Başlığı</th>
                      <th>Dil</th>
                      <th>Tarih</th>
                      <th>Yazar</th>
                      <th>Durum</th>
                      <th>İşlem</th>
                    </tr>
                  </tfoot>
                  <tbody>

                  <?php

                  $yazar_id = $_SESSION["admin_id"];

                  if($yazar_id == 1){

                      $duyurular = $wo_db->query("SELECT * FROM duyurular order by tarih DESC", PDO::FETCH_ASSOC);

                  }else{
                      $duyurular = $wo_db->query("SELECT * FROM duyurular where yazar_id='$yazar_id' order by tarih DESC", PDO::FETCH_ASSOC);
                  }

                    
                    if ($duyurular->rowCount()){
                         foreach( $duyurular as $row ){

                          $durum = $row["durum"];

                          if($durum == 1){
                            $durum_yaz = '<font style="color: green;">YAYINDA</font>';
                          }else{
                            $durum_yaz = '<font style="color: orange;">ONAY BEKLİYOR</font>';
                          }

                            $kategori_adi = dil_ad($row["dil"]);

                          echo '
                            <tr id="veri'.$row["id"].'">
                              <td class="tablo_gorsel"><img src="'.gorsel_kontrol($row["gorsel"]).'" style="width: 90px; height: 70px;" title="'.$row["baslik"].'"></td>
                              <td id="tablo_yazi" title="'.$row["baslik"].'">'.icerik_kisalt($row["baslik"],40).'</td>
                              <td id="tablo_yazi">'.$kategori_adi.'</td>
                              <td id="tablo_yazi">'.wo_tarih($row["tarih"]).'</td>
                              <td id="tablo_yazi">'.$row["yazar"].'</td>
                              <td id="tablo_yazi">'.$durum_yaz.'</td>
                              <td id="tablo_yazi" style="width:40px; text-align: center;">
                                <a class="btn aqua" href="admin.php?p=duyurular&islem=duzenle&id='.$row["id"].'"><i class="fa fa-edit"></i> Düzenle</a>
                                ';
                                ?>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#veri_sil" onclick="veri_sil('<?=$row["baslik"];?>','duyuru','<?=$row["id"];?>');"><i class="fa fa-close"></i> Sil</button>
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
       

