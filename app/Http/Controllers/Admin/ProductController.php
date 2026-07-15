<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductSpec;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Tampilkan daftar semua produk
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'spec']);

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(NAME) LIKE ?', ['%' . $search . '%'])
                  ->orWhereRaw('LOWER(BRAND) LIKE ?', ['%' . $search . '%'])
                  ->orWhereRaw('LOWER(MODEL) LIKE ?', ['%' . $search . '%']);
            });
        }

        $products = $query->orderByRaw('CREATED_AT DESC')->paginate(15);
        $categories = Category::where('is_active', 'Y')->orderBy('sort_order')->get();

        $stats = [
            'total' => Product::count(),
            'active' => Product::where('is_active', 'Y')->count(),
            'featured' => Product::where('is_featured', 'Y')->count(),
            'low_stock' => Product::where('stock', '<', 10)->where('is_active', 'Y')->count(),
        ];

        return view('admin.products.index', compact('products', 'categories', 'stats'));
    }

    /**
     * Tampilkan form tambah produk
     */
    public function create()
    {
        $categories = Category::where('is_active', 'Y')->orderBy('sort_order')->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Simpan produk baru ke database
     */
    public function store(Request $request)
    {
        Log::info('=== STORE PRODUCT START ===');

        // Validasi input
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'discount_percent' => 'nullable|integer|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'condition' => 'required|in:new,used',
            'description' => 'nullable|string',
            'philosophy' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'required|in:Y,N',
            'is_featured' => 'nullable|in:Y,N',
            'is_hot_deal' => 'nullable|in:Y,N',
            'is_gaming' => 'nullable|in:Y,N',

            // Product Specs validation
            'spec.processor' => 'nullable|string|max:255',
            'spec.ram' => 'nullable|string|max:255',
            'spec.storage' => 'nullable|string|max:255',
            'spec.expandable_storage' => 'nullable|in:Y,N',
            'spec.display' => 'nullable|string|max:255',
            'spec.resolution' => 'nullable|string|max:255',
            'spec.camera_rear' => 'nullable|string|max:255',
            'spec.camera_front' => 'nullable|string|max:255',
            'spec.battery' => 'nullable|string|max:255',
            'spec.charging' => 'nullable|string|max:255',
            'spec.os' => 'nullable|string|max:255',
            'spec.connectivity' => 'nullable|string',
            'spec.dimensions' => 'nullable|string|max:255',
            'spec.colors' => 'nullable|string',
            'spec.other_specs' => 'nullable|string',
        ], [
            'slug.regex' => 'Slug hanya boleh huruf kecil, angka, dan tanda hubung (-). Contoh: samsung-galaxy-s25',
        ]);

        DB::beginTransaction();

        try {
            // Set default untuk checkbox yang tidak dicentang
            $validated['is_featured'] = $validated['is_featured'] ?? 'N';
            $validated['is_hot_deal'] = $validated['is_hot_deal'] ?? 'N';
            $validated['is_gaming'] = $validated['is_gaming'] ?? 'N';

            // Cek slug unique (case-insensitive untuk Oracle)
            $slugExists = Product::whereRaw('LOWER(SLUG) = ?', [strtolower($validated['slug'])])->exists();
            if ($slugExists) {
                throw new \Exception('Slug "' . $validated['slug'] . '" sudah digunakan.');
            }

            // Upload gambar
            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();

                $uploadPath = public_path('product/' . strtolower($request->brand));
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                $image->move($uploadPath, $imageName);
                Log::info('Image uploaded: ' . $imageName);
            }

            // Create Product (ID auto-generated oleh trigger Oracle)
            $product = Product::create([
                'category_id' => $validated['category_id'],
                'name' => $validated['name'],
                'brand' => $validated['brand'],
                'model' => $validated['model'] ?? null,
                'slug' => $validated['slug'],
                'price' => $validated['price'],
                'discount_price' => $validated['discount_price'] ?? null,
                'discount_percent' => $validated['discount_percent'] ?? null,
                'stock' => $validated['stock'],
                'condition' => $validated['condition'],
                'description' => $validated['description'] ?? null,
                'philosophy' => $validated['philosophy'] ?? null,
                'image' => $imageName,
                'is_active' => $validated['is_active'],
                'is_featured' => $validated['is_featured'],
                'is_hot_deal' => $validated['is_hot_deal'],
                'is_gaming' => $validated['is_gaming'],
            ]);

            Log::info('Product created with ID: ' . $product->id);

            // Create ProductSpec (TANPA weight karena kolom tidak ada di database)
            ProductSpec::create([
                'product_id' => $product->id,
                'processor' => $validated['spec']['processor'] ?? null,
                'ram' => $validated['spec']['ram'] ?? null,
                'storage' => $validated['spec']['storage'] ?? null,
                'expandable_storage' => $validated['spec']['expandable_storage'] ?? 'N',
                'display' => $validated['spec']['display'] ?? null,
                'resolution' => $validated['spec']['resolution'] ?? null,
                'camera_rear' => $validated['spec']['camera_rear'] ?? null,
                'camera_front' => $validated['spec']['camera_front'] ?? null,
                'battery' => $validated['spec']['battery'] ?? null,
                'charging' => $validated['spec']['charging'] ?? null,
                'os' => $validated['spec']['os'] ?? null,
                'connectivity' => $validated['spec']['connectivity'] ?? null,
                'dimensions' => $validated['spec']['dimensions'] ?? null,
                'colors' => $validated['spec']['colors'] ?? null,
                'other_specs' => $validated['spec']['other_specs'] ?? null,
            ]);

            DB::commit();
            Log::info('=== STORE PRODUCT SUCCESS ===');

            return redirect()->route('admin.products.index')
                ->with('success', 'Produk "' . $validated['name'] . '" berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Store Product Error: ' . $e->getMessage());

            if (isset($imageName) && $imageName) {
                $imagePath = public_path('product/' . strtolower($request->brand) . '/' . $imageName);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan produk: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan form edit produk
     */
    public function edit(Product $product)
    {
        $categories = Category::where('is_active', 'Y')->orderBy('sort_order')->get();
        $product->load('spec');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update produk yang sudah ada
     */
    public function update(Request $request, Product $product)
    {
        Log::info('=== UPDATE PRODUCT START ===');

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'discount_percent' => 'nullable|integer|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'condition' => 'required|in:new,used',
            'description' => 'nullable|string',
            'philosophy' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'required|in:Y,N',
            'is_featured' => 'nullable|in:Y,N',
            'is_hot_deal' => 'nullable|in:Y,N',
            'is_gaming' => 'nullable|in:Y,N',

            'spec.processor' => 'nullable|string|max:255',
            'spec.ram' => 'nullable|string|max:255',
            'spec.storage' => 'nullable|string|max:255',
            'spec.expandable_storage' => 'nullable|in:Y,N',
            'spec.display' => 'nullable|string|max:255',
            'spec.resolution' => 'nullable|string|max:255',
            'spec.camera_rear' => 'nullable|string|max:255',
            'spec.camera_front' => 'nullable|string|max:255',
            'spec.battery' => 'nullable|string|max:255',
            'spec.charging' => 'nullable|string|max:255',
            'spec.os' => 'nullable|string|max:255',
            'spec.connectivity' => 'nullable|string',
            'spec.dimensions' => 'nullable|string|max:255',
            'spec.colors' => 'nullable|string',
            'spec.other_specs' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Set default untuk checkbox
            $validated['is_featured'] = $validated['is_featured'] ?? 'N';
            $validated['is_hot_deal'] = $validated['is_hot_deal'] ?? 'N';
            $validated['is_gaming'] = $validated['is_gaming'] ?? 'N';

            // Cek slug unique (exclude current product)
            $slugExists = Product::whereRaw('LOWER(SLUG) = ? AND ID != ?', [strtolower($validated['slug']), $product->id])->exists();
            if ($slugExists) {
                throw new \Exception('Slug "' . $validated['slug'] . '" sudah digunakan produk lain.');
            }

            // Handle upload gambar
            $imageName = $product->image;
            if ($request->hasFile('image')) {
                // Hapus gambar lama
                if ($product->image) {
                    $oldPath = public_path('product/' . strtolower($product->brand) . '/' . $product->image);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }

                $image = $request->file('image');
                $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();

                $uploadPath = public_path('product/' . strtolower($request->brand));
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                $image->move($uploadPath, $imageName);
            }

            // Update Product
            $product->update([
                'category_id' => $validated['category_id'],
                'name' => $validated['name'],
                'brand' => $validated['brand'],
                'model' => $validated['model'] ?? null,
                'slug' => $validated['slug'],
                'price' => $validated['price'],
                'discount_price' => $validated['discount_price'] ?? null,
                'discount_percent' => $validated['discount_percent'] ?? null,
                'stock' => $validated['stock'],
                'condition' => $validated['condition'],
                'description' => $validated['description'] ?? null,
                'philosophy' => $validated['philosophy'] ?? null,
                'image' => $imageName,
                'is_active' => $validated['is_active'],
                'is_featured' => $validated['is_featured'],
                'is_hot_deal' => $validated['is_hot_deal'],
                'is_gaming' => $validated['is_gaming'],
            ]);

            // Update or Create ProductSpec (TANPA weight)
            ProductSpec::updateOrCreate(
                ['product_id' => $product->id],
                [
                    'processor' => $validated['spec']['processor'] ?? null,
                    'ram' => $validated['spec']['ram'] ?? null,
                    'storage' => $validated['spec']['storage'] ?? null,
                    'expandable_storage' => $validated['spec']['expandable_storage'] ?? 'N',
                    'display' => $validated['spec']['display'] ?? null,
                    'resolution' => $validated['spec']['resolution'] ?? null,
                    'camera_rear' => $validated['spec']['camera_rear'] ?? null,
                    'camera_front' => $validated['spec']['camera_front'] ?? null,
                    'battery' => $validated['spec']['battery'] ?? null,
                    'charging' => $validated['spec']['charging'] ?? null,
                    'os' => $validated['spec']['os'] ?? null,
                    'connectivity' => $validated['spec']['connectivity'] ?? null,
                    'dimensions' => $validated['spec']['dimensions'] ?? null,
                    'colors' => $validated['spec']['colors'] ?? null,
                    'other_specs' => $validated['spec']['other_specs'] ?? null,
                ]
            );

            DB::commit();
            Log::info('=== UPDATE PRODUCT SUCCESS ===');

            return redirect()->route('admin.products.index')
                ->with('success', 'Produk "' . $validated['name'] . '" berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Update Product Error: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui produk: ' . $e->getMessage());
        }
    }

    /**
     * Hapus produk dari database
     */
    public function destroy(Product $product)
    {
        DB::beginTransaction();

        try {
            // Hapus gambar
            if ($product->image) {
                $imagePath = public_path('product/' . strtolower($product->brand) . '/' . $product->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Hapus product specs
            if ($product->spec) {
                $product->spec->delete();
            }

            $productName = $product->name;
            $product->delete();

            DB::commit();

            return redirect()->route('admin.products.index')
                ->with('success', 'Produk "' . $productName . '" berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
        }
    }
}