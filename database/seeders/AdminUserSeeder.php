<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $tenant = Tenant::where('slug', 'pizzaria-brasil')->first();

        \App\Models\User::create([
            'tenant_id' => $tenant?->id,
            'name' => 'Administrador',
            'email' => 'admin@cardapio.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'),
            'is_admin' => true,
        ]);
    }
}

