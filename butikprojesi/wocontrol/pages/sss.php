<?php @session_start(); @ob_start();
  
  $islem = $_GET["islem"];
  $id = $_GET["id"];

  if($islem == "duzenle"){

     $kontrol = $wo_db->prepare("SELECT * FROM sss WHERE id = :id");
      $kontrol2 = $kontrol->execute(array(
           "id" => $id
      ));

      $say = $kontrol->rowCount();

      if($say > 0){
          
          foreach($kontrol as $veri){

            $d_soru = $veri["soru"];
            $d_cevap = $veri["cevap"];
            $d_sira = $veri["sira"];

          }


      }else{
        header("Location: admin.php?p=sss");
        exit();
      }

  }
 

?>

<div class="wrapper-content "> 

<div class="row">


<?php
  
  if($islem == "duzenle"){
    ?>


    <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=sss/sss_duzenle" onsubmit="return false;" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="<?=$_GET["id"];?>">

    	<div class="col-lg-12">
        <a class="btn aqua btn-lgy" href="admin.php?p=sss"><i class="fa fa-plus"> </i> Yeni Soru Ekle </a>
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>S.S.S DÜZENLE</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>

              <div class="row">

              <div class="col-lg-6">

              		<div class="form-group">
		               <div class="input-icon">
		               <i class="fa fa-edit"></i>
		               <input class="form-control" placeholder="Soru ?" type="text" name="soru" id="soru" value="<?=$d_soru;?>">
		               </div>
		             </div>

		             <div class="form-group">
		               <div class="input-icon">
		               <i class="fa fa-edit"></i>
		               <textarea class="form-control" placeholder="Cevap" name="cevap" id="cevap"><?=$d_cevap;?></textarea>
		               </div>
		             </div>

		             <div class="form-group">
		               <div class="input-icon">
		               <i class="fa fa-edit"></i>
		               <input class="form-control" placeholder="0" type="number" name="sira" id="sira" value="<?=$d_sira;?>">
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


    

    <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=sss/sss_ekle" onsubmit="return false;" enctype="multipart/form-data">

    	<div class="col-lg-12">
        <!-- <a class="btn aqua btn-lgy" href="admin.php?p=sss&islem=ekle"><i class="fa fa-plus"> </i> Yeni Kurum Ekle </a> -->
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>YENİ SORU EKLE</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>

              <div class="row">

	              <div class="col-lg-5">

	              		<div class="form-group">
	              			<label>Soru :</label>
			               <div class="input-icon">
			               <i class="fa fa-question"></i>
			               <input class="form-control" placeholder="" type="text" name="soru" id="soru" value="<?=$d_soru;?>">
			               </div>
			             </div>

			             <div class="form-group">
			             	<label>Cevap :</label>
			               <div class="input-icon">
			               <i class="fa fa-edit"></i>
			               <textarea class="form-control" placeholder="" name="cevap" id="cevap"><?=$d_cevap;?></textarea>
			               </div>
			             </div>

			             <div class="form-group">
			             <label>Sıra :</label>
			               <div class="input-icon">
			               <i class="fa fa-edit"></i>
			               <input class="form-control" placeholder="0" type="number" name="sira" id="sira" value="<?=$d_sira;?>">
			               </div>
			             </div>


			              <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#kaydet" onclick="AjaxFormS('forms','form_status');">
			                  <i class="fa fa-check"></i>&nbsp;Yeni Soru Ekle
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
        <!-- <a class="btn aqua btn-lgy" href="admin.php?p=sss&islem=ekle"><i class="fa fa-plus"> </i> Yeni Kurum Ekle </a> -->
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>S.S.S. YÖNETİMİ</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                <table id="example" class="table  responsive nowrap table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th style="max-width: 20px;">Sıra</th>
                      <th>Soru</th>
                      <th>İşlem</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Sıra</th>
                      <th>Soru</th>
                      <th>İşlem</th>
                    </tr>
                  </tfoot>
                  <tbody>

                  <?php

                    $sss = $wo_db->query("SELECT * FROM sss order by sira DESC", PDO::FETCH_ASSOC);
                    if ( $sss->rowCount()){
                         foreach( $sss as $row ){


                          echo '
                            <tr id="veri'.$row["id"].'">
                              <td id="tablo_yazi">'.$row["sira"].'</td>
                              <td id="tablo_yazi">'.$row["soru"].'</td>
                              <td id="tablo_yazi" style="width:40px; text-align: center;">
                                <a class="btn aqua" href="admin.php?p=sss&islem=duzenle&id='.$row["id"].'"><i class="fa fa-edit"></i> Düzenle</a>
                                ';
                                ?>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#veri_sil" onclick="veri_sil('<?=$row["soru"];?>','sss','<?=$row["id"];?>');"><i class="fa fa-close"></i> Sil</button>
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
       

