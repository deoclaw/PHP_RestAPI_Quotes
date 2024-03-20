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
            if(isset($_GET['id'])){
                if(isValid($_GET['id'], $author)){
                    require('read.php');
                    break;
                }
                else{
                    echo json_encode(
                        array('message' => 'author_id Not Found')
                    );
                    break;
                }
            }
            require ('read.php');
            break;
        case 'POST':
            $data = json_decode(file_get_contents("php://input"));
            if(isset($data->author)){
                require ('create.php');
            }else{
                echo json_encode(
                    array('message' => 'Missing Required Parameters')
                );
            }
            break;
        case 'PUT':
            $data = json_decode(file_get_contents("php://input"));
            if(isset($data->author) && isset($data->id)){
                if(isValid($id=$data->id, $author)){
                    require ('update.php');
                }
            }
            else{
                echo json_encode(
                    array('message' => 'Missing Required Parameters')
                );
            }
            break;
        case 'DELETE':
            $data = json_decode(file_get_contents("php://input"));
            if(isset($data->id)){
                if(isValid($id=$data->id, $author)){
                    require ('delete.php');
                }
            }else{
                echo json_encode(
                    array('message' => 'Missing Required Parameters')
                );
            }
            break;
        default:
            echo 'Uh-oh!';
            break;
    }