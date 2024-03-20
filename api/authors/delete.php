<?php



//assign what's in the data obj to the author obj
$author->id = $data->id;

//delete author
if($author->delete()){
    echo json_encode(
        array('id'=>$author->id)
    );
    
} else {
    echo json_encode(
        array('message' => 'author not deleted')
    );
}