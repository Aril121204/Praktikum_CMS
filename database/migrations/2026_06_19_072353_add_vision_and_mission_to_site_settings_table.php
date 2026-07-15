<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ============================================
        // FIX 1: Tambah kolom is_read di contacts
        // ============================================
        if (!Schema::hasColumn('contacts', 'is_read')) {
            Schema::table('contacts', function (Blueprint $table) {
                $table->char('is_read', 1)->default('N')->after('message');
            });
        }

        // ============================================
        // FIX 2: Tambah kolom yang hilang di site_settings
        // ============================================
        Schema::table('site_settings', function (Blueprint $table) {
            // Contact subtitle
            if (!Schema::hasColumn('site_settings', 'contact_subtitle')) {
                $table->string('contact_subtitle')->nullable()->after('contact_title');
            }
            
            // Jakarta Location
            if (!Schema::hasColumn('site_settings', 'contact_jakarta_title')) {
                $table->string('contact_jakarta_title')->nullable()->after('contact_description');
            }
            if (!Schema::hasColumn('site_settings', 'contact_jakarta_address')) {
                $table->text('contact_jakarta_address')->nullable()->after('contact_jakarta_title');
            }
            if (!Schema::hasColumn('site_settings', 'contact_jakarta_hours')) {
                $table->string('contact_jakarta_hours')->nullable()->after('contact_jakarta_address');
            }
            if (!Schema::hasColumn('site_settings', 'contact_jakarta_phone')) {
                $table->string('contact_jakarta_phone')->nullable()->after('contact_jakarta_hours');
            }
            
            // Surabaya Location
            if (!Schema::hasColumn('site_settings', 'contact_surabaya_title')) {
                $table->string('contact_surabaya_title')->nullable()->after('contact_jakarta_phone');
            }
            if (!Schema::hasColumn('site_settings', 'contact_surabaya_address')) {
                $table->text('contact_surabaya_address')->nullable()->after('contact_surabaya_title');
            }
            if (!Schema::hasColumn('site_settings', 'contact_surabaya_hours')) {
                $table->string('contact_surabaya_hours')->nullable()->after('contact_surabaya_address');
            }
            if (!Schema::hasColumn('site_settings', 'contact_surabaya_phone')) {
                $table->string('contact_surabaya_phone')->nullable()->after('contact_surabaya_hours');
            }
            
            // Contact Emails
            if (!Schema::hasColumn('site_settings', 'contact_email_1')) {
                $table->string('contact_email_1')->nullable()->after('contact_surabaya_phone');
            }
            if (!Schema::hasColumn('site_settings', 'contact_email_2')) {
                $table->string('contact_email_2')->nullable()->after('contact_email_1');
            }
            
            // Quote
            if (!Schema::hasColumn('site_settings', 'contact_quote_title')) {
                $table->string('contact_quote_title')->nullable()->after('contact_email_2');
            }
            if (!Schema::hasColumn('site_settings', 'contact_quote_text')) {
                $table->text('contact_quote_text')->nullable()->after('contact_quote_title');
            }
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('is_read');
        });

        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'contact_subtitle',
                'contact_jakarta_title',
                'contact_jakarta_address',
                'contact_jakarta_hours',
                'contact_jakarta_phone',
                'contact_surabaya_title',
                'contact_surabaya_address',
                'contact_surabaya_hours',
                'contact_surabaya_phone',
                'contact_email_1',
                'contact_email_2',
                'contact_quote_title',
                'contact_quote_text',
            ]);
        });
    }
};