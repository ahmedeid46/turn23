<?php

namespace App\Traits;

trait APITrait
{
    function returnSuccess($message,$data=" ",$code="200"){
        return response()->json([
            'status'=> "success",
            'message'=>$message,
            'data'=>$data
        ],$code);

    }
    function returnError($message,$code){
        return response()->json([
            'status'=> "error",
            'message'=>$message,
        ],$code);
    }

}
