<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SiteSetting;

class ProductController extends Controller
{
    /**
     * Tampilkan detail produk
     * 
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function detail($slug)
    {
        // Pengaturan website
        $setting = SiteSetting::first();
        
        // Ambil produk beserta relasinya
        $product = Product::with(['category', 'spec'])
            ->where('slug', $slug)
            ->where('is_active', 'Y')
            ->firstOrFail();
        
        // Kirim ke halaman detail
        return view('catalog.detail', compact('setting', 'product'));
    }
}