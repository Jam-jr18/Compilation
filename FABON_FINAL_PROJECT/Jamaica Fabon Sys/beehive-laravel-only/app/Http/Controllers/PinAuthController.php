<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PinAuthController extends Controller
{
    public function portal(): View
    {
        return view('auth.portal');
    }

    public function show(string $role): View
    {
        return view('auth.login', ['role' => $role]);
    }

    public function login(Request $request, string $role): RedirectResponse
    {
        $validated = $request->validate([
            'pin' => ['required', 'string', 'max:64'],
        ]);

        if (! Setting::verifyPin($role, $validated['pin'])) {
            return back()->withInput()->with('error', 'Incorrect PIN. Please try again.');
        }

        $request->session()->put("beehive_access_{$role}", true);

        return $role === 'admin'
            ? redirect()->route('admin.dashboard')->with('success', 'Admin access granted.')
            : redirect()->route('staff.orders')->with('success', 'Staff access granted.');
    }

    public function logout(Request $request, string $role): RedirectResponse
    {
        $request->session()->forget("beehive_access_{$role}");

        return redirect()->route('portal')->with('success', ucfirst($role).' logged out.');
    }
}
