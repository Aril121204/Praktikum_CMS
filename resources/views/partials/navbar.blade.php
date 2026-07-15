<!-- STELLAR BACKGROUND: WEBGL SHADER START -->
<div class="fixed inset-0 -z-20 w-full h-full pointer-events-none">
    <canvas class="w-full h-full block" id="shader-canvas-stellar"></canvas>
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-background/10 to-background/80"></div>
</div>
<!-- STELLAR BACKGROUND END -->

<!-- NAVBAR START -->
<header class="fixed top-6 left-1/2 -translate-x-1/2 w-[calc(100%-48px)] max-w-container-max-width rounded-full bg-surface-container/20 backdrop-blur-[40px] border border-white/10 shadow-2xl flex justify-between items-center px-gutter py-4 z-50 transition-all duration-500">
    <!-- Logo -->
    <div class="font-h3 text-h3 tracking-tighter text-on-surface flex items-center gap-2">
        <img
            src="{{ isset($setting) && $setting->logo ? asset('storage/' . $setting->logo) : asset('logo/asiaphone.png') }}"
            alt="{{ isset($setting) && $setting->logo_text ? $setting->logo_text : 'ASIAPHONE' }}"
            class="w-12 h-12 object-contain">
        {{ isset($setting) && $setting->logo_text ? $setting->logo_text : 'ASIAPHONE' }}
    </div>
    
    <!-- Navigation Menu -->
    <nav class="hidden md:flex items-center gap-10">
        <a class="{{ request()->routeIs('home') ? 'font-body-md text-body-md text-primary font-bold transition-all hover:opacity-80': 'font-body-md text-body-md text-on-surface-variant hover:text-primary transition-all duration-300' }}" href="{{ route('home') }}">Beranda</a>
        <a class="{{ request()->routeIs('catalog*') ? 'font-body-md text-body-md text-primary font-bold transition-all hover:opacity-80': 'font-body-md text-body-md text-on-surface-variant hover:text-primary transition-all duration-300' }}" href="{{ route('catalog.index') }}">Katalog</a>
        <a class="{{ request()->routeIs('contact*') ? 'font-body-md text-body-md text-primary font-bold transition-all hover:opacity-80': 'font-body-md text-body-md text-on-surface-variant hover:text-primary transition-all duration-300' }}" href="{{ route('contact') }}">Kontak</a>
    </nav>
    
    <!-- Action Icons -->
    <div class="flex items-center gap-4">
        <!-- 🔍 SEARCH BUTTON -->
        <button
            id="searchToggleBtn"
            class="material-symbols-outlined text-primary hover:text-on-surface transition-colors cursor-pointer p-2 rounded-full hover:bg-white/5"
            title="Cari Produk">
            search
        </button>
        
        <!-- 🔐 ADMIN LOGIN BUTTON -->
        <a href="{{ route('admin.login') }}"
           class="group relative flex items-center gap-2 px-4 py-2 rounded-full overflow-hidden transition-all duration-300 hover:scale-105"
           title="Admin Login">
            
            <!-- Animated Background Glow -->
            <div class="absolute inset-0 bg-gradient-to-r from-primary/0 via-primary/20 to-primary/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            
            <!-- Border Animation -->
            <div class="absolute inset-0 rounded-full border border-primary/30 group-hover:border-primary/60 transition-colors duration-300"></div>
            
            <!-- Icon dengan animasi -->
            <span class="material-symbols-outlined text-primary group-hover:text-on-primary transition-colors duration-300 text-xl relative z-10"
                  style="font-variation-settings: 'FILL' 1;">
                shield_person
            </span>
            
            <!-- Text Label (hidden di mobile, muncul di desktop) -->
            <span class="hidden lg:block text-sm font-semibold text-primary group-hover:text-on-primary transition-colors duration-300 relative z-10">
                Admin
            </span>
            
            <!-- Pulse Effect -->
            <span class="absolute -top-1 -right-1 w-3 h-3 bg-primary rounded-full opacity-75 animate-ping"></span>
            <span class="absolute -top-1 -right-1 w-3 h-3 bg-primary rounded-full"></span>
        </a>
    </div>
</header>
<!-- NAVBAR END -->

