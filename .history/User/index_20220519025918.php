<?php 

    session_start();
    require_once('../db.php');

    if(isset($_SESSION['id'])){
        $var = "Bonjour" . $_SESSION['pseudo'];
    } else {
        $var = "Bonjour à tous"
    }
?>