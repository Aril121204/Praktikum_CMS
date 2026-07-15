<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Contact;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard admin
     * URL: /admin/dashboard
     * Route name: admin.dashboard
     */
    public function index()
    {
        // ============================================
        // STATISTIK UTAMA
        // ============================================
        
        // Total semua produk (aktif + nonaktif)
        $totalProducts = Product::count();
        
        // Produk yang aktif (IS_ACTIVE = 'Y')
        $activeProducts = Product::where('is_active', 'Y')->count();
        
        // Produk yang nonaktif (IS_ACTIVE = 'N')
        $inactiveProducts = Product::where('is_active', 'N')->count();

        // Total semua kategori
        $totalCategories = Category::count();
        
        // Kategori yang aktif
        $activeCategories = Category::where('is_active', 'Y')->count();

        // Total pesan dari pelanggan
        $totalContacts = Contact::count();
        
        // 5 pesan terbaru
        $recentContacts = Contact::orderBy('created_at', 'desc')->take(5)->get();

        // ============================================
        // PRODUK DENGAN STOK MENIPIS (< 10 unit)
        // ============================================
        $lowStockProducts = Product::where('stock', '<', 10)
            ->where('is_active', 'Y')
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        // ============================================
        // PRODUK TERBARU
        // ============================================
        $latestProducts = Product::with('category')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // ============================================
        // PRODUK PER KATEGORI (untuk Chart)
        // ============================================
        $productsByCategory = Category::withCount(['products' => function($query) {
            $query->where('is_active', 'Y');
        }])
        ->where('is_active', 'Y')
        ->orderBy('products_count', 'desc')
        ->take(5)
        ->get();

        // ============================================
        // TOTAL NILAI INVENTORI
        // ============================================
        $inventoryValue = Product::where('is_active', 'Y')
            ->selectRaw('SUM(price * stock) as total')
            ->first()
            ->total ?? 0;

        // ============================================
        // RATA-RATA HARGA PRODUK
        // ============================================
        $averagePrice = Product::where('is_active', 'Y')
            ->selectRaw('AVG(price) as avg')
            ->first()
            ->avg ?? 0;

        // ============================================
        // KIRIM DATA KE VIEW
        // ============================================
        return view('admin.dashboard', compact(
            'totalProducts',
            'activeProducts',
            'inactiveProducts',
            'totalCategories',
            'activeCategories',
            'totalContacts',
            'recentContacts',
            'lowStockProducts',
            'latestProducts',
            'inventoryValue',
            'averagePrice',
            'productsByCategory'
        ));
    }
}