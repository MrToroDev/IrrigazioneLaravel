<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUtenteRequest;
use App\Http\Requests\UpdateUtenteRequest;
use App\Models\Utente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UtenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.settings.index');
    }

    /**
     * Display the specified resource.
     */
    public function showHelp()
    {
        return "404";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUtenteRequest $request)
    {
        $data = $request->validated();
        $utente = Auth::user();
        
        if (is_null($data['Pword'])) {
            $data['Pword'] = $utente->Pword;
        }
        else $data['Pword'] = Hash::make($data['Pword']);

        $utente->updateOrFail($data);

        return redirect()->back()->with("success", true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete()
    {
        /**
         * @var Utente
         */
        $utente = Auth::user();
        $utente->updateOrFail(['enabled' => 0]);

        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        
        return redirect()->route("home");
    }
}
