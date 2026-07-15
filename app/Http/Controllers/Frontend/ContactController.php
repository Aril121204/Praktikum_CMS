<?php

/*
|--------------------------------------------------------------------------
| NAMESPACE
|--------------------------------------------------------------------------
| Namespace menentukan lokasi file ini di struktur folder Laravel
| File ini ada di: app/Http/Controllers/Frontend/
*/
namespace App\Http\Controllers\Frontend;

/*
|--------------------------------------------------------------------------
| IMPORT CLASS
|--------------------------------------------------------------------------
| Import semua class yang dibutuhkan oleh controller ini
|
| PENTING: Setiap class yang digunakan HARUS di-import di sini!
| Jika tidak, Laravel akan mencari class di namespace controller
| dan akan error "Class not found"
*/

// Import base Controller dari Laravel
use App\Http\Controllers\Controller;

// Import Request untuk menangani input dari user
use Illuminate\Http\Request;

// Import Model Contact untuk menyimpan pesan ke database
use App\Models\Contact;

// Import Model SiteSetting untuk mengambil pengaturan website
// ⚠️ INI YANG HILANG DI KODE ANDA SEBELUMNYA!
use App\Models\SiteSetting;

/*
|--------------------------------------------------------------------------
| CONTACT CONTROLLER (FRONTEND)
|--------------------------------------------------------------------------
| Controller untuk menangani form kontak di halaman publik
|
| Fungsi:
| 1. Menampilkan halaman contact (method index)
| 2. Memproses form submission (method store)
| 3. Validasi input dari user
| 4. Simpan data ke database
| 5. Kirim notifikasi (opsional)
|
| URL Pattern:
| - GET  /contact  → Tampilkan form
| - POST /contact  → Proses submit form
*/
class ContactController extends Controller
{
    /*
    |----------------------------------------------------------------------
    | METHOD: index()
    |----------------------------------------------------------------------
    | Menampilkan halaman contact form
    |
    | URL: http://localhost:8000/contact
    | Route name: contact
    | Method: GET
    |
    | Penjelasan:
    | - Method ini dipanggil ketika user mengakses /contact
    | - Mengambil data SiteSetting dari database
    | - Menampilkan view 'frontend.contact' dengan data setting
    |
    | Return:
    | - View: resources/views/frontend/contact.blade.php
    | - Data: $setting (pengaturan website)
    */
    public function index()
    {
        // ============================================
        // STEP 1: AMBIL DATA SITE SETTING
        // ============================================
        // Mengambil data pengaturan website dari tabel site_settings
        // Data ini digunakan untuk menampilkan:
        // - Judul halaman kontak
        // - Deskripsi halaman kontak
        // - Informasi kontak (Jakarta, Surabaya)
        // - Email & sosial media
        // - Quote reservasi
        $setting = SiteSetting::first();

        // ============================================
        // STEP 2: RETURN VIEW
        // ============================================
        // Kirim data $setting ke view
        // compact('setting') sama dengan: ['setting' => $setting]
        return view('frontend.contact', compact('setting'));
    }

