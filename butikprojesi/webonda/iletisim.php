<style type="text/css">

	.uyari{

	    background: #e2700b;
	    color: #713500;
	    padding: 11px;
	    font-size: 14px;
	}

	.hata{
		
	    background: #bf1616;
    	color: #6f0303;
	    padding: 11px;
	    margin-left: 30px;
	}

	.basarili{
		
	    background: #14a904;
    	color: #063500;
	    padding: 11px;
	    font-size: 14px;
	}

</style>

<?php @session_start(); @ob_start();  include("../wocontrol/system/config.php"); include("../wocontrol/system/wofonk.php");


	if(@$_POST){


			?>
				<script type="text/javascript">
					$("#form-submit").html('<i class="fa fa-paper-plane"></i> GÖNDERİLİYOR...');
				</script>
			<?


		$adsoyad 	= strip_tags($_POST["adsoyad"]);
		$email		= strip_tags($_POST["email"]);
		$telefon	= strip_tags($_POST["telefon"]);
		$konu		= strip_tags($_POST["konu"]);
		$mesaj 		= nl2br($_POST["mesaj"]);

		if($adsoyad == "" || $email == "" || $konu == "" || $mesaj == ""){
			echo '<div class="uyari">Lütfen gerekli alanları doldurun !</div>';
			?>


				<script type="text/javascript">
					$("#form-submit").html('<i class="fa fa-paper-plane"></i> GÖNDER');
				</script>


			<?
			exit();
		}

		// $query = $wo_db->prepare("INSERT INTO mesajlar SET
		// baslik = ?,
		// adsoyad = ?,
		// email = ?,
		// icerik  = ?");

		// $insert = $query->execute(array(
		//      $konu, $adsoyad, $email, $mesaj
		// ));

			


			// İNFOYA MAİL GÖNDERİYORUM

			$mail_icerik = '
			  <p><b>AD SOYAD: </b> '.$adsoyad.'</p>
              <p><b>E-POSTA : </b> '.$email.'</p>
              <p><b>E-POSTA : </b> '.$telefon.'</p>
              <p><b>KONU : </b> '.$konu.'</p>
              <p><b>MESAJ : </b> '.$mesaj.'</p>
              <br>
            ';

	           require 'mail/PHPMailerAutoload.php';
              //Create a new PHPMailer instance
              $mail = new PHPMailer;
              //Tell PHPMailer to use SMTP
              $mail->isSMTP();
              //Enable SMTP debugging
              // 0 = off (for production use)
              // 1 = client messages
              // 2 = client and server messages
              $mail->SMTPDebug = 0;
              //Ask for HTML-friendly debug output
              $mail->Debugoutput = 'html';
              //Set the hostname of the mail server
              $mail->Host = "smtp.yandex.ru";
              //Set the SMTP port number - likely to be 25, 465 or 587
              $mail->Port = 465;
	          $mail->SMTPSecure = 'ssl';
              //Whether to use SMTP authentication
              $mail->SMTPAuth = true;
              //Username to use for SMTP authentication
              $mail->Username = "noreply@lollis.com.tr";
              //Password to use for SMTP authentication
              $mail->Password = "lollis.noreply123";
              $mail->CharSet = "utf-8";
              //Set who the message is to be sent from
              $mail->setFrom($mail->Username, 'lollis.com.tr');
              //Set an alternative reply-to address
              $mail->addReplyTo($email, $adsoyad);
              //Set who the message is to be sent to
              $mail->addAddress('info@lollis.com.tr', 'Lollis Beauty Make Up');
              //Set the subject line
              $mail->Subject = $adsoyad.' - İletişim Formu Mesajı - lollis.com.tr';
              //Read an HTML message body from an external file, convert referenced images to embedded,
              //convert HTML into a basic plain-text alternative body
              $mail->msgHTML($mail_icerik);

              $mail->send();

				
				echo '<div class="basarili">Mesajınız için teşekkür ederiz. En kısa sürede yanıtlayacağız.</div>';

			?>
				<script type="text/javascript">
					document.getElementById("forms").reset();
					$("#form-submit").html('<i class="fa fa-paper-plane"></i> GÖNDER');
				</script>
			<?

	}





?>
	