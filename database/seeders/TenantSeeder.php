<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        Tenant::create([
            'name' => 'Pizzaria Brasil',
            'slug' => 'pizzaria-brasil',
            'whatsapp' => '5511999999999',
            'is_active' => true,
        ]);

        Tenant::create([
            'name' => 'Hamburgueria do Zé',
            'slug' => 'hamburgueria-do-ze',
            'whatsapp' => '5511988888888',
            'is_active' => true,
        ]);

        Tenant::create([
            'name' => 'Sushi Bar Oriental',
            'slug' => 'sushi-bar-oriental',
            'whatsapp' => '5511977777777',
            'is_active' => true,
        ]);
    }
}
