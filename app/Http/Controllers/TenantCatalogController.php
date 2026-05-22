<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TenantCatalogController extends Controller
{
    public function index(Request $request)
    {
        $tenants = Tenant::where('is_active', true)
            ->orderBy('name')
            ->get();

        $domain = config('app.domain');
        $baseUrl = $request->getSchemeAndHttpHost();

        $tenants->transform(function ($tenant) use ($baseUrl, $domain) {
            $tenant->menu_url = str_replace(
                "://{$domain}",
                "://{$tenant->slug}.{$domain}",
                $baseUrl
            );
            return $tenant;
        });

        return Inertia::render('catalog/Index', [
            'tenants' => $tenants,
        ]);
    }
}
