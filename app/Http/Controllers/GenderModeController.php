<?php

namespace App\Http\Controllers;

use App\Models\gender_mode;
use App\Http\Requests\Storegender_modeRequest;
use App\Http\Requests\Updategender_modeRequest;

class GenderModeController extends Controller
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
     * @param  \App\Http\Requests\Storegender_modeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storegender_modeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\gender_mode  $gender_mode
     * @return \Illuminate\Http\Response
     */
    public function show(gender_mode $gender_mode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\gender_mode  $gender_mode
     * @return \Illuminate\Http\Response
     */
    public function edit(gender_mode $gender_mode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updategender_modeRequest  $request
     * @param  \App\Models\gender_mode  $gender_mode
     * @return \Illuminate\Http\Response
     */
    public function update(Updategender_modeRequest $request, gender_mode $gender_mode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\gender_mode  $gender_mode
     * @return \Illuminate\Http\Response
     */
    public function destroy(gender_mode $gender_mode)
    {
        //
    }
}
