<?php @session_start(); @ob_start();
  
  $islem = $_GET["islem"];
  $id = $_GET["id"];

  if($islem == "duzenle"){

     $kontrol = $wo_db->prepare("SELECT * FROM basin WHERE id = :id");
      $kontrol2 = $kontrol->execute(array(
           "id" => $id
      ));

      $say = $kontrol->rowCount();

      if($say > 0){
          
          foreach($kontrol as $veri){

            $d_baslik = $veri["baslik"];
            $g_tarih = $veri["tarih"];
            $d_gorsel = $veri["gorsel"];

          }

          $tarihparcala = explode(" ", $g_tarih);
          $d_tarih = $tarihparcala[0];

          if($d_gorsel == ""){

            $d_gorsel = "assets/gorsel_yok.png";

          }else{

          }


      }else{
        header("Location: admin.php?p=basin");
      }

  }
 

?>

<div class="wrapper-content "> 

<div class="row">


<?php
  
  if($islem == "duzenle"){
    ?>


    <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=basin/basin_duzenle" onsubmit="return false;" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="<?=$_GET["id"];?>">

    	<div class="col-lg-12">
        <a class="btn aqua btn-lgy" href="admin.php?p=basin"><i class="fa fa-plus"> </i> Yeni Basın Haberi Ekle </a>
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>BASIN DÜZENLE</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>

              <div class="row">
              		
              		<div class="col-lg-3" style="text-align:center;">

	              <div class="fileinput fileinput-new" data-provides="fileinput">
	                <div class="fileinput-new thumbnail" style="width: 90%;">
	                <img data-src="" alt="Öne Çıkarılan Görsel" src="<?=$d_gorsel;?>" style="max-width: 90px; margin:0px 50px;"> </div>
	                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 180px;"></div>
	                <div> <span class="btn btn-default btn-file"><span class="fileinput-new">Görsel Seç</span><span class="fileinput-exists">Değiştir</span>
	                  <input type="file" name="gorsel" id="gorsel">
	                  </span> <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Sil</a> </div>
	              </div>


              </div>

              <div class="col-lg-6">

              		<div class="form-group">
		               <div class="input-icon">
		               <i class="fa fa-edit"></i>
		               <input class="form-control" placeholder="Basın Haberi Başlığı" type="text" name="baslik" id="baslik" value="<?=$d_baslik;?>">
		               </div>
		             </div>

		             <div class="form-group">
                  <label for="dtp_input2" class="col-md-2 control-label">Haber Tarihi</label>
                  <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2"
                    data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="<?=$d_tarih;?>" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                  </div>
                  <input type="hidden" id="dtp_input2" name="dtp_input2" value="<?=$d_tarih;?>" />
                  <br/>
                </div>

		              <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#kaydet" onclick="AjaxFormS('forms','form_status');">
		                  <i class="fa fa-check"></i>&nbsp;Düzenle
		                </button>

              	
              </div>

              </div>




              </div>
             </div>
           </div>
        </div>
        </div>
        </form>








    <?
  }else{
    ?>


    

    <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=basin/basin_ekle" onsubmit="return false;" enctype="multipart/form-data">

    	<div class="col-lg-12">
        <!-- <a class="btn aqua btn-lgy" href="admin.php?p=basin&islem=ekle"><i class="fa fa-plus"> </i> Yeni Kurum Ekle </a> -->
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>YENİ BASIN HABERİ EKLE</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>

              <div class="row">
              		
              		<div class="col-lg-3" style="text-align:center;">

	              <div class="fileinput fileinput-new" data-provides="fileinput">
	                <div class="fileinput-new thumbnail" style="width: 90%;">
	                <img data-src="" alt="Öne Çıkarılan Görsel" src="assets/gorsel_yok.png" style="max-width: 90px; margin:0px 50px;"> </div>
	                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 180px;"></div>
	                <div> <span class="btn btn-default btn-file"><span class="fileinput-new">Görsel Seç</span><span class="fileinput-exists">Değiştir</span>
	                  <input type="file" name="gorsel" id="gorsel">
	                  </span> <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Sil</a> </div>
	              </div>


              </div>

              <div class="col-lg-6">

              		<div class="form-group">
		               <div class="input-icon">
		               <i class="fa fa-edit"></i>
		               <input class="form-control" placeholder="Basın Haberi Başlığı" type="text" name="baslik" id="baslik">
		               </div>
		             </div>

		             <div class="form-group">
                  <label for="dtp_input2" class="col-md-2 control-label">Haber Tarihi</label>
                  <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2"
                    data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                  </div>
                  <input type="hidden" id="dtp_input2" name="dtp_input2" value="" />
                  <br/>
                </div>

		              <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#kaydet" onclick="AjaxFormS('forms','form_status');">
		                  <i class="fa fa-check"></i>&nbsp;Ekle
		                </button>

              	
              </div>

              </div>




              </div>
             </div>
           </div>
        </div>
        </div>
        </form>





    <?
  }

?>

<div class="col-lg-12">
        <!-- <a class="btn aqua btn-lgy" href="admin.php?p=basin&islem=ekle"><i class="fa fa-plus"> </i> Yeni Kurum Ekle </a> -->
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>BASINDA BİZ</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                <table id="example" class="table  responsive nowrap table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th style="max-width: 95px;">Görsel</th>
                      <th>Başlık</th>
                      <th>Tarih</th>
                      <th>İşlem</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Görsel</th>
                      <th>Başlık</th>
                      <th>Tarih</th>
                      <th>İşlem</th>
                    </tr>
                  </tfoot>
                  <tbody>

                  <?php

                    $basin = $wo_db->query("SELECT * FROM basin order by id DESC", PDO::FETCH_ASSOC);
                    if ( $basin->rowCount()){
                         foreach( $basin as $row ){


                          echo '
                            <tr id="veri'.$row["id"].'">
                              <td class="tablo_gorsel"><img src="'.gorsel_kontrol($row["gorsel"]).'" style="width: 90px; height: 70px;"></td>
                              <td id="tablo_yazi">'.$row["baslik"].'</td>
                              <td id="tablo_yazi">'.wo_tarih($row["tarih"]).'</td>
                              <td id="tablo_yazi" style="width:40px; text-align: center;">
                                
                                ';
                                ?>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#veri_sil" onclick="veri_sil('Seçili Basın Verisi','basin','<?=$row["id"];?>');"><i class="fa fa-close"></i> Sil</button>
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

</div>
       

