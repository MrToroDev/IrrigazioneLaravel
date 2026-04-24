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
            'Pword' => ['required']
        ]);

        // $credentials['Pword'] = Hash::make($credentials['Pword']);

        // return var_dump($credentials);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
        
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid email',
            'password' => 'Invalid password',
        ]);
    }
}
