<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method=$_SERVER['REQUEST_METHOD'];

    if($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }

    //for post and put, determine if an id is sent through! otherwise nix

    switch ($method) {
        case 'GET':
            require ('read.php');
            break;
        case 'POST':
            if(is_null($data->author)){
                echo json_encode(
                    array('message' => 'Missing Required Parameters')
                );
                break;
            }
            require ('create.php');
            break;
        case 'PUT':
            if(is_null($data->author)){
                echo json_encode(
                    array('message' => 'Missing Required Parameters')
                );
                break;
            }
            require ('update.php');
            break;
        case 'DELETE':
            require ('delete.php');
            break;
        default:
            echo 'Uh-oh!';
            break;
    }