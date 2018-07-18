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
$id= $kullanici_adi=$kategori_adi=$uyeler_fk=$aktif="";
//Blog post query
$post->uyeler_fk=$_POST['uyeler_fk'];
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
            'kategori_adi'=>$kategori_adi,
            'kullanici_adi'=> $kullanici_adi,
            'uyeler_fk'=> $uyeler_fk,
            'aktif'=>$aktif
        );
        //Push to "data"
        array_push($posts_arr['data'],$post_item);

    }
    //Turn to Json output
    echo json_encode($posts_arr);

}else{
    echo json_encode(
        array('message'=>'0')
    );
}