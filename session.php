<?php
session_start();

if (isset($_GET['kullanici_adi'])){
    $_SESSION["kullanici_adi"]= $_GET['kullanici_adi'];
}
if (isset($_GET['id'])){
    $_SESSION["id"]= $_GET['id'];
}
if (isset($_GET['firma'])){
    $_SESSION["firma"]= $_GET['firma'];
}
if (isset($_GET['email'])){
    $_SESSION["email"]= $_GET['email'];
}
if (isset($_GET['tab'])){
    $_SESSION["tab"]= $_GET['tab'];
}
?>