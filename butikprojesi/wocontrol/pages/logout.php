<?php
    
    $_SESSION["admin_oturum"] = false;
    session_destroy();

    header("Location: index.php");

?>