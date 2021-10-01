<?php @session_start(); @ob_start();

  $islem = $_GET["islem"];
  $id = $_GET["id"];


$ilanlar = $wo_db->query("SELECT * FROM mesajlar WHERE okundu=0 ORDER BY id DESC", PDO::FETCH_ASSOC);
$ilanlar2 = $wo_db->query("SELECT * FROM mesajlar WHERE okundu=1 ORDER BY id DESC", PDO::FETCH_ASSOC);
 
$bekleyen_row	 	= $ilanlar->rowCount();
$onaylanan_row	 	= $ilanlar2->rowCount();	


?>

<div class="wrapper-content ">

<?php

	if($islem == "duzenle"){
?>

	<!-- mesaj düzenleme yok -->

<?
	}else{
?>

<div class="row">
          <!-- tabs -->
          <div class="col-lg-12 top20">
            <div class="tabs-container">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab-1" data-toggle="tab" aria-expanded="true" style="color: #d48725;"> Yeni Mesajlar (<?=$bekleyen_row;?>)</a></li>
                <li class=""><a href="#tab-2" data-toggle="tab" aria-expanded="false" style="color: #229a21;">Okunan Mesajlar (<?=$onaylanan_row;?>) </a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab-1">
                  <div class="panel-body">


                  		<div class="col-lg-12">
					       <table id="example" class="table  responsive nowrap table-bordered" cellspacing="0" width="100%">
			                  <thead>
			                    <tr>
			                      <th>Tarih</th>
			                      <th>Ad Soyad</th>
			                      <th>Mesaj</th>
			                      <th>Telefon</th>
			                      <th>E-mail</th>
			                      <th>İşlem</th>
			                    </tr>
			                  </thead>
			                  <tfoot>
			                    <tr>
			                      <th>Tarih</th>
			                      <th>Ad Soyad</th>
			                      <th>Mesaj</th>
			                      <th>Telefon</th>
			                      <th>E-mail</th>
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
			                              <td id="tablo_yazi">'.$row["adsoyad"].'</td>';
			                              ?>
			                              <td id="tablo_yazi" data-toggle="modal" data-target="#ilan_oku" onclick="mesaj_oku('Gelen Kutusu','<?=$row["id"];?>');"><a href="javascript:;">Mesaj İçeriğini Gör</a></td>
			                              <?
			                              echo '
			                              <td id="tablo_yazi">'.$row["telefon"].'</td>
			                              <td id="tablo_yazi">'.$row["email"].'</td>
			                              <td id="tablo_yazi" style="width:40px; text-align: center;">
			                                ';
			                                ?>
			                                <button class="btn btn-danger" data-toggle="modal" data-target="#veri_sil" onclick="veri_sil('<?=$row["baslik"];?>','mesajlar','<?=$row["id"];?>');"><i class="fa fa-close"></i> Sil</button>
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
			                      <th>Ad Soyad</th>
			                      <th>Mesaj</th>
			                      <th>Telefon</th>
			                      <th>E-mail</th>
			                      <th>İşlem</th>
			                    </tr>
			                  </thead>
			                  <tfoot>
			                    <tr>
			                      <th>Tarih</th>
			                      <th>Ad Soyad</th>
			                      <th>Mesaj</th>
			                      <th>Telefon</th>
			                      <th>E-mail</th>
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
			                              <td id="tablo_yazi">'.$row["adsoyad"].'</td>';
			                              ?>
			                              <td id="tablo_yazi" data-toggle="modal" data-target="#ilan_oku" onclick="mesaj_oku('Gelen Kutusu','<?=$row["id"];?>');"><a href="javascript:;">Mesaj İçeriğini Gör</a></td>
			                              <?
			                              echo '
			                              <td id="tablo_yazi">'.$row["telefon"].'</td>
			                              <td id="tablo_yazi">'.$row["email"].'</td>
			                              <td id="tablo_yazi" style="width:40px; text-align: center;">
			                                ';
			                                ?>
			                                <button class="btn btn-danger" data-toggle="modal" data-target="#veri_sil" onclick="veri_sil('<?=$row["baslik"];?>','mesajlar','<?=$row["id"];?>');"><i class="fa fa-close"></i> Sil</button>
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
            
