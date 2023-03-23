<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/category.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database ->connect ();
 
//Instantiate quote post object
$post = new Category($db);

//Get ID
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

//GET Post 
$post->read_single();

//create array
$post_arr = array(
    'id' => $post->id,
    'category' => $post->category
);

//Make JSON
print_r(json_encode($post_arr));
