<?php

namespace App\Http\Controllers\Data;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("user.data.alert");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrtoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Orto $orto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orto $orto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrtoRequest $request, Orto $orto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orto $orto)
    {
        //
    }
}
