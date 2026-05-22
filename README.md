# 🍕 Cardápio Digital Multi-Tenant

Sistema de cardápios online multi-restaurante com gestão de pedidos via WhatsApp. Suporta múltiplos restaurantes (tenants) separados por subdomínio, cada um com seu próprio cardápio, produtos, categorias e painel administrativo.

---

## 🏗️ Arquitetura Multi-Tenant

### Modelo: Subdomínio por Tenant

Cada restaurante é um **tenant** identificado por um subdomínio único:

```
🌐 localhost:8000                          → Catálogo de restaurantes
🍕 pizzaria-brasil.localhost:8000          → Cardápio da Pizzaria Brasil
🍔 hamburgueria-do-ze.localhost:8000      → Cardápio da Hamburgueria do Zé
🍣 sushi-bar-oriental.localhost:8000      → Cardápio do Sushi Bar Oriental
🔧 {slug}.localhost:8000/admin            → Painel administrativo
```

No **localhost**, subdomínios funcionam nativamente — `*.localhost` resolve para `127.0.0.1` sem configuração extra.

Em produção, basta configurar um wildcard DNS (`*.seudominio.com`) apontando para o servidor.

### Tabela `tenants`

```php
Schema::create('tenants', function (Blueprint $table) {
    $table->id();
    $table->string('name');              // Nome do restaurante
    $table->string('slug')->unique();    // Identificador do subdomínio
    $table->string('whatsapp');          // WhatsApp para pedidos
    $table->boolean('is_active')->default(true);
    $table->timestamps();
});
```

### Escopo por Tenant (Global Scope)

Todas as entidades que pertencem a um restaurante (`Category`, `Product`, `Order`) usam a trait `BelongsToTenant`:

```php
class Product extends Model
{
    use BelongsToTenant; // Aplica global scope `where('tenant_id', X)`
}
```

Isso garante que **toda query filtra automaticamente** pelo tenant atual. Sem vazamento de dados entre restaurantes.

### Usuário Global (Cliente)

Diferente dos admins, o **cliente** tem uma conta **global** — `tenant_id = null` — e pode logar em qualquer restaurante. O `User` **não** usa `BelongsToTenant`.

O `tenant_id` só é preenchido para **admins de restaurante**:

| Tipo | tenant_id | Acesso |
|------|-----------|--------|
| Cliente | `null` | Loga em qualquer restaurante |
| Admin do restaurante | ID do tenant | Só gerencia o próprio |
| Super admin | `null` + `is_admin=true` | Gerencia qualquer tenant |

### Fluxo de Requisição

```
1. Usuário acessa hamburgueria-do-ze.localhost:8000
                     │
2. TenantMiddleware resolve o slug do subdomínio
                     │
3. Busca o tenant no banco (cacheado na request)
                     │
4. Salva no container: app()->instance('tenant', $tenant)
                     │
5. Compartilha com Inertia: 'tenant' => $tenant
                     │
6. TenantScope filtra todas as queries automaticamente
```

### Middleware `TenantMiddleware`

```php
class TenantMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost();
        $domain = config('app.domain');
        
        // Extrai o subdomínio: "hamburgueria-do-ze" de "hamburgueria-do-ze.localhost"
        if (Str::endsWith($host, ".$domain")) {
            $slug = Str::before($host, ".$domain");
            $tenant = Tenant::where('slug', $slug)->where('is_active', true)->firstOrFail();
            app()->instance('tenant', $tenant);
        }
        
        return $next($request);
    }
}
```

### Função Helper `tenant()`

```php
// app/helpers.php
if (!function_exists('tenant')) {
    function tenant(): ?Tenant
    {
        return app()->bound('tenant') ? app('tenant') : null;
    }
}
```

Disponível globalmente em controllers, views, e componentes Inertia.

### Rotas (Subdomínio vs Domínio Raiz)

```php
// web.php — Estrutura de rotas

// === DOMÍNIO RAIZ (Catálogo) ===
Route::domain('{domain}')  // Ex: localhost:8000
    ->where('domain', 'localhost|127.0.0.1|[\w\.-]+\.com')
    ->group(function () {
        Route::get('/', [TenantCatalogController::class, 'index'])->name('catalog');
    });

// === SUBDOMÍNIO (Restaurante) ===
Route::domain('{tenant}.{domain}')  // Ex: pizzaria-brasil.localhost:8000
    ->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('menu');
        Route::get('/cart', [CartController::class, 'index'])->name('cart');
        Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/my-orders', [CustomerOrderController::class, 'index'])->name('customer.orders');
        
        // Auth (Laravel UI)
        require __DIR__.'/auth.php';
        
        // Admin
        Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
            Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');
            Route::resource('products', Admin\ProductController::class);
            Route::resource('categories', Admin\CategoryController::class);
            Route::get('orders', [Admin\OrderController::class, 'index'])->name('orders.index');
            // ...
        });
    });
```

### Configuração `.env`

```env
APP_DOMAIN=localhost        # Domínio base para subdomínios
SESSION_DOMAIN=.localhost   # Cookie de sessão compartilhado entre subdomínios
```

`APP_DOMAIN` define o domínio base. Em produção: `APP_DOMAIN=meudominio.com`.

### Ziggy: Parâmetro `tenant` como Default

O middleware `HandleInertiaRequests` injeta o tenant atual como default do Ziggy, permitindo que `route('login')`, `route('menu')` etc. funcionem sem passar o parâmetro manualmente:

```php
'ziggy' => fn (): array => [
    ...(new Ziggy)->toArray(),
    'location' => $request->url(),
    'defaults' => [
        'tenant' => tenant()?->slug ?? '',
    ],
],
```

---

## 🚀 Como Executar

```bash
# 1. Instalar dependências
composer install
npm install

# 2. Configurar ambiente
cp .env.example .env
php artisan key:generate

# 3. Banco de dados
touch database/database.sqlite
php artisan migrate --seed

# 4. Build frontend
npm run build

# 5. Servir
php artisan serve

# Acessar:
#   http://localhost:8000                    → Catálogo
#   http://pizzaria-brasil.localhost:8000    → Cardápio
#   http://pizzaria-brasil.localhost:8000/admin → Admin
```

### Credenciais Admin

```
E-mail: admin@cardapio.com
Senha:  admin123
```

Este admin é **super admin** (`is_admin=true`, `tenant_id=null`) — acessa o painel de qualquer restaurante.

---

## 🧪 Seeders

O seeder cria **3 restaurantes** com dados reais:

| Restaurante | Slug | Categorias | Produtos |
|-------------|------|-----------|----------|
| Pizzaria Brasil | `pizzaria-brasil` | 5 | 23 |
| Hamburgueria do Zé | `hamburgueria-do-ze` | 4 | 17 |
| Sushi Bar Oriental | `sushi-bar-oriental` | 5 | 20 |

---

## 🛠️ Stack Tecnológica

| Camada | Tecnologia |
|--------|-----------|
| **Backend** | Laravel 13 |
| **Frontend** | React 19 + Inertia.js (SPA) |
| **Estilização** | Tailwind CSS 4 + Shadcn UI |
| **Banco** | SQLite |
| **Estado** | Zustand |

---

## 📄 Licença

MIT
