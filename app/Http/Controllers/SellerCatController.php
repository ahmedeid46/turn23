<?php

namespace App\Http\Controllers;

use App\Models\SellerCat;
use App\Http\Requests\StoreSellerCatRequest;
use App\Http\Requests\UpdateSellerCatRequest;

class SellerCatController extends Controller
{
  public function index(){
      return view('seller.page.');
  }
}
