<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !$user->isAdmin()) {
            abort(403, 'Acesso não autorizado.');
        }

        $tenant = tenant();

        // If admin has a specific tenant, they can only manage that tenant
        if ($user->tenant_id && $tenant && $user->tenant_id !== $tenant->id) {
            abort(403, 'Você não tem permissão para gerenciar este restaurante.');
        }

        // Super admins (tenant_id = null) can manage any tenant
        return $next($request);
    }
}
