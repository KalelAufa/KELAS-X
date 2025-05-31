<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->isMethod('OPTIONS')) {
            return $this->handlePreflightRequest($request);
        }

        $response = $next($request);

        return $this->addCorsHeaders($response);
    }

    protected function handlePreflightRequest($request)
    {
        return response('', 204)
            ->header('Access-Control-Allow-Origin', config('cors.allowed_origins')[0])
            ->header('Access-Control-Allow-Methods', implode(', ', config('cors.allowed_methods')))
            ->header('Access-Control-Allow-Headers', implode(', ', config('cors.allowed_headers')))
            ->header('Access-Control-Max-Age', config('cors.max_age'));
    }

    protected function addCorsHeaders($response)
    {
        $response->headers->set('Access-Control-Allow-Origin', config('cors.allowed_origins')[0]);
        $response->headers->set('Access-Control-Allow-Methods', implode(', ', config('cors.allowed_methods')));
        $response->headers->set('Access-Control-Allow-Headers', implode(', ', config('cors.allowed_headers')));
        $response->headers->set('Access-Control-Expose-Headers', implode(', ', config('cors.exposed_headers')));

        if (config('cors.supports_credentials')) {
            $response->headers->set('Access-Control-Allow-Credentials', 'true');
        }

        return $response;
    }
}
