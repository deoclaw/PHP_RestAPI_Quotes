<?php



//assign what's in the data obj to the category obj
// $category->id = $data->id;
$category->category = $data->category;

//create category
if($category->create()){
    $category_arr=array(
        'id'=>$category->id,
        'category'=>$category->category
    );
    echo json_encode(
        $category_arr
    );
} else {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
}