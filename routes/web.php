<?php

/*
|--------------------------------------------------------------------------
| WEB ROUTES - ASIAPHONE CMS
|--------------------------------------------------------------------------
| File ini berisi semua route untuk aplikasi ASIAPHONE
|
| Struktur Route:
| 1. Import Controllers
| 2. Frontend Website Routes (publik)
| 3. Admin Login Routes (tanpa middleware)
| 4. Admin Panel Routes (dengan middleware 'admin')
| 5. User Profile Routes
| 6. Authentication Routes (Breeze)
*/

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| IMPORT CONTROLLERS
|--------------------------------------------------------------------------
| Import semua controller yang digunakan di aplikasi
| Menggunakan alias (as) untuk menghindari konflik nama class
*/

// ============================================
// FRONTEND CONTROLLERS
// ============================================
// Controller untuk halaman publik (tanpa login)
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CatalogController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;

// ============================================
// ADMIN CONTROLLERS
// ============================================
// Controller untuk halaman admin (dengan middleware admin)
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;

// ============================================
// PROFILE CONTROLLER
// ============================================
// Controller untuk user biasa (bukan admin)
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| FRONTEND WEBSITE ROUTES
|--------------------------------------------------------------------------
| Route untuk halaman publik yang bisa diakses semua pengunjung
| Tidak memerlukan login atau middleware khusus
|
| URL Pattern:
| - /                    → Beranda
| - /catalog             → Katalog produk
| - /category/{slug}     → Detail brand (samsung, apple, dll)
| - /search              → Pencarian brand
| - /catalog/{slug}      → Detail produk
| - /contact             → Halaman kontak (GET & POST)
*/

// ============================================
// HALAMAN BERANDA
// ============================================
// URL: http://localhost:8000/
// Route name: home
// Controller: Frontend\HomeController@index
Route::get('/', [HomeController::class, 'index'])->name('home');

// ============================================
// HALAMAN KATALOG PRODUK
// ============================================
// URL: http://localhost:8000/catalog
// Route name: catalog.index
// Controller: Frontend\CatalogController@index
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');

// ============================================
// HALAMAN DETAIL KATEGORI/BRAND
// ============================================
// URL: http://localhost:8000/category/samsung
// Route name: category.show
// Controller: Frontend\CategoryController@show
// Parameter: {slug} = slug brand (contoh: samsung, apple, xiaomi)
Route::get('/category/{slug}', [FrontendCategoryController::class, 'show'])->name('category.show');

// ============================================
// HALAMAN PENCARIAN (dari navbar search)
// ============================================
// URL: http://localhost:8000/search?q=samsung
// Route name: search
// Controller: Frontend\CategoryController@searchByBrand
Route::get('/search', [FrontendCategoryController::class, 'searchByBrand'])->name('search');

// ============================================
// HALAMAN DETAIL PRODUK
// ============================================
// URL: http://localhost:8000/catalog/samsung-galaxy-s25-ultra
// Route name: catalog.detail
// Controller: Frontend\ProductController@detail
// Parameter: {slug} = slug produk
Route::get('/catalog/{slug}', [ProductController::class, 'detail'])->name('catalog.detail');

// ============================================
// HALAMAN KONTAK (FRONTEND)
// ============================================
// GET /contact - Tampilkan form kontak
// URL: http://localhost:8000/contact
// Route name: contact
// Controller: Frontend\ContactController@index
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// POST /contact - Proses submit form kontak
// URL: http://localhost:8000/contact (method POST)
// Route name: contact.submit
// Controller: Frontend\ContactController@store
Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');

/*
|--------------------------------------------------------------------------
| ADMIN LOGIN ROUTES (TANPA MIDDLEWARE)
|--------------------------------------------------------------------------
| Route untuk login/logout admin
| Tidak menggunakan middleware karena user belum login saat mengakses
|
| URL Pattern:
| - /admin/login  → Form login (GET) & Proses login (POST)
| - /admin/logout → Proses logout (POST)
*/

// ============================================
// GET /admin/login - Tampilkan form login
// ============================================
// URL: http://localhost:8000/admin/login
// Route name: admin.login
Route::get('/admin/login', function() {
    // Jika sudah login sebagai admin, langsung redirect ke dashboard
    if (Auth::check() && strtolower(Auth::user()->role) === 'admin') {
        return redirect('/admin/dashboard');
    }
    
    // Tampilkan form login
    return view('admin.auth.login');
})->name('admin.login');

