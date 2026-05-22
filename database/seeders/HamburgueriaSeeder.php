<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class HamburgueriaSeeder extends Seeder
{
    public function run(): void
    {
        $tenant = Tenant::where('slug', 'hamburgueria-do-ze')->first();
        $t = $tenant?->id;

        $artesanais = Category::create(['tenant_id' => $t, 'name' => 'Hambúrgueres Artesanais', 'slug' => 'hamburgueres-artesanais', 'description' => 'Hambúrgueres artesanais com ingredientes selecionados', 'is_active' => true, 'sort_order' => 1]);
        $porcoes = Category::create(['tenant_id' => $t, 'name' => 'Porções', 'slug' => 'porcoes-h', 'description' => 'Porções para acompanhar', 'is_active' => true, 'sort_order' => 2]);
        $bebidas = Category::create(['tenant_id' => $t, 'name' => 'Bebidas', 'slug' => 'bebidas-h', 'description' => 'Refrigerantes e sucos', 'is_active' => true, 'sort_order' => 3]);
        $combos = Category::create(['tenant_id' => $t, 'name' => 'Combos', 'slug' => 'combos-h', 'description' => 'Combos econômicos', 'is_active' => true, 'sort_order' => 0]);

        Product::create(['tenant_id' => $t, 'category_id' => $artesanais->id, 'name' => 'X-Burger Simples', 'description' => 'Hambúrguer 180g, queijo cheddar, alface, tomate', 'price' => 24.90, 'is_active' => true, 'sort_order' => 1]);
        Product::create(['tenant_id' => $t, 'category_id' => $artesanais->id, 'name' => 'X-Bacon', 'description' => 'Hambúrguer 180g, queijo, bacon crocante, barbecue', 'price' => 29.90, 'is_active' => true, 'sort_order' => 2]);
        Product::create(['tenant_id' => $t, 'category_id' => $artesanais->id, 'name' => 'X-Salada', 'description' => 'Hambúrguer 200g, queijo, alface, tomate, cebola roxa', 'price' => 26.90, 'is_active' => true, 'sort_order' => 3]);
        Product::create(['tenant_id' => $t, 'category_id' => $artesanais->id, 'name' => 'X-Tudo', 'description' => 'Hambúrguer 200g, ovo, bacon, calabresa, queijo, alface, tomate', 'price' => 34.90, 'is_active' => true, 'sort_order' => 4]);
        Product::create(['tenant_id' => $t, 'category_id' => $artesanais->id, 'name' => 'X-Cheddar Duplo', 'description' => 'Dois hambúrgueres 150g, cheddar duplo, cebola caramelizada', 'price' => 36.90, 'is_active' => true, 'sort_order' => 5]);
        Product::create(['tenant_id' => $t, 'category_id' => $artesanais->id, 'name' => 'X-Picanha', 'description' => 'Hambúrguer de picanha 200g, queijo prato, rúcula, tomate seco', 'price' => 39.90, 'is_active' => true, 'sort_order' => 6]);

        Product::create(['tenant_id' => $t, 'category_id' => $porcoes->id, 'name' => 'Batata Frita com Cheddar e Bacon', 'description' => 'Batata frita crocante coberta com cheddar e bacon', 'price' => 28.90, 'is_active' => true, 'sort_order' => 1]);
        Product::create(['tenant_id' => $t, 'category_id' => $porcoes->id, 'name' => 'Anéis de Cebola Empanados', 'description' => 'Anéis de cebola empanados na hora', 'price' => 19.90, 'is_active' => true, 'sort_order' => 2]);
        Product::create(['tenant_id' => $t, 'category_id' => $porcoes->id, 'name' => 'Chicken Fingers', 'description' => 'Tiras de frango empanadas com molho honey mustard', 'price' => 24.90, 'is_active' => true, 'sort_order' => 3]);

        Product::create(['tenant_id' => $t, 'category_id' => $bebidas->id, 'name' => 'Coca-Cola Lata', 'description' => 'Coca-Cola lata 350ml', 'price' => 6.00, 'is_active' => true, 'sort_order' => 1]);
        Product::create(['tenant_id' => $t, 'category_id' => $bebidas->id, 'name' => 'Guaraná Antarctica Lata', 'description' => 'Guaraná Antarctica lata 350ml', 'price' => 5.50, 'is_active' => true, 'sort_order' => 2]);
        Product::create(['tenant_id' => $t, 'category_id' => $bebidas->id, 'name' => 'Suco Natural 500ml', 'description' => 'Suco de laranja ou limão natural 500ml', 'price' => 9.00, 'is_active' => true, 'sort_order' => 3]);
        Product::create(['tenant_id' => $t, 'category_id' => $bebidas->id, 'name' => 'Água Mineral 500ml', 'description' => 'Água mineral sem gás 500ml', 'price' => 4.00, 'is_active' => true, 'sort_order' => 4]);
        Product::create(['tenant_id' => $t, 'category_id' => $bebidas->id, 'name' => 'Milkshake de Chocolate', 'description' => 'Milkshake cremoso de chocolate 400ml', 'price' => 16.90, 'is_active' => true, 'sort_order' => 5]);

        Product::create(['tenant_id' => $t, 'category_id' => $combos->id, 'name' => 'Combo X-Burger + Batata + Refri', 'description' => 'X-Burger simples + batata frita + refrigerante lata', 'price' => 39.90, 'promotional_price' => 34.90, 'is_active' => true, 'sort_order' => 1]);
        Product::create(['tenant_id' => $t, 'category_id' => $combos->id, 'name' => 'Combo X-Tudo + Batata + Milkshake', 'description' => 'X-Tudo + batata frita + milkshake de chocolate', 'price' => 59.90, 'promotional_price' => 49.90, 'is_active' => true, 'sort_order' => 2]);
        Product::create(['tenant_id' => $t, 'category_id' => $combos->id, 'name' => 'Combo Duplo', 'description' => 'Dois X-Burgers + duas batatas + dois refris', 'price' => 69.90, 'promotional_price' => 59.90, 'is_active' => true, 'sort_order' => 3]);
    }
}
