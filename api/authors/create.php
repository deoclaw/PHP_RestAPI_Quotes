<?php

include_once '../../config/Database.php';
include_once '../../models/Author.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//instantiate Author object
$author = new Author($db);

//get raw posted data
$data = json_decode(file_get_contents("php://input"));

if(is_null($data->author)){
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
    exit();
}

//assign what's in the data obj to the author obj
// $author->id = $data->id;
$author->author = $data->author;

//create author

if($author->create()){
    $author_arr=array(
        'id'=>$author->id,
        'author'=>$author->author
    );
    print_r(json_encode($author_arr));
} else {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
}