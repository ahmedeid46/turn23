<?php

namespace App\Traits;

use App\Models\SubCat;

trait NavBar
{
    function customer(){
        $data['chemical'] = SubCat::with('subsubCat')->where('cat_id',1)->get();
        $data['service']  = SubCat::with('subsubCat')->where('cat_id',3)->get();
        $data['manpower']  = SubCat::with('subsubCat')->where('cat_id',4)->get();
        return $data;
    }
}
