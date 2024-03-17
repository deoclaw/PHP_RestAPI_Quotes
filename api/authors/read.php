<?php
// Headers

include_once '../../config/Database.php';
include_once '../../models/Author.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//instantiate Author object
$author = new Author($db);

//get ID from URL
if ($author->id=isset($_GET['id'])){
    //reads single
    $author->id = $_GET['id']; //assign
    $author->read_single();
    $author_arr=array(
        'id'=>$author->id,
        'author'=>$author->author
    );
    print_r(json_encode($author_arr));
} else {
    //reads all
    //author query
    $result = $author->read();

    //get row count of query result
    $num = $result->rowCount();

    //check if any authors
    if ($num > 0){
        $authors_arr = array(); //author array
        $authors_arr['data'] = array(); //want data from json

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            //we get an associative array?
            extract($row);
            $author_item = array(
                'id' => $id,
                'author' => $author
            );
            //push to 'data'
            array_push($authors_arr['data'], $author_item);
        }

        //turn to JSON and output
        echo json_encode($authors_arr);

    } else {
        //no authors
        echo json_encode(
            array('message'=>'Authors Not Found')
        );
    }

}



