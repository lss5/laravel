<?php

namespace App\Http\Middleware;

use Closure;

class checkInboundKey
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
        $secret_key = config('services.vk.secret_key');

        if ($request->secret == $secret_key) {
            return $next($request);
        }

        return response('ok_m', 200);
    }
}
