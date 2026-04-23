<?php

namespace App\Http\Middleware;

use Closure;

class EnsureBlogAdminAccess
{
    public function handle($request, Closure $next)
    {
        $previlage = session('previlage');

        if (! session('id') || $previlage === null || $previlage === '' || $previlage === 'ortu') {
            abort(403);
        }

        return $next($request);
    }
}
