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

$quote->read_single();
if(is_null($quote->quote)){
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
} else {


//delete author
if($author->delete()){
    echo json_encode(
        array('id'=>$author->id)
    );
    
} else {
    echo json_encode(
        array('message' => 'author not deleted')
    );
}
}