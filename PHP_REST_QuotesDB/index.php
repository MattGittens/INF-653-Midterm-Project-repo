<?php
header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title> Midterm Project </title>
</head>
<body>
    <?php include_once('./view/header.php');
    include_once('./api/author/create.php');
    include_once('./api/author/delete.php');
    include_once('./api/author/index.php');
    include_once('./api/author/read_single.php');
    include_once('./api/author/update.php');
    include_once('./api/author/read.php');
    
    include_once('./api/category/create.php');
    include_once('./api/category/delete.php');
    include_once('./api/category/index.php');
    include_once('./api/category/read_single.php');
    include_once('./api/category/update.php');
    include_once('./api/category/read.php');
    
    include_once('./api/quotes/create.php');
    include_once('./api/quotes/delete.php');
    include_once('./api/quotes/index.php');
    include_once('./api/quotes/read_single.php');
    include_once('./api/quotes/update.php');
    include_once('./api/quotes/read.php');
    
    ?>
    
</body>
</html>