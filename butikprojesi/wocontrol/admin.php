<?php @session_start(); @ob_start();  include("system/config.php"); include("system/wofonk.php");

    if(@$_SESSION["admin_oturum"] != true){

        header("Location: index.php");
        exit();

    }

    $p = $_GET["p"];
    $islem = $_GET["islem"];

    $ilansay = $wo_db->query("SELECT * FROM ilanlar WHERE yayin=0", PDO::FETCH_ASSOC);
    $ilan_say  = $ilansay->rowCount();

    $mesajsay = $wo_db->query("SELECT * FROM mesajlar WHERE okundu=0", PDO::FETCH_ASSOC);
    $mesaj_say  = $mesajsay->rowCount();

    $uyeler = $wo_db->query("SELECT * FROM uyeler WHERE aktif=0", PDO::FETCH_ASSOC);
    $uye_say  = $uyeler->rowCount();



?>

<!DOCTYPE html>
<html lang="en">
<head>    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WOCONTROL</title>
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/jasny-bootstrap.min.css">
    <link href="assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="assets/css/daterangepicker.css" />
    <!-- slimscroll -->
    <link href="assets/css/jquery.slimscroll.css" rel="stylesheet">
    <!-- project -->
    <link href="assets/css/project.css" rel="stylesheet">
    <!-- flotCart css -->
    <link href="assets/css/flotCart.css" rel="stylesheet">
    <!-- jvectormap -->
	<link href="assets/css/jqvmap.css" rel="stylesheet">

    <!-- webonda css -->
    <link href="assets/css/webonda.css" rel="stylesheet">

    

	<!-- dataTables -->
	<link href="assets/css/buttons.dataTables.min.css" rel="stylesheet">
	<link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/responsive.dataTables.min.css" rel="stylesheet">
	<link href="assets/css/fixedHeader.dataTables.min.css" rel="stylesheet">


    <!-- Fontes -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/simple-line-icons.css" rel="stylesheet">
    <link href="assets/css/ameffectsanimation.css" rel="stylesheet">
    <link href="assets/css/buttons.css" rel="stylesheet">
    <!-- animate css -->
    <link href="assets/css/animate.css" rel="stylesheet">
    <!-- top nev css -->
    <link href="assets/css/page-header.css" rel="stylesheet">
    <!-- adminui main css -->
    <link href="assets/css/main.css" rel="stylesheet">
   
    <!-- morris -->
	<link href="assets/css/morris.css" rel="stylesheet">

    <!-- Light theme css -->
    <link href="assets/css/light.css" rel="stylesheet">
    <!-- media css for responsive  -->
    <link href="assets/css/main.media.css" rel="stylesheet">
    <!-- AdminUI demo css-->
    <link href="assets/css/adminUIdemo.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="page-header-fixed ">
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="admin.php?p=admin"> <img class="logo-default" alt="logo" src="assets/img/wo-white.png"> </a>
            </div>
            <div class="library-menu"> <span class="one">-</span> <span class="two">-</span> <span class="three">-</span> </div><div class="top-nev-mobile-togal"><i class="glyphicon glyphicon-cog"></i></div>
            <!-- END LOGO -->
            <div class="top-menu">
