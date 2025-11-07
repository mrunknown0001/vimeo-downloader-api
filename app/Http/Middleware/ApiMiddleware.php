<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Models\Usage;
use Illuminate\Support\Facades\RateLimiter;
use App\Service\CheckUsage;

class ApiMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->input('api_key');

        // 1️⃣ Check if api_key exists
        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'message' => 'API key is required.'
            ], 401);
        }

        $user = User::where('api_key', $apiKey)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid API key.'
            ], 401);
        }

        if (!$user->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'User account is inactive.'
            ], 403);
        }

        $checkUsage = new CheckUsage();
        
        if ($checkUsage->check($user) >= $user->userPlan->plan->points_per_month) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient API points.'
            ], 403);
        }

        $key = "api:limit:{$user->id}";
        if (RateLimiter::tooManyAttempts($key, $user->userPlan->plan->request_per_second ?? 7)) {
            return response()->json([
                'success' => false,
                'message' => 'Too many requests. Please slow down.'
            ], 429);
        }

        RateLimiter::hit($key, 1);

        // Optionally, attach user to request for downstream use
        $request->merge(['auth_user' => $user]);

        // Add 1 point to the usage
        $user->usage()->create();

        return $next($request);
    }
}
