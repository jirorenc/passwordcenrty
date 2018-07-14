<?php
session_start();
if (isset($_GET['kullanici_adi'])){
    $_SESSION["kullanici_adi"]= $_GET['kullanici_adi'];
}
?>