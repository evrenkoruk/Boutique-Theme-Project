<?php @session_start(); @ob_start();  include("system/config.php"); include("system/wofonk.php");



if(@$_SESSION["admin_oturum"] != true){

	header("Location: index.php");
	exit();

}


$p      = $_GET["p"];
$pdir   = 'ajax/'.$p.'.php';


if(file_exists($pdir)){

    require $pdir;

}else{
echo 'File Not Found';
}

?>