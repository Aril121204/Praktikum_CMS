@extends('admin.layouts.app')

@section('title', 'Produk')
@section('page-title', 'MANAGE PRODUCTS')

@section('content')
<div class="space-y-6 animate-fade-in">

    {{-- Header --}}
    <div class="flex items-center justify-between flex-wrap gap-4">
        <div>
            <h2 class="font-space text-2xl font-bold text-white">PRODUK HANDPHONE</h2>
            <p class="text-slate-400 text-sm mt-1">Kelola semua produk handphone di sistem</p>
        </div>
        <a href="{{ route('admin.products.create') }}" 
           class="btn-modern px-6 py-3 rounded-xl font-medium font-space flex items-center gap-3">
            <i class="fas fa-plus text-xl"></i>
            TAMBAH PRODUK
        </a>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="modern-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-xs uppercase tracking-wider">Total Produk</p>
                    <h3 class="font-space text-3xl font-bold text-white mt-2">{{ $stats['total'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                    <i class="fas fa-mobile-alt text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="modern-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-xs uppercase tracking-wider">Produk Aktif</p>
                    <h3 class="font-space text-3xl font-bold text-white mt-2">{{ $stats['active'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center">
                    <i class="fas fa-check-circle text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="modern-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-xs uppercase tracking-wider">Featured</p>
                    <h3 class="font-space text-3xl font-bold text-white mt-2">{{ $stats['featured'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center">
                    <i class="fas fa-star text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="modern-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-xs uppercase tracking-wider">Stok Menipis</p>
                    <h3 class="font-space text-3xl font-bold text-white mt-2">{{ $stats['low_stock'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-rose-500 to-rose-600 flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter & Search Bar --}}
    <div class="modern-card p-6">
        <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[250px]">
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Cari nama, brand, atau model..."
                           class="w-full pl-12 pr-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all font-space">
                </div>
            </div>

            <select name="category" class="px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-blue-500/50 transition-all font-space">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <select name="status" class="px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-blue-500/50 transition-all font-space">
                <option value="">Semua Status</option>
                <option value="Y" {{ request('status') == 'Y' ? 'selected' : '' }}>Aktif</option>
                <option value="N" {{ request('status') == 'N' ? 'selected' : '' }}>Nonaktif</option>
            </select>

            <button type="submit" class="px-6 py-3 bg-blue-500/20 hover:bg-blue-500/30 border border-blue-500/30 text-blue-400 rounded-xl transition-all font-space font-semibold">
                TERAPKAN
            </button>

            @if(request('search') || request('category') || request('status'))
            <a href="{{ route('admin.products.index') }}" class="px-6 py-3 bg-rose-500/20 hover:bg-rose-500/30 border border-rose-500/30 text-rose-400 rounded-xl transition-all font-space font-semibold">
                RESET
            </a>
            @endif
        </form>
    </div>

    {{-- Products Table --}}
    <div class="modern-card p-8">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-700/50">
                        <th class="text-left py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-widest font-space">Produk</th>
                        <th class="text-left py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-widest font-space">Kategori</th>
                        <th class="text-right py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-widest font-space">Harga</th>
                        <th class="text-center py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-widest font-space">Stok</th>
                        <th class="text-center py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-widest font-space">Flag</th>
                        <th class="text-center py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-widest font-space">Status</th>
                        <th class="text-center py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-widest font-space">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/30">
                    @forelse($products as $product)
                    <tr class="group hover:bg-slate-800/30 transition-all">
                        
                        {{-- Kolom Produk --}}
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-500/20 to-purple-600/20 flex items-center justify-center flex-shrink-0 overflow-hidden">
                                    @if($product->image)
                                        <img src="{{ asset('product/' . strtolower($product->brand) . '/' . $product->image) }}" 
                                             alt="{{ $product->name }}"
                                             class="w-full h-full object-cover"
                                             onerror="this.parentElement.innerHTML='<i class=\'fas fa-mobile-alt text-blue-400 text-xl\'></i>'">
                                    @else
                                        <i class="fas fa-mobile-alt text-blue-400 text-xl"></i>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-sm font-bold text-white font-space truncate">{{ $product->name }}</h4>
                                    <p class="text-xs text-slate-400 truncate">{{ $product->brand }} - {{ $product->model ?? '-' }}</p>
                                    <p class="text-xs text-slate-500 font-mono truncate">{{ $product->slug }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- Kolom Kategori --}}
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 bg-blue-500/10 text-blue-400 text-xs font-bold rounded-full border border-blue-500/30 font-space">
                                {{ $product->category->name ?? '-' }}
                            </span>
                        </td>

                        {{-- Kolom Harga --}}
                        <td class="py-4 px-6 text-right">
                            @if($product->discount_price && $product->discount_price < $product->price)
                                <div class="flex flex-col items-end">
                                    <span class="text-sm font-bold text-emerald-400 font-space">
                                        Rp {{ number_format($product->discount_price, 0, ',', '.') }}
                                    </span>
                                    <span class="text-xs text-slate-500 line-through">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </div>
                            @else
                                <span class="text-sm font-bold text-white font-space">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            @endif
                        </td>

                        {{-- Kolom Stok --}}
                        <td class="py-4 px-6 text-center">
                            @php
                                $stockClass = $product->stock > 10 
                                    ? 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30' 
                                    : ($product->stock > 0 
                                        ? 'bg-amber-500/20 text-amber-400 border-amber-500/30' 
                                        : 'bg-rose-500/20 text-rose-400 border-rose-500/30');
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $stockClass }} border font-space">
                                {{ $product->stock }}
                            </span>
                        </td>

                        {{-- Kolom Flag --}}
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-1">
                                @if($product->is_featured === 'Y')
                                    <span class="w-7 h-7 rounded-full bg-yellow-500/20 border border-yellow-500/30 flex items-center justify-center" title="Featured">
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    </span>
                                @endif
                                @if($product->is_hot_deal === 'Y')
                                    <span class="w-7 h-7 rounded-full bg-orange-500/20 border border-orange-500/30 flex items-center justify-center" title="Hot Deal">
                                        <i class="fas fa-fire text-orange-400 text-xs"></i>
                                    </span>
                                @endif
                                @if($product->is_gaming === 'Y')
                                    <span class="w-7 h-7 rounded-full bg-purple-500/20 border border-purple-500/30 flex items-center justify-center" title="Gaming">
                                        <i class="fas fa-gamepad text-purple-400 text-xs"></i>
                                    </span>
                                @endif
                                @if($product->is_featured !== 'Y' && $product->is_hot_deal !== 'Y' && $product->is_gaming !== 'Y')
                                    <span class="text-slate-500 text-xs">-</span>
                                @endif
                            </div>
                        </td>

                        {{-- Kolom Status --}}
                        <td class="py-4 px-6 text-center">
                            @if($product->is_active === 'Y')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 font-space">
                                    <i class="fas fa-check mr-1"></i> AKTIF
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-500/20 text-slate-400 border border-slate-500/30 font-space">
                                    <i class="fas fa-times mr-1"></i> NONAKTIF
                                </span>
                            @endif
                        </td>

                        {{-- Kolom Aksi --}}
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" 
                                   class="w-10 h-10 rounded-lg bg-blue-500/10 hover:bg-blue-500/20 text-blue-400 transition-all flex items-center justify-center border border-blue-500/30"
                                   title="Edit Produk">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.products.destroy', $product) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus produk \'{{ $product->name }}\'? Data tidak dapat dikembalikan!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-10 h-10 rounded-lg bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 transition-all flex items-center justify-center border border-rose-500/30"
                                            title="Hapus Produk">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-16 text-center">
                            <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-blue-500/20 to-purple-600/20 flex items-center justify-center">
                                <i class="fas fa-inbox text-blue-400 text-5xl"></i>
                            </div>
                            <p class="text-slate-400 font-space text-lg tracking-wide mb-2">Belum ada produk</p>
                            <p class="text-slate-500 text-sm mb-4">Mulai tambahkan produk pertama Anda</p>
                            <a href="{{ route('admin.products.create') }}" 
                               class="inline-flex items-center gap-2 px-6 py-3 bg-blue-500/10 hover:bg-blue-500/20 text-blue-400 rounded-xl transition-all border border-blue-500/30 font-space font-semibold">
                                <i class="fas fa-plus"></i>
                                Tambah Produk Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
        <div class="mt-8 flex items-center justify-center gap-2">
            {{ $products->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection