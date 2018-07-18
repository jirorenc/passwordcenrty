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


//Set ID to update
$post->id=94;

$post->aktif=$_POST['aktif'];
$post->id=$_POST['id'];
//Created post
if($post->update()){
    echo json_encode(
        array('message'=>'Post Update')
    );
}else{
    echo json_encode(
        array('message'=>'Post Not Update')
    );
}
