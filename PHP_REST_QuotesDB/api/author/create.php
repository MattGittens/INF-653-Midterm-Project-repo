<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
include_once '../../config/Database.php';
include_once '../../models/author.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database ->connect ();
 
//Instantiate quote post object
$post = new Author($db);

//Get raw posted data
$data =json_decode(file_get_contents("php://input"));

$post->author = $data->author;

//Create post
if($post->create()) {
echo json_encode(
    array('message' =>'Author Created')
)
}else{
    echo json_encode(
        array('message' =>'Author Not Created')
    )
}