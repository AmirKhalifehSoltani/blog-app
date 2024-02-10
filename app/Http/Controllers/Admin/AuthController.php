<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.auth.login');
    }

    public function do_login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        if (auth()->guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.articles.index');
        }
        return back()->withErrors([
            'email' => 'invalid credentials']
        )->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
