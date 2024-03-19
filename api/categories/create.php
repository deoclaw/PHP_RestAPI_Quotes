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

//assign what's in the data obj to the category obj
// $category->id = $data->id;
$category->category = $data->category;

//create category
if($category->create()){
    echo json_encode(
        array('message'=>'category created')
    );
} else {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
}