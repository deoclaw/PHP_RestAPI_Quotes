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

//assign what's in the data obj to the author obj
$author->id = $data->id;
$author->author = $data->author;

//create author

if($author->create()){
    echo json_encode(
        array('id'=>$author->id,
        "author"=>$author->author)
    );
} else {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
}