<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class CheckVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next)
    {
        if (!$this->isLoginRequest($request)) {
            // If it's not a login request, just pass the request to the next middleware
            return $next($request);
        }

        // Handle login request
        return $this->handleLoginRequest($request, $next);
    }

    private function isLoginRequest(Request $request)
    {
        return $request->is('api/login/email');
    }

    private function handleLoginRequest(Request $request, Closure $next)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Incorrect password'], 401);
        }

        if (!$user->verified) {
            return response()->json(['error' => 'Your email is not verified'], 403);
        }

        return $next($request);
    }
}
