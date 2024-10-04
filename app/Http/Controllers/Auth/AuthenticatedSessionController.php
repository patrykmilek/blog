<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Uwierzytelnienie użytkownika
        $request->authenticate();

        // Regeneracja sesji po zalogowaniu
        $request->session()->regenerate();

        // Poprawa przekierowania po zalogowaniu
        return redirect()->intended('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Wylogowanie użytkownika
        Auth::guard('web')->logout();

        // Unieważnienie sesji
        $request->session()->invalidate();

        // Regeneracja tokena CSRF
        $request->session()->regenerateToken();

        // Przekierowanie po wylogowaniu
        return redirect('/');
    }
}
