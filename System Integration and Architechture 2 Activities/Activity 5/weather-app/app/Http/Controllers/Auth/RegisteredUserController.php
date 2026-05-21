<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        // 1. Validate the incoming request including your custom fields
        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'role'      => ['required', 'string', 'in:Admin,User'], // Added role validation
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Create the user with the updated field names
        $user = User::create([
            'full_name' => $request->full_name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => $request->role, // Saves the selected role
        ]);

        event(new Registered($user));

        Auth::login($user);

        // 3. Redirect to the weather dashboard
        return redirect(route('dashboard', absolute: false));
    }
}