@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'DASHBOARD OVERVIEW')

@section('content')
<div class="space-y-8 animate-fade-in">

    <!-- ======================================== -->
    <!-- WELCOME BANNER -->
    <!-- ======================================== -->
    <div class="glass rounded-3xl p-10 relative overflow-hidden group holographic neon-border">
        <div class="absolute inset-0 bg-gradient-to-r from-cyan-600/20 via-purple-600/20 to-pink-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
        <div class="relative z-10 flex items-center justify-between">
            <div class="flex items-center gap-8">
                <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-cyan-400 via-blue-500 to-purple-600 flex items-center justify-center shadow-2xl shadow-cyan-500/50 animate-float">
                    <i class="fas fa-hand-sparkles text-white text-4xl"></i>
                </div>
                <div>
                    <h2 class="font-orbitron text-4xl font-bold text-white mb-3 neon-text tracking-wider">
                        SELAMAT DATANG, {{ strtoupper(auth()->user()->name ?? 'ADMIN') }}! 👋
                    </h2>
                    <p class="text-cyan-300/80 text-lg font-rajdhani tracking-wide">Sistem manajemen teknologi masa depan Anda</p>
                </div>
            </div>
            <div class="hidden lg:block">
                <div class="flex items-center gap-4 px-8 py-4 glass rounded-2xl border border-cyan-500/30">
                    <i class="fas fa-chart-line text-cyan-400 text-4xl animate-pulse"></i>
                    <div>
                        <p class="text-xs text-cyan-400/60 font-rajdhani tracking-widest uppercase">Total Kunjungan Hari Ini</p>
                        <p class="text-3xl font-bold text-white font-orbitron">{{ number_format(rand(1000, 5000)) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================================== -->
    <!-- STATS CARDS (4 Cards) -->
    <!-- ======================================== -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Total Products -->
        <div class="stat-card glass rounded-3xl p-8 relative overflow-hidden gradient-card-1 neon-border">
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center shadow-xl shadow-cyan-500/40">
                        <i class="fas fa-mobile-alt text-white text-3xl"></i>
                    </div>
                    <span class="px-4 py-2 bg-emerald-500/20 text-emerald-400 text-xs font-bold rounded-full border border-emerald-500/30 font-rajdhani tracking-wider">
                        {{ $activeProducts ?? 0 }} AKTIF
                    </span>
                </div>
                <h3 class="font-orbitron text-5xl font-bold text-white mb-2 neon-text">{{ $totalProducts ?? 0 }}</h3>
                <p class="text-cyan-300/70 text-sm mb-6 font-rajdhani tracking-wider uppercase">Total Produk</p>
                <div class="pt-6 border-t border-cyan-500/20">
                    <p class="text-xs text-gray-400 font-rajdhani tracking-wide">
                        <i class="fas fa-arrow-down text-rose-400 mr-2"></i>
                        {{ $inactiveProducts ?? 0 }} tidak aktif
                    </p>
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="stat-card glass rounded-3xl p-8 relative overflow-hidden gradient-card-4 neon-border">
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-400 to-pink-600 flex items-center justify-center shadow-xl shadow-purple-500/40">
                        <i class="fas fa-tags text-white text-3xl"></i>
                    </div>
                </div>
                <h3 class="font-orbitron text-5xl font-bold text-white mb-2 neon-text-purple">{{ $totalCategories ?? 0 }}</h3>
                <p class="text-purple-300/70 text-sm mb-6 font-rajdhani tracking-wider uppercase">Kategori Brand</p>
                <div class="pt-6 border-t border-purple-500/20">
                    <p class="text-xs text-gray-400 font-rajdhani tracking-wide">
                        <i class="fas fa-check-circle text-emerald-400 mr-2"></i>
                        {{ $activeCategories ?? 0 }} brand aktif
                    </p>
                </div>
            </div>
        </div>

        <!-- Contacts -->
        <div class="stat-card glass rounded-3xl p-8 relative overflow-hidden gradient-card-2 neon-border">
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-pink-400 to-rose-600 flex items-center justify-center shadow-xl shadow-pink-500/40">
                        <i class="fas fa-envelope text-white text-3xl"></i>
                    </div>
                </div>
                <h3 class="font-orbitron text-5xl font-bold text-white mb-2" style="text-shadow: 0 0 20px rgba(255, 0, 110, 0.8);">{{ $totalContacts ?? 0 }}</h3>
                <p class="text-pink-300/70 text-sm mb-6 font-rajdhani tracking-wider uppercase">Pesan Pelanggan</p>
                <div class="pt-6 border-t border-pink-500/20">
                    <p class="text-xs text-gray-400 font-rajdhani tracking-wide">
                        <i class="fas fa-clock text-amber-400 mr-2"></i>
                        Perlu ditindaklanjuti
                    </p>
                </div>
            </div>
        </div>

        <!-- Inventory Value -->
        <div class="stat-card glass rounded-3xl p-8 relative overflow-hidden gradient-card-3 neon-border">
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-cyan-400 to-teal-600 flex items-center justify-center shadow-xl shadow-cyan-500/40">
                        <i class="fas fa-coins text-white text-3xl"></i>
                    </div>
                </div>
                <h3 class="font-orbitron text-2xl font-bold text-white mb-2 neon-text">Rp {{ number_format($inventoryValue ?? 0, 0, ',', '.') }}</h3>
                <p class="text-cyan-300/70 text-sm mb-6 font-rajdhani tracking-wider uppercase">Nilai Inventori</p>
                <div class="pt-6 border-t border-cyan-500/20">
                    <p class="text-xs text-gray-400 font-rajdhani tracking-wide">
                        <i class="fas fa-calculator text-cyan-400 mr-2"></i>
                        Avg: Rp {{ number_format($averagePrice ?? 0, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================================== -->
    <!-- CHARTS & TABLES -->
    <!-- ======================================== -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Products by Category Chart -->
        <div class="glass rounded-3xl p-8 neon-border">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="font-orbitron text-xl font-bold text-white tracking-wider">PRODUK PER KATEGORI</h3>
                    <p class="text-sm text-cyan-300/60 mt-2 font-rajdhani tracking-wide">Distribusi produk berdasarkan brand</p>
                </div>
                <span class="px-4 py-2 bg-cyan-500/20 text-cyan-400 text-xs font-bold rounded-full border border-cyan-500/30 font-rajdhani tracking-wider">
                    TOP 5
                </span>
            </div>
            <div class="relative" style="height: 320px;">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>

        <!-- Low Stock Alert -->
        <div class="glass rounded-3xl p-8 neon-border">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="font-orbitron text-xl font-bold text-white tracking-wider">STOK MENIPIS</h3>
                    <p class="text-sm text-cyan-300/60 mt-2 font-rajdhani tracking-wide">Produk dengan stok kurang dari 10 unit</p>
                </div>
                <span class="px-4 py-2 bg-rose-500/20 text-rose-400 text-xs font-bold rounded-full border border-rose-500/30 flex items-center gap-2 font-rajdhani tracking-wider">
                    <i class="fas fa-exclamation-triangle animate-pulse"></i>
                    ALERT
                </span>
            </div>
            <div class="space-y-4 max-h-[320px] overflow-y-auto pr-2">
                @forelse($lowStockProducts ?? [] as $product)
                <div class="group flex items-center gap-5 p-5 glass rounded-2xl hover:bg-rose-500/10 transition-all border border-white/5 hover:border-rose-500/40 neon-border">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-rose-500/20 to-pink-600/20 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform shadow-lg shadow-rose-500/20">
                        <i class="fas fa-box text-rose-400 text-2xl"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-sm font-bold text-white font-rajdhani tracking-wide truncate">{{ $product->name ?? $product->NAME ?? '-' }}</h4>
                        <p class="text-xs text-cyan-400/60 font-rajdhani">{{ $product->category->name ?? '-' }}</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-bold bg-rose-500/20 text-rose-400 border border-rose-500/30 font-rajdhani tracking-wider">
                            {{ $product->stock ?? $product->STOCK ?? 0 }} UNIT
                        </span>
                    </div>
                </div>
                @empty
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-emerald-500/20 to-green-600/20 flex items-center justify-center shadow-xl shadow-emerald-500/20">
                        <i class="fas fa-check-circle text-emerald-400 text-5xl"></i>
                    </div>
                    <p class="text-cyan-300/60 font-rajdhani text-lg tracking-wide">Semua stok aman</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- ======================================== -->
    <!-- LATEST PRODUCTS TABLE -->
    <!-- ======================================== -->
    <div class="glass rounded-3xl p-8 neon-border">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h3 class="font-orbitron text-xl font-bold text-white tracking-wider">PRODUK TERBARU</h3>
                <p class="text-sm text-cyan-300/60 mt-2 font-rajdhani tracking-wide">5 produk yang baru ditambahkan</p>
            </div>
            <button class="px-6 py-3 bg-cyan-500/10 hover:bg-cyan-500/20 text-cyan-400 rounded-xl transition-all text-sm font-bold font-rajdhani tracking-wider border border-cyan-500/30 btn-neon">
                LIHAT SEMUA
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-cyan-500/20">
                        <th class="text-left py-5 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Produk</th>
                        <th class="text-left py-5 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Kategori</th>
                        <th class="text-right py-5 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Harga</th>
                        <th class="text-center py-5 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Stok</th>
                        <th class="text-center py-5 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cyan-500/10">
                    @forelse($latestProducts ?? [] as $product)
                    <tr class="group hover:bg-cyan-500/5 transition-all">
                        <td class="py-5 px-6">
                            <div class="flex items-center gap-5">
                                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-cyan-500/20 to-purple-600/20 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform shadow-lg shadow-cyan-500/20">
                                    <i class="fas fa-mobile-alt text-cyan-400 text-2xl"></i>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-sm font-bold text-white font-rajdhani tracking-wide truncate">{{ $product->name ?? $product->NAME ?? '-' }}</h4>
                                    <p class="text-xs text-cyan-400/60 font-rajdhani">{{ $product->model ?? $product->MODEL ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-5 px-6">
                            <span class="px-4 py-2 bg-cyan-500/10 text-cyan-400 text-xs font-bold rounded-full border border-cyan-500/30 font-rajdhani tracking-wider">
                                {{ $product->category->name ?? '-' }}
                            </span>
                        </td>
                        <td class="py-5 px-6 text-right">
                            <span class="text-sm font-bold text-white font-orbitron tracking-wide">
                                Rp {{ number_format($product->price ?? $product->PRICE ?? 0, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="py-5 px-6 text-center">
                            @php
                                $stock = $product->stock ?? $product->STOCK ?? 0;
                            @endphp
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-bold {{ $stock > 0 ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : 'bg-rose-500/20 text-rose-400 border border-rose-500/30' }} font-rajdhani tracking-wider">
                                {{ $stock }}
                            </span>
                        </td>
                        <td class="py-5 px-6 text-center">
                            <button class="w-11 h-11 rounded-xl bg-cyan-500/10 hover:bg-cyan-500/20 text-cyan-400 transition-all flex items-center justify-center mx-auto border border-cyan-500/30 btn-neon">
                                <i class="fas fa-ellipsis-v text-xl"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-16 text-center">
                            <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-gray-500/20 to-gray-600/20 flex items-center justify-center">
                                <i class="fas fa-inbox text-gray-400 text-5xl"></i>
                            </div>
                            <p class="text-cyan-300/60 font-rajdhani text-lg tracking-wide">Belum ada produk</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ======================================== -->
    <!-- RECENT CONTACTS -->
    <!-- ======================================== -->
    <div class="glass rounded-3xl p-8 neon-border">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h3 class="font-orbitron text-xl font-bold text-white tracking-wider">PESAN TERBARU</h3>
                <p class="text-sm text-cyan-300/60 mt-2 font-rajdhani tracking-wide">Pesan dari pelanggan</p>
            </div>
            <button class="px-6 py-3 bg-cyan-500/10 hover:bg-cyan-500/20 text-cyan-400 rounded-xl transition-all text-sm font-bold font-rajdhani tracking-wider border border-cyan-500/30 btn-neon">
                LIHAT SEMUA
            </button>
        </div>
        <div class="space-y-4">
            @forelse($recentContacts ?? [] as $contact)
            <div class="group p-6 glass rounded-2xl hover:bg-cyan-500/5 transition-all border border-white/5 hover:border-cyan-500/40 cursor-pointer neon-border">
                <div class="flex items-start gap-5">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-cyan-400 via-blue-500 to-purple-600 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform shadow-xl shadow-cyan-500/30">
                        <span class="text-white font-bold text-xl font-orbitron">
                            {{ substr($contact->name ?? $contact->NAME ?? '?', 0, 1) }}
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-sm font-bold text-white font-rajdhani tracking-wide">{{ $contact->name ?? $contact->NAME ?? '-' }}</h4>
                            <span class="text-xs text-cyan-400/60 font-rajdhani">{{ $contact->created_at ?? $contact->CREATED_AT ?? '' }}</span>
                        </div>
                        <p class="text-xs text-cyan-400 mb-3 font-bold font-rajdhani tracking-wide">{{ $contact->subject ?? $contact->SUBJECT ?? '-' }}</p>
                        <p class="text-sm text-gray-400 line-clamp-2 font-rajdhani">{{ Str::limit($contact->message ?? $contact->MESSAGE ?? '', 100) }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <span class="w-4 h-4 bg-cyan-400 rounded-full animate-pulse shadow-lg shadow-cyan-400/50"></span>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-16">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-cyan-500/20 to-purple-600/20 flex items-center justify-center shadow-xl shadow-cyan-500/20">
                    <i class="fas fa-envelope-open text-cyan-400 text-5xl"></i>
                </div>
                <p class="text-cyan-300/60 font-rajdhani text-lg tracking-wide">Belum ada pesan dari pelanggan</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Chart.js - Products by Category dengan efek modern
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('categoryChart');
        if (ctx) {
            const categoryData = @json($productsByCategory ?? []);
            const labels = categoryData.map(item => item.name ?? item.NAME ?? 'Unknown');
            const data = categoryData.map(item => item.products_count ?? 0);

            const gradientCyan = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
            gradientCyan.addColorStop(0, 'rgba(0, 243, 255, 0.8)');
            gradientCyan.addColorStop(1, 'rgba(0, 243, 255, 0.2)');

            const gradientPurple = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
            gradientPurple.addColorStop(0, 'rgba(188, 19, 254, 0.8)');
            gradientPurple.addColorStop(1, 'rgba(188, 19, 254, 0.2)');

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: [
                            '#00f3ff',
                            '#bc13fe',
                            '#ff006e',
                            '#00fff9',
                            '#8b5cf6'
                        ],
                        borderWidth: 0,
                        hoverOffset: 20,
                        hoverBorderWidth: 4,
                        hoverBorderColor: '#fff',
                        shadowBlur: 20,
                        shadowColor: 'rgba(0, 243, 255, 0.5)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 25,
                                usePointStyle: true,
                                pointStyle: 'circle',
                                color: '#00f3ff',
                                font: {
                                    family: 'Rajdhani',
                                    size: 13,
                                    weight: '600'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(3, 0, 20, 0.95)',
                            titleColor: '#00f3ff',
                            bodyColor: '#e2e8f0',
                            borderColor: 'rgba(0, 243, 255, 0.5)',
                            borderWidth: 2,
                            padding: 15,
                            displayColors: true,
                            titleFont: {
                                family: 'Orbitron',
                                size: 14
                            },
                            bodyFont: {
                                family: 'Rajdhani',
                                size: 13
                            },
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + context.parsed + ' produk';
                                }
                            }
                        }
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true,
                        duration: 2000,
                        easing: 'easeOutQuart'
                    }
                }
            });
        }
    });
</script>
@endpush
@endsection