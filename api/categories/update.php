<?php


//set id to be updated
$category->id = $data->id;

//assign what's in the data to the category obj
$category->category = $data->category;

//create category
if($category->update()){
    echo json_encode(
        array('id'=>$category->id,
        "category"=>$category->category)
    );
} else {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
}
