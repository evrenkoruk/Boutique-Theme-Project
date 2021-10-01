<?php @session_start(); ob_start(); include("header.php"); 
  
  $wo_id    = $_GET["wo_id"];
  $wo_id2   = $_GET["wo_id2"];

  if(is_numeric($wo_id)){

     $sayfalar = $wo_db->prepare("SELECT * FROM sayfalar WHERE id= :id");
      $skontrol = $sayfalar->execute(array(
           "id" => $wo_id
      ));


  }else{
    header("Location: /index.php");
      exit();
  }
 
    $sayfa_say = $sayfalar->rowCount();


    if($sayfa_say > 0){

      foreach ($sayfalar as $sayfa){
        // $s_baslik   = $sayfa["baslik"];
        // $s_icerik   = $sayfa["icerik"];
        $gorsel   = $sayfa["gorsel"];
        $s_ust      = $sayfa["ust_id"];
        $ust_ad     = sayfa_ad($s_ust);

        $ust_ad = lang_baslik($s_ust,$dil_id);
      }


      $sayfaicerik = $wo_db->query("select * from sayfa_icerikler where sayfa_id='$wo_id' and dil='$dil_id'");
      foreach ($sayfaicerik as $ss) {
        $s_baslik = $ss["baslik"];
        $s_icerik = $ss["icerik"];
      }

    }else{

      header("Location: /index.php");
      exit();

    }


    if($gorsel == ""){

        $sayfalar = $wo_db->prepare("SELECT * FROM sayfalar WHERE id= :id");
          $skontrol = $sayfalar->execute(array(
               "id" => $wo_id2
          ));

          foreach ($sayfalar as $sayf) {
              $s_gorsel = wo_gorsel($sayf["gorsel"]);
          }

    }else{

        $s_gorsel   = wo_gorsel($sayfa["gorsel"]);
    }
    
