<?php

namespace App\Http\Middleware;

use Closure;

class SwitchAdministrator
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
        //切换user验证，管理员
        config(['jwt.user' => '\App\Models\Administrator']); //用于重定位model
        config(['auth.providers.users.model' => \App\Models\Administrator::class]); //用于重定位model

        return $next($request);
    }
}
