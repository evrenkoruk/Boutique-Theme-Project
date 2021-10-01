<?php @session_start(); @ob_start();
  
  $islem = $_GET["islem"];
  $id = $_GET["id"];

  if($islem == "duzenle"){

     $kontrol = $wo_db->prepare("SELECT * FROM linkler WHERE id = :id");
      $kontrol2 = $kontrol->execute(array(
           "id" => $id
      ));

      $say = $kontrol->rowCount();

      if($say > 0){
          
          foreach($kontrol as $veri){

            $l_baslik = $veri["baslik"];
            $l_url    = $veri["link"];
            $l_sira   = $veri["sira"];

          }

      }else{
        header("Location: admin.php?p=linkler");
        exit();
      }

  }
 

?>

<div class="wrapper-content "> 

<div class="row">


<?php
  
  if($islem == "duzenle"){
    ?>


    <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=linkler/link_duzenle" onsubmit="return false;" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="<?=$_GET["id"];?>">

    	<div class="col-lg-12">
        <a class="btn aqua btn-lgy" href="admin.php?p=linkler"><i class="fa fa-plus"> </i> Yeni Link Ekle </a>
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>LİNK DÜZENLE</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>

              <div class="row">

              <div class="col-lg-6">
              		<div class="form-group">
		               <div class="input-icon">
		               <i class="fa fa-edit"></i>
		               <input class="form-control" placeholder="Link Başlığı" type="text" name="baslik" id="baslik" value="<?=$l_baslik;?>">
		               </div>
		             </div>

                 <div class="form-group">
                   <div class="input-icon">
                   <i class="fa fa-edit"></i>
                   <input class="form-control" placeholder="Url Adresi (Örn: http://sakaryabarosu.org.tr/haberler.html)" type="text" name="link" id="link" value="<?=$l_url;?>">
                   </div>
                 </div>

		             <div class="form-group">
		               <div class="input-icon">
		               <i class="fa fa-edit"></i>
		               <input class="form-control" placeholder="0" type="number" name="sira" id="sira" value="<?=$l_sira;?>">
		               </div>
		             </div>


		              <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#kaydet" onclick="AjaxFormS('forms','form_status');">
		                  <i class="fa fa-check"></i>&nbsp;Değişiklikleri Kaydet
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


    

    <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=linkler/link_ekle" onsubmit="return false;" enctype="multipart/form-data">

    	<div class="col-lg-12">
        <!-- <a class="btn aqua btn-lgy" href="admin.php?p=linkler&islem=ekle"><i class="fa fa-plus"> </i> Yeni Kurum Ekle </a> -->
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>YENİ LİNK EKLE</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>

              <div class="row">

	              <div class="col-lg-5">

	              	<div class="form-group">
                   <div class="input-icon">
                   <i class="fa fa-edit"></i>
                   <input class="form-control" placeholder="Link Başlığı" type="text" name="baslik" id="baslik" value="">
                   </div>
                 </div>

                 <div class="form-group">
                   <div class="input-icon">
                   <i class="fa fa-edit"></i>
                   <input class="form-control" placeholder="Url Adresi (Örn: http://sakaryabarosu.org.tr/haberler.html)" type="text" name="link" id="link" value="">
                   </div>
                 </div>

                 <div class="form-group">
                   <div class="input-icon">
                   <i class="fa fa-edit"></i>
                   <input class="form-control" placeholder="0" type="number" name="sira" id="sira" value="">
                   </div>
                 </div>



			              <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#kaydet" onclick="AjaxFormS('forms','form_status');">
			                  <i class="fa fa-check"></i>&nbsp;Yeni Link Ekle
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
        <!-- <a class="btn aqua btn-lgy" href="admin.php?p=linkler&islem=ekle"><i class="fa fa-plus"> </i> Yeni Kurum Ekle </a> -->
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>LİNK YÖNETİMİ</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                <table id="example" class="table  responsive nowrap table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th style="max-width: 20px;">Sıra</th>
                      <th>Başlık</th>
                      <th>Link</th>
                      <th>İşlem</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Sıra</th>
                      <th>Başlık</th>
                      <th>Link</th>
                      <th>İşlem</th>
                    </tr>
                  </tfoot>
                  <tbody>

                  <?php

                    $linkler = $wo_db->query("SELECT * FROM linkler order by sira DESC", PDO::FETCH_ASSOC);
                    if ( $linkler->rowCount()){
                         foreach( $linkler as $row ){


                          echo '
                            <tr id="veri'.$row["id"].'">
                              <td id="tablo_yazi">'.$row["sira"].'</td>
                              <td id="tablo_yazi">'.$row["baslik"].'</td>
                              <td id="tablo_yazi"><a href="'.$row["link"].'" target="_blank">'.$row["link"].'</a></td>
                              <td id="tablo_yazi" style="width:40px; text-align: center;">
                                <a class="btn aqua" href="admin.php?p=linkler&islem=duzenle&id='.$row["id"].'"><i class="fa fa-edit"></i> Düzenle</a>
                                ';
                                ?>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#veri_sil" onclick="veri_sil('<?=$row["Link"];?>','linkler','<?=$row["id"];?>');"><i class="fa fa-close"></i> Sil</button>
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
       

