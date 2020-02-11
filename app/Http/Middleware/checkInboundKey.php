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
        $setting = Setting::where([['secret_key', $request->secret],['vk_id_group', $request->group_id]])->first();

        if (!empty($setting)) {
            Setting::$access_token = $setting->access_token;
            Setting::$confirm_token = $setting->confirm_token;
            Setting::$group_id = $setting->vk_id_group;

            return $next($request, $setting);
        }

        return response('ok', 200);
    }
}
