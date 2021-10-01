<?php @session_start(); @ob_start();

  $islem = $_GET["islem"];
  $id = $_GET["id"];

  if($islem == "duzenle"){

     $kontrol = $wo_db->prepare("SELECT * FROM ilanlar WHERE id = :id");
      $kontrol2 = $kontrol->execute(array(
           "id" => $id
      ));

      $say = $kontrol->rowCount();

      if($say > 0){
          
          foreach($kontrol as $veri){

            $d_ilantip = $veri["ilan_tip"];
            $d_baslik = $veri["baslik"];
            $d_adsoyad = $veri["adsoyad"];
            $d_telefon = $veri["telefon"];
            $d_email = $veri["email"];
            $d_icerik = $veri["icerik"];
            $d_tarih = $veri["tarih"];
            $d_yayin = $veri["yayin"];

          }


      }else{
        header("Location: admin.php?p=ilanlar");
        exit();
      }

  }


$ilanlar = $wo_db->query("SELECT * FROM ilanlar WHERE yayin=0 ORDER BY id DESC", PDO::FETCH_ASSOC);
$ilanlar2 = $wo_db->query("SELECT * FROM ilanlar WHERE yayin=1 ORDER BY id DESC", PDO::FETCH_ASSOC);
$ilanlar3 = $wo_db->query("SELECT * FROM ilanlar WHERE yayin=2 ORDER BY id DESC", PDO::FETCH_ASSOC);
 
$bekleyen_row	 	= $ilanlar->rowCount();
$onaylanan_row	 	= $ilanlar2->rowCount();
$onaylanmayan_row	= $ilanlar3->rowCount();	


?>

<div class="wrapper-content ">

