<?php

namespace App\Http\Controllers\Data;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSensoreRequest;
use App\Http\Requests\StoreSensoreRequest;

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
                if ($sensore->deleted == 1) continue;
                
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("user.dashboard.sensor.create");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sensore $sensore)
    {
        return view("user.dashboard.sensor.edit", compact("sensore"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSensoreRequest $request)
    {
        $data = $request->validated();

        $sensore = new Sensore($data);
        $sensore->saveOrFail();

        return redirect()->route('dashboard.orto');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSensoreRequest $request, Sensore $sensore)
    {
        $data = $request->validated();

        $sensore->updateOrFail($data);

        return redirect()->route('dashboard.sensori.id', compact("sensore"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sensore $sensore)
    {
        $sensore->deleted = 1;
        $sensore->saveOrFail();

        return redirect()->route('dashboard.sensori');
    }
}