// ============================================
// POST /admin/login - Proses login
// ============================================
// URL: http://localhost:8000/admin/login (method POST)
// Route name: admin.login.post
Route::post('/admin/login', function() {
    // 1. Validasi input
    $credentials = request()->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ], [
        'email.required' => 'Email harus diisi',
        'email.email' => 'Format email tidak valid',
        'password.required' => 'Password harus diisi',
    ]);

    // 2. DEBUG LOGGING (AMAN - tanpa password plain text)
    \Log::info('=== ADMIN LOGIN ATTEMPT ===');
    \Log::info('Email: ' . $credentials['email']);
    \Log::info('IP Address: ' . request()->ip());
    \Log::info('Timestamp: ' . now());

    // 3. Cek user di database dengan case-insensitive
    // Menggunakan LOWER() untuk Oracle yang menyimpan data UPPERCASE
    $user = DB::table('users')
        ->whereRaw('LOWER(EMAIL) = ?', [strtolower($credentials['email'])])
        ->first();

    // 4. Jika user tidak ditemukan
    if (!$user) {
        \Log::warning('Login gagal: Email tidak terdaftar - ' . $credentials['email']);
        return back()
            ->withErrors(['email' => 'Email tidak terdaftar di sistem'])
            ->withInput(request()->except('password'));
    }

    // 5. NORMALISASI PROPERTY (handle lowercase & UPPERCASE)
    // Helper function untuk safely get property dari stdClass
    $getProp = function($obj, $name) {
        // Coba lowercase dulu (Oracle yajra default)
        $lower = strtolower($name);
        if (property_exists($obj, $lower)) {
            return $obj->$lower;
        }
        // Coba UPPERCASE (Oracle native)
        $upper = strtoupper($name);
        if (property_exists($obj, $upper)) {
            return $obj->$upper;
        }
        // Coba original case
        if (property_exists($obj, $name)) {
            return $obj->$name;
        }
        return null;
    };

    // Ambil property dengan helper function
    $userId = $getProp($user, 'ID');
    $userName = $getProp($user, 'NAME');
    $userEmail = $getProp($user, 'EMAIL');
    $userRole = $getProp($user, 'ROLE');
    $userPassword = $getProp($user, 'PASSWORD');

    // 6. DEBUG: Log struktur object (untuk troubleshooting)
    \Log::info('User properties: ' . json_encode(array_keys((array)$user)));
    \Log::info('User ditemukan: ' . $userName);
    \Log::info('Role: ' . $userRole);
    \Log::info('Password hash (30 char): ' . substr($userPassword, 0, 30) . '...');

    // 7. Verifikasi password dengan Hash::check()
    if (!Hash::check($credentials['password'], $userPassword)) {
        \Log::warning('Login gagal: Password salah untuk email - ' . $credentials['email']);
        return back()
            ->withErrors(['email' => 'Password yang Anda masukkan salah'])
            ->withInput(request()->except('password'));
    }

    // 8. Cek apakah user adalah admin
    if (strtolower($userRole) !== 'admin') {
        \Log::warning('Login gagal: Bukan admin. Role: ' . $userRole);
        return back()
            ->withErrors(['email' => 'Akun Anda bukan administrator (Role: ' . $userRole . ')'])
            ->withInput(request()->except('password'));
    }

    // 9. Login dengan Model Eloquent
    $userModel = \App\Models\User::find($userId);
    
    if (!$userModel) {
        \Log::error('Login gagal: User model tidak ditemukan untuk ID: ' . $userId);
        return back()->withErrors(['email' => 'Terjadi kesalahan sistem']);
    }

    // 10. Login berhasil - Set session
    Auth::login($userModel, request()->boolean('remember'));
    request()->session()->regenerate();

    \Log::info('✅ Login berhasil untuk: ' . $userEmail);

    // 11. Redirect ke dashboard atau halaman yang dituju
    return redirect()->intended('/admin/dashboard')
        ->with('success', 'Selamat datang, ' . $userName . '!');

})->name('admin.login.post');

// ============================================
// POST /admin/logout - Proses logout
// ============================================
// URL: http://localhost:8000/admin/logout (method POST)
// Route name: admin.logout
Route::post('/admin/logout', function() {
    $userName = Auth::check() ? Auth::user()->name : 'Unknown';
    
    // Logout user
    Auth::logout();
    
    // Invalidate session
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    
    \Log::info(' Logout berhasil untuk: ' . $userName);
    
    // Redirect ke halaman login
    return redirect('/admin/login')
        ->with('success', 'Anda telah logout dengan aman');
})->name('admin.logout');

