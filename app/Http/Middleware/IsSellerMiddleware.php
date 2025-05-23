<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsSellerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->is_seller) {
            return $next($request);
        }

        return redirect()->route('seller.store.create');

    }
}
