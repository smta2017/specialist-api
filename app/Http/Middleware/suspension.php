<?php

namespace App\Http\Middleware;

use App\Helpers\ApiResponse;
use Closure;
use Illuminate\Http\Request;

class suspension
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
        if (setting('admin.suspension')) {
            return ApiResponse::format('SORRY...The system is in development mode, please try again later', '', false);
        }
        return $next($request);
    }
}
