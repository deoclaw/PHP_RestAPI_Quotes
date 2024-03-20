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
    include_once '../../models/Author.php';
    include_once '../../models/Category.php';
    include_once '../../functions/isValid.php';

    //Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    //instantiate quote object
    $quote = new Quote($db);
    $author = new Author($db);
    $category = new Category($db);


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
            $data = json_decode(file_get_contents("php://input"));
            if(isset($data->quote) && isset($data->author_id) && isset($data->category_id)){
                if(isValid($id=$data->author_id, $$author)){
                    if(isValid($id=$data->category_id, $category)){
                        require ('create.php');
                        break;
                    }else{
                        echo json_encode(
                            array('message' => 'category_id Not Found')
                        );
                        break;
                    }
                } else {
                    echo json_encode(
                        array('message' => 'author_id Not Found')
                    );
                    break;
                }
            }else{
                echo json_encode(
                    array('message' => 'Missing Required Parameters')
                );
            }
            break;
        case 'PUT':
            $data = json_decode(file_get_contents("php://input"));
            if(isset($data->id) && isset($data->quote) && isset($data->author_id) && isset($data->category_id)){
                if(isValid($id=$data->id, $quote))
                {
                    if(isValid($id=$data->author_id, $$author)){
                        if(isValid($id=$data->category_id, $category)){
                            require ('update.php');
                            break;
                        }else{
                            echo json_encode(
                                array('message' => 'category_id Not Found')
                            );
                            break;
                        }
                    } else {
                        echo json_encode(
                            array('message' => 'author_id Not Found')
                        );
                        break;
                    }
                } else {
                    echo json_encode(
                        array('message' => 'Missing Required Parameters')
                    );
                    break;
                }
            }else{
                echo json_encode(
                    array('message' => 'Missing Required Parameters')
                );
            }
            break;
        case 'DELETE':
            $data = json_decode(file_get_contents("php://input"));
            if(isset($data->id)){
                if(isValid($id=$data->id, $quote)){
                    require ('delete.php');
                }echo json_encode(
                    array('message' => 'No Quotes Found')
                );
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