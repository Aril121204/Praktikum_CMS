<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 'site_settings';

    /**
     * Kolom yang bisa diisi (mass assignable)
     */
    protected $fillable = [
        'logo',
        'logo_text',
        'hero_label',
        'hero_title',
        'hero_description',
        'hero_image',
        'about_store',
        'vision',
        'mission',
        'catalog_title',
        'catalog_description',
        'catalog_banner',
        'contact_title',
        'contact_subtitle',
        'contact_description',
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
        'phone',
        'whatsapp',
        'email',
        'address',
        'google_maps_embed',
        'footer_text',
        'copyright',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Helper: Ambil setting pertama (single row)
     * 
     * @return SiteSetting|null
     */
    public static function getSettings()
    {
        return self::first();
    }

    /**
     * Helper: Ambil nilai berdasarkan key
     * 
     * @param string $key
     * @param string $default
     * @return mixed
     */
    public static function getValue($key, $default = '')
    {
        $setting = self::first();
        return $setting ? ($setting->$key ?? $default) : $default;
    }
}