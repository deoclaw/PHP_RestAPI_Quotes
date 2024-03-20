<?php

// include_once '../../config/Database.php';
// include_once '../../models/Author.php';

// //Instantiate DB & Connect
// $database = new Database();
// $db = $database->connect();

// //instantiate Author object
// $author = new Author($db);

//get raw posted data
// $data = json_decode(file_get_contents("php://input"));

// if(is_null($data->author)){
//     echo json_encode(
//         array('message' => 'Missing Required Parameters')
//     );
//     quit();
// }

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
