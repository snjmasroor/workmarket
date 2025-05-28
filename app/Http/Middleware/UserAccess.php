<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next, ...$userTypes): Response
    {
        
        $types = array_map('strtolower', $userTypes); // ← Converts "admin,superadmin" to ['admin', 'superadmin']
    $currentUserType = strtolower(auth()->user()->type);

    // \Log::info('User type: ' . $currentUserType);
    // \Log::info('Allowed types: ', $types);

    if (auth()->check() && in_array($currentUserType, $types)) {
        return $next($request);
    }

    return response()->json([
        'message' => 'Access denied',
        'user_type' => $currentUserType,
        'allowed_types' => $types
    ], 403);
    }
}
