<?php @session_start(); @ob_start();
  
  $islem = $_GET["islem"];
  $id = $_GET["id"];

  if($islem == "duzenle"){

     $kontrol = $wo_db->prepare("SELECT * FROM urun_gruplar WHERE id = :id");
      $kontrol2 = $kontrol->execute(array(
           "id" => $id
      ));

      $say = $kontrol->rowCount();

      if($say > 0){
          
          foreach($kontrol as $veri){

            $kategori_id = $veri["kategori_id"];
            $altkategori_id = $veri["altkategori_id"];
            $baslik = $veri["baslik"];

          }


      }else{
        header("Location: admin.php?p=urunler_kategoriler");
        exit();
      }

  }
 

?>

<div class="wrapper-content "> 

<div class="row">


<?php
  
  if($islem == "duzenle"){
    ?>


    <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=urunler/grup_duzenle" onsubmit="return false;" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="<?=$_GET["id"];?>">

    	<div class="col-lg-12">
        <a class="btn aqua btn-lgy" href="admin.php?p=urun_gruplar"><i class="fa fa-plus"> </i> Yeni Ürün Grubu Ekle </a>
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>ÜRÜN GRUBU DÜZENLE</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>

              <div class="row">



               <div class="col-lg-5">

                  <div class="form-group" style="text-align: left;">
                    <label>Ürün Kategorisi</label>
                     <select class="form-control bottom10" name="ust_id" id="ust_id" onchange="kat_cek(this);">
                      <option value="">Ürün Kategorisi Seçiniz</option>
                       <?php
                        $sayfa_kategori = $wo_db->query("SELECT * FROM sayfalar where ust_id=5", PDO::FETCH_ASSOC);
                         
                          if($sayfa_kategori->rowCount()){
                              foreach( $sayfa_kategori as $wos ){
                                if($kategori_id == $wos["id"]){
                                  echo '<option value="'.$wos["id"].'" selected>'.$wos["baslik"].'</option>';
                                }else{
                                  echo '<option value="'.$wos["id"].'">'.$wos["baslik"].'</option>';
                                }
                              }
                          }

                       ?>

                    </select>


                    </div>

                    <div class="form-group" style="text-align: left;">
                      <label>Alt Kategori</label>
                         <select class="form-control" name="altkat_id" id="altkat_id">
                          <option value="">Ürün Kategorisi Seçiniz</option>
                          <?php
                          $sayfa_kategori = $wo_db->query("SELECT * FROM sayfalar where ust_id=$kategori_id", PDO::FETCH_ASSOC);
                           
                            if($sayfa_kategori->rowCount()){
                                foreach( $sayfa_kategori as $wos ){
                                  if($altkategori_id == $wos["id"]){
                                    echo '<option value="'.$wos["id"].'" selected>'.$wos["baslik"].'</option>';
                                  }else{
                                    echo '<option value="'.$wos["id"].'">'.$wos["baslik"].'</option>';
                                  }
                                }
                            }

                         ?>
                        </select>
                    </div>

                    <div class="form-group">
                      <label>Grup Adı :</label>
                     <div class="input-icon">
                     <i class="fa fa-edit"></i>
                     <input class="form-control" placeholder="" type="text" name="baslik" id="baslik" value="<?=$baslik;?>">
                     </div>
                   </div>



                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#kaydet" onclick="AjaxFormS('forms','form_status');">
                        <i class="fa fa-check"></i>&nbsp;Grup Düzenle
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


    

    <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=urunler/grup_ekle" onsubmit="return false;" enctype="multipart/form-data">

    	<div class="col-lg-12">
        <!-- <a class="btn aqua btn-lgy" href="admin.php?p=sss&islem=ekle"><i class="fa fa-plus"> </i> Yeni Kurum Ekle </a> -->
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>YENİ GRUP EKLE</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>

              <div class="row">


	              <div class="col-lg-5">

                  <div class="form-group" style="text-align: left;">
                    <label>Ürün Kategorisi</label>
                     <select class="form-control bottom10" name="ust_id" id="ust_id" onchange="kat_cek(this);">
                      <option value="">Ürün Kategorisi Seçiniz</option>
                       <?php
                        $sayfa_kategori = $wo_db->query("SELECT * FROM sayfalar where ust_id=5", PDO::FETCH_ASSOC);
                         
                          if($sayfa_kategori->rowCount()){
                              foreach( $sayfa_kategori as $wos ){
                                echo '<option value="'.$wos["id"].'">'.$wos["baslik"].'</option>';
                              }
                          }

                       ?>

                    </select>


                    </div>

                    <div class="form-group" style="text-align: left;">
                      <label>Alt Kategori</label>
                         <select class="form-control" name="altkat_id" id="altkat_id">
                          <option value="">Ürün Kategorisi Seçiniz</option>
                        </select>
                    </div>

	              		<div class="form-group">
	              			<label>Grup Adı :</label>
			               <div class="input-icon">
			               <i class="fa fa-edit"></i>
			               <input class="form-control" placeholder="" type="text" name="baslik" id="baslik" value="">
			               </div>
			             </div>



			              <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#kaydet" onclick="AjaxFormS('forms','form_status');">
			                  <i class="fa fa-check"></i>&nbsp;Yeni Grup Ekle
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
                      <th>Kategori</th>
                      <th>Grup Adı</th>
                      <th>İşlem</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Kategori</th>
                      <th>Grup Adı</th>
                      <th>İşlem</th>
                    </tr>
                  </tfoot>
                  <tbody>

                  <?php

                    $sss = $wo_db->query("SELECT * FROM urun_gruplar order by id DESC", PDO::FETCH_ASSOC);
                    if ( $sss->rowCount()){
                         foreach( $sss as $row ){


                          echo '
                            <tr id="veri'.$row["id"].'">
                              <td id="tablo_yazi">'.sayfa_ad($row["kategori_id"]).' > '.sayfa_ad($row["altkategori_id"]).'</td>
                              <td id="tablo_yazi">'.$row["baslik"].'</td>
                              <td id="tablo_yazi" style="width:40px; text-align: center;">
                                <a class="btn aqua" href="admin.php?p=urun_gruplar&islem=duzenle&id='.$row["id"].'"><i class="fa fa-edit"></i> Düzenle</a>
                                ';
                                ?>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#veri_sil" onclick="veri_sil('<?=$row["baslik"];?>','urun_gruplar','<?=$row["id"];?>');"><i class="fa fa-close"></i> Sil</button>
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



<script type="text/javascript">

  function kat_cek(id){

    var gelen = id.value;

    $.ajax({
        url:'altkategoriler.php?id='+gelen, // serileştirilen değerleri ajax.php dosyasına
        type:'GET', // post metodu ile 
        success:function(e){ // gonderme işlemi başarılı ise e değişkeni ile gelen değerleri aldı
          $("#altkat_id").html(""); // div elemanını her gönderme işleminde boşalttı ve gelen verileri içine attı
          $("#altkat_id").html(e); // div elemanını her gönderme işleminde boşalttı ve gelen verileri içine attı
          
          // if(e == ""){
          //  $("#tarifebildirim").hide();

          // }else{

          //  $("#tarifebildirim").html("Kayıtlı Tarife("+e+" TL) Uygulama Ücretine Eklendi");
          //  $("#tarifebildirim").show(300);
            
          // }
          


        }
      });

  }
</script>
       

