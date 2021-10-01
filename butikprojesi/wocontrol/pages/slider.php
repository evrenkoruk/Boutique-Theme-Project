<?php @session_start(); @ob_start();
  
  $islem = $_GET["islem"];
  $id = $_GET["id"];

  if($islem == "duzenle"){

     $kontrol = $wo_db->prepare("SELECT * FROM slider WHERE id = :id");
      $kontrol2 = $kontrol->execute(array(
           "id" => $id
      ));

      $say = $kontrol->rowCount();

      if($say > 0){
          
          foreach($kontrol as $veri){

            $d_baslik = $veri["baslik"];
            $d_aciklama = $veri["aciklama"];
            $d_url = $veri["url"];
            $d_gorsel = $veri["gorsel"];

          }

          if($d_gorsel == ""){

            $d_gorsel = "assets/gorsel_yok.png";

          }else{

          }


      }else{
        header("Location: admin.php?p=slider");
      }

  }
 

?>

<div class="wrapper-content "> 

<div class="row">


<?php
  
  if($islem == "duzenle"){
    ?>


    <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=slider/slider_duzenle" onsubmit="return false;" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="<?=$_GET["id"];?>">

    	<div class="col-lg-12">
        <a class="btn aqua btn-lgy" href="admin.php?p=slider"><i class="fa fa-plus"> </i> Yeni Slider Ekle </a>
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>SLİDER DÜZENLE</h5>

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
		               <input class="form-control" placeholder="Slider Başlığı" type="text" name="baslik" id="baslik" value="<?=$d_baslik;?>">
		               </div>
		             </div>

                 <div class="form-group">
                   <div class="input-icon">
                   <i class="fa fa-edit"></i>
                   <input class="form-control" placeholder="Açıklama Alanı" type="text" name="aciklama" id="aciklama" value="<?=$d_aciklama;?>">
                   </div>
                 </div>

		             <div class="form-group">
		               <div class="input-icon">
		               <i class="fa fa-link"></i>
		               <input class="form-control" placeholder="URL Adresi (Örn: http://sakaryabarosu.org.tr/haberler)" type="text" name="url" id="url" value="<?=$d_url;?>">
		               </div>
		             </div>

		              <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#kaydet" onclick="AjaxFormS('forms','form_status');">
		                  <i class="fa fa-check"></i>&nbsp;Slider Düzenle
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


    

    <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=slider/slider_ekle" onsubmit="return false;" enctype="multipart/form-data">

    	<div class="col-lg-12">
        <!-- <a class="btn aqua btn-lgy" href="admin.php?p=slider&islem=ekle"><i class="fa fa-plus"> </i> Yeni Kurum Ekle </a> -->
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>YENİ SLİDER EKLE</h5>

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
		               <input class="form-control" placeholder="Slider Başlığı" type="text" name="baslik" id="baslik">
		               </div>
		             </div>

                 <div class="form-group">
                   <div class="input-icon">
                   <i class="fa fa-edit"></i>
                   <input class="form-control" placeholder="Açıklama Alanı" type="text" name="aciklama" id="aciklama">
                   </div>
                 </div>

		             <div class="form-group">
		               <div class="input-icon">
		               <i class="fa fa-link"></i>
		               <input class="form-control" placeholder="URL Adresi (Örn: http://sakaryabarosu.org.tr/haberler)" type="text" name="url" id="url">
		               </div>
		             </div>

		              <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#kaydet" onclick="AjaxFormS('forms','form_status');">
		                  <i class="fa fa-check"></i>&nbsp;Slider Ekle
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
        <!-- <a class="btn aqua btn-lgy" href="admin.php?p=slider&islem=ekle"><i class="fa fa-plus"> </i> Yeni Kurum Ekle </a> -->
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>SLİDER YÖNETİMİ</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                <table id="example" class="table  responsive nowrap table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th style="max-width: 95px;">Görsel</th>
                      <th>Başlık</th>
                      <th>Açıklama</th>
                      <th>Url</th>
                      <th>Tarih</th>
                      <th>İşlem</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Görsel</th>
                      <th>Başlık</th>
                      <th>Açıklama</th>
                      <th>Url</th>
                      <th>İşlem</th>
                    </tr>
                  </tfoot>
                  <tbody>

                  <?php

                    $slider = $wo_db->query("SELECT * FROM slider order by id DESC", PDO::FETCH_ASSOC);
                    if ( $slider->rowCount()){
                         foreach( $slider as $row ){


                          echo '
                            <tr id="veri'.$row["id"].'">
                              <td class="tablo_gorsel"><img src="'.gorsel_kontrol($row["gorsel"]).'" style="width: 90px; height: 70px;"></td>
                              <td id="tablo_yazi">'.$row["baslik"].'</td>
                              <td id="tablo_yazi">'.$row["aciklama"].'</td>
                              <td id="tablo_yazi"><a href="'.$row["url"].'" target="_blank">'.$row["url"].'</a></td>
                              <td id="tablo_yazi" style="width:40px; text-align: center;">
                                <a class="btn aqua" href="admin.php?p=slider&islem=duzenle&id='.$row["id"].'"><i class="fa fa-edit"></i> Düzenle</a>
                                ';
                                ?>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#veri_sil" onclick="veri_sil('<?=$row["baslik"];?>','slider','<?=$row["id"];?>');"><i class="fa fa-close"></i> Sil</button>
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
       

