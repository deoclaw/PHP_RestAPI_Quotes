<?php


//set id to be updated
$author->id = $data->id;

//assign what's in the data to the author obj
$author->author = $data->author;

//create author
if($author->update()){
    echo json_encode(
        array('id'=>$author->id,
        "author"=>$author->author)
    );
} else {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
}
