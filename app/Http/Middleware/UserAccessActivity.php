<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\ActivityLogger;
use Illuminate\Http\Request;

class UserAccessActivity
{

    use ActivityLogger;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $description = null)
    {
        ActivityLogger::activity($description);
        return $next($request);
    }

    protected function shouldLog($request)
    {
        foreach (config('app.accessLoggerMiddlewareExcept', []) as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }
            if ($request->is($except)) {
                return false;
            }
        }
        return true;
    }

}
