<?php include 'header.php'; 

$wo_id = $_GET["wo_id"];


$haberler = $wo_db->query("SELECT * FROM sayfalar where id=$wo_id");


foreach ($haberler as $haber) {

  $h_id       = $haber["id"];
  $h_baslik   = lang_baslik($h_id,$dil_id);
  $h_icerik   = lang_icerik($h_id,$dil_id);
  $h_tarih    = wo_tarih($haber["tarih"]);
  $h_gorsel   = $haber["gorsel"];

  $h_link = 'haber/'.$haber["id"].'/'.wo_seo($haber["baslik"]).'.html';

  $tparcala = explode(" ", $h_tarih);
  $tarihh = $tparcala[0];
}



?>


        <!-- start page-title -->
        <section class="page-title">
            <div class="page-title-container">
                <div class="page-title-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col col-xs-12">
                                <h2><?=$h_baslik;?></h2>
                                <ol class="breadcrumb">
                                    <li><a href="index.html">Anasayfa</a></li>
                                    <li>Haberler</li>
                                    <li><?=$h_baslik;?></li>
                                </ol>
                            </div>
                        </div> <!-- end row -->
                    </div> <!-- end container -->
                </div>
            </div>
        </section>
        <!-- end page-title -->    





        <section class="about-section section-padding">
            <div class="container-fluid">
                <div class="row">
                    <div class="col col-lg-12">

                        <?php

                            if($h_gorsel != ""){
                                ?>
                                    <center><img src="<?=$h_gorsel;?>" style="max-width: 90%; margin-bottom: 15px;"></center>
                                <?
                            }

                        ?>

                        <?=$h_icerik;?>
                        <br>
                        <p>Yayınlanma tarihi: <strong><?=$h_tarih;?></strong></p>
                    </div>
                    
                </div>
            </div>
        </section> 




<?php include("footer.php"); ?>
