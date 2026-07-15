<?php

/*
|--------------------------------------------------------------------------
| NAMESPACE
|--------------------------------------------------------------------------
| Namespace HARUS SAMA dengan lokasi folder
| File ini ada di: app/Http/Controllers/Admin/
*/
namespace App\Http\Controllers\Admin;

/*
|--------------------------------------------------------------------------
| IMPORT CLASS
|--------------------------------------------------------------------------
| Import semua class yang dibutuhkan
*/
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| CATEGORY CONTROLLER (ADMIN)
|--------------------------------------------------------------------------
| Controller untuk mengelola kategori/brand di admin panel
|
| Fitur:
| 1. List semua kategori (index)
| 2. Form tambah kategori (create)
| 3. Simpan kategori baru (store)
| 4. Form edit kategori (edit)
| 5. Update kategori (update)
| 6. Hapus kategori (destroy)
| 7. Detail kategori (show)
|
| URL Pattern:
| - GET    /admin/categories              → index
| - GET    /admin/categories/create       → create
| - POST   /admin/categories              → store
| - GET    /admin/categories/{id}/edit    → edit
| - PUT    /admin/categories/{id}         → update
| - DELETE /admin/categories/{id}         → destroy
| - GET    /admin/categories/{id}         → show
|
| View Location: resources/views/admin/categories/
*/
class CategoryController extends Controller
{
    /**
     * Tampilkan daftar semua kategori
     * 
     * URL: /admin/categories
     * Route name: admin.categories.index
     * Method: GET
     * 
     * @param  Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Query dasar
        $query = Category::query();

        // Filter berdasarkan status
        if ($request->has('status') && $request->status) {
            $query->where('is_active', $request->status);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('slug', 'like', '%' . $search . '%');
            });
        }

        // Pagination
        $categories = $query->orderBy('sort_order', 'asc')
                           ->orderBy('name', 'asc')
                           ->paginate(10);

        // Statistik
        $stats = [
            'total' => Category::count(),
            'active' => Category::where('is_active', 'Y')->count(),
            'inactive' => Category::where('is_active', 'N')->count(),
        ];

        return view('admin.categories.index', compact('categories', 'stats'));
    }

    /**
     * Tampilkan form tambah kategori
     * 
     * URL: /admin/categories/create
     * Route name: admin.categories.create
     * Method: GET
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Simpan kategori baru ke database
     * 
     * URL: /admin/categories
     * Route name: admin.categories.store
     * Method: POST
     * 
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'required|string|max:255|unique:categories,slug|alpha_dash',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'required|in:Y,N',
        ], [
            'name.required' => 'Nama kategori wajib diisi',
            'name.unique' => 'Nama kategori sudah ada',
            'slug.required' => 'Slug wajib diisi',
            'slug.unique' => 'Slug sudah digunakan',
            'slug.alpha_dash' => 'Slug hanya boleh berisi huruf, angka, dan tanda hubung',
            'sort_order.required' => 'Urutan wajib diisi',
            'is_active.required' => 'Status wajib dipilih',
        ]);

        // Handle upload gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            
            $uploadPath = public_path('Images/categories');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            $image->move($uploadPath, $imageName);
            $validated['image'] = 'Images/categories/' . $imageName;
        }

        // Simpan ke database
        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori "' . $validated['name'] . '" berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail kategori
     * 
     * URL: /admin/categories/{id}
     * Route name: admin.categories.show
     * Method: GET
     * 
     * @param  Category $category
     * @return \Illuminate\View\View
     */
    public function show(Category $category)
    {
        // Load relasi products
        $category->loadCount('products');
        
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Tampilkan form edit kategori
     * 
     * URL: /admin/categories/{id}/edit
     * Route name: admin.categories.edit
     * Method: GET
     * 
     * @param  Category $category
     * @return \Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update kategori yang sudah ada
     * 
     * URL: /admin/categories/{id}
     * Route name: admin.categories.update
     * Method: PUT
     * 
     * @param  Request $request
     * @param  Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id . '|alpha_dash',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'required|in:Y,N',
        ]);

        // Handle upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($category->image) {
                $oldPath = public_path($category->image);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Upload gambar baru
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            
            $uploadPath = public_path('Images/categories');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            $image->move($uploadPath, $imageName);
            $validated['image'] = 'Images/categories/' . $imageName;
        } else {
            $validated['image'] = $category->image;
        }

        // Update database
        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori "' . $validated['name'] . '" berhasil diperbarui!');
    }

    /**
     * Hapus kategori dari database
     * 
     * URL: /admin/categories/{id}
     * Route name: admin.categories.destroy
     * Method: DELETE
     * 
     * @param  Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        // Cek apakah ada produk di kategori ini
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Tidak dapat menghapus kategori "' . $category->name . '" karena masih ada produk yang menggunakan kategori ini!');
        }

        // Hapus gambar
        if ($category->image) {
            $imagePath = public_path($category->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $categoryName = $category->name;
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori "' . $categoryName . '" berhasil dihapus!');
    }
}