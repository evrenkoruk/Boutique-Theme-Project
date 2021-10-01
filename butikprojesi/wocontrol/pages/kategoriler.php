<?php @session_start(); @ob_start();
  
  $islem = $_GET["islem"];
  $id = $_GET["id"];

  if($islem == "duzenle"){

     $kontrol = $wo_db->prepare("SELECT * FROM duyuru_kategori WHERE id = :id");
      $kontrol2 = $kontrol->execute(array(
           "id" => $id
      ));

      $say = $kontrol->rowCount();

      if($say > 0){
          
          foreach($kontrol as $veri){

            $kategori_ad = $veri["kategori_ad"];

          }


      }else{
        header("Location: admin.php?p=kategoriler");
        exit();
      }

  }
 

?>

<div class="wrapper-content "> 

<div class="row">


<?php
  
  if($islem == "duzenle"){
    ?>


    <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=kategoriler/kategori_duzenle" onsubmit="return false;" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="<?=$_GET["id"];?>">

    	<div class="col-lg-12">
        <a class="btn aqua btn-lgy" href="admin.php?p=kategoriler"><i class="fa fa-plus"> </i> Yeni Kategori Ekle </a>
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>KATEGORİ DÜZENLE</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>

              <div class="row">

              <div class="col-lg-6">

              		<div class="form-group">
		               <div class="input-icon">
		               <i class="fa fa-edit"></i>
		               <input class="form-control" placeholder="Kategori Adı" type="text" name="kategori_ad" id="kategori_ad" value="<?=$kategori_ad;?>">
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


    

    <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=kategoriler/kategori_ekle" onsubmit="return false;" enctype="multipart/form-data">

    	<div class="col-lg-12">
        <!-- <a class="btn aqua btn-lgy" href="admin.php?p=sss&islem=ekle"><i class="fa fa-plus"> </i> Yeni Kurum Ekle </a> -->
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>YENİ KATEGORİ EKLE</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>

              <div class="row">

	              <div class="col-lg-5">

	              		<div class="form-group">
	              			<label>Kategori Adı :</label>
			               <div class="input-icon">
			               <i class="fa fa-edit"></i>
			               <input class="form-control" placeholder="" type="text" name="kategori_ad" id="kategori_ad" value="">
			               </div>
			             </div>


			              <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#kaydet" onclick="AjaxFormS('forms','form_status');">
			                  <i class="fa fa-check"></i>&nbsp;Yeni Kategori Ekle
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
            <h5>İçerik Kategorileri</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                <table id="example" class="table  responsive nowrap table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th style="max-width: 20px;">ID</th>
                      <th>Kategori</th>
                      <th>İşlem</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Kategori</th>
                      <th>İşlem</th>
                    </tr>
                  </tfoot>
                  <tbody>

                  <?php

                    $sss = $wo_db->query("SELECT * FROM duyuru_kategori order by id DESC", PDO::FETCH_ASSOC);
                    if ( $sss->rowCount()){
                         foreach( $sss as $row ){


                          echo '
                            <tr id="veri'.$row["id"].'">
                              <td id="tablo_yazi">'.$row["id"].'</td>
                              <td id="tablo_yazi">'.$row["kategori_ad"].'</td>
                              <td id="tablo_yazi" style="width:40px; text-align: center;">
                                <a class="btn aqua" href="admin.php?p=kategoriler&islem=duzenle&id='.$row["id"].'"><i class="fa fa-edit"></i> Düzenle</a>
                                ';
                                ?>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#veri_sil" onclick="veri_sil('<?=$row["kategori_ad"];?>','kategori','<?=$row["id"];?>');"><i class="fa fa-close"></i> Sil</button>
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
       

