<?php

  function wo_slider2(){

     global $wo_db;

      $slider = $wo_db->query("SELECT * FROM slider order by id DESC limit 0,20");

      $slider_say = $slider->rowCount();


      ?>

        <section class="slider-space">
          <div class="baro-slider">
            <?php

              foreach ($slider as $sldr) {

                $slider_url = $sldr["url"];
                $slider_baslik = $sldr["baslik"];
                $slider_gorsel = $sldr["gorsel"];
                $s_url = "";

                if($slider_url == ""){
                  $s_url = "javascript:;";
                }else{
                  $s_url = $slider_url;
                }

                echo '<div class="item" style="width: 100%;"><a href="'.$s_url.'"><img src="'.wo_gorsel($slider_gorsel).'"></a></div>';



              }


            ?>
            
          </div>
        </section>


      <?

  }


  function wo_slider(){

    echo '<li data-transition="slideremoveright">
            <img src="images/slider/b1.jpg"  alt="" width="1920" height="700" data-bgposition="top center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="1" >
            
            <div class="tp-caption  tp-resizeme" 
              data-x="left" data-hoffset="15" 
              data-y="top" data-voffset="250" 
              data-transform_idle="o:1;"         
              data-transform_in="x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;" 
              data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" 
              data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" 
              data-splitin="none" 
              data-splitout="none"
              data-start="700">
              <div class="slide-content-box">
                <h2>ORTOPEDİ VE TRAVMATOLOJİ</h2>
              </div>
            </div>
            <div class="tp-caption  tp-resizeme" 
              data-x="left" data-hoffset="15" 
              data-y="top" data-voffset="320" 
              data-transform_idle="o:1;"         
              data-transform_in="x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;" 
              data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" 
              data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" 
              data-splitin="none" 
              data-splitout="none"
              data-start="700">
              <div class="slide-content-box">
                <h1>Doç. Dr. Burak AKESEN</h1>
              </div>
            </div>
            
            <div class="tp-caption tp-resizeme" 
              data-x="left" data-hoffset="15" 
              data-y="top" data-voffset="460" 
              data-transform_idle="o:1;"                         
              data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
              data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"                     
              data-splitin="none" 
              data-splitout="none" 
              data-responsive_offset="on"
              data-start="2300">
              <div class="slide-content-box">
                <div class="button">
                  <a class="thm-btn yellow-bg" href="hakkinda.html">HAKKINDA</a>     
                </div>
              </div>
            </div>
            
          </li>



          <li data-transition="slideremoveright">
            <img src="images/slider/b2.jpg"  alt="" width="1920" height="700" data-bgposition="top center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="1" >
            
            <div class="tp-caption  tp-resizeme" 
              data-x="left" data-hoffset="15" 
              data-y="top" data-voffset="250" 
              data-transform_idle="o:1;"         
              data-transform_in="x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;" 
              data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" 
              data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" 
              data-splitin="none" 
              data-splitout="none"
              data-start="700">
              <div class="slide-content-box">
                <h2>İLERLEYEN YAŞ<br><span style="font-size:24px;">HAREKETLERİNİZİ ENGELLEMESİN</span></h2>
              </div>
            </div>

            <div style="" class="tp-caption  tp-resizeme" 
              data-x="left" data-hoffset="15" 
              data-y="top" data-voffset="370" 
              data-transform_idle="o:1;"         
              data-transform_in="x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;" 
              data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" 
              data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" 
              data-splitin="none" 
              data-splitout="none"
              data-start="700">
              <div class="slide-content-box">
                <h1 style="font-size: 14px;">BACAĞA YAYILAN AĞRILAR VE YÜRÜRKEN DURUP DİNLENME İHTİYACI İLE KENDİNİ GÖSTEREN DAR KANAL TEDAVİ EDİLİR.</h1>
              </div>
            </div>
            
          </li>




          ';


  }






function wo_haberindex(){

  global $wo_db;

  $haberler = $wo_db->query("SELECT * FROM haberler order by tarih DESC limit 0,15");

  $haber_say = $haberler->rowCount();


  if($haber_say > 0){

    foreach ($haberler as $haber) {

      $h_baslik   = $haber["baslik"];
      $h_icerik   = $haber["icerik"];
      $h_tarih    = wo_tarih($haber["tarih"]);
      $h_gorsel   = $haber["gorsel"];
      $h_hit      = $haber["hit"];

      $h_link = 'haber/'.$haber["id"].'/'.wo_seo($haber["baslik"]).'.html';

      $tparcala = explode(" ", $h_tarih);
      $tarihh = $tparcala[0];

     ?>


      <div class="col-md-4 col-sm-6">
            <div class="image-box image-box-4 matchHeigh">
                <div class="image">
                    <a href="<?=$h_link;?>">
                        <img src="wogorsel.php?src=<?=wo_gorsel($h_gorsel);?>&h=200&w=400" alt="<?=$h_baslik;?>" />
                    </a>
                </div>
                <div class="content">
                    <h3 class="title">
                        <a href="<?=$h_link;?>"><?=$h_baslik;?></a>
                    </h3>
                    <div class="sub-info">
                        <span class="date"><?=$tarihh;?></span>
                    </div>
                </div>
            </div>
        </div>


    <?
    }


  }else{

    echo '<div class="col-12" style="text-align:center;">Kayıtlı Haber Bulunamadı</div>';

  }



}



