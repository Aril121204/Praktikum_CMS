<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = trim($request->input('q'));

        Log::info('=== SEARCH DIMULAI ===');
        Log::info('Query pencarian: [' . $query . ']');

        if (empty($query)) {
            return redirect()->back()->with('info', 'Silakan masukkan kata kunci pencarian');
        }

        // Case-insensitive exact match
        $category = Category::where(function ($q) use ($query) {
            $q->whereRaw('LOWER(NAME) = ?', [strtolower($query)])
              ->orWhereRaw('LOWER(SLUG) = ?', [strtolower($query)]);
        })->where('is_active', 'Y')->first();

        if ($category) {
            Log::info('✅ Category DITEMUKAN (exact): ' . $category->name);
            return redirect()->route('category.show', strtolower($category->slug))
                ->with('success', 'Menampilkan semua produk ' . $category->name);
        }

        // Case-insensitive partial match
        $partialCategory = Category::where(function ($q) use ($query) {
            $q->whereRaw('LOWER(NAME) LIKE ?', ['%' . strtolower($query) . '%'])
              ->orWhereRaw('LOWER(SLUG) LIKE ?', ['%' . strtolower($query) . '%']);
        })->where('is_active', 'Y')->first();

        if ($partialCategory) {
            Log::info('✅ Partial match DITEMUKAN: ' . $partialCategory->name);
            return redirect()->route('category.show', strtolower($partialCategory->slug))
                ->with('success', 'Menampilkan semua produk ' . $partialCategory->name);
        }

        // Case-insensitive brand search
        $brandProduct = Product::whereRaw('LOWER(BRAND) LIKE ?', ['%' . strtolower($query) . '%'])
            ->select('brand')
            ->distinct()
            ->first();

        if ($brandProduct) {
            Log::info('✅ Brand DITEMUKAN di products: ' . $brandProduct->brand);
            
            $categoryFromBrand = Category::where(function ($q) use ($brandProduct) {
                $q->whereRaw('LOWER(NAME) = ?', [strtolower($brandProduct->brand)])
                  ->orWhereRaw('LOWER(SLUG) = ?', [strtolower(Str::slug($brandProduct->brand))]);
            })->where('is_active', 'Y')->first();

            if ($categoryFromBrand) {
                Log::info('✅ Category dari brand DITEMUKAN: ' . $categoryFromBrand->name);
                return redirect()->route('category.show', strtolower($categoryFromBrand->slug))
                    ->with('success', 'Menampilkan semua produk ' . $brandProduct->brand);
            }
        }

        Log::info('⚠️ TIDAK ADA YANG COCOK - Redirect ke catalog');
        return redirect()->route('catalog.index', ['search' => $query])
            ->with('info', 'Menampilkan hasil pencarian untuk: ' . $query);
    }
}