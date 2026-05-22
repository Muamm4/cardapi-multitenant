<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class SushiBarSeeder extends Seeder
{
    public function run(): void
    {
        $tenant = Tenant::where('slug', 'sushi-bar-oriental')->first();
        $t = $tenant?->id;

        $entradas = Category::create(['tenant_id' => $t, 'name' => 'Entradas', 'slug' => 'entradas-sushi', 'description' => 'Entradas leves e saborosas', 'is_active' => true, 'sort_order' => 1]);
        $sushis = Category::create(['tenant_id' => $t, 'name' => 'Sushis & Sashimis', 'slug' => 'sushis-sashimis', 'description' => 'Sushis e sashimis fresquinhos', 'is_active' => true, 'sort_order' => 2]);
        $temakis = Category::create(['tenant_id' => $t, 'name' => 'Temakis', 'slug' => 'temakis', 'description' => 'Temakis recheados', 'is_active' => true, 'sort_order' => 3]);
        $bebidas = Category::create(['tenant_id' => $t, 'name' => 'Bebidas', 'slug' => 'bebidas-sushi', 'description' => 'Bebidas orientais e tradicionais', 'is_active' => true, 'sort_order' => 4]);
        $combos = Category::create(['tenant_id' => $t, 'name' => 'Combos', 'slug' => 'combos-sushi', 'description' => 'Combos para dividir', 'is_active' => true, 'sort_order' => 0]);

        Product::create(['tenant_id' => $t, 'category_id' => $entradas->id, 'name' => 'Sunomono', 'description' => 'Salada de pepino ao molho agridoce', 'price' => 14.90, 'is_active' => true, 'sort_order' => 1]);
        Product::create(['tenant_id' => $t, 'category_id' => $entradas->id, 'name' => 'Harumaki (Rolinho Primavera)', 'description' => 'Rolinho primavera frito (6 unidades)', 'price' => 18.90, 'is_active' => true, 'sort_order' => 2]);
        Product::create(['tenant_id' => $t, 'category_id' => $entradas->id, 'name' => 'Edamame', 'description' => 'Vagens de soja cozidas com sal marinho', 'price' => 16.90, 'is_active' => true, 'sort_order' => 3]);
        Product::create(['tenant_id' => $t, 'category_id' => $entradas->id, 'name' => 'Missoshiro', 'description' => 'Sopa tradicional de missô com tofu e cebolinha', 'price' => 12.90, 'is_active' => true, 'sort_order' => 4]);

        Product::create(['tenant_id' => $t, 'category_id' => $sushis->id, 'name' => 'Sushi de Salmão (8 peças)', 'description' => 'Sushi de salmão fresco com arroz temperado', 'price' => 28.90, 'is_active' => true, 'sort_order' => 1]);
        Product::create(['tenant_id' => $t, 'category_id' => $sushis->id, 'name' => 'Sushi de Atum (8 peças)', 'description' => 'Sushi de atum fresco com arroz temperado', 'price' => 32.90, 'is_active' => true, 'sort_order' => 2]);
        Product::create(['tenant_id' => $t, 'category_id' => $sushis->id, 'name' => 'Sashimi de Salmão (10 fatias)', 'description' => 'Sashimi de salmão cortado à mão', 'price' => 34.90, 'is_active' => true, 'sort_order' => 3]);
        Product::create(['tenant_id' => $t, 'category_id' => $sushis->id, 'name' => 'Sashimi Especial (12 fatias)', 'description' => 'Mix de salmão, atum e peixe branco', 'price' => 42.90, 'is_active' => true, 'sort_order' => 4]);
        Product::create(['tenant_id' => $t, 'category_id' => $sushis->id, 'name' => 'Uramaki Filadélfia (8 peças)', 'description' => 'Uramaki de salmão com cream cheese', 'price' => 26.90, 'is_active' => true, 'sort_order' => 5]);
        Product::create(['tenant_id' => $t, 'category_id' => $sushis->id, 'name' => 'Hot Roll (10 peças)', 'description' => 'Sushi empanado e frito com salmão e cream cheese', 'price' => 29.90, 'is_active' => true, 'sort_order' => 6]);

        Product::create(['tenant_id' => $t, 'category_id' => $temakis->id, 'name' => 'Temaki Salmão', 'description' => 'Cone de alga com salmão, arroz e cream cheese', 'price' => 24.90, 'is_active' => true, 'sort_order' => 1]);
        Product::create(['tenant_id' => $t, 'category_id' => $temakis->id, 'name' => 'Temaki Skin', 'description' => 'Cone de alga com pele de salmão grelhada', 'price' => 22.90, 'is_active' => true, 'sort_order' => 2]);
        Product::create(['tenant_id' => $t, 'category_id' => $temakis->id, 'name' => 'Temaki Atum', 'description' => 'Cone de alga com atum fresco e arroz', 'price' => 26.90, 'is_active' => true, 'sort_order' => 3]);

        Product::create(['tenant_id' => $t, 'category_id' => $bebidas->id, 'name' => 'Sake Quente 300ml', 'description' => 'Saquê sake tradicional aquecido', 'price' => 18.00, 'is_active' => true, 'sort_order' => 1]);
        Product::create(['tenant_id' => $t, 'category_id' => $bebidas->id, 'name' => 'Refrigerante Lata 350ml', 'description' => 'Coca-Cola ou Guaraná Antarctica', 'price' => 6.00, 'is_active' => true, 'sort_order' => 2]);
        Product::create(['tenant_id' => $t, 'category_id' => $bebidas->id, 'name' => 'Chá Gelado 400ml', 'description' => 'Chá gelado natural de hortelã ou limão', 'price' => 8.00, 'is_active' => true, 'sort_order' => 3]);
        Product::create(['tenant_id' => $t, 'category_id' => $bebidas->id, 'name' => 'Água Mineral 500ml', 'description' => 'Água mineral sem gás 500ml', 'price' => 4.00, 'is_active' => true, 'sort_order' => 4]);

        Product::create(['tenant_id' => $t, 'category_id' => $combos->id, 'name' => 'Combo Oriental para 2', 'description' => '8 sushis salmão, 6 uramaki filadélfia, 2 temakis, 10 sashimis', 'price' => 89.90, 'promotional_price' => 74.90, 'is_active' => true, 'sort_order' => 1]);
        Product::create(['tenant_id' => $t, 'category_id' => $combos->id, 'name' => 'Combo Master para 3', 'description' => '12 sushis variados, 10 hot rolls, 3 temakis, 12 sashimis', 'price' => 129.90, 'promotional_price' => 99.90, 'is_active' => true, 'sort_order' => 2]);
        Product::create(['tenant_id' => $t, 'category_id' => $combos->id, 'name' => 'Combo Executivo', 'description' => '8 sushis salmão + missoshiro + chá gelado', 'price' => 44.90, 'promotional_price' => 39.90, 'is_active' => true, 'sort_order' => 3]);
    }
}
