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
$restful=$post->read();
$num=$restful->rowCount();

//Check if any posts
if($num>0){
    //post array
    $posts_arr=array();
    $posts_arr['data']=array();
    while ($row=$restful->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post_item=array(
            'id' =>$id,
            'firma_adi'=>$firma_adi,
            'kullanici_adi'=> $kullanici_adi
        );
        //Push to "data"
        array_push($posts_arr['data'],$post_item);

    }
    //Turn to Json output
    echo json_encode($posts_arr);

}else{
echo json_encode(
    array('message'=>'No Posts Found')
);
}