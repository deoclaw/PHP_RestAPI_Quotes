<?php

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//instantiate Q object
$quote = new Quote($db);

//get raw posted data
$data = json_decode(file_get_contents("php://input"));

if(is_null($data->id)){
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
}

$quote->read_single();
if(is_null($quote->quote)){
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
} else {

//assign what's in the data obj to the quote obj
$quote->id = $data->id;

//create quote
if($quote->delete()){
    echo json_encode(
        array('id'=>$quote->id)
    );
} else {
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
}
}