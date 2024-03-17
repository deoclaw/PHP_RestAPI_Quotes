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
$category->id = $data->id;

//create category
if($category->delete()){
    echo json_encode(
        array('message'=>'category deleted')
    );
} else {
    echo json_encode(
        array('message' => 'category not deleted')
    );
}