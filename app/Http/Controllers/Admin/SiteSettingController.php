<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SiteSettingController extends Controller
{
    /**
     * Tampilkan halaman edit site settings
     */
    public function edit()
    {
        $setting = SiteSetting::firstOrCreate([]);
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update site settings
     */
    public function update(Request $request)
    {
        Log::info('=== UPDATE SITE SETTINGS START ===');
        
        $setting = SiteSetting::firstOrCreate([]);

        // Validasi
        $validated = $request->validate([
            // Logo & Branding
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo_text' => 'nullable|string|max:255',
            
            // Hero Section
            'hero_label' => 'nullable|string|max:255',
            'hero_title' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            
            // About & Vision
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'about_store' => 'nullable|string',
            
            // Catalog Section
            'catalog_title' => 'nullable|string|max:255',
            'catalog_description' => 'nullable|string',
            'catalog_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            
            // Contact Section
            'contact_title' => 'nullable|string|max:255',
            'contact_subtitle' => 'nullable|string|max:255',
            'contact_description' => 'nullable|string',
            
            // Jakarta Location
            'contact_jakarta_title' => 'nullable|string|max:255',
            'contact_jakarta_address' => 'nullable|string',
            'contact_jakarta_hours' => 'nullable|string|max:255',
            'contact_jakarta_phone' => 'nullable|string|max:50',
            
            // Surabaya Location
            'contact_surabaya_title' => 'nullable|string|max:255',
            'contact_surabaya_address' => 'nullable|string',
            'contact_surabaya_hours' => 'nullable|string|max:255',
            'contact_surabaya_phone' => 'nullable|string|max:50',
            
            // Contact Info
            'contact_email_1' => 'nullable|email|max:255',
            'contact_email_2' => 'nullable|email|max:255',
            'contact_quote_title' => 'nullable|string|max:255',
            'contact_quote_text' => 'nullable|string',
            
            // General Contact
            'phone' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            
            // Google Maps
            'google_maps_embed' => 'nullable|string',
            
            // Footer
            'footer_text' => 'nullable|string',
            'copyright' => 'nullable|string|max:255',
        ]);

        // Handle file uploads
        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }
            
            $logo = $request->file('logo');
            $logoName = time() . '_logo.' . $logo->getClientOriginalExtension();
            $logo->storeAs('settings', $logoName, 'public');
            $validated['logo'] = 'settings/' . $logoName;
        }

        if ($request->hasFile('hero_image')) {
            if ($setting->hero_image) {
                Storage::disk('public')->delete($setting->hero_image);
            }
            
            $heroImage = $request->file('hero_image');
            $heroImageName = time() . '_hero.' . $heroImage->getClientOriginalExtension();
            $heroImage->storeAs('settings', $heroImageName, 'public');
            $validated['hero_image'] = 'settings/' . $heroImageName;
        }

        if ($request->hasFile('catalog_banner')) {
            if ($setting->catalog_banner) {
                Storage::disk('public')->delete($setting->catalog_banner);
            }
            
            $banner = $request->file('catalog_banner');
            $bannerName = time() . '_banner.' . $banner->getClientOriginalExtension();
            $banner->storeAs('settings', $bannerName, 'public');
            $validated['catalog_banner'] = 'settings/' . $bannerName;
        }

        // Update settings
        $setting->update($validated);

        Log::info('=== UPDATE SITE SETTINGS SUCCESS ===');

        return redirect()->route('admin.settings.edit')
            ->with('success', 'Pengaturan website berhasil diperbarui!');
    }

    /**
     * Hapus gambar tertentu
     */
    public function deleteImage(Request $request, $type)
    {
        $setting = SiteSetting::first();
        
        if (!$setting) {
            return response()->json(['success' => false, 'message' => 'Settings not found'], 404);
        }

        $fieldMap = [
            'logo' => 'logo',
            'hero' => 'hero_image',
            'banner' => 'catalog_banner',
        ];

        $field = $fieldMap[$type] ?? null;

        if (!$field || !$setting->$field) {
            return response()->json(['success' => false, 'message' => 'Image not found'], 404);
        }

        // Hapus file dari storage
        Storage::disk('public')->delete($setting->$field);
        
        // Update database
        $setting->update([$field => null]);

        return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
    }
}