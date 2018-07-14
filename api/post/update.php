<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-type,Access-Control-Allow-Methods,
Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../modals/Post.php';
//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post objecta
$post = new Post($db);

//get row posted data
$data = json_decode(file_get_contents("php://input"));

//Set ID to update
$post->id=$data->id;

$post->kullanici_adi=$data->name;
$post->created_at=$data->created_at;

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
