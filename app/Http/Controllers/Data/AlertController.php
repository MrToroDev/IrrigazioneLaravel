<?php

namespace App\Http\Controllers\Data;
use App\Http\Controllers\Controller;

use App\Models\Utente;
use App\Models\Alert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var Utente */
        $alerts = Auth::user()->alerts()->orderBy("DataOraAlert", "desc")->get();

        return view("user.dashboard.alert", compact("alerts"));
    }

    /**
     * Destroy the specified resource.
     */
    public function destroy(Alert $alert)
    {
        $alert->deleteOrFail();

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Alert $alert)
    {
        $alert->Visualizzato = Carbon::now()->toDateTimeString();
        $alert->saveOrFail();

        return redirect()->back();
    }
}
