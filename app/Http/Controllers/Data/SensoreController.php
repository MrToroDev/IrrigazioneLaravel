<?php

namespace App\Http\Controllers\Data;
use App\Http\Controllers\Controller;

use App\Models\Utente;
use App\Models\Sensore;
use App\Models\Orto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SensoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sensori = [];

        /** @var Orto */
        foreach (Auth::user()->orti()->get()->all() as $orto) {
            /** @var Sensore */
            foreach ($orto->sensori()->get()->all() as $sensore) {
                array_push($sensori, $sensore);
            }
        }

        return view("user.dashboard.sensor.index", compact("sensori"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Sensore $sensore)
    {
        return view("user.dashboard.sensor.show", compact("sensore"));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(StoreOrtoRequest $request)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Orto $orto)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(UpdateOrtoRequest $request, Orto $orto)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Orto $orto)
    // {
    //     //
    // }
}
