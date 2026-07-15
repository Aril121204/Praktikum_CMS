<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SiteSetting;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $setting = SiteSetting::first();
        
        $brands = Category::where('is_active', 'Y')
            ->orderBy('sort_order')
            ->pluck('name')
            ->toArray();

        $query = Product::where('is_active', 'Y')->with('spec');

        // ✅ FIX: Filter brand case-insensitive
        if ($request->filled('brand')) {
            $query->whereRaw('LOWER(BRAND) = ?', [strtolower($request->brand)]);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->has('ram') && is_array($request->ram)) {
            $query->whereHas('spec', function($q) use ($request) {
                $q->whereIn('ram', $request->ram);
            });
        }

        if ($request->has('storage') && is_array($request->storage)) {
            $query->whereHas('spec', function($q) use ($request) {
                $q->whereIn('storage', $request->storage);
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(NAME) LIKE ?', ['%' . strtolower($search) . '%'])
                  ->orWhereRaw('LOWER(BRAND) LIKE ?', ['%' . strtolower($search) . '%'])
                  ->orWhereRaw('LOWER(MODEL) LIKE ?', ['%' . strtolower($search) . '%']);
            });
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'name':
                    $query->orderBy('name', 'asc');
                    break;
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderByRaw('CREATED_AT DESC');
                    break;
                default:
                    $query->orderByRaw('CREATED_AT DESC');
            }
        } else {
            $query->orderByRaw('CREATED_AT DESC');
        }

        $products = $query->paginate(12)->withQueryString();

        $rams = Product::join('product_specs', 'products.id', '=', 'product_specs.product_id')
            ->where('products.is_active', 'Y')
            ->whereNotNull('product_specs.ram')
            ->distinct()
            ->pluck('product_specs.ram')
            ->sort()
            ->values();

        $storages = Product::join('product_specs', 'products.id', '=', 'product_specs.product_id')
            ->where('products.is_active', 'Y')
            ->whereNotNull('product_specs.storage')
            ->distinct()
            ->pluck('product_specs.storage')
            ->sort()
            ->values();

        return view('catalog.index', compact(
            'setting',
            'products',
            'brands',
            'rams',
            'storages'
        ));
    }
}