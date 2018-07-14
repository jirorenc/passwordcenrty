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

//Blog post query


$post->kullanici_adi=$_POST['name'];
$post->sifre=$_POST['passwordone'];
//Created post
if($post->login_control()){
        echo json_encode(
            array('message'=>'1'));
}
else{
    echo json_encode(
        array('message'=>'0')
    );
}