<?php @session_start(); @ob_start();
  
  $islem = $_GET["islem"];
  $id = $_GET["id"];

  if($islem == "duzenle"){

     $kontrol = $wo_db->prepare("SELECT * FROM etkinlikler WHERE id = :id");
      $kontrol2 = $kontrol->execute(array(
           "id" => $id
      ));

      $say = $kontrol->rowCount();

      if($say > 0){
          
          foreach($kontrol as $veri){

            $d_baslik = $veri["baslik"];
            $d_adres = $veri["adres"];
            $d_icerik = $veri["icerik"];
            $d_gorsel = $veri["gorsel"];
            $g_tarih = $veri["tarih"];

          }

          $tarihparcala = explode(" ", $g_tarih);
          $d_tarih = $tarihparcala[0];
          $g_saat = $tarihparcala[1];

          $saatparcala = explode(":", $g_saat);
          $d_saat = $saatparcala[0].':'.$saatparcala[1];

          if($d_gorsel == ""){

            $d_gorsel = "assets/gorsel_yok.png";

          }else{

          }


      }else{
        header("Location: admin.php?p=etkinlikler");
      }

  }
 

?>

<div class="wrapper-content "> 


<?php
  
  if($islem == "ekle"){
    ?>



    <div class="row">
    
      <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=etkinlikler/etkinlik_ekle" onsubmit="return false;" enctype="multipart/form-data">

      <div class="col-lg-9">

        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>ETKİNLİK EKLE</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                
              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-edit"></i>
                <input class="form-control" placeholder="Etkinlik Başlığı" type="text" name="baslik" id="baslik">
                </div>
              </div>

              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-map-marker"></i>
                <input class="form-control" placeholder="Etkinlik Merkezi" type="text" name="adres" id="adres">
                </div>
              </div>

              <div class="form-group">
                <label for="dtp_input2" class="col-md-2 control-label">Etkinlik Tarihi</label>
                <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2"
                  data-link-format="yyyy-mm-dd">
                  <input class="form-control" size="16" type="text" value="" readonly>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <input type="hidden" id="dtp_input2" name="dtp_input2" value="" />
                <br/>
              </div>

              <div class="form-group">
                <label for="dtp_input3" class="col-md-2 control-label">Etkinlik Saati</label>
                <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                  <input class="form-control" size="16" type="text" value="" readonly>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                </div>
                <input type="hidden" id="dtp_input3" name="dtp_input3" value="" />
                <br/>
              </div>

              <div class="form-group">
                <textarea name="icerik" id="icerik" class="ckeditor"></textarea>
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
    
      <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=etkinlikler/etkinlik_duzenle" onsubmit="return false;" enctype="multipart/form-data">
      <input type="hidden" name="id" id="id" value="<?=$_GET["id"];?>">
      <div class="col-lg-9">

        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>ETKİNLİK DÜZENLE</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                
              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-edit"></i>
                <input class="form-control" placeholder="Etkinlik Başlığı" type="text" name="baslik" id="baslik" value="<?=$d_baslik;?>">
                </div>
              </div>

              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-map-marker"></i>
                <input class="form-control" placeholder="Etkinlik Merkezi" type="text" name="adres" id="adres" value="<?=$d_adres;?>">
                </div>
              </div>

              <div class="form-group">
                <label for="dtp_input2" class="col-md-2 control-label">Etkinlik Tarihi</label>
                <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2"
                  data-link-format="yyyy-mm-dd">
                  <input class="form-control" size="16" type="text" value="<?=$d_tarih;?>" readonly>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <input type="hidden" id="dtp_input2" name="dtp_input2" value="<?=$d_tarih;?>" />
                <br/>
              </div>

              <div class="form-group">
                <label for="dtp_input3" class="col-md-2 control-label">Etkinlik Saati</label>
                <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                  <input class="form-control" size="16" type="text" value="<?=$d_saat;?>" readonly>
                  <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                </div>
                <input type="hidden" id="dtp_input3" name="dtp_input3" value="<?=$d_saat;?>" />
                <br/>
              </div>

              <div class="form-group">
                <textarea name="icerik" id="icerik" class="ckeditor"><?=$d_icerik;?></textarea>
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
        <a class="btn aqua btn-lgy" href="admin.php?p=etkinlikler&islem=ekle"><i class="fa fa-plus"> </i> Yeni Etkinlik Ekle </a>
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>ETKİNLİKLER</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                <table id="example" class="table  responsive nowrap table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th style="max-width: 95px;">Görsel</th>
                      <th>Etkinlik Başlığı</th>
                      <th>Etkinlik Merkezi</th>
                      <th>Tarih</th>
                      <th>İşlem</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Görsel</th>
                      <th>Etkinlik Başlığı</th>
                      <th>Etkinlik Merkezi</th>
                      <th>Tarih</th>
                      <th>İşlem</th>
                    </tr>
                  </tfoot>
                  <tbody>

                  <?php

                    $etkinlikler = $wo_db->query("SELECT * FROM etkinlikler order by id DESC", PDO::FETCH_ASSOC);
                    if ( $etkinlikler->rowCount()){
                         foreach( $etkinlikler as $row ){


                          echo '
                            <tr id="veri'.$row["id"].'">
                              <td class="tablo_gorsel"><img src="'.gorsel_kontrol($row["gorsel"]).'" style="width: 90px; height: 70px;"></td>
                              <td id="tablo_yazi">'.$row["baslik"].'</td>
                              <td id="tablo_yazi">'.$row["adres"].'</td>
                              <td id="tablo_yazi">'.wo_tarih($row["tarih"]).'</td>
                              <td id="tablo_yazi" style="width:40px; text-align: center;">
                                <a class="btn aqua" href="admin.php?p=etkinlikler&islem=duzenle&id='.$row["id"].'"><i class="fa fa-edit"></i> Düzenle</a>
                                ';
                                ?>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#veri_sil" onclick="veri_sil('<?=$row["baslik"];?>','etkinlik','<?=$row["id"];?>');"><i class="fa fa-close"></i> Sil</button>
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
       
      <script type="text/javascript" src="assets/js/vendor/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="assets/js/vendor/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

    <script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
        showMeridian: 1
    });
  $('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
    });
  $('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 1,
    minView: 0,
    maxView: 1,
    forceParse: 0
    });

        $(function () {
            $('#datetimepicker12').datetimepicker({
                inline: true,
                sideBySide: true
            });
      
       $('input[name="daterange"]').daterangepicker();       

        $('input[name="dateTimeRange"]').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'MM/DD/YYYY h:mm A'
        }
    });

    });
</script>