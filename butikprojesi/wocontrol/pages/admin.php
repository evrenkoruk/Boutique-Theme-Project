<?php

	$habersay = $wo_db->query("SELECT * FROM haberler", PDO::FETCH_ASSOC);
	$haber_say  = $habersay->rowCount();

	$duyurusay = $wo_db->query("SELECT * FROM duyurular", PDO::FETCH_ASSOC);
	$duyuru_say  = $duyurusay->rowCount();

	$etkinliksay = $wo_db->query("SELECT * FROM etkinlikler", PDO::FETCH_ASSOC);
	$etkinlik_say  = $etkinliksay->rowCount();

	$slidersay = $wo_db->query("SELECT * FROM slider", PDO::FETCH_ASSOC);
	$slider_say  = $slidersay->rowCount();


?>


<style type="text/css">
	
	.widget{
		cursor: pointer;
	}

	.widget:hover{
   		box-shadow: 4px 5px 10px #d6d6d6;
   		/*box-shadow: 0px 6px 12px 1px #848484;*/
   		opacity: 0.90;
	}

</style>

<div class="wrapper-content "> 


<div class="row">


   <?php

        if($_SESSION["yetki"] == 1){
            ?>


                <!-- begin col-2 -->
                <div class="col-lg-2">
                    <div class="widget black-bg text-center" onclick='window.location = "admin.php?p=mesajlar"'>
                        <div>
                            <i class="fa fa-envelope fa-4x"></i>

                            <h1><?=$mesaj_say;?></h1>

                            <h3 class="font-bold no-margins">
                                Yeni Mesaj
                            </h3>

                        </div>
                    </div>
                </div>


            <?
        }else{
            ?>

                <div class="col-lg-12">
                    <p>Sol Menüyü Kullanarak İşlem Yapabilirsiniz</p>
                </div>

            <?
        }

   ?>




</div>
            
