<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    private function getBrandFolder($brand)
    {
        $mapping = [
            'Samsung' => 'samsung',
            'Apple' => 'apple',
            'Xiaomi' => 'xiaomi',
            'Oppo' => 'oppo',
            'Vivo' => 'vivo',
            'Realme' => 'realme',
            'Infinix' => 'infinix',
            'Tecno' => 'tecno',
            'ASUS ROG' => 'asus',
            'HUAWEI' => 'huawei',
        ];

        return $mapping[$brand] ?? strtolower(str_replace(' ', '-', $brand));
    }

    private function formatRupiah($amount)
    {
        return 'Rp ' . number_format((float)$amount, 0, ',', '.');
    }

    public function show($slug)
    {
        // Case-insensitive matching untuk slug
        $category = Category::whereRaw('LOWER(SLUG) = ?', [strtolower($slug)])
            ->where('is_active', 'Y')
            ->first();

        if (!$category) {
            abort(404, 'Brand tidak ditemukan');
        }

        // Gunakan where biasa untuk NUMBER column (BUKAN LOWER())
        $products = Product::where('category_id', $category->id)
            ->where('is_active', 'Y')
            ->with('spec')
            ->orderByRaw('CREATED_AT DESC')
            ->paginate(9);

        $totalProducts = $products->total();
        $featuredCount = Product::where('category_id', $category->id)
            ->where('is_active', 'Y')
            ->where('is_featured', 'Y')
            ->count();

        foreach ($products as $product) {
            $brandFolder = $this->getBrandFolder($product->brand);
            $product->image_path = asset('product/' . $brandFolder . '/' . $product->image);
            $product->formatted_price = $this->formatRupiah($product->price);
            
            if ($product->discount_price) {
                $product->formatted_discount_price = $this->formatRupiah($product->discount_price);
            }
            
            $product->detail_url = route('catalog.detail', $product->slug);
        }

        return view('catalog.category', compact(
            'category',
            'products',
            'totalProducts',
            'featuredCount'
        ));
    }

    public function searchByBrand(Request $request)
    {
        $query = trim($request->input('q'));

        if (empty($query)) {
            return redirect()->back()->with('info', 'Silakan masukkan kata kunci pencarian');
        }

        // Case-insensitive search
        $category = Category::where(function ($q) use ($query) {
            $q->whereRaw('LOWER(NAME) = ?', [strtolower($query)])
              ->orWhereRaw('LOWER(SLUG) = ?', [strtolower($query)]);
        })->where('is_active', 'Y')->first();

        if ($category) {
            return redirect()->route('category.show', strtolower($category->slug))
                ->with('success', 'Menampilkan semua produk ' . $category->name);
        }

        $partialCategory = Category::where(function ($q) use ($query) {
            $q->whereRaw('LOWER(NAME) LIKE ?', ['%' . strtolower($query) . '%'])
              ->orWhereRaw('LOWER(SLUG) LIKE ?', ['%' . strtolower($query) . '%']);
        })->where('is_active', 'Y')->first();

        if ($partialCategory) {
            return redirect()->route('category.show', strtolower($partialCategory->slug))
                ->with('success', 'Menampilkan semua produk ' . $partialCategory->name);
        }

        return redirect()->route('catalog.index', ['search' => $query])
            ->with('info', 'Menampilkan hasil pencarian untuk: ' . $query);
    }
}