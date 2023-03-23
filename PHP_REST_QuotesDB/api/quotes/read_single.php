<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/quotes.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database ->connect ();
 
//Instantiate quote quote object
$quotes = new Quotes($db);

//Get ID
$quotes->id = isset($_GET['id']) ? $_GET['id'] : die();

//GET quote 
$quotes->read_single();

//create array
$quote_arr = array(
    'id' => $quotes->id,
    'quote' => $quotes->body,
    'author_id'=> $quotes->author_id,
    'category_id' => $quotes->category_id,
    'category_name' => $quotes->category_name
    'author_name' => $quotes ->author_name
);

//Make JSON
print_r(json_encode($quote_arr));
