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
if(is_null($data->author_id)){
    echo json_encode(
        array('message' => 'author_id Not Found')
    );
    exit();
}

if (is_null($data->category_id)){
    echo json_encode(
        array('message' => 'category_id Not Found')
    );
    exit();
}

//assign what's in the data obj to the quote obj
$quote->id = $data->id;
$quote->quote = $data->quote;
$quote->author_id = $data->author_id;
$quote->category_id = $data->category_id;


//create quote
if($quote->update()){
    echo json_encode(
        array(
            'id'=>$quote->id,
            'quote'=>$quote->quote,
            'author_id'=>$quote->author_id,
            'category_id'=>$quote->category_id)
    );
} else {
    echo json_encode(
        array('message' => 'quote not updated')
    );
}