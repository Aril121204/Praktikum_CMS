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
        Schema::create('product_specs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                ->unique()
                ->constrained()
                ->onDelete('cascade');

            // Prosesor
            $table->string('processor')->nullable();

            // Memori
            $table->string('ram')->nullable();
            $table->string('storage')->nullable();
            $table->boolean('expandable_storage')->default(false);

            // Layar
            $table->string('display')->nullable();
            $table->string('resolution')->nullable();

            // Kamera
            $table->string('camera_rear')->nullable();
            $table->string('camera_front')->nullable();

            // Baterai
            $table->string('battery')->nullable();
            $table->string('charging')->nullable();

            // Sistem & Konektivitas
            $table->string('os')->nullable();
            $table->string('connectivity')->nullable();

            // Fisik
            $table->string('dimensions')->nullable();
            $table->string('colors')->nullable();

            // Lainnya
            $table->text('other_specs')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_specs');
    }
};
