<?php

/*
|--------------------------------------------------------------------------
| NAMESPACE
|--------------------------------------------------------------------------
*/
namespace App\Http\Controllers\Admin;

/*
|--------------------------------------------------------------------------
| IMPORT CLASS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

/*
|--------------------------------------------------------------------------
| ADMIN CONTACT CONTROLLER
|--------------------------------------------------------------------------
| Controller untuk admin mengelola pesan dari pelanggan
|
| Fitur:
| 1. List semua pesan (dengan filter & search)
| 2. Lihat detail pesan
| 3. Tandai sudah/belum dibaca
| 4. Hapus pesan
| 5. Statistik pesan
|
| Perbedaan dengan Frontend ContactController:
| - Frontend: Untuk user mengirim pesan
| - Admin: Untuk admin membaca & mengelola pesan
*/
class ContactController extends Controller
{
    /*
    |----------------------------------------------------------------------
    | METHOD: index()
    |----------------------------------------------------------------------
    | Menampilkan daftar semua pesan dengan filter & search
    |
    | URL: http://localhost:8000/admin/contacts
    | Route name: admin.contacts.index
    | Method: GET
    |
    | Fitur:
    | - Filter berdasarkan status baca (unread/read)
    | - Search berdasarkan nama, email, atau subjek
    | - Pagination (10 pesan per halaman)
    | - Statistik pesan
    */
    public function index(Request $request)
    {
        // ============================================
        // STEP 1: QUERY DASAR
        // ============================================
        /*
        | Contact::query()
        | - Membuat query builder untuk tabel contacts
        | - Bisa ditambahkan kondisi (where, orderBy, dll)
        | - Belum dieksekusi sampai dipanggil get() atau paginate()
        */
        $query = Contact::query();

        // ============================================
        // STEP 2: FILTER STATUS BACA
        // ============================================
        /*
        | Filter berdasarkan parameter 'filter' di URL
        | Contoh URL:
        | - /admin/contacts?filter=unread  → Hanya yang belum dibaca
        | - /admin/contacts?filter=read    → Hanya yang sudah dibaca
        | - /admin/contacts                → Semua pesan
        */
        if ($request->has('filter')) {
            switch ($request->filter) {
                case 'unread':
                    $query->where('is_read', 'N');
                    break;
                case 'read':
                    $query->where('is_read', 'Y');
                    break;
            }
        }

        // ============================================
        // STEP 3: SEARCH
        // ============================================
        /*
        | Search berdasarkan parameter 'search' di URL
        | Contoh URL:
        | - /admin/contacts?search=john
        |
        | Mencari di kolom:
        | - name    : Nama pengirim
        | - email   : Email pengirim
        | - subject : Subjek pesan
        |
        | LIKE '%keyword%':
        | - Mencari teks yang mengandung keyword di mana saja
        | - Contoh: 'john' akan cocok dengan 'John Doe'
        */
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('subject', 'like', '%' . $search . '%');
            });
        }

        // ============================================
        // STEP 4: PAGINATE & ORDER
        // ============================================
        /*
        | paginate(10):
        | - Menampilkan 10 pesan per halaman
        | - Otomatis membuat link pagination
        |
        | orderBy('created_at', 'desc'):
        | - Urutkan dari yang terbaru
        | - Pesan baru muncul di atas
        */
        $contacts = $query->orderBy('created_at', 'desc')
                         ->paginate(10);

        // ============================================
        // STEP 5: STATISTIK
        // ============================================
        /*
        | Statistik untuk ditampilkan di dashboard
        | - total  : Total semua pesan
        | - unread : Pesan yang belum dibaca
        | - read   : Pesan yang sudah dibaca
        | - today  : Pesan yang masuk hari ini
        */
        $stats = [
            'total'      => Contact::count(),
            'unread'     => Contact::where('is_read', 'N')->count(),
            'read'       => Contact::where('is_read', 'Y')->count(),
            'today'      => Contact::whereDate('created_at', today())->count(),
        ];

        // ============================================
        // STEP 6: RETURN VIEW
        // ============================================
        /*
        | compact():
        | - Fungsi PHP untuk membuat array dari variabel
        | - compact('contacts', 'stats') sama dengan:
        |   ['contacts' => $contacts, 'stats' => $stats]
        |
        | View menerima variabel:
        | - $contacts : List pesan (paginated)
        | - $stats    : Statistik pesan
        */
        return view('admin.contacts.index', compact('contacts', 'stats'));
    }

    /*
    |----------------------------------------------------------------------
    | METHOD: show()
    |----------------------------------------------------------------------
    | Menampilkan detail pesan
    |
    | URL: http://localhost:8000/admin/contacts/1
    | Route name: admin.contacts.show
    | Method: GET
    |
    | Parameter:
    | - Contact $contact : Model contact yang akan ditampilkan
    |   (Laravel otomatis inject berdasarkan ID di URL)
    |
    | Fitur:
    | - Otomatis menandai pesan sebagai sudah dibaca
    | - Menampilkan semua detail pesan
    */
    public function show(Contact $contact)
    {
        // Tandai sebagai sudah dibaca saat dibuka
        $contact->markAsRead();

        // Return view dengan data contact
        return view('admin.contacts.show', compact('contact'));
    }

    /*
    |----------------------------------------------------------------------
    | METHOD: toggleRead()
    |----------------------------------------------------------------------
    | Toggle status baca (read/unread)
    |
    | URL: http://localhost:8000/admin/contacts/1/toggle-read
    | Route name: admin.contacts.toggle-read
    | Method: POST
    |
    | Fungsi:
    | - Jika sudah dibaca → tandai sebagai belum dibaca
    | - Jika belum dibaca → tandai sebagai sudah dibaca
    |
    | Penggunaan:
    | - Tombol di list pesan untuk toggle status
    */
    public function toggleRead(Contact $contact)
    {
        if ($contact->is_read === 'Y') {
            $contact->markAsUnread();
            $message = 'Pesan ditandai sebagai belum dibaca';
        } else {
            $contact->markAsRead();
            $message = 'Pesan ditandai sebagai sudah dibaca';
        }

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', $message);
    }

    /*
    |----------------------------------------------------------------------
    | METHOD: destroy()
    |----------------------------------------------------------------------
    | Hapus pesan
    |
    | URL: http://localhost:8000/admin/contacts/1
    | Route name: admin.contacts.destroy
    | Method: DELETE
    |
    | Fungsi:
    | - Menghapus pesan dari database
    | - Redirect kembali ke list dengan pesan sukses
    |
    | Keamanan:
    | - Konfirmasi sebelum hapus (JavaScript confirm)
    | - Hanya admin yang bisa akses
    */
    public function destroy(Contact $contact)
    {
        $name = $contact->name;
        $contact->delete();

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'Pesan dari "' . $name . '" berhasil dihapus');
    }

    /*
    |----------------------------------------------------------------------
    | METHOD: markAllRead()
    |----------------------------------------------------------------------
    | Tandai semua pesan sebagai sudah dibaca
    |
    | URL: http://localhost:8000/admin/contacts/mark-all-read
    | Route name: admin.contacts.mark-all-read
    | Method: POST
    |
    | Fungsi:
    | - Update semua pesan yang belum dibaca menjadi sudah dibaca
    | - Berguna untuk admin yang ingin clear semua notifikasi
    */
    public function markAllRead()
    {
        $count = Contact::where('is_read', 'N')->update(['is_read' => 'Y']);

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', $count . ' pesan ditandai sebagai sudah dibaca');
    }
}