<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->getIsAdminAttributes()) {
            return $next($request);
        }
        return response([
            'message' => 'forbidden'
        ], \Illuminate\Http\Response::HTTP_FORBIDDEN);
    }

}
