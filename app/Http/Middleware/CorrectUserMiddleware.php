<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CorrectUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)

    {
        try {

            $userID = $request->route()?->parameter('profilePage');
            $user = User::find($userID);
            $isCurrentUser = $user->is(Auth::user());
            abort_if(!$isCurrentUser, 403, 'Dont have permission');
            return $next($request);

        } catch (\Throwable $th) {
            Log::error('User not found: ' . $th->getMessage());
            return response()->json(['error' => 'Go Back']);
        }
        
    
    }
}

