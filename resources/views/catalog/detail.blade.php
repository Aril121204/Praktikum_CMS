@extends('layouts.frontend')

@section('title', $product->name . ' - AsiaPhone')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-20">
    
    {{-- Breadcrumb --}}
    <nav class="mb-8">
        <ol class="flex items-center gap-2 text-sm">
            <li><a href="{{ route('home') }}" class="text-slate-400 hover:text-white">Beranda</a></li>
            <li class="text-slate-500">/</li>
            <li><a href="{{ route('catalog.index') }}" class="text-slate-400 hover:text-white">Katalog</a></li>
            @if($product->category)
            <li class="text-slate-500">/</li>
            <li><a href="{{ route('category.show', $product->category->slug) }}" class="text-slate-400 hover:text-white">{{ $product->category->name }}</a></li>
            @endif
            <li class="text-slate-500">/</li>
            <li class="text-white font-semibold">{{ $product->name }}</li>
        </ol>
    </nav>

    {{-- Product Detail --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
        
        {{-- Image --}}
        <div class="relative">
            <div class="aspect-square rounded-3xl overflow-hidden bg-slate-800/50 flex items-center justify-center">
                @if($product->image)
                    <img src="{{ asset('product/' . strtolower($product->brand) . '/' . $product->image) }}" 
                         alt="{{ $product->name }}"
                         class="w-full h-full object-contain p-8"
                         onerror="this.src='{{ asset('Images/no-image.png') }}'">
                @else
                    <i class="fas fa-mobile-alt text-9xl text-slate-600"></i>
                @endif
            </div>

            {{-- Badges --}}
            <div class="absolute top-6 left-6 flex flex-col gap-2">
                @if($product->is_featured === 'Y')
                    <span class="px-4 py-2 bg-yellow-500 text-black rounded-full text-xs font-bold uppercase">
                        <i class="fas fa-star mr-1"></i> Unggulan
                    </span>
                @endif
                @if($product->is_hot_deal === 'Y')
                    <span class="px-4 py-2 bg-orange-500 text-white rounded-full text-xs font-bold uppercase">
                        <i class="fas fa-fire mr-1"></i> Hot Deal
                    </span>
                @endif
                @if($product->is_gaming === 'Y')
                    <span class="px-4 py-2 bg-purple-500 text-white rounded-full text-xs font-bold uppercase">
                        <i class="fas fa-gamepad mr-1"></i> Gaming
                    </span>
                @endif
            </div>

            {{-- Discount Badge --}}
            @if($product->discount_price && $product->discount_percent > 0)
            <div class="absolute top-6 right-6">
                <span class="px-4 py-2 bg-emerald-500 text-white rounded-full text-xs font-bold uppercase">
                    -{{ $product->discount_percent }}%
                </span>
            </div>
            @endif
        </div>

        {{-- Info --}}
        <div class="space-y-6">
            <div>
                <span class="text-sm text-slate-400 uppercase tracking-wider">{{ $product->brand }}</span>
                <h1 class="text-4xl md:text-5xl font-bold text-white mt-2">{{ $product->name }}</h1>
                @if($product->model)
                <p class="text-xl text-slate-400 mt-2">{{ $product->model }}</p>
                @endif
            </div>

            {{-- Price --}}
            <div class="p-6 bg-slate-800/50 rounded-2xl border border-slate-700/50">
                @if($product->discount_price && $product->discount_price < $product->price)
                    <div class="flex items-baseline gap-4 mb-2">
                        <span class="text-4xl font-bold text-emerald-400">
                            Rp {{ number_format($product->discount_price, 0, ',', '.') }}
                        </span>
                        <span class="text-xl text-slate-500 line-through">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                    </div>
                    <span class="px-3 py-1 bg-emerald-500/20 text-emerald-400 text-sm font-bold rounded-full border border-emerald-500/30">
                        Hemat Rp {{ number_format($product->price - $product->discount_price, 0, ',', '.') }}
                    </span>
                @else
                    <span class="text-4xl font-bold text-white">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                @endif
            </div>

            {{-- Stock --}}
            <div class="flex items-center gap-2">
                @if($product->stock > 10)
                    <span class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></span>
                    <span class="text-emerald-400 font-semibold">Stok Tersedia ({{ $product->stock }} unit)</span>
                @elseif($product->stock > 0)
                    <span class="w-3 h-3 bg-amber-500 rounded-full animate-pulse"></span>
                    <span class="text-amber-400 font-semibold">Stok Terbatas ({{ $product->stock }} unit)</span>
                @else
                    <span class="w-3 h-3 bg-rose-500 rounded-full"></span>
                    <span class="text-rose-400 font-semibold">Stok Habis</span>
                @endif
            </div>

            {{-- Condition --}}
            <div>
                <span class="text-sm text-slate-400">Kondisi:</span>
                <span class="ml-2 px-3 py-1 {{ $product->condition === 'new' ? 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30' : 'bg-amber-500/20 text-amber-400 border-amber-500/30' }} border rounded-full text-sm font-bold">
                    {{ $product->condition === 'new' ? 'BARU' : 'BEKAS' }}
                </span>
            </div>

            {{-- WhatsApp Button --}}
            @if($product->stock > 0)
            <a href="https://wa.me/6281234567890?text=Halo%20ASIAPHONE,%20saya%20tertarik%20dengan%20{{ urlencode($product->name) }}" 
               target="_blank"
               class="w-full py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white rounded-xl font-bold text-lg flex items-center justify-center gap-3 transition-all">
                <i class="fab fa-whatsapp text-2xl"></i>
                PESAN VIA WHATSAPP
            </a>
            @else
            <button disabled class="w-full py-4 bg-slate-700 text-slate-500 rounded-xl font-bold text-lg cursor-not-allowed">
                STOK HABIS
            </button>
            @endif
        </div>
    </div>

    {{-- Specifications --}}
    @if($product->spec)
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-white mb-8">Spesifikasi Teknis</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @if($product->spec->processor)
            <div class="p-6 bg-slate-800/50 rounded-2xl border border-slate-700/50">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fas fa-microchip text-blue-400 text-xl"></i>
                    <h3 class="text-lg font-bold text-white">Prosesor</h3>
                </div>
                <p class="text-slate-300">{{ $product->spec->processor }}</p>
            </div>
            @endif

            @if($product->spec->ram)
            <div class="p-6 bg-slate-800/50 rounded-2xl border border-slate-700/50">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fas fa-memory text-purple-400 text-xl"></i>
                    <h3 class="text-lg font-bold text-white">RAM</h3>
                </div>
                <p class="text-slate-300">{{ $product->spec->ram }}</p>
            </div>
            @endif

            @if($product->spec->storage)
            <div class="p-6 bg-slate-800/50 rounded-2xl border border-slate-700/50">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fas fa-hdd text-emerald-400 text-xl"></i>
                    <h3 class="text-lg font-bold text-white">Penyimpanan</h3>
                </div>
                <p class="text-slate-300">{{ $product->spec->storage }}</p>
            </div>
            @endif

            @if($product->spec->display)
            <div class="p-6 bg-slate-800/50 rounded-2xl border border-slate-700/50">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fas fa-mobile-alt text-cyan-400 text-xl"></i>
                    <h3 class="text-lg font-bold text-white">Layar</h3>
                </div>
                <p class="text-slate-300">{{ $product->spec->display }}</p>
            </div>
            @endif

            @if($product->spec->camera_rear)
            <div class="p-6 bg-slate-800/50 rounded-2xl border border-slate-700/50">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fas fa-camera text-rose-400 text-xl"></i>
                    <h3 class="text-lg font-bold text-white">Kamera Belakang</h3>
                </div>
                <p class="text-slate-300">{{ $product->spec->camera_rear }}</p>
            </div>
            @endif

            @if($product->spec->camera_front)
            <div class="p-6 bg-slate-800/50 rounded-2xl border border-slate-700/50">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fas fa-user-circle text-pink-400 text-xl"></i>
                    <h3 class="text-lg font-bold text-white">Kamera Depan</h3>
                </div>
                <p class="text-slate-300">{{ $product->spec->camera_front }}</p>
            </div>
            @endif

            @if($product->spec->battery)
            <div class="p-6 bg-slate-800/50 rounded-2xl border border-slate-700/50">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fas fa-battery-full text-green-400 text-xl"></i>
                    <h3 class="text-lg font-bold text-white">Baterai</h3>
                </div>
                <p class="text-slate-300">{{ $product->spec->battery }}</p>
            </div>
            @endif

            @if($product->spec->charging)
            <div class="p-6 bg-slate-800/50 rounded-2xl border border-slate-700/50">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fas fa-bolt text-yellow-400 text-xl"></i>
                    <h3 class="text-lg font-bold text-white">Charging</h3>
                </div>
                <p class="text-slate-300">{{ $product->spec->charging }}</p>
            </div>
            @endif

            @if($product->spec->os)
            <div class="p-6 bg-slate-800/50 rounded-2xl border border-slate-700/50">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fab fa-android text-green-400 text-xl"></i>
                    <h3 class="text-lg font-bold text-white">Sistem Operasi</h3>
                </div>
                <p class="text-slate-300">{{ $product->spec->os }}</p>
            </div>
            @endif

            @if($product->spec->dimensions)
            <div class="p-6 bg-slate-800/50 rounded-2xl border border-slate-700/50">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fas fa-ruler text-indigo-400 text-xl"></i>
                    <h3 class="text-lg font-bold text-white">Dimensi</h3>
                </div>
                <p class="text-slate-300">{{ $product->spec->dimensions }}</p>
            </div>
            @endif

            @if($product->spec->weight)
            <div class="p-6 bg-slate-800/50 rounded-2xl border border-slate-700/50">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fas fa-weight text-orange-400 text-xl"></i>
                    <h3 class="text-lg font-bold text-white">Berat</h3>
                </div>
                <p class="text-slate-300">{{ $product->spec->weight }}</p>
            </div>
            @endif

            @if($product->spec->colors)
            <div class="p-6 bg-slate-800/50 rounded-2xl border border-slate-700/50">
                <div class="flex items-center gap-3 mb-3">
                    <i class="fas fa-palette text-pink-400 text-xl"></i>
                    <h3 class="text-lg font-bold text-white">Warna</h3>
                </div>
                <p class="text-slate-300">{{ $product->spec->colors }}</p>
            </div>
            @endif
        </div>
    </div>
    @endif

    {{-- Description --}}
    @if($product->description)
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-white mb-6">Deskripsi</h2>
        <div class="p-8 bg-slate-800/50 rounded-2xl border border-slate-700/50">
            <p class="text-slate-300 leading-relaxed whitespace-pre-wrap">{{ $product->description }}</p>
        </div>
    </div>
    @endif

    {{-- Philosophy --}}
    @if($product->philosophy)
    <div class="mb-16">
        <h2 class="text-3xl font-bold text-white mb-6">Filosofi</h2>
        <div class="p-8 bg-gradient-to-br from-purple-500/10 to-pink-500/10 rounded-2xl border border-purple-500/30">
            <p class="text-slate-300 leading-relaxed italic text-lg">"{{ $product->philosophy }}"</p>
        </div>
    </div>
    @endif

</div>
@endsection