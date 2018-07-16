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
$control = new kategori($db);


//get row posted data
$data = json_decode(file_get_contents("php://input"));
$post->kategori_adi=$_POST['k_name'];
$post->kullanici_adi=$_POST['u_name'];
$post->sifre=md5($_POST['password']);
$post->aktif=true;
$post->id= $_POST['id'];
$control->kategori_adi=$_POST['k_name'];
//Created post
if($control->control()){
    if( $post->create()){
        echo json_encode(
            array('message'=> 1)
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


