<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended(route('users.index'));
        }

        return redirect()
            ->route('login')
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Invalid credentials']);
    }

    public function index()
    {
        // Your logic for the user dashboard or index page
        return view('users.index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
