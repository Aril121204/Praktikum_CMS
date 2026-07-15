<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            $table->foreignId('category_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('name');

            $table->string('brand');

            $table->string('model');

            $table->string('slug')->unique();

            $table->decimal('price', 12, 2);

            // Hot Deals
            $table->decimal('discount_price', 12, 2)
                ->nullable();

            $table->integer('discount_percent')
                ->nullable();

            $table->integer('stock')->default(0);

            $table->string('condition', 20)
                ->default('new');

            $table->text('description')->nullable();

            // Detail Produk
            $table->longText('philosophy')
                ->nullable();

            $table->string('image')->nullable();

            $table->boolean('is_active')->default(true);

            // Beranda
            $table->boolean('is_featured')->default(false);

            // Catalog
            $table->boolean('is_hot_deal')->default(false);

            $table->boolean('is_gaming')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
