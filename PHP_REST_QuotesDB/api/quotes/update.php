<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
include_once '../../config/Database.php';
include_once '../../models/quotes.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database ->connect ();
 
//Instantiate quote post object
$post = new Quotes($db);

//Get raw posted data
$data =json_decode(file_get_contents("php://input"));

//Set ID to update
$post->id = $data->id;
$post->quote = $data->quote;
$post->author_id = $data->author_id;
$post->category_id = $data->category_id;

//Update post
if($post->update()) {
echo json_encode(
    array('message' =>'Post Updated')
)
}else{
    echo json_encode(
        array('message' =>'Post Not Updated')
    )
}