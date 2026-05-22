<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            TenantSeeder::class,
            AdminUserSeeder::class,
            PizzariaSeeder::class,
            HamburgueriaSeeder::class,
            SushiBarSeeder::class,
        ]);
    }

}