<?php

	if($islem == "duzenle"){
?>

<div class="row">
    
      <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=ilanlar/ilan_duzenle" onsubmit="return false;" enctype="multipart/form-data">
      <input type="hidden" name="id" id="id" value="<?=$_GET["id"];?>">
      <div class="col-lg-9">

        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>İLAN DÜZENLE</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                
              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-edit"></i>
                <input class="form-control" placeholder="İlan Başlığı" type="text" name="baslik" id="baslik" value="<?=$d_baslik;?>">
                </div>
              </div>

              <div class="form-group">
               <div class="input-icon">
               <i class="fa fa-edit"></i>
               <textarea class="form-control" placeholder="İlan İçeriği" name="icerik" id="icerik" style="min-height: 200px;"><?=strip_tags($d_icerik);?></textarea>
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
            <h5>İLAN BİLGİLERİ</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container" style="">
              <div>
                  
                  <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control" placeholder="Ad Soyad" type="text" name="adsoyad" id="adsoyad" value="<?=$d_adsoyad;?>">
                </div>
              </div>

              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-phone"></i>
                <input class="form-control" placeholder="Telefon" type="text" name="telefon" id="telefon" value="<?=$d_telefon;?>">
                </div>
              </div>

              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control" placeholder="E-Mail Adresi" type="text" name="email" id="email" value="<?=$d_email;?>">
                </div>
              </div>
                 



              </div>
            </div>
          </div>
        </div>


        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>İLAN TİP</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container" style="text-align: center;">
              <div>
                   <div class="form-group">
                     <select class="form-control bottom15" name="ilan_tip" id="ilan_tip">
                       
                       <?php

                         $duyuru_kategori = $wo_db->query("SELECT * FROM ilanlar_tip order by id ASC", PDO::FETCH_ASSOC);
                          if($duyuru_kategori->rowCount()){
                              foreach( $duyuru_kategori as $kat ){
                                if($d_ilantip == $kat["id"]){
                                  echo '<option value="'.$kat["id"].'" selected>'.$kat["ilan_tip"].'</option>';
                                }else{
                                  echo '<option value="'.$kat["id"].'">'.$kat["ilan_tip"].'</option>';
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
          <!-- tabs -->
          <div class="col-lg-12 top20">
            <div class="tabs-container">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab-1" data-toggle="tab" aria-expanded="true" style="color: #d48725;"> Onay Bekleyen Rezervasyonlar (<?=$bekleyen_row;?>)</a></li>
                <li class=""><a href="#tab-2" data-toggle="tab" aria-expanded="false" style="color: #229a21;">Onaylanan Rezervasyonlar (<?=$onaylanan_row;?>) </a></li>
                <li class=""><a href="#tab-3" data-toggle="tab" aria-expanded="false">İptal Edilen Rezervasyonlar (<?=$onaylanmayan_row;?>) </a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab-1">
                  <div class="panel-body">


                  		<div class="col-lg-12">
					       <table id="example" class="table  responsive nowrap table-bordered" cellspacing="0" width="100%">
			                  <thead>
			                    <tr>
			                      <th>Tarih</th>
			                      <th>Rezervasyon Tarihi</th>
			                      <th>Rezervasyon Detayları</th>
			                      <th>Ad Soyad</th>
			                      <th>Telefon</th>
			                      <th>İşlem</th>
			                    </tr>
			                  </thead>
			                  <tfoot>
			                    <tr>
			                      <th>Tarih</th>
			                      <th>Rezervasyon Tarihi</th>
			                      <th>Rezervasyon Detayları</th>
			                      <th>Ad Soyad</th>
			                      <th>Telefon</th>
			                      <th>İşlem</th>
			                    </tr>
			                  </tfoot>
			                  <tbody>

			                  <?php

			                  	
			                    if ( $ilanlar->rowCount()){
			                         foreach( $ilanlar as $row ){

			                          echo '
			                            <tr id="veri'.$row["id"].'">
			                              <td id="tablo_yazi">'.wo_tarih($row["tarih"]).'</td>
			                              <td id="tablo_yazi">'.$row["rtarih"].' - '.$row["rsaat"].'</td>
			                              ';
			                              ?>
			                              <td id="tablo_yazi" data-toggle="modal" data-target="#ilan_oku" onclick="ilan_oku('<?=$row["baslik"];?>','<?=$row["id"];?>');"><a href="javascript:;"><?=$row["baslik"];?></a></td>
			                              <?
			                              echo '<td id="tablo_yazi">'.$row["adsoyad"].'</td>
			                              <td id="tablo_yazi">'.$row["telefon"].'</td>
			                              <td id="tablo_yazi" style="width:40px; text-align: center;">
			                                ';
			                                ?>
			                                <button class="btn btn-success" data-toggle="modal" data-target="#ilan_islem" onclick="ilan_yayinla('<?=$row["baslik"];?>','<?=$row["id"];?>');"><i class="fa fa-check"></i> Onayla</button>
			                                <button class="btn btn-warning" data-toggle="modal" data-target="#ilan_islem" onclick="ilan_pasif('<?=$row["baslik"];?>','<?=$row["id"];?>');"><i class="fa fa-check"></i> İptal Et</button>
			                                <button class="btn btn-danger" data-toggle="modal" data-target="#veri_sil" onclick="veri_sil('<?=$row["baslik"];?>','ilanlar','<?=$row["id"];?>');"><i class="fa fa-close"></i> Sil</button>
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
                <div class="tab-pane" id="tab-2">
                  <div class="panel-body"> 
                  	<div class="col-lg-12">
					       <table id="wo_tablo" class="table  responsive nowrap table-bordered" cellspacing="0" width="100%">
			                  <thead>
			                    <tr>
			                      <th>Tarih</th>
			                      <th>Rezervasyon Tarihi</th>
			                      <th>Rezervasyon Detayları</th>
			                      <th>Ad Soyad</th>
			                      <th>Telefon</th>
			                      <th>İşlem</th>
			                    </tr>
			                  </thead>
			                  <tfoot>
			                    <tr>
			                      <th>Tarih</th>
			                      <th>Rezervasyon Tarihi</th>
			                      <th>Rezervasyon Detayları</th>
			                      <th>Ad Soyad</th>
			                      <th>Telefon</th>
			                      <th>İşlem</th>
			                    </tr>
			                  </tfoot>
			                  <tbody>

			                  <?php

			                  	
			                    if ( $ilanlar2->rowCount()){
			                         foreach( $ilanlar2 as $row ){

			                          echo '
			                            <tr id="veri'.$row["id"].'">
			                              <td id="tablo_yazi">'.wo_tarih($row["tarih"]).'</td>
			                              <td id="tablo_yazi">'.$row["rtarih"].' - '.$row["rsaat"].'</td>
			                              ';
			                              ?>
			                              <td id="tablo_yazi" data-toggle="modal" data-target="#ilan_oku" onclick="ilan_oku('<?=$row["baslik"];?>','<?=$row["id"];?>');"><a href="javascript:;"><?=$row["baslik"];?></a></td>
			                              <?
			                              echo '
			                              <td id="tablo_yazi">'.$row["adsoyad"].'</td>
			                              <td id="tablo_yazi">'.$row["telefon"].'</td>
			                              <td id="tablo_yazi" style="width:40px; text-align: center;">
			                                ';
			                                ?>
			                                <button class="btn btn-warning" data-toggle="modal" data-target="#ilan_islem" onclick="ilan_pasif('<?=$row["baslik"];?>','<?=$row["id"];?>');"><i class="fa fa-check"></i> İptal Et</button>
			                                <button class="btn btn-danger" data-toggle="modal" data-target="#veri_sil" onclick="veri_sil('<?=$row["baslik"];?>','ilanlar','<?=$row["id"];?>');"><i class="fa fa-close"></i> Sil</button>
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
                <div class="tab-pane" id="tab-3">
                  <div class="panel-body">

                  <div class="col-lg-12">
					       <table id="wo_tabloo" class="table  responsive nowrap table-bordered" cellspacing="0" width="100%">
			                  <thead>
			                    <tr>
			                      <th>Tarih</th>
			                      <th>Rezervasyon Tarihi</th>
			                      <th>Rezervasyon Detayları</th>
			                      <th>Ad Soyad</th>
			                      <th>Telefon</th>
			                      <th>İşlem</th>
			                    </tr>
			                  </thead>
			                  <tfoot>
			                    <tr>
			                      <th>Tarih</th>
			                      <th>Rezervasyon Tarihi</th>
			                      <th>Rezervasyon Detayları</th>
			                      <th>Ad Soyad</th>
			                      <th>Telefon</th>
			                      <th>İşlem</th>
			                    </tr>
			                  </tfoot>
			                  <tbody>

			                  <?php

			                  	
			                    if ( $ilanlar3->rowCount()){
			                         foreach( $ilanlar3 as $row ){

			                          echo '
			                            <tr id="veri'.$row["id"].'">
			                              <td id="tablo_yazi">'.wo_tarih($row["tarih"]).'</td>
			                              <td id="tablo_yazi">'.$row["rtarih"].' - '.$row["rsaat"].'</td>
			                              ';
			                              ?>
			                              <td id="tablo_yazi" data-toggle="modal" data-target="#ilan_oku" onclick="ilan_oku('<?=$row["baslik"];?>','<?=$row["id"];?>');"><a href="javascript:;"><?=$row["baslik"];?></a></td>
			                              <?
			                              echo '
			                              <td id="tablo_yazi">'.$row["adsoyad"].'</td>
			                              <td id="tablo_yazi">'.$row["telefon"].'</td>
			                              <td id="tablo_yazi" style="width:40px; text-align: center;">
			                                ';
			                                ?>
			                                <button class="btn btn-success" data-toggle="modal" data-target="#ilan_islem" onclick="ilan_yayinla('<?=$row["baslik"];?>','<?=$row["id"];?>');"><i class="fa fa-check"></i> Onayla</button>
			                                <button class="btn btn-danger" data-toggle="modal" data-target="#veri_sil" onclick="veri_sil('<?=$row["baslik"];?>','ilanlar','<?=$row["id"];?>');"><i class="fa fa-close"></i> Sil</button>
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
          <!-- tabs -->
        </div>


        <?
	}

?> 


</div>
            
