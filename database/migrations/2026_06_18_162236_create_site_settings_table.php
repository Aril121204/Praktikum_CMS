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
        Schema::create('site_settings', function (Blueprint $table) {

            $table->id();

            // Navbar
            $table->string('logo')->nullable();
            $table->string('logo_text')->nullable();

            // Hero Home
            $table->string('hero_label')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_image')->nullable();

            // About Store
            $table->longText('about_store')->nullable();

            // Catalog
            $table->string('catalog_title')->nullable();
            $table->text('catalog_description')->nullable();
            $table->string('catalog_banner')->nullable();

            // Contact
            $table->string('contact_title')->nullable();
            $table->text('contact_description')->nullable();

            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();

            $table->text('address')->nullable();
            $table->longText('google_maps_embed')->nullable();

            // Footer
            $table->text('footer_text')->nullable();
            $table->string('copyright')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
