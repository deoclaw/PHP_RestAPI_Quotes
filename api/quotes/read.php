<?php

//get ID from URL
if (isset($_GET['id'])){
    //reads single
    $quote->id = $_GET['id']; //assign
    $quote->read_single();
    $quotes_arr = array(
        'id'=>$quote->id,
        'quote'=>$quote->quote,
        // 'author_id'=>$quote->author_id,
        'author'=>$quote->author_name,
        // 'category_id'=>$quote->category_id,
        'category'=>$quote->category_name
    );
    print_r(json_encode($quotes_arr));
} elseif (isset($_GET['author_id']) and isset($_GET['category_id'])){
    
    $quote->author_id = $_GET['author_id'];
    $quote->category_id = $_GET['category_id'];
    
    $result = $quote->read_by_both();
    
    // //get row count of query result
    $num = $result->rowCount();

    if ($num > 0){
        $quotes_arr = array(); //quote array
        $quotes_arr['data'] = array(); //want data from json

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            //we get an associative array?
            extract($row);
            $quote_item = array(
                // a.author as author_name,
            // c.category as category_name,
            // q.id,
            // q.quote,
            // q.author_id,
            // q.category_id
            'id' => $id,
            'quote'=>$quote,
            // 'author_id'=>$author_id,
            // 'category_id'=>$category_id,
            'category' => $category_name,
            'author'=>$author_name
            );
            //push to 'data'
            array_push($quotes_arr['data'], $quote_item);
        }

        //turn to JSON and output
        echo json_encode($quotes_arr['data']);
    } else {
        //no categorys
        echo json_encode(
            array('message'=>'Quotes Not Found')
        );
    }
} elseif ($quote->author_id=isset($_GET['author_id'])){
    
    $quote->author_id = $_GET['author_id'];
    $result = $quote->read_by_author();
    
    //get row count of query result
    $num = $result->rowCount();

    if ($num > 0){
        $quotes_arr = array(); //quote array
        $quotes_arr['data'] = array(); //want data from json

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            //we get an associative array?
            extract($row);
            $quote_item = array(
                // a.author as author_name,
            // c.category as category_name,
            // q.id,
            // q.quote,
            // q.author_id,
            // q.category_id
            'id' => $id,
            'quote'=>$quote,
            // 'author_id'=>$author_id,
            // 'category_id'=>$category_id,
            'category' => $category_name,
            'author'=>$author_name
            );
            //push to 'data'
            array_push($quotes_arr['data'], $quote_item);
        }

        //turn to JSON and output
        echo json_encode($quotes_arr['data']);
    } else {
        //no categorys
        echo json_encode(
            array('message'=>'Quotes Not Found')
        );
    }
    
} elseif ($quote->category_id=isset($_GET['category_id'])){
    
    $quote->category_id = $_GET['category_id'];
    $result = $quote->read_by_category();

    //get row count of query result
    $num = $result->rowCount();

    if ($num > 0){
        $quotes_arr = array(); //quote array
        $quotes_arr['data'] = array(); //want data from json

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            //we get an associative array?
            extract($row);
            $quote_item = array(
                // a.author as author_name,
            // c.category as category_name,
            // q.id,
            // q.quote,
            // q.author_id,
            // q.category_id
            'id' => $id,
            'quote'=>$quote,
            // 'author_id'=>$author_id,
            // 'category_id'=>$category_id,
            'category' => $category_name,
            'author'=>$author_name
            );
            //push to 'data'
            array_push($quotes_arr['data'], $quote_item);
        }

        //turn to JSON and output
        echo json_encode($quotes_arr['data']);
    } else {
        //no categorys
        echo json_encode(
            array('message'=>'Quotes Not Found')
        );
    }

} else {
    //reads all
    //category query
    $result = $quote->read();

    //get row count of query result
    $num = $result->rowCount();

    if ($num > 0){
        $quotes_arr = array(); //quote array
        $quotes_arr['data'] = array(); //want data from json

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            //we get an associative array?
            extract($row);
            $quote_item = array(
                // a.author as author_name,
            // c.category as category_name,
            // q.id,
            // q.quote,
            // q.author_id,
            // q.category_id
                'id' => $id,
                'quote'=>$quote,
                // 'author_id'=>$author_id,
                // 'category_id'=>$category_id,
                'category' => $category_name,
                'author'=>$author_name
            );
            //push to 'data'
            array_push($quotes_arr['data'], $quote_item);
        }

        //turn to JSON and output
        echo json_encode($quotes_arr['data']);

    } else {
        //no categorys
        echo json_encode(
            array('message'=>'No Quotes Found')
        );
    }

}