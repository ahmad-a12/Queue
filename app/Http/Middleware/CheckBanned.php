<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckBanned
{
    public function handle(Request $request, Closure $next)
    {
        if ($this->isLoginRequest($request)) {
            return $this->handleLoginRequest($request, $next);
        } else {
            return $this->handleAuthenticatedRequest($request, $next);
        }
    }

    private function isLoginRequest(Request $request)
    {
        return $request->is('api/login/email');
    }

    private function handleLoginRequest(Request $request, Closure $next)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && $user->banned) {
            $user->tokens->each(function ($token) {
                $token->delete();
            });
            return response()->json(['banned' => 'Your account is banned and you have been logged out.'], 200);
    }

        return $next($request);
    }

    private function handleAuthenticatedRequest(Request $request, Closure $next)
    {
        $user = $request->user('sanctum');

        if ($user && $user->banned) {
            $user->tokens->each(function ($token) {
                $token->delete();
            });

            Log::info('User is banned, tokens deleted.');

            return response()->json(['banned' => 'Your account is banned and you have been logged out.'], 200);
        }

        return $next($request);
    }
}
