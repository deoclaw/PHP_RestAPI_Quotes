<?php

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//instantiate quote object
$quote = new Quote($db);

//get raw posted data
$data = json_decode(file_get_contents("php://input"));

//assign what's in the data obj to the quote obj
$quote->id = $data->id;
$quote->quote = $data->quote;
$quote->author_id = $data->author_id;
$quote->category_id = $data->category_id;


//create quote
if($quote->create()){
    echo json_encode(
        array('message'=>'quote created')
    );
} else {
    echo json_encode(
        array('message' => 'quote not created')
    );
}