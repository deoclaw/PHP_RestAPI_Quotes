<?php


$author->author = $data->author;

//create author

if($author->create()){
    $author_arr=array(
        'id'=>$author->id,
        'author'=>$author->author
    );
    echo json_encode(
        $author_arr
    );
} else {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
}