<?php @session_start(); @ob_start();  include("wocontrol/system/config.php"); include("wocontrol/system/wofonk.php"); include("webonda/enes.php"); 
    

    $lang    = $_GET["lang"];
    $dil_id = 1;


    if($lang == "tr"){

        $_SESSION['dil'] = "tr";

    }else if($lang == "en"){

        $_SESSION['dil'] = "en";

    }else if($lang == "ru"){

        $_SESSION['dil'] = "ru";

    }else if($lang == "fr"){

        $_SESSION['dil'] = "fr";

    }else{

    }


    if($_SESSION['dil'] == "tr"){
        include("webonda/lang/tr.php");
    }else if($_SESSION['dil'] == "en"){
        include("webonda/lang/en.php");
    }else if($_SESSION['dil'] == "ru"){
        include("webonda/lang/ru.php");
    }else if($_SESSION['dil'] == "fr"){
        include("webonda/lang/fr.php");
    }else{
        include("webonda/lang/tr.php");
    }


     function lang_baslik($sayfa_id, $dil_id){

        global $wo_db;
        $sayfalar = $wo_db->query("select * from sayfa_icerikler where sayfa_id='$sayfa_id' and dil='$dil_id'");
        foreach ($sayfalar as $sayfa) {
            $s_baslik = $sayfa["baslik"];
        }

        return $s_baslik;

    }


    function lang_icerik($sayfa_id, $dil_id){

        global $wo_db;
        $sayfalar = $wo_db->query("select * from sayfa_icerikler where sayfa_id='$sayfa_id' and dil='$dil_id'");
        foreach ($sayfalar as $sayfa) {
            $s_icerik = $sayfa["icerik"];
        }

        return $s_icerik;

    }
    


    $tam_url = 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

    $url_parcala = explode("?lang", $tam_url);

    $tam_url = $url_parcala[0];



?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="webonda">
    <link rel="shortcut icon" href="assets/images/favicon.png?V=3" type="image/x-icon">

    <title> Ksenya Butik - Ataşehir</title>

    <base href="https://www.ksenyabutik.com" />
    
    <link href="assets/css/themify-icons.css" rel="stylesheet">
    <link href="assets/css/icomoon.css" rel="stylesheet">
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet">
    <link href="assets/css/flaticon.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/owl.carousel.css" rel="stylesheet">
    <link href="assets/css/owl.theme.css" rel="stylesheet">
    <link href="assets/css/slick.css" rel="stylesheet">
    <link href="assets/css/slick-theme.css" rel="stylesheet">
    <link href="assets/css/swiper.min.css" rel="stylesheet">
    <link href="assets/css/owl.transitions.css" rel="stylesheet">
    <link href="assets/css/jquery.fancybox.css" rel="stylesheet">
    <link href="assets/css/jquery-ui.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- start page-wrapper -->
    <div class="page-wrapper">

        <div class="body-overlay"></div>

        <!-- start preloader -->
        <div class="preloader">
            <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>
        </div>
        <!-- end preloader -->
        

                <!-- Start header -->
        <header id="header" class="site-header header-style-2">
            <div class="topbar">
                <div class="topbar-text">
                    <p>200 TL ve Üzeri Alışverişlerde Kargo Ücretsiz!</p>
                </div>
            </div> <!-- end topbar -->
            <nav class="navigation navbar navbar-default">
                <div class="container-1410">
                    <div class="navbar-header">
                        <button type="button" class="open-btn">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.html"><img src="assets/images/logo.png" alt></a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse navigation-holder">
                        <button class="close-navbar"><i class="ti-close"></i></button>
                        <ul class="nav navbar-nav">


                             <?php

                                        $hizmetler = $wo_db->query("select * from sayfalar where ust_id=5 order by id ASC");

                                        foreach ($hizmetler as $hizmet){

                                            $sayfa_id = $hizmet["id"];

                                            $sayfaKontrol = $wo_db->query("select * from sayfa_icerikler where sayfa_id='$sayfa_id' and dil='$dil_id'");
                                            foreach ($sayfaKontrol as $sayfa) {
                                                $sayfa_baslik = $sayfa["baslik"];
                                                $h_url = 'urunler/'.$hizmet["id"].'/'.wo_seo($sayfa_baslik).'.html';
                                            }

                                            
                                            
                                            ?>

                                                <li class="menu-item-has-children">
                                                    <a href="<?=$h_url;?>"><?=$sayfa_baslik;?>  <i class="fa fa-angle-down"></i></a>

                                                    <ul class="sub-menu">

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
                                                                    <li><a href="<?=$h_url;?>" style="<?=($wo_id==$altkat_id ? 'color: #ff7e67;' : '');?>"><?=$altsayfa_baslik;?></a></li>
                                                                <?


                                                            }
                                                        ?>
                                                    </ul>

                                                </li>

                                            <?
                                        }

                                    ?>

                            <li><a href="kisiye-ozel-tasarim.html">Kişiye Özel Tasarım</a></li>
                            
                                
                        </ul>
                    </div><!-- end of nav-collapse -->
                    <div class="header-right">
                        <div class="header-search-form-wrapper">
                            <button class="search-toggle-btn"><i class="fi flaticon-search-1"></i></button>
                            <div class="header-search-area">
                                <div class="container">
                                    <div class="row">
                                        <div class="col col-xs-12">
                                            <h3>Arama</h3>
                                             <div class="header-search-form">
                                                <form>
                                                    <div>
                                                        <input type="text" class="form-control" placeholder="Aramak istediğiniz kelime...">
                                                        <button type="submit"><i class="ti-search"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="close-form">
                                    <button>Kapat</button>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div><!-- end of container -->
            </nav>
        </header>
        <!-- end of header -->