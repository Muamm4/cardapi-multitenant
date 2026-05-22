<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class TenantMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        $domain = config('app.domain');

        $subdomain = str_replace('.' . $domain, '', $host);

        if ($subdomain !== $host && $subdomain !== 'www') {
            $tenant = Tenant::where('slug', $subdomain)
                ->where('is_active', true)
                ->first();

            if (!$tenant) {
                abort(404);
            }

            app()->instance('currentTenant', $tenant);

            Inertia::share('tenant', fn () => $tenant);

            $request->attributes->set('tenant', $tenant);
        }

        return $next($request);
    }
}
