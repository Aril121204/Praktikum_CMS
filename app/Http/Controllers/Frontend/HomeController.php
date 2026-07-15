<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Ambil setting dari database
        $setting = SiteSetting::first();
        
        // Ambil semua brand untuk filter
        $brands = Category::where('is_active', 'Y')
            ->orderBy('name')
            ->pluck('name')
            ->toArray();

        $brand = $request->input('brand');
        
        // ============================================
        // QUERY DASAR DENGAN FILTER BRAND
        // ============================================
        $query = Product::where('is_active', 'Y')->with('spec');
        
        // Jika ada filter brand, terapkan ke query
        if ($brand) {
            $query->where('brand', $brand);
        }
        
        // ============================================
        // PRODUK UNGGULAN (dengan filter brand)
        // ============================================
        $featuredQuery = Product::where('is_active', 'Y')
            ->where('is_featured', 'Y')
            ->with('spec');
        
        if ($brand) {
            $featuredQuery->where('brand', $brand);
        }
        
        $featuredProducts = $featuredQuery
            ->orderByRaw('CREATED_AT DESC')
            ->limit(3)
            ->get();
        
        // ============================================
        // HOT DEAL PRODUCTS (dengan filter brand)
        // ============================================
        $hotDealQuery = Product::where('is_active', 'Y')
            ->whereNotNull('discount_price')
            ->whereRaw('DISCOUNT_PRICE < PRICE')
            ->with('spec');
        
        if ($brand) {
            $hotDealQuery->where('brand', $brand);
        }
        
        $hotDealProducts = $hotDealQuery
            ->orderByRaw('CREATED_AT DESC')
            ->limit(4)
            ->get();
        
        // ============================================
        // GAMING PRODUCTS (dengan filter brand)
        // ============================================
        $gamingQuery = Product::where('is_active', 'Y')
            ->where('is_gaming', 'Y')
            ->with('spec');
        
        if ($brand) {
            $gamingQuery->where('brand', $brand);
        }
        
        $gamingProducts = $gamingQuery
            ->orderByRaw('CREATED_AT DESC')
            ->limit(3)
            ->get();
        
        // ============================================
        // LATEST PRODUCTS (dengan filter brand)
        // ============================================
        $latestQuery = Product::where('is_active', 'Y')
            ->with('spec');
        
        if ($brand) {
            $latestQuery->where('brand', $brand);
        }
        
        $latestProducts = $latestQuery
            ->orderByRaw('CREATED_AT DESC')
            ->limit(4)
            ->get();
        
        return view('frontend.home', compact(
            'setting',
            'brands',
            'brand',
            'featuredProducts',
            'hotDealProducts',
            'gamingProducts',
            'latestProducts'
        ));
    }
}