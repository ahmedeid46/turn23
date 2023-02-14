<?php

namespace App\Http\Controllers\Customer\api;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Traits\APITrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatController extends Controller
{
    use APITrait;
    //
    function cats()
    {
        $cats  = Cat::with('subCat')->get();
        foreach ($cats as $cat){
            $cat['cover'] = route('category.img',$cat->cover);
            foreach ($cat->subCat as $subCat){
                $subCat['cover'] = route('category.img',$subCat->cover);
                foreach ($subCat->subsubCat as $subSubCat){
                   $subSubCat['cover'] = route('category.img',$subSubCat->cover);
                }
                foreach ($subCat->allproduct as $allProduct){
                    $allProduct['cover'] = route('category.img',$allProduct->cover);
                }
                foreach ($subCat->ind_allproduct as $allProduct){
                    $allProduct['cover'] = route('category.img',$allProduct->cover);
                }
            }
        }
        $data['categories'] = $cats;
        return $this->returnSuccess('',$data);
    }
    function file($filename){
        $file = Storage::download('public/upload/category/'.$filename);
        return $file;
    }
}