    /*
    |----------------------------------------------------------------------
    | METHOD: store()
    |----------------------------------------------------------------------
    | Memproses form submission dan menyimpan ke database
    |
    | URL: http://localhost:8000/contact
    | Route name: contact.submit
    | Method: POST
    |
    | Penjelasan:
    | - Method ini dipanggil ketika user submit form
    | - Menerima data dari request POST
    | - Validasi semua input
    | - Simpan ke tabel contacts
    | - Redirect kembali dengan pesan sukses/error
    |
    | Parameter:
    | - Request $request : Object yang berisi data dari form
    |
    | Return:
    | - Redirect ke halaman contact dengan pesan sukses/error
    */
    public function store(Request $request)
    {
        // ============================================
        // STEP 1: VALIDASI INPUT
        // ============================================
        /*
        | Fungsi Validasi:
        | - Memastikan data yang masuk sesuai aturan
        | - Mencegah data yang tidak valid masuk ke database
        | - Memberikan feedback ke user jika ada error
        |
        | Aturan Validasi:
        | - 'required' : Field wajib diisi
        | - 'string'   : Harus berupa teks
        | - 'min:3'    : Minimal 3 karakter
        | - 'max:255'  : Maksimal 255 karakter
        | - 'email'    : Harus format email yang valid
        | - 'nullable' : Boleh kosong (opsional)
        */
        $validated = $request->validate([
            'name'    => 'required|string|min:3|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string|min:5|max:255',
            'message' => 'required|string|min:10|max:5000',
        ], [
            /*
            | Custom Error Messages (Bahasa Indonesia)
            | Pesan yang ditampilkan jika validasi gagal
            */
            'name.required'    => 'Nama lengkap wajib diisi',
            'name.min'         => 'Nama minimal 3 karakter',
            'name.max'         => 'Nama maksimal 255 karakter',
            'email.required'   => 'Email wajib diisi',
            'email.email'      => 'Format email tidak valid',
            'email.max'        => 'Email maksimal 255 karakter',
            'phone.max'        => 'Nomor telepon maksimal 20 karakter',
            'subject.required' => 'Subjek pesan wajib diisi',
            'subject.min'      => 'Subjek minimal 5 karakter',
            'subject.max'      => 'Subjek maksimal 255 karakter',
            'message.required' => 'Pesan wajib diisi',
            'message.min'      => 'Pesan minimal 10 karakter',
            'message.max'      => 'Pesan maksimal 5000 karakter',
        ]);

        // ============================================
        // STEP 2: SIMPAN KE DATABASE
        // ============================================
        /*
        | Try-Catch Block:
        | - Try: Mencoba eksekusi kode
        | - Catch: Menangkap error jika ada
        |
        | Fungsi:
        | - Mencegah aplikasi crash jika ada error
        | - Memberikan error message yang user-friendly
        */
        try {
            /*
            | Contact::create()
            | - Membuat record baru di tabel contacts
            | - Hanya field yang ada di $fillable yang diproses
            | - Otomatis mengisi created_at dan updated_at
            |
            | trim():
            | - Menghapus spasi di awal dan akhir string
            | - Mencegah data dengan spasi berlebih
            */
            $contact = Contact::create([
                'name'      => trim($validated['name']),
                'email'     => trim($validated['email']),
                'phone'     => isset($validated['phone']) ? trim($validated['phone']) : null,
                'subject'   => trim($validated['subject']),
                'message'   => trim($validated['message']),
                'is_read'   => 'N', // Pesan baru otomatis belum dibaca
            ]);

            // ============================================
            // STEP 3: LOG AKTIVITAS
            // ============================================
            /*
            | Logging:
            | - Mencatat aktivitas ke file log
            | - Berguna untuk debugging dan audit trail
            | - File log tersimpan di: storage/logs/laravel.log
            */
            \Log::info('Pesan baru dari kontak:', [
                'id'        => $contact->id,
                'name'      => $contact->name,
                'email'     => $contact->email,
                'subject'   => $contact->subject,
                'timestamp' => now(),
            ]);

            // ============================================
            // STEP 4: REDIRECT DENGAN PESAN SUKSES
            // ============================================
            /*
            | redirect()->route('contact'):
            | - Redirect ke route dengan nama 'contact'
            | - URL: http://localhost:8000/contact
            |
            | ->with('success', '...'):
            | - Menampilkan pesan sukses di session
            | - Pesan akan muncul di view menggunakan:
            |   @if(session('success')) ... @endif
            */
            return redirect()
                ->route('contact')
                ->with('success', 'Terima kasih! Pesan Anda telah kami terima. Tim kami akan segera menghubungi Anda.');

        } catch (\Exception $e) {
            // ============================================
            // STEP 5: HANDLE ERROR
            // ============================================
            /*
            | Jika ada error saat save ke database:
            | - Log error untuk debugging
            | - Tampilkan pesan error yang user-friendly
            | - Jangan tampilkan detail error ke user (keamanan)
            */
            \Log::error('Gagal menyimpan pesan kontak: ' . $e->getMessage());

            return redirect()
                ->route('contact')
                ->with('error', 'Maaf, terjadi kesalahan saat mengirim pesan. Silakan coba lagi nanti.')
                ->withInput(); // Kembalikan input user agar tidak perlu ketik ulang
        }
    }
}