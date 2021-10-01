<?php @session_start(); @ob_start();

  $gelen = $_GET["id"];

  if($_SESSION["yetki"] == 1){

    if($gelen != ""){
      $id = $gelen;
    }else{
      $id = $_SESSION["admin_id"];
    }


  }else{
    $id = $_SESSION["admin_id"];
  }

  


     $kontrol = $wo_db->prepare("SELECT * FROM user WHERE id = :id");
      $kontrol2 = $kontrol->execute(array(
           "id" => $id
      ));

      $say = $kontrol->rowCount();

      if($say > 0){
          
          foreach($kontrol as $veri){

            $adsoyad    = $veri["adsoyad"];
            $email      = $veri["email"];
            $aciklama   = $veri["aciklama"];
            $twitter    = $veri["twitter"];
            $facebook   = $veri["facebook"];
            $instagram  = $veri["instagram"];

            $d_gorsel = $veri["gorsel"];

          }

          if($d_gorsel == ""){

            $d_gorsel = "assets/gorsel_yok.png";

          }else{

          }


      }else{
        header("Location: admin.php?p=admin");
        exit();
      }

 

?>





<div class="row">
    
      <form role="form" class="form-horizontal"  id="forms" name="forms" method="POST" action="ajax.php?p=profil/profil_duzenle" onsubmit="return false;" enctype="multipart/form-data">
      <input type="hidden" name="id" id="id" value="<?=$id;?>">
      <div class="col-lg-9">

        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>PROFİL DÜZENLE</h5>

          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container">
              <div>
                
              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-edit"></i>
                <input class="form-control" placeholder="Ad Soyad" type="text" name="adsoyad" id="adsoyad" value="<?=$adsoyad;?>">
                </div>
              </div>

              <div class="form-group">
                <textarea name="aciklama" id="aciklama" class="ckeditor"><?=$aciklama;?></textarea>
              </div>

              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-twitter"></i>
                <input class="form-control" placeholder="E-Posta Adresi" type="text" name="email" id="email" value="<?=$email;?>">
                </div>
              </div>

              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-twitter"></i>
                <input class="form-control" placeholder="Twitter Url" type="text" name="twitter" id="twitter" value="<?=$twitter;?>">
                </div>
              </div>

              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-facebook"></i>
                <input class="form-control" placeholder="Facebook Url" type="text" name="facebook" id="facebook" value="<?=$facebook;?>">
                </div>
              </div>

              <div class="form-group">
                <div class="input-icon">
                <i class="fa fa-instagram"></i>
                <input class="form-control" placeholder="İnstagram Url" type="text" name="instagram" id="instagram" value="<?=$instagram;?>">
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
            <h5>Profil Fotoğrafı</h5>

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
          <div class="ibox-title">
            <h5>Parola Yenile</h5>
          </div>
          <div class="ibox-content collapse in">
            <div class="widgets-container" style="text-align: center;">
              <div>
                  
                <div class="form-group">
                  <div class="input-icon">
                  <i class="fa fa-lock"></i>
                  <input class="form-control" placeholder="Yeni Parola" type="text" name="parola1" id="parola1">
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-icon">
                  <i class="fa fa-lock"></i>
                  <input class="form-control" placeholder="Yeni Parola (Tekrar)" type="text" name="parola2" id="parola2">
                  </div>
                </div>

                <p style="font-size:11px;">Yenilemek istemiyorsanız boş bırakın.</p>



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









