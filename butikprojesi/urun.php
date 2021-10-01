<?php @session_start(); ob_start(); include("header.php"); 
  
  $wo_id = $_GET["wo_id"];

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
        $s_gorsel   = wo_gorsel($sayfa["gorsel"]);
        $s_ust      = $sayfa["ust_id"];
        $fiyat      = $sayfa["fiyat"];
        $fiyat2      = $sayfa["fiyat2"];
        $shopier_url      = $sayfa["shopier_url"];
        $s_urunkat  = $sayfa["urun_kat"];
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



    if($shopier_url == ""){
        $shopier_url = "https://shopier.com/Ksenya";
    }else{
        
    }


     $sayfalar = $wo_db->prepare("SELECT * FROM sayfalar WHERE id= :id");
      $skontrol = $sayfalar->execute(array(
           "id" => $s_urunkat
      ));

      foreach ($sayfalar as $sayf) {
          $ust_gorsel = wo_gorsel($sayf["gorsel"]);
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
                                    <li><a href="urunler/<?=$s_ust;?>/<?=$s_urunkat;?>/<?=wo_seo($ust_ad);?>.html"><?=$ust_ad;?></a></li>
                                    <li><?=$s_baslik;?></li>
                                </ol>
                            </div>
                        </div> <!-- end row -->
                    </div> <!-- end container -->
                </div>
            </div>
        </section>
        <!-- end page-title -->     


        <!-- start shop-single-section -->
        <section class="shop-single-section shop-single-vertical-thumb section-padding">
            <div class="container-1410">
                <div class="row">
                    <div class="col col-md-7">
                        <div class="shop-single-slider">
                            <div class="slider-for">

                                 <?php

                                        $gorselKontrol = $wo_db->query("select * from gorseller where kategori='sayfa' and yazi_id=$wo_id");
                                        if($gorselKontrol->rowCount()){

                                            
                                            foreach ($gorselKontrol as $pic) {
                                                $gors = wo_gorsel($pic["gorsel"]);
                                                echo ' <div>
                                                        <img src="'.$gors.'" alt="" style="max-height:420px;"/>
                                                    </div>';

                                            }

                                        }else{

                                            echo ' <div>
                                                        <img src="'.$s_gorsel.'" alt="" style="max-height:420px;" />
                                                    </div>';

                                        }


                                    ?>

                            </div>
                            <div class="slider-nav">
                                <?php

                                        $gorselKontrol = $wo_db->query("select * from gorseller where kategori='sayfa' and yazi_id=$wo_id");
                                        if($gorselKontrol->rowCount()){

                                            
                                            foreach ($gorselKontrol as $pic) {
                                                $gors = wo_gorsel($pic["gorsel"]);
                                                echo ' <div>
                                                        <img src="'.$gors.'" alt="" style="max-height:90px;"/>
                                                    </div>';

                                            }

                                        }else{

                                            echo ' <div>
                                                        <img src="'.$s_gorsel.'" alt="" style="max-height:90px;"/>
                                                    </div>';

                                        }


                                    ?>
                            </div>
                        </div>
                    </div>

                    <div class="col col-md-5">
                        <div class="product-details">
                            <h2><?=$s_baslik;?></h2>
                            <div class="price">
                                <span class="current"><?=$fiyat;?> TL</span>
                                <?php

                                    if($fiyat2 != ""){
                                        ?>

                                            <span class="old"><?=$fiyat2;?> TL</span>

                                        <?
                                    }

                                ?>
                            </div>
                            <div class="rating">
                                <i class="fi flaticon-star"></i>
                                <i class="fi flaticon-star"></i>
                                <i class="fi flaticon-star"></i>
                                <i class="fi flaticon-star"></i>
                                <i class="fi flaticon-star"></i>
                            </div>
                            
                            <?=$s_icerik;?>

                            <div class="product-option">

                            	 <a href="https://api.whatsapp.com/send?phone=+905435443134&text=ksenyabutik.com - <?=$s_baslik;?> ürünü hakkında bilgi almak ve sipariş vermek istiyorum. Bana yardımcı olur musunuz? " target="_blank">
				                        <img src="uploads/whatsapp.gif" alt="WhatsApp ile sipariş ver. Ksenya Butik" style="margin-bottom: 10px;">
				                      </a>

                                <form class="form" action="<?=$shopier_url;?>" method="get" target="_blank">
                                    <div class="product-row">
                                        <div>
                                            <input class="product-count" type="text" value="1" name="product-count">
                                        </div>
                                        <div>
                                            <button type="submit">Satın Al</button>
                                        </div>
                                    </div>
                                </form>


                            </div> 

                           
                        </div> 
                    </div> <!-- end col -->
                </div> <!-- end row -->

               

                <div class="row">
                    <div class="col col-xs-12">
                        <div class="realted-porduct">
                            <h3>Benzer Ürünler</h3>
                            <ul class="products">



                                <?php

                    $hizmetler = $wo_db->query("select * from sayfalar where ust_id=$s_ust order by RAND() limit 0,3");

                    foreach ($hizmetler as $hizmet){

                        $sayfa_id = $hizmet["id"];
                        $u_fiyat = $hizmet["fiyat"];
                        $u_fiyat2 = $hizmet["fiyat2"];
                        $gorsel = wo_gorsel($hizmet["gorsel"]);

                        $sayfaKontrol = $wo_db->query("select * from sayfa_icerikler where sayfa_id='$sayfa_id' and dil='$dil_id'");
                        foreach ($sayfaKontrol as $sayfa) {
                            $sayfa_baslik = $sayfa["baslik"];
                            $h_url = 'urun/'.$hizmet["id"].'/'.wo_seo($sayfa_baslik).'.html';
                        }

                        
                        
                        ?>



                        <li class="product">
                                    <div class="product-holder">
                                        <a href="<?=$h_url;?>"><img src="<?=$gorsel;?>" alt></a>
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
                                                    <bdi><?=$u_fiyat;?> <span class="woocommerce-Price-currencySymbol">TL</span></bdi>
                                                </span>
                                            </ins>
                                            <?php
                                                if($u_fiyat2 != ""){
                                                    ?>

                                                        <del>
                                                <span class="woocommerce-Price-amount amount">
                                                    <bdi><?=$u_fiyat2;?> <span class="woocommerce-Price-currencySymbol">TL</span></bdi>
                                                </span>
                                            </del>

                                                    <?
                                                }
                                            ?>
                                        </span>
                                    </div>
                                    
                                </li>


                        <?
                    }

                ?>


                                


                            </ul>
                        </div>
                    </div>
                </div>
            </div> <!-- end of container -->
        </section>
        <!-- end of shop-single-section -->




<?php include("footer.php"); ?>