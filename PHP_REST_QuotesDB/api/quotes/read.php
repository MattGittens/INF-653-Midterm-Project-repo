<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/quotes.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database ->connect ();
 
//Instantiate quote post object
$post = new Quotes($db);

//Quote post query
$result = $post->read();
//Get row count
$num = $result ->rowCount();

//Check if any posts
if(num>0){
$posts_arr = array();
$posts_arr['data'] = array();

while($row = $result->fetch(PDO::FETCH_ASSOC)){
extract($row);

$post_item = array(
'id' =>$id,
'quote'=> html_entity_decode($quote),
'author_id'=> $author_id,
'category_id' => $category_id,
'category_name' => $category_name,
'author_name' => $author_name
);

//Pusg to data
array_push($posts_arr['data'], $post_item);
}

//Turn to JSON & output
echo json_encode($posts_arr);

}else{
echo json_encode (
    array('message' => 'No Posts Found')
);
}