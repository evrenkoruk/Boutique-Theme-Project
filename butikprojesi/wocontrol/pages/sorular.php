<?php @session_start(); @ob_start();

  $islem = $_GET["islem"];
  $id = $_GET["id"];

  if($islem == "duzenle"){

     $kontrol = $wo_db->prepare("SELECT * FROM sorular WHERE id = :id");
      $kontrol2 = $kontrol->execute(array(
           "id" => $id
      ));

      $say = $kontrol->rowCount();

      if($say > 0){
          
          foreach($kontrol as $veri){

            $d_baslik = $veri["baslik"];
            $d_icerik = $veri["icerik"];
            $d_gorsel = $veri["gorsel"];

          }

          if($d_gorsel == ""){

            $d_gorsel = "assets/gorsel_yok.png";

          }else{

          }


      }else{
        header("Location: admin.php?p=sorular");
        exit();
      }

  }
 

?>

<div class="wrapper-content "> 


<?php
  
  if($islem == "ekle"){
    ?>



    <div class="row">
    
      <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=sorular/soru_ekle" onsubmit="return false;" enctype="multipart/form-data">

      <div class="col-lg-9">

        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>SORU EKLE</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                
              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-edit"></i>
                <input class="form-control" placeholder="Soru Başlığı" type="text" name="baslik" id="baslik">
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
            <h5>SORU GÖRSELLERİ</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>

                <div class="form-group">
                  <div class="input-icon">
                  <i class="fa fa-upload"></i>
                  <input class="form-control" placeholder="Duyuru Görselleri" name="gorseller[]" id="gorseller[]" type="file" multiple="multiple">
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
    
      <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=sorular/soru_duzenle" onsubmit="return false;" enctype="multipart/form-data">
      <input type="hidden" name="id" id="id" value="<?=$_GET["id"];?>">
      <div class="col-lg-9">

        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>DUYURU DÜZENLE</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                
              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-edit"></i>
                <input class="form-control" placeholder="Soru Başlığı" type="text" name="baslik" id="baslik" value="<?=$d_baslik;?>">
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
            <h5>SORU GÖRSELLERİ</h5>

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
                      echo 'Duyuruya ait görsel bulunamadı';
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
                  <input class="form-control" placeholder="Duyuru Görselleri" name="gorseller[]" id="gorseller[]" type="file" multiple="multiple">
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
        <a class="btn aqua btn-lgy" href="admin.php?p=sorular&islem=ekle"><i class="fa fa-plus"> </i> Yeni Soru Ekle </a>
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>SORULAR</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                <table id="example" class="table  responsive nowrap table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th style="max-width: 95px;">Görsel</th>
                      <th>Soru Başlığı</th>
                      <th>Tarih</th>
                      <th>İşlem</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Görsel</th>
                      <th>Soru Başlığı</th>
                      <th>Tarih</th>
                      <th>İşlem</th>
                    </tr>
                  </tfoot>
                  <tbody>

                  <?php

                    $sorular = $wo_db->query("SELECT * FROM sorular order by tarih DESC", PDO::FETCH_ASSOC);
                    if ($sorular->rowCount()){
                         foreach( $sorular as $row ){

                          echo '
                            <tr id="veri'.$row["id"].'">
                              <td class="tablo_gorsel"><img src="'.gorsel_kontrol($row["gorsel"]).'" style="width: 90px; height: 70px;"></td>
                              <td id="tablo_yazi">'.$row["baslik"].'</td>
                              <td id="tablo_yazi">'.wo_tarih($row["tarih"]).'</td>
                              <td id="tablo_yazi" style="width:40px; text-align: center;">
                                <a class="btn aqua" href="admin.php?p=sorular&islem=duzenle&id='.$row["id"].'"><i class="fa fa-edit"></i> Düzenle</a>
                                ';
                                ?>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#veri_sil" onclick="veri_sil('<?=$row["baslik"];?>','sorular','<?=$row["id"];?>');"><i class="fa fa-close"></i> Sil</button>
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
       

