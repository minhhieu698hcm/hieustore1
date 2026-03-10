<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SeoOptimization
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Add Security Headers for SEO
        $response->header('X-Content-Type-Options', 'nosniff');
        $response->header('X-Frame-Options', 'SAMEORIGIN');
        $response->header('X-XSS-Protection', '1; mode=block');
        $response->header('Referrer-Policy', 'no-referrer-when-downgrade');
        $response->header('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://code.jquery.com https://fonts.googleapis.com; style-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://fonts.googleapis.com; img-src 'self' data: https: blob:; font-src 'self' https://cdnjs.cloudflare.com https://fonts.gstatic.com; connect-src 'self' https:;");
        
        // Add Cache Headers for static assets
        if ($request->is('public/*')) {
            $response->header('Cache-Control', 'public, max-age=31536000, immutable');
        }

        // Add Canonical Header
        $response->header('Link', '<' . url()->current() . '>; rel="canonical"');

        return $response;
    }
}
