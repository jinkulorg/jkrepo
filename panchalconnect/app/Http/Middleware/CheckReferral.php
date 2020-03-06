<?php

namespace App\Http\Middleware;

use Closure;

class CheckReferral
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
        // return $next($request);
        $response = $next($request);

        // Check that there is not already a cookie set and that we have 'ref' in the url
        if (! $request->hasCookie('referral') && $request->query('ref') ) {
          // Add a cookie to the response that lasts 24 hours (1440 in minutes)
          $response->cookie( 'referral', encrypt( $request->query('ref') ), 1440 );
        }

        return $response;
    }
}
