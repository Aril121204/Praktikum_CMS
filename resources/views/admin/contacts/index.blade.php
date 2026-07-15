@extends('admin.layouts.app')

@section('title', 'Pesan Kontak')
@section('page-title', 'MANAGE CONTACTS')

@section('content')
<div class="space-y-6 animate-fade-in">

    {{-- ============================================
        HEADER SECTION
        ============================================ --}}
    <div class="flex items-center justify-between flex-wrap gap-4">
        <div>
            <h2 class="font-orbitron text-2xl font-bold text-white neon-text">PESAN PELANGGAN</h2>
            <p class="text-cyan-300/60 text-sm mt-1 font-rajdhani">Kelola pesan yang masuk dari pelanggan</p>
        </div>
        @if($stats['unread'] > 0)
        <form action="{{ route('admin.contacts.mark-all-read') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white rounded-xl transition-all btn-neon font-rajdhani font-semibold tracking-wide flex items-center gap-3">
                <i class="fas fa-check-double text-xl"></i>
                TANDAI SEMUA DIBACA
            </button>
        </form>
        @endif
    </div>

    {{-- ============================================
        STATISTICS CARDS
        ============================================ --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        
        {{-- Total Pesan --}}
        <div class="glass rounded-2xl p-6 neon-border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-cyan-300/60 text-xs font-rajdhani uppercase tracking-wider">Total Pesan</p>
                    <h3 class="font-orbitron text-3xl font-bold text-white mt-2">{{ $stats['total'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center shadow-lg shadow-cyan-500/30">
                    <i class="fas fa-envelope text-white text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Belum Dibaca --}}
        <div class="glass rounded-2xl p-6 neon-border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-rose-300/60 text-xs font-rajdhani uppercase tracking-wider">Belum Dibaca</p>
                    <h3 class="font-orbitron text-3xl font-bold text-white mt-2">{{ $stats['unread'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-rose-400 to-pink-600 flex items-center justify-center shadow-lg shadow-rose-500/30">
                    <i class="fas fa-envelope-open text-white text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Sudah Dibaca --}}
        <div class="glass rounded-2xl p-6 neon-border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-300/60 text-xs font-rajdhani uppercase tracking-wider">Sudah Dibaca</p>
                    <h3 class="font-orbitron text-3xl font-bold text-white mt-2">{{ $stats['read'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-green-600 flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <i class="fas fa-envelope-open text-white text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Pesan Hari Ini --}}
        <div class="glass rounded-2xl p-6 neon-border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-300/60 text-xs font-rajdhani uppercase tracking-wider">Hari Ini</p>
                    <h3 class="font-orbitron text-3xl font-bold text-white mt-2">{{ $stats['today'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-400 to-pink-600 flex items-center justify-center shadow-lg shadow-purple-500/30">
                    <i class="fas fa-calendar-day text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================
        FILTER & SEARCH BAR
        ============================================ --}}
    <div class="glass rounded-2xl p-6 neon-border">
        <form action="{{ route('admin.contacts.index') }}" method="GET" class="flex flex-wrap gap-4">
            
            {{-- Search Input --}}
            <div class="flex-1 min-w-[250px]">
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-cyan-400">
                        <i class="fas fa-search"></i>
                    </span>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Cari nama, email, atau subjek..."
                        class="w-full pl-12 pr-4 py-3 bg-black/20 border border-cyan-500/30 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 transition-all font-rajdhani">
                </div>
            </div>

            {{-- Filter Status --}}
            <select name="filter" class="px-4 py-3 bg-black/20 border border-cyan-500/30 rounded-xl text-white focus:outline-none focus:border-cyan-400 transition-all font-rajdhani">
                <option value="">Semua Pesan</option>
                <option value="unread" {{ request('filter') == 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
                <option value="read" {{ request('filter') == 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
            </select>

            {{-- Tombol Terapkan --}}
            <button type="submit" class="px-6 py-3 bg-cyan-500/20 hover:bg-cyan-500/30 border border-cyan-500/30 text-cyan-400 rounded-xl transition-all btn-neon font-rajdhani font-semibold tracking-wide">
                TERAPKAN
            </button>

            {{-- Tombol Reset --}}
            @if(request('search') || request('filter'))
            <a href="{{ route('admin.contacts.index') }}" class="px-6 py-3 bg-rose-500/20 hover:bg-rose-500/30 border border-rose-500/30 text-rose-400 rounded-xl transition-all btn-neon font-rajdhani font-semibold tracking-wide">
                RESET
            </a>
            @endif
        </form>
    </div>

    {{-- ============================================
        CONTACTS TABLE
        ============================================ --}}
    <div class="glass rounded-3xl p-8 neon-border">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-cyan-500/20">
                        <th class="text-left py-4 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Pengirim</th>
                        <th class="text-left py-4 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Subjek</th>
                        <th class="text-left py-4 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Pesan</th>
                        <th class="text-center py-4 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Tanggal</th>
                        <th class="text-center py-4 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Status</th>
                        <th class="text-center py-4 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cyan-500/10">
                    @forelse($contacts as $contact)
                    <tr class="group hover:bg-cyan-500/5 transition-all {{ $contact->is_read === 'N' ? 'bg-cyan-500/5' : '' }}">
                        
                        {{-- Kolom Pengirim --}}
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-500 to-purple-600 flex items-center justify-center flex-shrink-0 shadow-lg shadow-cyan-500/20">
                                    <span class="text-white font-bold font-orbitron">{{ strtoupper(substr($contact->name, 0, 1)) }}</span>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-sm font-bold text-white font-rajdhani tracking-wide truncate">{{ $contact->name }}</h4>
                                    <p class="text-xs text-cyan-400/60 truncate">{{ $contact->email }}</p>
                                    @if($contact->phone)
                                    <p class="text-xs text-gray-500 truncate">
                                        <i class="fas fa-phone text-[10px] mr-1"></i>{{ $contact->phone }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </td>

                        {{-- Kolom Subjek --}}
                        <td class="py-4 px-6">
                            <span class="text-sm font-semibold text-white font-rajdhani">{{ $contact->subject }}</span>
                        </td>

                        {{-- Kolom Pesan (Preview) --}}
                        <td class="py-4 px-6">
                            <p class="text-sm text-gray-400 truncate max-w-xs">{{ Str::limit($contact->message, 80, '...') }}</p>
                        </td>

                        {{-- Kolom Tanggal --}}
                        <td class="py-4 px-6 text-center">
                            <span class="text-xs text-gray-400 font-rajdhani">
                                {{ $contact->created_at->format('d M Y') }}<br>
                                <span class="text-cyan-400/60">{{ $contact->created_at->format('H:i') }} WIB</span>
                            </span>
                        </td>

                        {{-- Kolom Status --}}
                        <td class="py-4 px-6 text-center">
                            @if($contact->is_read === 'Y')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 font-rajdhani">
                                    <i class="fas fa-check mr-1"></i> DIBACA
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-500/20 text-rose-400 border border-rose-500/30 font-rajdhani animate-pulse">
                                    <i class="fas fa-circle mr-1 text-[6px]"></i> BARU
                                </span>
                            @endif
                        </td>

                        {{-- Kolom Aksi --}}
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center gap-2">
                                {{-- Tombol Lihat Detail --}}
                                <a href="{{ route('admin.contacts.show', $contact) }}" 
                                   class="w-10 h-10 rounded-lg bg-cyan-500/10 hover:bg-cyan-500/20 text-cyan-400 transition-all flex items-center justify-center border border-cyan-500/30 btn-neon"
                                   title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- Tombol Toggle Read --}}
                                <form action="{{ route('admin.contacts.toggle-read', $contact) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="w-10 h-10 rounded-lg bg-purple-500/10 hover:bg-purple-500/20 text-purple-400 transition-all flex items-center justify-center border border-purple-500/30 btn-neon"
                                            title="{{ $contact->is_read === 'Y' ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}">
                                        <i class="fas {{ $contact->is_read === 'Y' ? 'fa-envelope-open' : 'fa-envelope' }}"></i>
                                    </button>
                                </form>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus pesan dari \'{{ $contact->name }}\'? Data tidak dapat dikembalikan!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-10 h-10 rounded-lg bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 transition-all flex items-center justify-center border border-rose-500/30 btn-neon"
                                            title="Hapus Pesan">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-16 text-center">
                            <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-cyan-500/20 to-purple-600/20 flex items-center justify-center">
                                <i class="fas fa-inbox text-cyan-400 text-5xl"></i>
                            </div>
                            <p class="text-cyan-300/60 font-rajdhani text-lg tracking-wide mb-2">Belum ada pesan</p>
                            <p class="text-gray-500 text-sm">Pesan dari pelanggan akan muncul di sini</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($contacts->hasPages())
        <div class="mt-8 flex items-center justify-center gap-2">
            {{ $contacts->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection