<?php

namespace App\Http\Middleware;

use App\Services\UsersService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Administrator
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user() || Auth::user()->permission != UsersService::ADMIN) {
            return redirect(route('main'));
        }

        return $next($request);
    }
}
