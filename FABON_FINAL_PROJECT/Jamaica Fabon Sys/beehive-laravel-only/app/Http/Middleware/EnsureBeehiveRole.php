<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureBeehiveRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (! $request->session()->get("beehive_access_{$role}", false)) {
            return redirect()->route('login.show', ['role' => $role])
                ->with('error', 'Please enter the correct PIN first.');
        }

        return $next($request);
    }
}
