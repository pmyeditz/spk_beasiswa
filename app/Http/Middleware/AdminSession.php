<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminSession
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('user_id') || !session()->has('user_role')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}
