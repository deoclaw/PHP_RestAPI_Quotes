<?php

function isValid($id, $model){
    //assign id to passed in id
    //then check and see if the model has a read single --> this should also reassign to null if no rows
    //if the id is null then return false else return true
    $model->id = $id;
    $model->read_single();
    if(is_null($model->id)){
        return false;
     }else{
            return true;
    }
}