<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class CorrectUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $profilePage)
    {
        $user = User::find($profilePage);

        if ($user->id != auth()->id()) {
           
            return redirect()->back();
        }

        return $next($request);
    }
}
