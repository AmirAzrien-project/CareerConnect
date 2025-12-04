<?php

namespace App\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


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
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function customLogin(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in using the provided credentials
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Check if the user is authenticated and redirect based on their role
            switch (Auth::user()->type) {
                case 1: // Student
                    return redirect()->route('dashboard');
                case 2: // Admin
                    return redirect()->route('adminDashboardShow');
                case 3: // Supervisor (Penyelia)
                    return redirect()->route('penyeliaDashboardShow');
                default:
                    // Handle unknown roles
                    Auth::logout(); // Log out the user if the role is invalid
                    return redirect()->route('login')->with('error', 'Invalid user role.');
            }
        }

        // If authentication fails, redirect back with an error message
        return redirect()->route('login')->with('error', 'Invalid email or password.');
    }

    /*public function customLogin(Request $request)
    {

        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // check if the given user exists in db
        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {
            // check the user role
            if (Auth::user()->type == 1) {
                return redirect()->route('dashboard');
            } elseif (Auth::user()->type == 2) {
                return redirect()->route('adminDashboardShow');
            } elseif (Auth::user()->type == 3) {
                return redirect()->route('penyeliaDashboardShow');
            }
        } else {
            return redirect()->route('login')->with('error', "Wrong credentials");
        }
    }*/
}
