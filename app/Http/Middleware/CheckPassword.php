<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class CheckPassword
{
    public function handle(Request $request, Closure $next)
    {
        if($request->api_password != env("API_PASSWORD", 'Q3SDdyR8xHP146L68'))
        {
            return response()->json(['message' => 'Unauthenticated.!']);
        }
        return $next($request);
    }
}
