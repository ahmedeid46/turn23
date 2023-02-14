<?php

namespace App\Http\Controllers;

use App\Models\ServicePriceList;
use App\Http\Requests\StoreServicePriceListRequest;
use App\Http\Requests\UpdateServicePriceListRequest;

class ServicePriceListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServicePriceListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServicePriceListRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServicePriceList  $servicePriceList
     * @return \Illuminate\Http\Response
     */
    public function show(ServicePriceList $servicePriceList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServicePriceList  $servicePriceList
     * @return \Illuminate\Http\Response
     */
    public function edit(ServicePriceList $servicePriceList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServicePriceListRequest  $request
     * @param  \App\Models\ServicePriceList  $servicePriceList
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServicePriceListRequest $request, ServicePriceList $servicePriceList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServicePriceList  $servicePriceList
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServicePriceList $servicePriceList)
    {
        //
    }
}
