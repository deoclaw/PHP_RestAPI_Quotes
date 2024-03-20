<?php


//assign what's in the data obj to the category obj
$category->id = $data->id;

//create category
if($category->delete()){
    echo json_encode(
        array('id'=>$category->id)
    );
} else {
    echo json_encode(
        array('message' => 'category not deleted')
    );
}