?>




        <!-- start page-title -->
        <section class="page-title">
            <div class="page-title-container">
                <div class="page-title-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col col-xs-12">
                                <h2><?=$s_baslik;?></h2>
                                <ol class="breadcrumb">
                                    <li><a href="index.html">Anasayfa</a></li>
                                    <li><?=$ust_ad;?></li>
                                    <li><?=$s_baslik;?></li>
                                </ol>
                            </div>
                        </div> <!-- end row -->
                    </div> <!-- end container -->
                </div>
            </div>
        </section>
        <!-- end page-title -->     


        <!-- start shop-section -->
        <section class="shop-section section-padding">
            <div class="container-fluid">
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="shop-area clearfix">
                            <div class="woocommerce-content-wrap">
                                <div class="woocommerce-content-inner">
                                    <div class="woocommerce-toolbar-top">
                                        <p class="woocommerce-result-count"><strong><?=$ust_ad;?></strong> Kategorisinde <strong><?=$s_baslik;?></strong> ürünlerini listelemektesiniz.</p>
                                        <div class="products-sizes">
                                            <a href="#" class="grid-4 active">
                                                <div class="grid-draw">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                                <div class="grid-draw">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                                <div class="grid-draw">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                            </a>
                                            <a href="#" class="grid-3">
                                                <div class="grid-draw">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                                <div class="grid-draw">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                                <div class="grid-draw">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                            </a>
                                            <a href="#" class="list-view">
                                                <div class="grid-draw-line">
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                                <div class="grid-draw-line">
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                                <div class="grid-draw-line">
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                            </a>
                                        </div>
                                                                  
                                    </div>

                                    <ul class="products">

                                        <?php

                                        if($wo_id2 == ""){
                                            $hizmetler = $wo_db->query("select * from sayfalar where urun_kat=$wo_id and kategori='urun' order by id DESC");
                                        }else{
                                            if($_GET["grup"] == ""){
                                                $hizmetler = $wo_db->query("select * from sayfalar where ust_id=$wo_id and kategori='urun' order by id DESC");
                                            }else{
                                                $gelen_grup = $_GET["grup"];
                                                $hizmetler = $wo_db->query("select * from sayfalar where urun_grup=$gelen_grup and kategori='urun' order by id DESC");
                                            }
                                            $grupKontrol = $wo_db->query("select * from urun_gruplar where altkategori_id=$wo_id");
                                        }

                                    ?>



                                         <?php
                                        

                                        if($hizmetler->rowCount()){

                                            foreach ($hizmetler as $hizmet){

                                            $sayfa_id = $hizmet["id"];
                                            $gorsel = wo_gorsel($hizmet["gorsel"]);
                                            $gorsel2 = $hizmet["gorsel2"];
                                                $fiyat = $hizmet["fiyat"];
                                                $fiyat2 = $hizmet["fiyat2"];

                                            $sayfaKontrol = $wo_db->query("select * from sayfa_icerikler where sayfa_id='$sayfa_id' and dil='$dil_id'");
                                            foreach ($sayfaKontrol as $sayfa) {
                                                $sayfa_baslik = $sayfa["baslik"];
                                                $sayfa_icerik = icerik_kisalt(strip_tags($sayfa["icerik"]),270);
                                                $h_url = 'urun/'.$hizmet["id"].'/'.wo_seo($sayfa_baslik).'.html';
                                            }

                                            ?>



                                            <li class="product">
                                            <div class="product-holder">
                                                <!-- <div class="product-badge discount">-27%</div> -->
                                                <a href="<?=$h_url;?>"><img src="<?=$gorsel;?>" alt="<?=$sayfa_baslik;?>"></a>
                                                <div class="shop-action-wrap">
                                                    <ul class="shop-action">
                                                        <li><a href="<?=$h_url;?>"  title="Ürünü İncele"><i class="fi flaticon-view"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h4><a href="<?=$h_url;?>"><?=$sayfa_baslik;?></a></h4>
                                                <span class="woocommerce-Price-amount amount">
                                                    <ins>
                                                        <span class="woocommerce-Price-amount amount">
                                                            <bdi><?=$fiyat;?> <span class="woocommerce-Price-currencySymbol">TL</span></bdi>
                                                        </span>
                                                    </ins>
                                                    <?php
                                                                        if($fiyat2 != ""){
                                                                            ?>

                                                                                <del>
                                                                        <span class="woocommerce-Price-amount amount">
                                                                            <bdi><?=$fiyat2;?> <span class="woocommerce-Price-currencySymbol">TL</span></bdi>
                                                                        </span>
                                                                    </del>

                                                                            <?
                                                                        }
                                                                    ?>
                                                </span>
                                                <p class="product-description"><?=$sayfa_icerik;?> </p>
                                            </div>
                                        </li>


                                                    <?
                                                }

                                        }else{
                                            ?>

                                            <div class="col-md-12" style="text-align: center;">
                                                <p><strong><?=$s_baslik;?></strong> kategorisine ait kayıtlı ürün bulunamadı</p>
                                            </div>

                                            <?

                                        }

                                    ?>

                                        
                                        
                                    </ul>
                                </div>
                                
                            </div>

                            <div class="shop-sidebar">
                                                        

                                <div class="widget woocommerce widget_product_categories">
                                    <h3>Ürün Grupları</h3>



                                    <ul class="product-categories">
                                        
                                    


                                    <?php
                                            $hizmetler = $wo_db->query("select * from sayfalar where ust_id=5 order by id ASC");

                                            foreach ($hizmetler as $hizmet){

                                                $sayfa_id = $hizmet["id"];

                                                $sayfaKontrol = $wo_db->query("select * from sayfa_icerikler where sayfa_id='$sayfa_id' and dil='$dil_id'");
                                                foreach ($sayfaKontrol as $sayfa) {
                                                    $sayfa_baslik   = $sayfa["baslik"];

                                                    $a_url          = 'urunler/'.$sayfa_id.'/'.wo_seo($sayfa_baslik).'.html';
                                                }

                                                $mstyle = "display: none;";

                                                if($wo_id == $sayfa_id or $wo_id2 == $sayfa_id){
                                                    $mstyle = "display: block;";
                                                }
                                                
                                                
                                                ?>

                                                <li class="cat-item cat-parent"><a href="<?=$a_url;?>" style="font-weight: bold;"><?=$sayfa_baslik;?></a>
                                                    <ul class="children" style="<?=$mstyle;?>">
                                                        <?php
                                                            $altKategoriler = $wo_db->query("select * from sayfalar where ust_id=$sayfa_id order by id ASC");
                                                            foreach ($altKategoriler as $altKat) {
                                                                
                                                                $altkat_id = $altKat["id"];

                                                                $sayfaKontrol = $wo_db->query("select * from sayfa_icerikler where sayfa_id='$altkat_id' and dil='$dil_id'");
                                                                foreach ($sayfaKontrol as $sayfa) {
                                                                    $altsayfa_baslik   = $sayfa["baslik"];
                                                                    $h_url          = 'urunler/'.$altKat["id"].'/'.$altKat["ust_id"].'/'.wo_seo($altsayfa_baslik).'.html';
                                                                }

                                                                ?>
                                                                    <li class="cat-item"><a href="<?=$h_url;?>" style="<?=($wo_id==$altkat_id ? 'color: #ff7e67;' : '');?>"><?=$altsayfa_baslik;?></a></li>
                                                                <?


                                                            }
                                                        ?>
                                                    </ul>
                                                </li>

                                                <?
                                            }

                                        ?>



                                        </ul>






                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>                  
            </div> <!-- end container -->
        </section>
        <!-- end shop-section -->



<?php include("footer.php");?>