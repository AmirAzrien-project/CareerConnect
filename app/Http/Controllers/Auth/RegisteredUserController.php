<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $no_ic = str_replace('-', '', $request->no_ic);

        $request->validate([
            'type' => ['required', 'integer', 'in:1,2,3'], // Validate the role (Pelajar, Pensyarah, Penyelia)
            'name' => ['required', 'string', 'max:255'],
            'no_ic' => ['nullable', 'string', 'size:12', 'regex:/^\d{12}$/'], // Malaysian IC format
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone_number' => ['nullable', 'string', 'min:10', 'max:15'], // Validate phone number length
            //'password' => ['required', 'confirmed', 'min:8'], // Ensure password has a minimum length
            'password' => ['required', 'confirmed'], // Ensure password has a minimum length
            'location' => ['nullable', 'string', 'max:255'], // Home address (Taman)
            'city' => ['nullable', 'string', 'max:255'], // City (Bandar)
            'state' => ['nullable', 'string', 'max:255'], // State (Negeri)
            'student_course' => ['nullable', 'string', 'max:255'], // Academic information for students
        ]);
    
        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
            'no_ic' => $request->no_ic,
            'phone_number' => $request->phone_number,
            'location' => $request->location,
            'city' => $request->city,
            'state' => $request->state,
            'student_course' => $request->student_course, // Only if the role is student
        ]);

        event(new Registered($user));

        Auth::login($user);

        //$user->sendEmailVerificationNotification();

        return redirect()->route('verification.notice')->with('success', 'Sila semak email untuk pengesahan.');

        //return redirect(RouteServiceProvider::HOME);
    }
    
}