function wo_duyuruindex(){

  global $wo_db;

  $duyurular = $wo_db->query("SELECT * FROM duyurular where kategori_id=1 order by tarih DESC limit 0,10");

  $duyuru_say = $duyurular->rowCount();


  if($duyuru_say > 0){

    foreach ($duyurular as $duyuru) {

      $d_baslik   = $duyuru["baslik"];
      //$d_icerik   = $haber["icerik"];
      $d_tarih    = wo_tarih($duyuru["tarih"]);
      //$d_gorsel   = $haber["gorsel"];

      $d_link = 'duyuru/'.$duyuru["id"].'/'.wo_seo($duyuru["baslik"]).'.html';

      $tparcala = explode(" ", $d_tarih);
      $tarihh = $tparcala[0];

     ?>




      <div class="l-col-6 col-12">
        <div class="announce-block">
          <a href="<?=$d_link;?>">
            <img src="assets/img/logo.png" class="dsp-none s-dsp-block">
            <div class="announce-summary">
              <h4 class="announce-sum-title"><?=$d_baslik;?></h4>
              <p class="announce-meta">
                <span class="announce-meta-date">
                  <i class="fa fa-calendar-o"></i><?=$tarihh;?>
                </span>
                <span class="announce-meta-readmore">
                  <i class="fa fa-plus-square"></i>Ayrıntılar
                </span>
              </p>
            </div>
          </a>
        </div>
      </div>

    <?
    }


  }else{

    echo '<div class="col-12" style="text-align:center;">Kayıtlı Duyuru Bulunamadı</div>';

  }



}





  function wo_etkinlikler(){

     global $wo_db;

      $etkinlikler = $wo_db->query("SELECT * FROM etkinlikler order by id DESC limit 0,5");

      $etkinlik_say = $etkinlikler->rowCount();



    foreach ($etkinlikler as $etkinlik) {

      $e_id = $etkinlik["id"];
      $e_baslik = $etkinlik["baslik"];
      $e_tarih = wo_tarih($etkinlik["tarih"]);

      $tparcala = explode(" ", $e_tarih);
      $e_saat = $tparcala[1];

      $tparcala2 = explode(".", $tparcala[0]);
      $e_gun = $tparcala2[0];
      $e_ay = ay_adi($tparcala2[1]);


      ?>

         <div class="event-block">
          <div class="event-meta">
            <div class="event-time">
              <span><?=$e_saat;?></span>
            </div>
            <div class="event-date">
              <span><?=$e_gun;?> <?=$e_ay;?></span>
            </div>
          </div>
          <div class="event-title">
            <a href="etkinlik/<?=$e_id;?>/<?=wo_seo($e_baslik);?>.html"><?=$e_baslik;?></a>
          </div>
        </div>


      <?

    }


  }


  function wo_linkler(){

     global $wo_db;

      $linkler = $wo_db->query("SELECT * FROM linkler order by sira ASC");

      $link_say = $linkler->rowCount();

      if($link_say > 0){

          foreach ($linkler as $link) {

            $l_baslik = $link["baslik"];
            $l_link = $link["link"];

            echo '
              <div class="link-block">
                  <a href="'.$l_link.'"><i class="fa fa-chevron-right"></i> '.$l_baslik.'</a>
                </div>
            ';
          }

      }else{
        echo "Kayıtlı Link Bulunamadı";
      }


  }





  function ay_adi($ay){

    if($ay == "01"){
      $giden = "Oca";
    }else if($ay == "02"){
      $giden = "Şub";
    }else if($ay == "03"){
      $giden = "Mar";
    }else if($ay == "04"){
      $giden = "Nis";
    }else if($ay == "05"){
      $giden = "May";
    }else if($ay == "06"){
      $giden = "Haz";
    }else if($ay == "07"){
      $giden = "Tem";
    }else if($ay == "08"){
      $giden = "Ağu";
    }else if($ay == "09"){
      $giden = "Eyl";
    }else if($ay == "10"){
      $giden = "Ekim";
    }else if($ay == "11"){
      $giden = "Kasım";
    }else{
      $giden = "Ara";
    }

    return $giden;

  }





  function wo_gorsel($gorsel){

    if($gorsel == ""){

      $giden  = "upload/gorselyok.jpg";

    }else{

      $gelen      = explode("../", $gorsel);
      $giden      = $gelen[1];

    }

    

    return $giden;


  }


  

  

?>

