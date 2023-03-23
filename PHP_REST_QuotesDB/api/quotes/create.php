<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
include_once '../../config/Database.php';
include_once '../../models/quotes.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database ->connect ();
 
//Instantiate quote post object
$quote = new Quotes($db);

//Get raw quoteed data
$data =json_decode(file_get_contents("php://input"));

$quote->body = $data->body;
$quote->author = $data->author;
$quote->category_id = $data->category_id;

//Create quote
if($quote->create()) {
echo json_encode(
    array('message' =>'quotes Created')
)
}else{
    echo json_encode(
        array('message' =>'quotes Not Created')
    )
}