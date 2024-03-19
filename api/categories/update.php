<?php

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//instantiate Category object
$category = new Category($db);

//get raw posted data
$data = json_decode(file_get_contents("php://input"));

//set id to be updated
$category->id = $data->id;

//assign what's in the data to the category obj
$category->category = $data->category;

//create category
if($category->update()){
    echo json_encode(
        array('id'=>$author->id,
        "author"=>$author->author)
    );
} else {
    echo json_encode(
        array('message' => 'category not updated')
    );
}