<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');


include_once '../../config/Database.php';
include_once '../../modals/Post.php';
//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);
$control = new Post($db);

//get row posted data
$data = json_decode(file_get_contents("php://input"));
$post->firma_adi=$_POST['firma_adi'];
$post->kullanici_adi=$_POST['name'];
$post->sifre=md5($_POST['passwordone']);
$post->email=$_POST['email'];
$control->kullanici_adi=$_POST['name'];
//Created post
if($control->control()){
   if( $post->create()){
        echo json_encode(
            array('message'=>'1')
        );
    }else{
        echo json_encode(
            array('message'=>'0')
        );
    }
}
else{
    echo json_encode(
        array('message'=>'0')
    );
}


