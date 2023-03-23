<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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

//Set ID to update
$quote->id = $data->id;



//Delete quote
if($quote->delete()) {
echo json_encode(
    array('message' =>'quote Deleted')
)
}else{
    echo json_encode(
        array('message' =>'quote Not Deleted')
    )
}