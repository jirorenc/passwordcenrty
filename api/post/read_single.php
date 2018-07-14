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


// get id

$post->kullanici_adi=isset($_GET['kullanici_adi']) ? $_GET['kullanici_adi']:die();

//Get post
$post->read_single();

//create array

$post_arr=array(
    'id'=>$post->id,
    'kullanici_adi'=>$post->kullanici_adi,
    'firma_adi'=>$post->firma_adi
    );
print_r(json_encode($post_arr));