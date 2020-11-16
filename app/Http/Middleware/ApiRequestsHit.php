<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class ApiRequestsHit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle(Request $request, Closure $next)
    {
        $userId = $request->user()->id;
        $key = 'api:users:' . $userId;

        if (!Cache::has($key)) {
            Cache::put($key, 0);
        } else {
            Cache::increment($key);
        }

        return $next($request);
    }
}
