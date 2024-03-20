<?php


if(is_null($data->id)){
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
}

// $quote->read_single();
// $quotes_arr = array(
//     'id'=>$quote->id,
//         'quote'=>$quote->quote,
//         // 'author_id'=>$quote->author_id,
//         'author'=>$quote->author_name,
//         // 'category_id'=>$quote->category_id,
//         'category'=>$quote->category_name
// );
// if(is_null($quote->quote)){
//     echo json_encode(
//         array('message' => 'No Quotes Found')
//     );
// } else {

//assign what's in the data obj to the quote obj
$quote->id = $data->id;

//delete quote
if($quote->delete()){
    echo json_encode(
        array('id'=>$quote->id)
    );
} else {
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
}