<!--  TOP NAVIGATION MENU -->
                <div class="hor-menu  hor-menu-light hidden-sm hidden-xs">
                    <ul class="nav navbar-nav">
                        <!-- DOC: Remove data-hover="megamenu-dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
                        <!-- <li class="classic-menu-dropdown active"> <a href="index.html"><i class="icon-user fa-fw"></i></a> </li> -->
                    </ul>
                </div>
                <!--  TOP NAVIGATION MENU -->
               
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown">
                        <a href="admin.php?p=mesajlar" class="dropdown-toggle count-info"> <i class="fa fa-envelope"></i> <span class="badge badge-info"><?=$mesaj_say;?></span> </a>
                    </li>
                    <!-- START USER LOGIN DROPDOWN -->
                    <li class="dropdown dropdown-user">
                        <a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="javascript:;"> <img src="assets/images/teem/a2.jpg" class="img-circle" alt=""> <span class="username username-hide-on-mobile"> <?=$_SESSION['admin_adsoyad'];?></span> <i class="fa fa-angle-down"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="admin.php?p=profil"> <i class="icon-user"></i> Hesabım </a>

                            </li>
                            <!-- <li class="divider"> </li> -->
                            <li>
                                <a href="admin.php?p=logout"> <i class="icon-key"></i> Çıkış Yap </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <div class="clearfix"> </div>
    <div class="page-container">
        <!-- Start page sidebar wrapper -->
        <div class="page-sidebar-wrapper">
            <div class="page-sidebar">
                <ul class="page-sidebar-menu  page-header-fixed ">

                    <li class="nav-item <?php if($p == "admin"){echo 'active';}?>">
                        <a class="nav-link" href="admin.php?p=admin"><i class="fa fa-th-large"></i> <span class="title">Başlangıç</span> </a>
                    </li>

                     <li class="nav-item <?php if($p == "sayfalar" and $_GET["islem"] == "alt_liste" and $_GET["ust_id"] == 1){echo 'active';}?>">
                        <a class="nav-link" href="admin.php?p=sayfalar&islem=alt_liste&ust_id=1"><i class="fa fa-files-o"></i> <span class="title">Kurumsal Sayfalar </span> </a>
                    </li>

                    <li class="nav-item <?php if($p == "urunler"){echo 'active';}?>">
                        <a class="nav-link" href="admin.php?p=urunler"><i class="fa fa-shopping-cart"></i> <span class="title">Ürün Yönetimi </span> </a>
                    </li>

                    <li class="nav-item <?php if($p == "sayfalar" and $_GET["ust_id"] == 5){echo 'active';}?>">
                        <a class="nav-link" href="admin.php?p=sayfalar&islem=alt_liste&ust_id=5"><i class="fa fa-shopping-cart"></i> <span class="title">Ürün Kategorileri </span> </a>
                    </li>

                    <li class="nav-item <?php if($p == "urun_gruplar"){echo 'active';}?>">
                        <a class="nav-link" href="admin.php?p=urun_gruplar"><i class="fa fa-shopping-cart"></i> <span class="title">Ürün Grupları </span> </a>
                    </li>

                    <li class="nav-item <?php if($p == "sayfalar" and $_GET["islem"] == "alt_liste" and $_GET["ust_id"] == 3){echo 'active';}?>">
                        <a class="nav-link" href="admin.php?p=sayfalar&islem=alt_liste&ust_id=3"><i class="fa fa-newspaper-o"></i> <span class="title">Haber Yönetimi</span> </a>
                    </li>



