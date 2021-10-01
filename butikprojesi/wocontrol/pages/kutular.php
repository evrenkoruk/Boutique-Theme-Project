<?php @session_start(); @ob_start();


     $kontrol = $wo_db->prepare("SELECT * FROM kutular WHERE id = :id");
      $kontrol2 = $kontrol->execute(array(
           "id" => 1
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


      }
 

?>

<div class="wrapper-content "> 

<div class="row">



 <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=kutular/duzenle" onsubmit="return false;" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="1">

      <div class="col-lg-12">
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>1. KUTU DÜZENLE</h5>

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
                   <input class="form-control" placeholder="1. Kutu Başlığı" type="text" name="baslik" id="baslik" value="<?=$d_baslik;?>">
                   </div>
                 </div>

                  <div class="form-group">
                   <div class="input-icon">
                   <i class="fa fa-edit"></i>
                   <input class="form-control" placeholder="Açıklama" type="text" name="aciklama" id="aciklama" value="<?=$d_aciklama;?>">
                   </div>
                 </div>

                 <div class="form-group">
                   <div class="input-icon">
                   <i class="fa fa-edit"></i>
                   <input class="form-control" placeholder="URL" type="text" name="url" id="url" value="<?=$d_url;?>">
                   </div>
                 </div>

                  <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#kaydet" onclick="AjaxFormS('forms','form_status');">
                      <i class="fa fa-check"></i>&nbsp;Kutuyu Düzenle
                    </button>

                
              </div>

              </div>




              </div>
             </div>
           </div>
        </div>
        </div>
        </form>








<?php


     $kontrol = $wo_db->prepare("SELECT * FROM kutular WHERE id = :id");
      $kontrol2 = $kontrol->execute(array(
           "id" => 2
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


      }
 

?>





 <form role="form" class="form-horizontal"  id="formss" name="formss" method="POST" action="ajax.php?p=kutular/duzenle" onsubmit="return false;" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="2">

      <div class="col-lg-12">
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>2. KUTU DÜZENLE</h5>

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
                   <input class="form-control" placeholder="1. Kutu Başlığı" type="text" name="baslik" id="baslik" value="<?=$d_baslik;?>">
                   </div>
                 </div>

                  <div class="form-group">
                   <div class="input-icon">
                   <i class="fa fa-edit"></i>
                   <input class="form-control" placeholder="Açıklama" type="text" name="aciklama" id="aciklama" value="<?=$d_aciklama;?>">
                   </div>
                 </div>

                 <div class="form-group">
                   <div class="input-icon">
                   <i class="fa fa-edit"></i>
                   <input class="form-control" placeholder="URL" type="text" name="url" id="url" value="<?=$d_url;?>">
                   </div>
                 </div>

                  <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#kaydet" onclick="AjaxFormS('formss','form_status');">
                      <i class="fa fa-check"></i>&nbsp;Kutuyu Düzenle
                    </button>

                
              </div>

              </div>




              </div>
             </div>
           </div>
        </div>
        </div>
        </form>



</div>

</div>
       