/*
|--------------------------------------------------------------------------
| ADMIN PANEL ROUTES (DENGAN MIDDLEWARE)
|--------------------------------------------------------------------------
| Semua route di dalam group ini memerlukan:
| 1. Middleware 'admin' - Hanya admin yang bisa akses
| 2. Prefix '/admin' - URL dimulai dengan /admin
| 3. Name prefix 'admin.' - Nama route diawali dengan admin.
|
| Contoh: 
| - URL: /admin/dashboard
| - Route name: admin.dashboard
| - Controller: Admin\DashboardController@index
*/

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    
    // ============================================
    // DASHBOARD
    // ============================================
    // URL: /admin/dashboard
    // Route name: admin.dashboard
    // Controller: Admin\DashboardController@index
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // ============================================
    // CATEGORIES CRUD (Brand Handphone)
    // ============================================
    // Route::resource() akan otomatis membuat 7 routes:
    // 
    // GET     /admin/categories              → index    (List semua categories)
    // GET     /admin/categories/create       → create   (Form tambah category)
    // POST    /admin/categories              → store    (Simpan category baru)
    // GET     /admin/categories/{id}/edit    → edit     (Form edit category)
    // PUT     /admin/categories/{id}         → update   (Update category)
    // DELETE  /admin/categories/{id}         → destroy  (Hapus category)
    // GET     /admin/categories/{id}         → show     (Detail category - optional)
    Route::resource('categories', AdminCategoryController::class);

    // ============================================
    // PRODUCTS CRUD (Produk Handphone)
    // ============================================
    // Route untuk mengelola produk di admin panel
    // 
    // GET     /admin/products              → index    (List semua produk)
    // GET     /admin/products/create       → create   (Form tambah produk)
    // POST    /admin/products              → store    (Simpan produk baru)
    // GET     /admin/products/{id}/edit    → edit     (Form edit produk)
    // PUT     /admin/products/{id}         → update   (Update produk)
    // DELETE  /admin/products/{id}         → destroy  (Hapus produk)
    
    // List semua produk dengan filter & search
    Route::get('/products', [AdminProductController::class, 'index'])
        ->name('products.index');
    
    // Form tambah produk baru
    Route::get('/products/create', [AdminProductController::class, 'create'])
        ->name('products.create');
    
    // Simpan produk baru ke database
    Route::post('/products', [AdminProductController::class, 'store'])
        ->name('products.store');
    
    // Form edit produk
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])
        ->name('products.edit');
    
    // Update produk yang sudah ada
    Route::put('/products/{product}', [AdminProductController::class, 'update'])
        ->name('products.update');
    
    // Hapus produk dari database
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])
        ->name('products.destroy');

    // ============================================
    // CONTACTS (View pesan pelanggan)
    // ============================================
    // Route untuk admin mengelola pesan dari pelanggan
    // 
    // GET     /admin/contacts              → index    (List semua pesan)
    // POST    /admin/contacts/mark-all-read → markAllRead (Tandai semua dibaca)
    // GET     /admin/contacts/{id}         → show     (Detail pesan)
    // POST    /admin/contacts/{id}/toggle-read → toggleRead (Toggle status baca)
    // DELETE  /admin/contacts/{id}         → destroy  (Hapus pesan)
    
    // List semua pesan dengan filter & search
    Route::get('/contacts', [AdminContactController::class, 'index'])
        ->name('contacts.index');
    
    // Tandai semua pesan sebagai sudah dibaca
    Route::post('/contacts/mark-all-read', [AdminContactController::class, 'markAllRead'])
        ->name('contacts.mark-all-read');
    
    // Lihat detail pesan
    Route::get('/contacts/{contact}', [AdminContactController::class, 'show'])
        ->name('contacts.show');
    
    // Toggle status baca (read/unread)
    Route::post('/contacts/{contact}/toggle-read', [AdminContactController::class, 'toggleRead'])
        ->name('contacts.toggle-read');
    
    // Hapus pesan
    Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])
        ->name('contacts.destroy');

    // ============================================
    // SETTINGS (Pengaturan Akun & Website Admin)
    // ============================================
    
    // Profile Admin
    Route::get('/settings/profile', [AdminSettingController::class, 'profile'])
        ->name('settings.profile');
    
    Route::put('/settings/profile', [AdminSettingController::class, 'updateProfile'])
        ->name('settings.profile.update');
    
    Route::put('/settings/password', [AdminSettingController::class, 'updatePassword'])
        ->name('settings.password.update');

    // Site Settings (Pengaturan Website)
    Route::get('/settings/site', [AdminSettingController::class, 'siteSettings'])
        ->name('settings.site');
    
    Route::post('/settings/site', [AdminSettingController::class, 'updateSiteSettings'])
        ->name('settings.site.update');

});

/*
|--------------------------------------------------------------------------
| USER DASHBOARD & PROFILE ROUTES
|--------------------------------------------------------------------------
| Route untuk user biasa (bukan admin)
| Menggunakan middleware 'auth' dan 'verified'
*/

// User Dashboard (untuk user biasa)
Route::get('/user/dashboard', function() {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes (Edit, Update, Delete profile user)
Route::middleware('auth')->group(function() {
    // GET /profile - Tampilkan form edit profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    
    // PATCH /profile - Update profile
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // DELETE /profile - Hapus akun
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
| Include routes dari Laravel Breeze/Jetstream untuk login/register
| Route ini untuk user biasa (bukan admin)
*/
require __DIR__ . '/auth.php';