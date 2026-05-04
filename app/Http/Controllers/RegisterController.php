<?php

namespace App\Http\Controllers;

use App\Models\RuoloUtente;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

use App\Models\Utente;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'email' => ['required', 'email'],
            'Pword' => ['required']
        ]);

        $account = Utente::create([
            'Nome' => $credentials['name'],
            'Cognome' => $credentials['surname'],
            'Email' => $credentials['email'],
            'Pword' => Hash::make($credentials['Pword']),
            'Ruolo' => RuoloUtente::Utente
        ]);

        Auth::login($account);

        return redirect()->intended(route("dashboard"));
    }

    public function show()
    {
        return view('register');
    }
}
