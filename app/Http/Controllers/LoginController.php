<?php

namespace App\Http\Controllers;

use App\Models\RuoloUtente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'Email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // $credentials['Pword'] = Hash::make($credentials['Pword']);
        
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->getRuolo() === RuoloUtente::Admin) {
                // Handle admin user
            }
        
            return redirect()->intended(route('dashboard'));
        }
        
        return back()->withErrors([
            'email' => 'Invalid email',
            'password' => 'Invalid password',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended(route("home"));
    }

    public function show()
    {
        return view('login');
    }
}
