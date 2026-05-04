<?php

namespace App\Http\Controllers\Data;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreOrtoRequest;
use App\Http\Requests\UpdateOrtoRequest;
use App\Models\Orto;
use App\Models\Utente;
use Illuminate\Support\Facades\Auth;

class OrtoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orti = [];
            
        foreach (Auth::user()->orti()->get()->all() as $orto) {
            if ($orto->deleted == 1) continue;

            array_push($orti, $orto);
        }

        return view("user.dashboard.garden.index", compact("orti"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Orto $orto)
    {
        return view("user.dashboard.garden.show", compact("orto"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("user.dashboard.garden.create");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orto $orto)
    {
        return view("user.dashboard.garden.edit", compact("orto"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrtoRequest $request)
    {
        $data = $request->validated();

        $orto = new Orto($data);
        $orto->IdUtente = Auth::id();
        $orto->saveOrFail();

        return redirect()->route('dashboard.orto');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrtoRequest $request, Orto $orto)
    {
        $data = $request->validated();

        $orto->updateOrFail($data);

        return redirect()->route('dashboard.orto.id', compact("orto"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Orto $orto)
    {
        $orto->deleted = 1;
        $orto->saveOrFail();

        return redirect()->route('dashboard.orto');
    }
}
