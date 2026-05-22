<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add tenant_id to users
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('tenant_id')->nullable()->constrained('tenants')->cascadeOnDelete()->after('id');
            $table->index('tenant_id');
        });

        // Add tenant_id to categories (nullable for migration, drop unique slug first)
        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->foreignId('tenant_id')->nullable()->constrained('tenants')->cascadeOnDelete()->after('id');
            $table->index('tenant_id');
            $table->unique(['tenant_id', 'slug']);
        });

        // Add tenant_id to products
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('tenant_id')->nullable()->constrained('tenants')->cascadeOnDelete()->after('id');
            $table->index('tenant_id');
        });

        // Add tenant_id to orders
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('tenant_id')->nullable()->constrained('tenants')->cascadeOnDelete()->after('id');
            $table->index('tenant_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']);
            $table->dropColumn('tenant_id');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']);
            $table->dropColumn('tenant_id');
            $table->dropUnique(['tenant_id', 'slug']);
            $table->string('slug')->unique()->change();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']);
            $table->dropColumn('tenant_id');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']);
            $table->dropColumn('tenant_id');
        });
    }
};
