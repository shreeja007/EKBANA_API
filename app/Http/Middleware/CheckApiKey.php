<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apikey = $request->header('API_KEY');

        if($apikey !== 'BA673A414C3B44C98478BB5CF10A0F832574090C'){
            return response()->json([
                'error' => 'Unauthorized. invalid API Key.'
            ],401);
        }
        return $next($request);
    }
}
