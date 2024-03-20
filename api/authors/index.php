<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method=$_SERVER['REQUEST_METHOD'];

    if($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';
    include_once '../../functions/isValid.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate Author object
    $author = new Author($db);
    
    //for post and put, determine if an id is sent through! otherwise nix

    switch ($method) {
        case 'GET':
            require ('read.php');
            break;
        case 'POST':
            if(isValid($_GET['id'], $author)){
            require ('create.php');
            }else{
                echo json_encode(
                    array('message' => 'Missing Required Parameters')
                );
            }
            break;
        case 'PUT':
            $data = json_decode(file_get_contents("php://input"));
            if(is_null($data->author)){
                echo json_encode(
                    array('message' => 'Missing Required Parameters')
                );
            }
            elseif(isValid($id=$data->id, $author)){
                require ('update.php');
            }else{
                echo json_encode(
                    array('message' => 'Missing Required Parameters')
                );
            }
            break;
        case 'DELETE':
            require ('delete.php');
            break;
        default:
            echo 'Uh-oh!';
            break;
    }