<!-- 
                    <li class="nav-item <?php if($p == "duyurular"){echo 'active';}?>">
                        <a class="nav-link" href="admin.php?p=duyurular"><i class="fa fa-bullhorn"></i> <span class="title">İçerik Yönetimi</span> </a>
                    </li> -->

                    <!-- <li class="nav-item <?php if($p == "kategoriler"){echo 'active';}?>">
                        <a class="nav-link" href="admin.php?p=kategoriler"><i class="fa fa-bullhorn"></i> <span class="title">İçerik Kategorileri</span> </a>
                    </li> -->

                    <!--  <li class="nav-item <?php if($p == "etkinlikler"){echo 'active';}?>">
                        <a class="nav-link" href="admin.php?p=etkinlikler"><i class="fa fa-calendar"></i> <span class="title">Etkinlik Yönetimi</span> </a>
                    </li> -->

                     <li class="nav-item <?php if($p == "slider"){echo 'active';}?>">
                        <a class="nav-link" href="admin.php?p=slider"><i class="fa fa-image"></i> <span class="title">Slider Yönetimi</span> </a>
                    </li>

                    <!-- <li class="nav-item <?php if($p == "kutular"){echo 'active';}?>">
                        <a class="nav-link" href="admin.php?p=kutular"><i class="fa fa-files-o"></i> <span class="title">Kutular</span> </a>
                    </li> -->


                    <!--  <li class="nav-item <?php if($p == "sayfalar"){echo 'active open';}?>" style="display: none;">
                        <a class="nav-link nav-toggle" href="javascript:;"> <i class="fa fa-files-o"></i> <span class="title">Sayfa Yönetimi</span> <span class="arrow"></span> </a>
                        <ul class="sub-menu">

                            <li class="nav-item <?php if($p == "sayfalar" and $_GET["ust_id"] == ""){echo 'active';}?>">
                                <a class="nav-link" href="admin.php?p=sayfalar"> <span class="title">Sayfalar</span> </a>
                            </li>

                            <?php


                                $sayfalar = $wo_db->prepare("SELECT * FROM sayfalar WHERE ust_id = :id order by baslik ASC");
                                $kontrol2 = $sayfalar->execute(array(
                                   "id" => 0
                                ));

                                $say = $sayfalar->rowCount();

                                if($say > 0){
                                  
                                  foreach($sayfalar as $syf){

                                    if($_GET["ust_id"] == $syf["id"]){
                                        echo '<li class="nav-item active">';
                                    }else{
                                        echo '<li class="nav-item">';
                                    }

                                    echo '
                                        <a class="nav-link" href="admin.php?p=sayfalar&islem=alt_liste&ust_id='.$syf["id"].'"> <span class="title">'.$syf["baslik"].'</span> </a>
                                    </li>
                                    ';
                                   

                                  }

                                }else{

                                }



                            ?>

                        </ul>
                    </li> -->


                     <li class="nav-item <?php if($p == "sss"){echo 'active';}?>">
                        <a class="nav-link" href="admin.php?p=sss"><i class="fa fa-question"></i> <span class="title">Sık Sorulan Sorular</span> </a>
                    </li>

                     <!-- <li class="nav-item <?php if($p == "basin"){echo 'active';}?>">
                        <a class="nav-link" href="admin.php?p=basin"><i class="fa fa-vcard"></i> <span class="title">Basın Haberleri</span> </a>
                    </li> -->


                    <!-- <li class="nav-item <?php if($p == "anlasmali_kurumlar" || $p == "sorular" || $p == "linkler" || $p == "basin"){echo 'open';}?>">
                        <a class="nav-link nav-toggle" href="javascript:;"> <i class="fa fa-diamond"></i> <span class="title">Genel Modüller</span> <span class="arrow"></span> </a>
                        <ul class="sub-menu">

                            <li class="nav-item <?php if($p == "anlasmali_kurumlar"){echo 'active';}?>">
                                <a class="nav-link" href="admin.php?p=anlasmali_kurumlar"> <span class="title">Anlaşmalı Kurumlarımız</span> </a>
                            </li>

                            <li class="nav-item <?php if($p == "basin"){echo 'active';}?>">
                                <a class="nav-link" href="admin.php?p=basin"> <span class="title">Basında Baromuz</span> </a>
                            </li>

                            <li class="nav-item <?php if($p == "sorular"){echo 'active';}?>">
                                <a class="nav-link" href="admin.php?p=sorular"> <span class="title">Sık Sorulan Sorular</span> </a>
                            </li>

                             <li class="nav-item <?php if($p == "linkler"){echo 'active';}?>">
                                <a class="nav-link" href="admin.php?p=linkler"> <span class="title">Önemli Linkler</span> </a>
                            </li>



                        </ul>
                    </li>
 -->

                     <!-- <li class="nav-item <?php if($p == "ilanlar"){echo 'active';}?>">
                        <a class="nav-link" href="admin.php?p=ilanlar"><i class="fa fa-eye"></i> <span class="title">Rezervasyonlar</span>
                        <span class="label label-warning pull-right"><?=$ilan_say;?></span>
                        </a>
                    </li> -->

                     <li class="nav-item <?php if($p == "mesajlar"){echo 'active';}?>">
                        <a class="nav-link" href="admin.php?p=mesajlar"><i class="fa fa-envelope"></i> <span class="title">Gelen Kutusu</span>
                        <span class="label label-warning pull-right"><?=$mesaj_say;?></span>
                        </a>
                    </li>

                    <!-- <li class="nav-item <?php if($p == "uyeler"){echo 'active';}?>">
                        <a class="nav-link" href="admin.php?p=uyeler"><i class="fa fa-users"></i> <span class="title">Üyeler</span>
                        <span class="label label-warning pull-right"><?=$uye_say;?></span>
                        </a>
                    </li> -->





                </ul>
            </div>
        </div>
        <!-- End page sidebar wrapper -->
        <!-- Start page content wrapper -->
        <div class="page-content-wrapper animated fadeInRight">
            <div class="page-content">

			

				<?php

	                $pdir   = 'pages/'.$p.'.php';

	                if($p == ''){

	                    require "pages/admin.php";

	                }elseif(file_exists($pdir)){

	                    require $pdir;

	                }else{

	                    require "pages/404.php";

	                }

	            ?>





            </div>
        </div>
    </div>
    </div>
    <!-- Go top -->
    <a href="#" class="scrollup"><i class="fa fa-chevron-up"></i></a>
    <!-- Go top -->
    	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="assets/js/vendor/jquery.min.js"></script>
	<!-- bootstrap js -->
	<script src="assets/js/vendor/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/vendor/jasny-bootstrap.min.js" charset="UTF-8"></script>
    <script type="text/javascript" src="assets/js/vendor/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="assets/js/vendor/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
	<!--  morris Charts  -->
	


    <!-- dataTables-->
	<script type="text/javascript" src="assets/js/vendor/jquery.dataTables.js"></script>
	<script type="text/javascript" src="assets/js/vendor/dataTables.bootstrap.min.js"></script>
	<!-- js for print and download -->
	<script type="text/javascript" src="assets/js/vendor/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="assets/js/vendor/buttons.flash.min.js"></script>
	<script type="text/javascript" src="assets/js/vendor/jszip.min.js"></script>
	<script type="text/javascript" src="assets/js/vendor/pdfmake.min.js"></script>
	<script type="text/javascript" src="assets/js/vendor/vfs_fonts.js"></script>
	<script type="text/javascript" src="assets/js/vendor/buttons.html5.min.js"></script>
	<script type="text/javascript" src="assets/js/vendor/buttons.print.min.js"></script>
	<script type="text/javascript" src="assets/js/vendor/dataTables.responsive.min.js"></script>
	<script type="text/javascript" src="assets/js/vendor/dataTables.fixedHeader.min.js"></script>
    
	<script src="assets/js/vendor/chartJs/Chart.bundle.js"></script>
	<script src="assets/js/dashboard1.js"></script>
	<!-- slimscroll js -->
	<script type="text/javascript" src="assets/js/vendor/jquery.slimscroll.js"></script>
	<!-- pace js -->
	<script src="assets/js/vendor/pace/pace.min.js"></script>
	<!-- Sparkline -->
	<script src="assets/js/vendor/jquery.sparkline.min.js"></script>
	<!-- main js -->
		<script src="assets/js/main.js"></script>
	<!-- AdminUI demo js-->
	<script src="assets/js/adminUIdemo.js"></script>
    <!-- Ck Editör -->
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>

    <!-- webonda -->
    <script type="text/javascript" src="assets/webonda/jquery.form.min.js"></script>
    <script type="text/javascript" src="assets/webonda/main_script.js"></script>
    <script type="text/javascript" src="assets/webonda/webonda.js?v=12345676"></script>        

    <script>
        var dataSet = [
            ["Jordan Belfort", "System Architect", "Edinburgh", "5421", "2011/04/25", "$320,800"],
["Naomi Lapaglia", "Accountant", "Tokyo", "8422", "2011/07/25", "$170,750"],
["Auckland Straight Line Host", "Junior Technical Author", "San Francisco", "1562", "2009/01/12", "$86,000"],
["Donnie Azoff", "Senior Javascript Developer", "Edinburgh", "6224", "2012/03/29", "$433,060"],
["Mark Hanna", "Accountant", "Tokyo", "5407", "2008/11/28", "$162,700"],
["Jean-Jacques Saurel", "Integration Specialist", "New York", "4804", "2012/12/02", "$372,000"],
["Patrick Denham", "Sales Assistant", "San Francisco", "9608", "2012/08/06", "$137,500"],
["Teresa Petrillo", "Integration Specialist", "Tokyo", "6200", "2010/10/14", "$327,900"],
["Brad", "Javascript Developer", "San Francisco", "2360", "2009/09/15", "$205,500"],
["Max Belfort", "Software Engineer", "Edinburgh", "1667", "2008/12/13", "$103,600"],
["Manny Riskin", "Office Manager", "London", "3814", "2008/12/19", "$90,560"],
["Aunt Emma", "Support Lead", "Edinburgh", "9497", "2013/03/03", "$342,000"],
["Chantalle", "Regional Director", "San Francisco", "6741", "2008/10/16", "$470,600"],
["Nicky 'Rugrat' Koskoff", "Senior Marketing Designer", "London", "3597", "2012/12/18", "$313,500"],
["Captain Ted Beecham", "Regional Director", "London", "1965", "2010/03/17", "$385,750"],
["Leah Belfort", "Marketing Designer", "London", "1581", "2012/11/27", "$198,500"],
["Toby Welch", "Chief Financial Officer (CFO)", "New York", "3059", "2010/06/09", "$725,000"],
["Chester Ming", "Systems Administrator", "New York", "1721", "2009/04/10", "$237,500"],
["Alden 'Sea Otter' Kupferberg", "Software Engineer", "London", "2558", "2012/10/13", "$132,000"],
["Janet", "Personnel Lead", "Edinburgh", "2290", "2012/09/26", "$217,500"],
["Robbie ", "Development Lead", "New York", "1937", "2011/09/03", "$345,000"],
["Steve Madden", "Chief Marketing Officer (CMO)", "New York", "6154", "2009/06/25", "$675,000"],
["Kimmie Belzer", "Pre-Sales Support", "New York", "8330", "2011/12/12", "$106,450"],
["Hildy Azoff", "Sales Assistant", "Sidney", "3023", "2010/09/20", "$85,600"],
["Lucas Solomon", "Chief Executive Officer (CEO)", "London", "5797", "2009/10/09", "$1,200,000"],
["Honorary Samantha Stogel", "Developer", "Edinburgh", "8822", "2010/12/22", "$92,575"],
["Nolan Drager", "Regional Director", "Singapore", "9239", "2010/11/14", "$357,650"],
["Jenette Caldwell", "Software Engineer", "San Francisco", "1314", "2011/06/07", "$206,850"],
["Jennifer Acosta", "Chief Operating Officer (COO)", "San Francisco", "2947", "2010/03/11", "$850,000"],
["Jennifer Chang", "Regional Marketing", "Tokyo", "8899", "2011/08/14", "$163,000"],
["Jessica E. Summerville", "Integration Specialist", "Sidney", "2769", "2011/06/02", "$95,400"],
["Jonas Alexander", "Developer", "London", "6832", "2009/10/22", "$114,500"],
["Lael Greer", "Technical Author", "London", "3606", "2011/05/07", "$145,000"],
["Martena Mccray", "Team Leader", "San Francisco", "2860", "2008/10/26", "$235,500"],
["Michael Bruce", "Post-Sales support", "Edinburgh", "8240", "2011/03/09", "$324,050"],
["Michael Silva", "Marketing Designer", "San Francisco", "5384", "2009/12/09", "$85,675"]

        ];
        $(document).ready(function() {
            // Flexible table

            $('#example').DataTable();
            $('#wo_tablo').DataTable();
            $('#wo_tabloo').DataTable();

            // Scroll Horizontal example

            var table = $('#example2').DataTable( {
                    responsive: true,
                    paging: false,
                     fixedHeader: {
                        headerOffset: 40
                    }
                } );
 
 
            // Check Click row

            var table = $('#example3').DataTable();
            $('#example3 tbody').on('click', 'tr', function() {
                var data = table.row(this).data();
                alert('You clicked on ' + data[0] + '\'s row');
            });


            // Javascript sourced data table

            $('#example4').DataTable({
                data: dataSet,
                columns: [{
                    title: "Name"
                }, {
                    title: "Position"
                }, {
                    title: "Office"
                }, {
                    title: "Extn."
                }, {
                    title: "Start date"
                }, {
                    title: "Salary"
                }]
            });

            //addRow 
            var t = $('#example5').DataTable();
            var counter = 1;

            $('#addRow').on('click', function() {
                t.row.add([
                    counter + '.1',
                    counter + '.2',
                    counter + '.3',
                    counter + '.4',
                    counter + '.5'
                ]).draw(false);

                counter++;
            });




            // Individual column searching

            // Setup - add a text input to each footer cell
            $('#example6 tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input class="form-control dataSearch" type="text" placeholder="Search ' + title + '" />');
            });

            // DataTable
            var table = $('#example6').DataTable();

            // Apply the search
            table.columns().every(function() {
                var that = this;

                $('input', this.footer()).on('keyup change', function() {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });


            // Advanced
            $('#example7').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    text: 'copy',
                    extend: "copy",
                    className: 'btn dark btn-outline'
                }, {
                    text: 'csv',
                    extend: "csv",
                    className: 'btn aqua btn-outline'
                }, {
                    text: 'excel',
                    extend: "excel",
                    className: 'btn aqua btn-outline'
                }, {
                    text: 'pdf',
                    extend: "pdf",
                    className: 'btn yellow  btn-outline'
                }, {
                    text: 'print',
                    extend: "print",
                    className: 'btn purple  btn-outline'
                }]
            });



        });
    </script>

    <script type="text/javascript">
    $('.form_datetime').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
        showMeridian: 1
    });
  $('.form_date').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
    });
  $('.form_time').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 1,
    minView: 0,
    maxView: 1,
    forceParse: 0
    });

        $(function () {
            $('#datetimepicker12').datetimepicker({
                inline: true,
                sideBySide: true
            });
      
       $('input[name="daterange"]').daterangepicker();       

        $('input[name="dateTimeRange"]').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'MM/DD/YYYY h:mm A'
        }
    });

    });