<!-- 🔍 SEARCH MODAL OVERLAY -->
<div id="searchModal" class="fixed inset-0 z-[100] hidden">
    <!-- Backdrop -->
    <div id="searchBackdrop" class="absolute inset-0 bg-black/80 backdrop-blur-md transition-opacity duration-300 opacity-0"></div>
    
    <!-- Modal Content -->
    <div class="relative min-h-screen flex items-start justify-center pt-32 px-4">
        <div id="searchModalContent" class="w-full max-w-3xl transform transition-all duration-500 scale-95 opacity-0">
            <!-- Search Box -->
            <div class="glass-panel rounded-3xl overflow-hidden shadow-2xl border border-white/20">
                <!-- Search Header -->
                <div class="p-6 border-b border-white/10 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-2xl">search</span>
                        <h3 class="text-xl font-bold text-on-surface">Cari Produk atau Brand</h3>
                    </div>
                    <button
                        id="searchCloseBtn"
                        class="w-10 h-10 rounded-full bg-white/5 hover:bg-white/10 flex items-center justify-center transition-all group">
                        <span class="material-symbols-outlined text-on-surface-variant group-hover:text-on-surface">close</span>
                    </button>
                </div>
                
                <!-- Search Form -->
                <form action="{{ route('search') }}" method="GET" id="searchForm">
                    <div class="p-6">
                        <div class="relative">
                            <input
                                type="text"
                                name="q"
                                id="searchInput"
                                placeholder="Ketik nama brand (Samsung, Apple, Xiaomi, dll)..."
                                autocomplete="off"
                                class="w-full bg-surface-container-highest/30 border border-outline-variant/20 rounded-2xl py-5 pl-14 pr-6 text-on-surface text-lg focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all placeholder:text-on-surface-variant/40">
                            <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-on-surface-variant/60 text-2xl">
                                search
                            </span>
                            <!-- Clear Button -->
                            <button
                                type="button"
                                id="searchClearBtn"
                                class="absolute right-5 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white/5 hover:bg-white/10 flex items-center justify-center transition-all hidden">
                                <span class="material-symbols-outlined text-on-surface-variant text-sm">close</span>
                            </button>
                        </div>
                        
                        <!-- Quick Suggestions -->
                        <div class="mt-6">
                            <p class="text-xs text-on-surface-variant uppercase tracking-wider mb-3 font-semibold">Brand Populer</p>
                            <div class="flex flex-wrap gap-2" id="brandSuggestions">
                                <!-- Akan diisi oleh JavaScript -->
                            </div>
                        </div>
                    </div>
                    
                    <!-- Search Footer -->
                    <div class="p-4 bg-surface-container/50 border-t border-white/10 flex items-center justify-between">
                        <p class="text-xs text-on-surface-variant">
                            Tekan <kbd class="px-2 py-1 bg-white/10 rounded text-on-surface font-mono">Enter</kbd> untuk mencari
                        </p>
                        <button
                            type="submit"
                            class="px-6 py-2.5 bg-primary text-on-primary rounded-xl font-semibold hover:opacity-90 transition-opacity flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">search</span>
                            Cari
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Helper Text -->
            <p class="text-center text-sm text-on-surface-variant mt-6">
                💡 Tips: Ketik nama brand seperti "Samsung", "Apple", "Xiaomi" untuk langsung ke halaman kategori
            </p>
        </div>
    </div>
</div>

<!-- 🔍 SEARCH MODAL JAVASCRIPT -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elements
        const searchToggleBtn = document.getElementById('searchToggleBtn');
        const searchModal = document.getElementById('searchModal');
        const searchBackdrop = document.getElementById('searchBackdrop');
        const searchModalContent = document.getElementById('searchModalContent');
        const searchCloseBtn = document.getElementById('searchCloseBtn');
        const searchInput = document.getElementById('searchInput');
        const searchClearBtn = document.getElementById('searchClearBtn');
        const searchForm = document.getElementById('searchForm');
        const brandSuggestions = document.getElementById('brandSuggestions');
        
        // ✅ FIX: Ambil brands dari database (dinamis)
        const brands = @json(
            \App\Models\Category::where('is_active', 'Y')
                ->orderBy('sort_order')
                ->get()
                ->map(fn($c) => ['name' => $c->name, 'slug' => $c->slug])
                ->values()
        );

        // Populate brand suggestions
        function populateBrandSuggestions() {
            brandSuggestions.innerHTML = brands.map(brand => `
                <button 
                    type="button"
                    class="brand-suggestion-btn px-4 py-2 bg-white/5 hover:bg-primary hover:text-on-primary border border-white/10 rounded-full text-sm text-on-surface transition-all"
                    data-brand="${brand.name}"
                    data-slug="${brand.slug}">
                    ${brand.name}
                </button>
            `).join('');

            document.querySelectorAll('.brand-suggestion-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const brandSlug = this.dataset.slug;
                    window.location.href = `/category/${brandSlug}`;
                });
            });
        }

        // Handle form submission
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const keyword = searchInput.value.trim();
            if (keyword.length === 0) {
                searchInput.focus();
                return;
            }
            const matchedBrand = brands.find(brand =>
                brand.name.toLowerCase().includes(keyword.toLowerCase())
            );
            if (matchedBrand) {
                window.location.href = `/category/${matchedBrand.slug}`;
            } else {
                window.location.href = `/catalog?search=${encodeURIComponent(keyword)}`;
            }
        });

        // Open modal
        function openSearchModal() {
            searchModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                searchBackdrop.classList.remove('opacity-0');
                searchBackdrop.classList.add('opacity-100');
                searchModalContent.classList.remove('scale-95', 'opacity-0');
                searchModalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
            setTimeout(() => { searchInput.focus(); }, 300);
        }

        // Close modal
        function closeSearchModal() {
            searchBackdrop.classList.remove('opacity-100');
            searchBackdrop.classList.add('opacity-0');
            searchModalContent.classList.remove('scale-100', 'opacity-100');
            searchModalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                searchModal.classList.add('hidden');
                document.body.style.overflow = '';
                searchInput.value = '';
                searchClearBtn.classList.add('hidden');
            }, 300);
        }

        // Event Listeners
        searchToggleBtn.addEventListener('click', openSearchModal);
        searchCloseBtn.addEventListener('click', closeSearchModal);
        searchBackdrop.addEventListener('click', closeSearchModal);

        searchInput.addEventListener('input', function() {
            if (this.value.length > 0) {
                searchClearBtn.classList.remove('hidden');
            } else {
                searchClearBtn.classList.add('hidden');
            }
        });

        searchClearBtn.addEventListener('click', function() {
            searchInput.value = '';
            this.classList.add('hidden');
            searchInput.focus();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !searchModal.classList.contains('hidden')) {
                closeSearchModal();
            }
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                if (searchModal.classList.contains('hidden')) {
                    openSearchModal();
                } else {
                    closeSearchModal();
                }
            }
        });

        populateBrandSuggestions();
    });
</script>

<!-- Glass panel style untuk search modal -->
<style>
    #searchModal .glass-panel {
        background: rgba(20, 19, 19, 0.95);
        backdrop-filter: blur(40px);
        -webkit-backdrop-filter: blur(40px);
    }
</style>