<?php

namespace App\Http\Controllers;

use App\Models\AdminProduct;
use App\Models\AllProduct;
use App\Models\SubCat;
use App\Http\Requests\StoreSubCatRequest;
use App\Http\Requests\UpdateSubCatRequest;

class SubCatController extends Controller
{
    function searchByProduct($text){
        $result = AllProduct::where('name', 'LIKE', '%'. $text. '%')->with('adminproduct')->get();
        if(count($result)){
            return Response()->json(['products'=>$result]);
        }
        else
        {
            return response()->json(['Result' => 'No Data not found'], 404);
        }
    }
    function SearchByCat($text){
        $result = SubCat::where('title', 'LIKE', '%'. $text. '%')->get();
        if(count($result)){
            return Response()->json(['cats'=>$result]);
        }
        else
        {
            return response()->json(['Result' => 'No Data not found'], 404);
        }
    }
}
