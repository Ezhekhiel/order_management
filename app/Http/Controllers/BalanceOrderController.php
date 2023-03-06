<?php

namespace App\Http\Controllers;

use App\Models\balanceOrder;
use App\Http\Requests\StorebalanceOrderRequest;
use App\Http\Requests\UpdatebalanceOrderRequest;

class BalanceOrderController extends Controller
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
     * @param  \App\Http\Requests\StorebalanceOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorebalanceOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\balanceOrder  $balanceOrder
     * @return \Illuminate\Http\Response
     */
    public function show(balanceOrder $balanceOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\balanceOrder  $balanceOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(balanceOrder $balanceOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatebalanceOrderRequest  $request
     * @param  \App\Models\balanceOrder  $balanceOrder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatebalanceOrderRequest $request, balanceOrder $balanceOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\balanceOrder  $balanceOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(balanceOrder $balanceOrder)
    {
        //
    }
}
