<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

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
