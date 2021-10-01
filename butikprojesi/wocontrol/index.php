<?php @session_start(); @ob_start(); include("system/config.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WOCONTROL - KSENYABUTİK</title>
	<!-- Bootstrap -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<!-- slimscroll -->
	<link href="assets/css/jquery.slimscroll.css" rel="stylesheet">
	<!-- Fontes -->
	<link href="assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="assets/css/simple-line-icons.css" rel="stylesheet">
	<!-- all buttons css -->
	<link href="assets/css/buttons.css" rel="stylesheet">
	<!-- animate css -->
<link href="assets/css/animate.css" rel="stylesheet">
<!-- top nev css -->
<link href="assets/css/page-header.css" rel="stylesheet">
<!-- adminui main css -->
	<link href="assets/css/main.css" rel="stylesheet">
	<!-- Light theme css -->
	<link href="assets/css/light.css" rel="stylesheet">
	<!-- media css for responsive  -->
	<link href="assets/css/main.media.css" rel="stylesheet">
	<!--[if lt IE 9]> <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
	<!--[if lt IE 9]> <script src="dist/html5shiv.js"></script> <![endif]-->
</head>

<body class="gray-bg login">
	<div class="middle-box text-center loginscreen ">
		<div class="widgets-container">
			<div>
				<img src="assets/img/webonda.png" style="width: 80%;">
			</div>
			<br>
			<h3>Yönetim Paneli</h3>
			<br>
			<form action="" method="POST" class="top15">
				<div class="form-group">
					<input type="email" name="email" id="email" required="" placeholder="Kullanıcı Adınız" class="form-control">
				</div>
				<div class="form-group">
					<input type="password" name="password" id="password" required="" placeholder="Parolanız" class="form-control">
				</div>
				<button class="btn aqua block full-width bottom15" type="submit">Giriş Yap</button>



            <?php
			     if(@$_POST){

			        $email = trim(strip_tags($_POST['email']));
			        $password  = md5(trim(strip_tags($_POST['password'])));

		            $uyegiris = $wo_db->prepare("SELECT * FROM user WHERE email=? AND parola=? ");
		                $uyegiris->execute(array($email,$password));
		                if($uyegiris->rowCount()){

		                    foreach ($uyegiris as $uyebilgi){

		                       $admin_id 		= $uyebilgi['id'];
		                       $admin_adsoyad   = $uyebilgi['adsoyad'];
		                       $admin_yetki   	= $uyebilgi['yetki'];
		                    }

		                   $_SESSION["admin_oturum"] = true;
		                   $_SESSION["admin_id"] 	= $admin_id;
		                   $_SESSION["yetki"] 		= $admin_yetki;
		                   $_SESSION['admin_adsoyad'] = $admin_adsoyad;

		                   header("Location: admin.php?p=admin");

		                   //Burada index.php Sayfasına Yönlendiriyoruz.
		                   // echo '<script>window.location.replace("http://localhost:82/Dersler/index.php/")</script>';

		                }else{
		                   echo '<center>
               					<span style="line-height: 80px; color: #ec5656; font-size:18px;">Giriş Bilgileriniz Hatalı !</span>
               					<br>
               					<span style="color: #42474d; font-size:12px;">Doğru bilgiler ile yeniden giriş yapmayı deneyiniz. Bir hata olduğunu düşünüyorsanız yöneticinize başvurunuz.</span>
               				</center>';
		                }

			     }
			?>






			</form>
			<p class="top15"> <small>Webonda İnteractive Media &copy; 2017</small> </p>
		</div>
	</div>
</body>

</html>