@extends('admin.layouts.app')

@section('title', 'Produk')
@section('page-title', 'MANAGE PRODUCTS')

@section('content')
<div class="space-y-6 animate-fade-in">

    <!-- Header -->
    <div class="flex items-center justify-between flex-wrap gap-4">
        <div>
            <h2 class="font-orbitron text-2xl font-bold text-white neon-text">PRODUK HANDPHONE</h2>
            <p class="text-cyan-300/60 text-sm mt-1 font-rajdhani">Kelola semua produk handphone</p>
        </div>
        <a href="{{ route('admin.products.create') }}" 
           class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white rounded-xl transition-all btn-neon font-rajdhani font-semibold tracking-wide flex items-center gap-3">
            <i class="fas fa-plus text-xl"></i>
            TAMBAH PRODUK
        </a>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="glass rounded-2xl p-6 neon-border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-cyan-300/60 text-xs font-rajdhani uppercase tracking-wider">Total Produk</p>
                    <h3 class="font-orbitron text-3xl font-bold text-white mt-2">{{ $stats['total'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center">
                    <i class="fas fa-mobile-alt text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="glass rounded-2xl p-6 neon-border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-300/60 text-xs font-rajdhani uppercase tracking-wider">Produk Aktif</p>
                    <h3 class="font-orbitron text-3xl font-bold text-white mt-2">{{ $stats['active'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-green-600 flex items-center justify-center">
                    <i class="fas fa-check-circle text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="glass rounded-2xl p-6 neon-border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-300/60 text-xs font-rajdhani uppercase tracking-wider">Featured</p>
                    <h3 class="font-orbitron text-3xl font-bold text-white mt-2">{{ $stats['featured'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-400 to-pink-600 flex items-center justify-center">
                    <i class="fas fa-star text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="glass rounded-2xl p-6 neon-border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-rose-300/60 text-xs font-rajdhani uppercase tracking-wider">Stok Menipis</p>
                    <h3 class="font-orbitron text-3xl font-bold text-white mt-2">{{ $stats['low_stock'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-rose-400 to-pink-600 flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="glass rounded-2xl p-6 neon-border">
        <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[250px]">
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-cyan-400">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari nama, brand, atau model..."
                           class="w-full pl-12 pr-4 py-3 bg-black/20 border border-cyan-500/30 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-cyan-400 transition-all font-rajdhani">
                </div>
            </div>

            <select name="category" class="px-4 py-3 bg-black/20 border border-cyan-500/30 rounded-xl text-white focus:outline-none focus:border-cyan-400 transition-all font-rajdhani">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <select name="status" class="px-4 py-3 bg-black/20 border border-cyan-500/30 rounded-xl text-white focus:outline-none focus:border-cyan-400 transition-all font-rajdhani">
                <option value="">Semua Status</option>
                <option value="Y" {{ request('status') == 'Y' ? 'selected' : '' }}>Aktif</option>
                <option value="N" {{ request('status') == 'N' ? 'selected' : '' }}>Nonaktif</option>
            </select>

            <button type="submit" class="px-6 py-3 bg-cyan-500/20 hover:bg-cyan-500/30 border border-cyan-500/30 text-cyan-400 rounded-xl transition-all btn-neon font-rajdhani font-semibold tracking-wide">
                TERAPKAN
            </button>

            @if(request('search') || request('category') || request('status'))
            <a href="{{ route('admin.products.index') }}" class="px-6 py-3 bg-rose-500/20 hover:bg-rose-500/30 border border-rose-500/30 text-rose-400 rounded-xl transition-all btn-neon font-rajdhani font-semibold tracking-wide">
                RESET
            </a>
            @endif
        </form>
    </div>

    <!-- Products Table -->
    <div class="glass rounded-3xl p-8 neon-border">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-cyan-500/20">
                        <th class="text-left py-4 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Produk</th>
                        <th class="text-left py-4 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Kategori</th>
                        <th class="text-right py-4 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Harga</th>
                        <th class="text-center py-4 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Stok</th>
                        <th class="text-center py-4 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Status</th>
                        <th class="text-center py-4 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cyan-500/10">
                    @forelse($products as $product)
                    <tr class="group hover:bg-cyan-500/5 transition-all">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500/20 to-purple-600/20 flex items-center justify-center flex-shrink-0">
                                    @if($product->image)
                                        <img src="{{ asset('product/' . strtolower($product->brand) . '/' . $product->image) }}" 
                                             alt="{{ $product->name }}"
                                             class="w-full h-full object-cover rounded-xl"
                                             onerror="this.parentElement.innerHTML='<i class=\'fas fa-mobile-alt text-cyan-400\'></i>'">
                                    @else
                                        <i class="fas fa-mobile-alt text-cyan-400"></i>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-sm font-bold text-white font-rajdhani tracking-wide truncate">{{ $product->name }}</h4>
                                    <p class="text-xs text-cyan-400/60">{{ $product->brand }} - {{ $product->model }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 bg-cyan-500/10 text-cyan-400 text-xs font-bold rounded-full border border-cyan-500/30 font-rajdhani">
                                {{ $product->category->name ?? '-' }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <span class="text-sm font-bold text-white font-orbitron">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            @php
                                $stockClass = $product->stock > 10 ? 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30' : 
                                             ($product->stock > 0 ? 'bg-amber-500/20 text-amber-400 border-amber-500/30' : 'bg-rose-500/20 text-rose-400 border-rose-500/30');
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $stockClass }} border font-rajdhani">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            @if($product->is_active === 'Y')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 font-rajdhani">
                                    <i class="fas fa-check mr-1"></i> AKTIF
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-500/20 text-gray-400 border border-gray-500/30 font-rajdhani">
                                    <i class="fas fa-times mr-1"></i> NONAKTIF
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" 
                                   class="w-10 h-10 rounded-lg bg-cyan-500/10 hover:bg-cyan-500/20 text-cyan-400 transition-all flex items-center justify-center border border-cyan-500/30 btn-neon">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus produk \'{{ $product->name }}\'?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-10 h-10 rounded-lg bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 transition-all flex items-center justify-center border border-rose-500/30 btn-neon">
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
                            <p class="text-cyan-300/60 font-rajdhani text-lg tracking-wide mb-2">Belum ada produk</p>
                            <a href="{{ route('admin.products.create') }}" 
                               class="inline-flex items-center gap-2 px-6 py-3 bg-cyan-500/10 hover:bg-cyan-500/20 text-cyan-400 rounded-xl transition-all border border-cyan-500/30 font-rajdhani font-semibold">
                                <i class="fas fa-plus"></i>
                                Tambah Produk Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
        <div class="mt-8 flex items-center justify-center gap-2">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>
@endsection