</script>


    <!-- Kaydet Modal -->

<div class="modal fade modal-m" id="kaydet" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Webonda Control Panel</h4>
        </div>
        <div class="modal-body">
            <div id="wo_loading" style="display: none;">
            <center><img src="assets/img/bekleyin.gif" style="width: 200px;"><br>İşleminiz Yapılıyor...</center></div>
            <div id="form_status">
                  
            </div>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn aqua" data-dismiss="modal">TAMAM</button>
        </div> -->
      </div>
    </div>
  </div>



<!-- veri sil modal -->

  <div class="modal fade modal-m" id="veri_sil" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Webonda Control Panel</h4>
        </div>
        <div class="modal-body">
            <div id="verisil_status">
                
            </div>
        </div>
        <div class="modal-footer" id="sil_footer">
          
        </div>
      </div>
    </div>
  </div>


  <!-- ilan işlem modal -->

  <div class="modal fade modal-m" id="ilan_islem" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Webonda Control Panel</h4>
        </div>
        <div class="modal-body">
            <div id="ilan_status">
                
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn aqua" data-dismiss="modal" onclick="window.location ='admin.php?p=ilanlar';">TAMAM</button>
        </div>
      </div>
    </div>
  </div>

    <!-- ilan işlem modal -->

  <div class="modal fade modal-m" id="uye_islem" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Webonda Control Panel</h4>
        </div>
        <div class="modal-body">
            <div id="uye_status">
                
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn aqua" data-dismiss="modal" onclick="window.location ='admin.php?p=uyeler';">TAMAM</button>
        </div>
      </div>
    </div>
  </div>



   <!-- ilan oku modal -->

  <div class="modal fade modal-m" id="ilan_oku" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="m_ilanbaslik">Webonda Control Panel</h4>
        </div>
        <div class="modal-body">
            <div id="ilan_icerik">
                
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn aqua" data-dismiss="modal">TAMAM</button>
        </div>
      </div>
    </div>
  </div>

   <!-- iüye bilgi modal -->

  <div class="modal fade modal-m" id="uye_bilgi" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="uye_baslik">Webonda Control Panel</h4>
        </div>
        <div class="modal-body">
            <div id="uye_icerik">
                
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn aqua" data-dismiss="modal">TAMAM</button>
        </div>
      </div>
    </div>
  </div>







    
</body>
</html>



