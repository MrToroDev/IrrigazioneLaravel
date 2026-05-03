<?php

namespace App\Http\Controllers\Data;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreOrtoRequest;
use App\Http\Requests\UpdateOrtoRequest;
use App\Models\Orto;
use Illuminate\Support\Facades\Auth;

class OrtoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orti = Auth::user()->orti()->get();

        return view("user.dashboard.garden", compact("orti"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Orto $orto)
    {
        return view("user.dashboard.garden.index", compact("orto"));
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
