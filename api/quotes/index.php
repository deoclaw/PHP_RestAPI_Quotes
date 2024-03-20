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
    include_once '../../models/Quote.php';
    include_once '../../functions/isValid.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate quote object
    $quote = new Quote($db);

    switch ($method) {
        case 'GET':
            if(isset($_GET['id'])){
                if(isValid($_GET['id'], $quote)){
                    require('read.php');
                    break;
                }
                else{
                    echo json_encode(
                        array('message' => 'No Quotes Found')
                    );
                    break;
                }
            }
            require ('read.php');
            break;
        case 'POST':
            require ('create.php');
            break;
        case 'PUT':
            require ('update.php');
            break;
        case 'DELETE':
            $data = json_decode(file_get_contents("php://input"));
            if(isset($data->id)){
                if(isValid($id=$data->id, $quote)){
                    require ('delete.php');
                }
            }else{
                echo json_encode(
                    array('message' => 'No Quotes Found')
                );
            }
            break;
        default:
            echo 'Uh-oh!';
            break;
    }