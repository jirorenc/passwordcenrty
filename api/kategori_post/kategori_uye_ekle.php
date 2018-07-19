<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');


include_once '../../config/Database.php';
include_once '../../modals/kategori.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new kategori($db);

//get row posted data

$post->kategori_fk=$_POST['ka_id'];
$post->kullanici_adi=$_POST['uye_name'];
$post->sifre=$_POST['uye_password'];
$post->e_mail=$_POST['uye_email'];
$post->aktif=true;
$post->aktif_baslangic=$_POST['datetime_begin'];
$post->aktif_bitis=$_POST['datetime_finish'] ;


if($post->uye_create()){
        echo json_encode(
            array('message'=>1)
        );
}
else{
    echo json_encode(
        array('message'=>0)
    );
}


