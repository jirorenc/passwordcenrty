<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');


include_once '../../config/Database.php';
include_once '../../modals/kategori.php';
include_once '../../modals/kategori_entegrasyon.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new kategori($db);
$control = new kategori($db);
$k_e_post = new kategori_entegrasyon($db);

//get row posted data

$post->kategori_adi=$_POST['k_name'];
$post->kullanici_adi=$_POST['u_name'];
$post->sifre=md5($_POST['password']);
$post->aktif=true;
$post->id= $_POST['id'];
$control->kategori_adi=$_POST['k_name'];
$control->uyeler_fk=$_POST['id'];




//Created post
list($id_kategori,$id_uyeler)=$control->control();
if($id_kategori && $id_uyeler==0){
    if($post->create()){
        $control->kategori_adi=$_POST['k_name'];
        $control->uyeler_fk=$_POST['id'];
        $id_kateg=$control->control();
        $k_e_post->kategori_fk=$id_kateg;
        if(isset($_POST['soap'])){

            $k_e_post->entg_fk=$_POST['soap'];
            $k_e_post->ent_create();
        }
        if(isset($_POST['rest'])){
            $k_e_post->entg_fk=$_POST['rest'];
            $k_e_post->ent_create();
        }
        if(isset($_POST['xml'])){
            $k_e_post->entg_fk=$_POST['xml'];
            $k_e_post->ent_create();
        }
        if(isset($_POST['json'])){
            $k_e_post->entg_fk=$_POST['json'];
            $k_e_post->ent_create();
        }
        echo json_encode(
            array('message'=> 1,'id'=>$id_kateg)
        );
    }else{
        echo json_encode(
            array('message'=> 0)
        );
    }
}
else{
    echo json_encode(
        array('message'=>0)
    );
}


