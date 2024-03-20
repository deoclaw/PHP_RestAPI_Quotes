<?php


//get ID from URL
if ($category->id=isset($_GET['id'])){
    //reads single
    $category->id = $_GET['id']; //assign
    $category->read_single();
    $category_arr=array(
        'id'=>$category->id,
        'category'=>$category->category
    );
    print_r(json_encode($category_arr));
} else {
    //reads all
    //category query
    $result = $category->read();

    //get row count of query result
    $num = $result->rowCount();

    //check if any categorys
    if ($num > 0){
        $categorys_arr = array(); //category array
        $categorys_arr['data'] = array(); //want data from json

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            //we get an associative array?
            extract($row);
            $category_item = array(
                'id' => $id,
                'category' => $category
            );
            //push to 'data'
            array_push($categorys_arr['data'], $category_item);
        }

        //turn to JSON and output
        echo json_encode($categorys_arr['data']);

    } else {
        //no categorys
        echo json_encode(
            array('message'=>'category_id Not Found')
        );
    }

}



