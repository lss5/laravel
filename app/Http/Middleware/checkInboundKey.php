<?php

namespace App\Http\Middleware;

use Closure;
use App\Setting;

class CheckInboundKey
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
        if ($request->input('secret') == config('services.vk.secret_key')) {
            return $next($request);
        }

        return response('ok', 200);
    }
}
