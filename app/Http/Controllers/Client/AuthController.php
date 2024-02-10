<?php

namespace App\Http\Controllers\Client;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('client.auth.login');
    }

    public function do_login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
//        $credentials['user_type'] = UserType::CLIENT;
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('articles.index');
        }
        return back()->withErrors([
            'email' => 'invalid credentials']
        )->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
