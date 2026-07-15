
<?php $__env->startSection('content'); ?>
<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
    .glass-panel {
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.1);
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(185, 199, 228, 0.2);
        border-radius: 10px;
    }
    .catalog-page {
        background: #08090a;
        color: #e4e2e4;
    }
    #bg-canvas {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
        pointer-events: none;
        opacity: 0.6;
    }
    .content-overlay {
        position: relative;
        z-index: 10;
    }
    /* Accordion transition */
    .accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out, opacity 0.2s ease;
        opacity: 0;
    }
    .accordion-content.active {
        max-height: 800px;
        opacity: 1;
    }
    .rotate-icon {
        transition: transform 0.3s ease;
    }
    .rotate-icon.active {
        transform: rotate(180deg);
    }
</style>
<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                "colors": {
                    "primary": "#b9c7e4",
                    "surface-container-lowest": "#0e0e10",
                    "on-primary-fixed-variant": "#39475f",
                    "on-tertiary-fixed-variant": "#38485d",
                    "on-tertiary-container": "#73839b",
                    "surface-dim": "#131315",
                    "on-secondary-container": "#afb6bd",
                    "surface-container-highest": "#343536",
                    "background": "#131315",
                    "on-tertiary": "#213145",
                    "primary-container": "#0a192f",
                    "outline": "#8f9097",
                    "inverse-primary": "#515f78",
                    "surface": "#131315",
                    "surface-container-high": "#2a2a2c",
                    "secondary-fixed": "#dde3eb",
                    "on-surface-variant": "#c5c6cd",
                    "on-secondary": "#2b3137",
                    "on-background": "#e4e2e4",
                    "surface-container-low": "#1b1b1d",
                    "secondary-container": "#41474e",
                    "on-tertiary-fixed": "#0b1c30",
                    "on-error-container": "#ffdad6",
                    "error": "#ffb4ab",
                    "inverse-on-surface": "#303032",
                    "on-primary-container": "#74829d",
                    "tertiary-container": "#081a2d",
                    "tertiary": "#b7c8e1",
                    "surface-container": "#1f1f21",
                    "secondary-fixed-dim": "#c1c7cf",
                    "primary-fixed": "#d6e3ff",
                    "primary-fixed-dim": "#b9c7e4",
                    "tertiary-fixed": "#d3e4fe",
                    "on-primary-fixed": "#0d1c32",
                    "outline-variant": "#44474d",
                    "on-secondary-fixed": "#161c22",
                    "on-primary": "#233148",
                    "surface-variant": "#343536",
                    "on-secondary-fixed-variant": "#41474e",
                    "on-error": "#690005",
                    "secondary": "#c1c7cf",
                    "tertiary-fixed-dim": "#b7c8e1",
                    "surface-bright": "#39393b",
                    "error-container": "#93000a",
                    "surface-tint": "#b9c7e4",
                    "on-surface": "#e4e2e4",
                    "inverse-surface": "#e4e2e4"
                },
                "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
                },
                "spacing": {
                    "margin-mobile": "16px",
                    "md": "24px",
                    "xs": "4px",
                    "margin-desktop": "64px",
                    "base": "8px",
                    "container-max": "1440px",
                    "lg": "48px",
                    "sm": "12px",
                    "xl": "80px",
                    "gutter": "24px"
                },
                "fontFamily": {
                    "headline-lg": ["Inter"],
                    "label-sm": ["Inter"],
                    "headline-md": ["Inter"],
                    "body-lg": ["Inter"],
                    "display-sm": ["Inter"],
                    "display-lg": ["Inter"],
                    "body-md": ["Inter"],
                    "label-md": ["Inter"]
                },
                "fontSize": {
                    "headline-lg": ["32px", {
                        "lineHeight": "1.25",
                        "letterSpacing": "-0.01em",
                        "fontWeight": "600"
                    }],
                    "label-sm": ["12px", {
                        "lineHeight": "1.2",
                        "fontWeight": "500"
                    }],
                    "headline-md": ["24px", {
                        "lineHeight": "1.4",
                        "fontWeight": "600"
                    }],
                    "body-lg": ["18px", {
                        "lineHeight": "1.6",
                        "fontWeight": "400"
                    }],
                    "display-sm": ["40px", {
                        "lineHeight": "1.2",
                        "letterSpacing": "-0.02em",
                        "fontWeight": "700"
                    }],
                    "display-lg": ["64px", {
                        "lineHeight": "1.1",
                        "letterSpacing": "-0.02em",
                        "fontWeight": "700"
                    }],
                    "body-md": ["16px", {
                        "lineHeight": "1.6",
                        "fontWeight": "400"
                    }],
                    "label-md": ["14px", {
                        "lineHeight": "1.2",
                        "letterSpacing": "0.05em",
                        "fontWeight": "600"
                    }]
                }
            },
        },
    }
</script>
<div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
    <div class="absolute inset-0 bg-gradient-to-b from-surface/80 via-surface/60 to-surface z-10"></div>
    <img alt="Futuristic technology background" class="w-full h-full object-cover scale-110 transition-transform duration-700 opacity-60" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC9L0HDfIzDi4egRefGZbJFl1sIH-8d8oOogvGyZ1wVp8eEUEwnJqrF7-3BuMan7itt9OB1bydBacKN6i_9ENUig6Qs0gHa14rXm4NjK_fvW1gOy9V8R7Vh9XpJqf6S1ck4trKs4Yns17KGEqmp5Kno0OmePA55wsvzhAQGAXbtXjt2mIUjYQROgbtpHIKrhC0fwflMKrgo3jTW_XKoe0kI7v5OOrRZ-GSzRVfHSaqfL_se5oHI_0VHbTKUM05DSQIATKe1QgjSS3E" style="transform: translateZ(0); background-attachment: fixed; background-position: center; background-size: cover;">
</div>
<div class="max-w-container-max-width mx-auto flex pt-24 relative z-10 items-start gap-6 w-full px-6">
    <aside class="w-72 flex-shrink-0 glass-panel bg-surface/30 border border-secondary-container/10 rounded-3xl shadow-xl hidden lg:flex flex-col py-8 px-6 overflow-y-auto custom-scrollbar sticky" style="max-height: calc(100vh - 120px); top: 100px;">
        <div class="flex items-center gap-2 mb-8 px-2">
            <span class="material-symbols-outlined text-primary">filter_list</span>
            <h3 class="text-headline-md font-bold text-on-surface">Filter Produk</h3>
        </div>
        <form action="<?php echo e(route('catalog.index')); ?>" method="GET">
            <nav class="space-y-6">
                <div>
                    <button type="button" class="flex items-center justify-between w-full" onclick="toggleAccordion('filter-brands','brands-icon', event)">
                        <span>Merek</span>
                        <span class="material-symbols-outlined text-[18px] rotate-icon active" id="brands-icon">expand_more</span>
                    </button>
                    <ul class="space-y-2 accordion-content active" id="filter-brands">
                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="flex items-center gap-3 group cursor-pointer px-2">
                            <input type="radio" name="brand" value="<?php echo e($item); ?>" <?php echo e(request('brand') == $item ? 'checked' : ''); ?> class="w-4 h-4 rounded border-outline-variant bg-surface-variant text-primary">
                            <label class="text-label-md text-on-surface-variant"> <?php echo e($item); ?> </label>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div>
                    <button type="button" class="flex items-center justify-between w-full" onclick="toggleAccordion('filter-price','price-icon', event)">
                        <span>Rentang Harga</span>
                        <span class="material-symbols-outlined text-[18px] rotate-icon active" id="price-icon">expand_more</span>
                    </button>
                    <div class="accordion-content active px-2 space-y-4" id="filter-price">
                        <div class="space-y-3">
                            <input type="number" name="min_price" value="<?php echo e(request('min_price')); ?>" placeholder="Harga Minimum" class="w-full bg-surface-container/50 border border-outline-variant/30 rounded-lg py-2 px-3">
                            <input type="number" name="max_price" value="<?php echo e(request('max_price')); ?>" placeholder="Harga Maksimum" class="w-full bg-surface-container/50 border border-outline-variant/30 rounded-lg py-2 px-3">
                        </div>
                    </div>
                </div>
                <div>
                    <button type="button" class="flex items-center justify-between w-full" onclick="toggleAccordion('filter-ram','ram-icon', event)">
                        <span>RAM</span>
                        <span class="material-symbols-outlined text-[18px] rotate-icon" id="ram-icon">expand_more</span>
                    </button>
                    <ul class="space-y-2 accordion-content px-2" id="filter-ram">
                        <?php $__currentLoopData = $rams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ram): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="flex items-center gap-3">
                            <input type="checkbox" name="ram[]" value="<?php echo e($ram); ?>" <?php echo e(is_array(request('ram')) && in_array($ram,request('ram')) ? 'checked' : ''); ?>>
                            <label> <?php echo e($ram); ?> </label>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div>
                    <button type="button" class="flex items-center justify-between w-full" onclick="toggleAccordion('filter-storage','storage-icon', event)">
                        <span>Penyimpanan</span>
                        <span class="material-symbols-outlined text-[18px] rotate-icon" id="storage-icon">expand_more</span>
                    </button>
                    <ul class="space-y-2 accordion-content px-2" id="filter-storage">
                        <?php $__currentLoopData = $storages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $storage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="flex items-center gap-3">
                            <input type="checkbox" name="storage[]" value="<?php echo e($storage); ?>" <?php echo e(is_array(request('storage')) && in_array($storage, request('storage')) ? 'checked' : ''); ?>>
                            <span> <?php echo e($storage); ?> </span>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </nav>
            <div class="mt-auto pt-6 border-t border-white/5 flex flex-col gap-3">
                <div>
                    <button type="submit" class="w-full py-3 bg-primary text-on-primary rounded-xl mb-2"> Terapkan Filter </button>
                    <a href="<?php echo e(route('catalog.index')); ?>" class="w-full block text-center py-3 border border-outline-variant/30 rounded-xl"> Reset Filter </a>
                </div>
            </div>
        </form>
    </aside>
    <div class="flex-1 flex flex-col">
        <main class="pb-16 w-full space-y-xl">
            
            <section class="w-full mt-8 rounded-3xl overflow-hidden relative h-[450px] group border border-secondary-container/10">
                <div class="absolute inset-0 bg-gradient-to-r from-surface-container-lowest via-surface-container-lowest/80 to-transparent z-10"></div>
                <div class="absolute inset-0 z-0">
                    <?php if(isset($setting) && $setting->catalog_banner): ?>
                        <img alt="Catalog Banner" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                             src="<?php echo e(asset('storage/' . $setting->catalog_banner)); ?>" />
                    <?php else: ?>
                        <img alt="A futuristic, high-end smartphone floating in a dark cosmic environment." class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDl04dA4OQahNRgIvcdAU8ltSgOtZ_nE6TLwxP93-SfQzthfcNUGFa7eitqMVT5VJhD5ewfSlcFbBSVBbOTlbYsRFT_KQwVbn7Yge4igSnY1j-TpN1J3rfxGy5maMYwF1lcHtskXrzBwgrqFj5raNBhfND86HZRr0Vjr_UV6EtUEmQT00PeYiQqs4jKG_eXvHfQvUgFEJSXGVb0bv-iCvYvvxKNEYb5Lxaf-bYfrhS19vGWL4eTi_hCrnMffOlf_PgRMkxwrpOUwfE">
                    <?php endif; ?>
                </div>
                <div class="relative z-20 h-full flex flex-col justify-center px-8 md:px-16 max-w-2xl space-y-6">
                    <span class="inline-block px-4 py-1.5 bg-primary/20 text-primary text-label-sm font-label-sm rounded-full backdrop-blur-md border border-primary/20 w-max">NEW ARRIVAL</span>
                    <h2 class="text-display-sm font-display-sm text-on-surface leading-tight"><?php echo e(isset($setting) && $setting->catalog_title ? $setting->catalog_title : 'Galaxy S24 Ultra'); ?></h2>
                    <p class="text-body-lg text-on-surface-variant leading-relaxed"><?php echo e(isset($setting) && $setting->catalog_description ? $setting->catalog_description : 'Experience the pinnacle of mobile engineering with titanium durability and revolutionary AI performance.'); ?></p>
                    <div class="flex flex-wrap gap-4 pt-4">
                        <button class="px-8 md:px-10 py-4 bg-primary text-on-primary font-label-md rounded-full hover:shadow-[0_0_30px_rgba(185,199,228,0.5)] transition-all active:scale-95">Explore Specs</button>
                        <button class="px-8 md:px-10 py-4 border border-outline-variant text-on-surface font-label-md rounded-full hover:bg-white/5 transition-all active:scale-95">Watch Teaser</button>
                    </div>
                </div>
            </section>
            
            <section class="mt-12">
                <form action="<?php echo e(route('catalog.index')); ?>" method="GET">
                    <div class="glass-panel bg-surface-container-low/40 border border-secondary-container/10 rounded-3xl p-6 flex flex-col md:flex-row items-center gap-6">
                        <div class="relative flex-1 w-full">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant/60"> search </span>
                            <input name="search" value="<?php echo e(request('search')); ?>" class="w-full bg-surface-container-highest/30 border border-outline-variant/20 rounded-2xl py-4 pl-12 pr-6 text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all placeholder:text-on-surface-variant/40" placeholder="Cari model smartphone, merek, atau spesifikasi..." type="text">
                        </div>
                        <div class="flex items-center gap-4">
                            <select name="sort" class="px-4 py-4 rounded-xl bg-surface-container-highest/30 border border-outline-variant/20 text-on-surface bg-surface">
                                <option value="">Urutkan</option>
                                <option value="name" <?php echo e(request('sort')=='name'?'selected':''); ?>> Nama </option>
                                <option value="price_low" <?php echo e(request('sort')=='price_low'?'selected':''); ?>> Harga Terendah </option>
                                <option value="price_high" <?php echo e(request('sort')=='price_high'?'selected':''); ?>> Harga Tertinggi </option>
                            </select>
                            <button type="submit" class="px-6 py-4 bg-primary text-on-primary rounded-2xl"> Cari </button>
                        </div>
                    </div>
                </form>
            </section>
            <section class="scroll-mt-32" id="semua-produk">
                <div class="flex flex-col md:flex-row items-start md:items-end justify-between mb-10 gap-4">
                    <div>
                        <div class="flex items-center gap-2 text-primary mb-2">
                            <span class="material-symbols-outlined">grid_view</span>
                            <span class="text-label-sm font-label-sm uppercase tracking-[0.2em] font-bold">Product Catalog</span>
                        </div>
                        <h2 class="text-headline-lg font-headline-lg text-on-surface">Semua Produk</h2>
                    </div>
                    <p class="text-label-md text-on-surface-variant">
                        Menampilkan <strong><?php echo e($products->firstItem()); ?></strong> - <strong><?php echo e($products->lastItem()); ?></strong> dari <strong><?php echo e($products->total()); ?></strong> produk
                    </p>
                </div>
                <div class="grid w-full grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="group relative bg-surface-container-low/40 border border-secondary-container/10 rounded-3xl hover:border-primary/30 transition-all duration-300 glass-panel p-8 md:p-10">
                        <div class="relative rounded-2xl overflow-hidden mb-6 bg-surface-container/50 h-96">
                            <img src="<?php echo e(asset('product/'.$product->brand.'/'.$product->image)); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-full object-contain p-2 group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between items-start">
                                <h3 class="text-headline-md font-bold text-on-surface"> <?php echo e($product->name); ?> </h3>
                                <button class="w-10 h-10 rounded-full border border-primary/30 flex items-center justify-center text-primary hover:bg-primary hover:text-on-primary transition-all active:scale-90">
                                    <span class="material-symbols-outlined text-[20px]"> visibility </span>
                                </button>
                            </div>
                            <div class="flex items-center gap-2 text-label-sm font-label-sm text-on-surface-variant">
                                <span class="px-2 py-1 bg-surface-variant rounded-md"> <?php echo e($product->brand); ?> </span>
                                <span class="px-2 py-1 bg-surface-variant rounded-md"><?php echo e(optional($product->spec)->ram); ?> </span>
                                <span class="px-2 py-1 bg-surface-variant rounded-md"><?php echo e(optional($product->spec)->storage); ?></span>
                            </div>
                            <div class="pt-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-t border-outline-variant/10">
                                <div class="text-md font-bold text-primary">Rp <?php echo e(number_format($product->price,0,',','.')); ?></div>
                                <a href="<?php echo e(route('catalog.detail',$product->slug)); ?>" class="px-4 py-2.5 bg-white/5 hover:bg-white/10 rounded-xl transition-all font-label-md border border-outline-variant/20 whitespace-nowrap"> Detail </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-3 text-center py-20">
                        <h2 class="text-2xl font-bold text-on-surface-variant"> Produk belum tersedia. </h2>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if($products->hasPages()): ?>
                <div class="mt-16 flex items-center justify-center gap-3">
                    
                    <?php if($products->onFirstPage()): ?>
                    <span class="w-12 h-12 flex items-center justify-center rounded-xl glass-panel bg-white/5 border border-outline-variant/20 text-on-surface-variant opacity-30 cursor-not-allowed">
                        <span class="material-symbols-outlined"> chevron_left </span>
                    </span>
                    <?php else: ?>
                    <a href="<?php echo e($products->previousPageUrl()); ?>" class="w-12 h-12 flex items-center justify-center rounded-xl glass-panel bg-white/5 border border-outline-variant/20 text-on-surface-variant hover:bg-primary hover:text-on-primary transition-all">
                        <span class="material-symbols-outlined"> chevron_left </span>
                    </a>
                    <?php endif; ?>
                    
                    <?php for($page=1;$page<=$products->lastPage();$page++): ?>
                    <?php if($page==$products->currentPage()): ?>
                    <span class="w-12 h-12 flex items-center justify-center rounded-xl bg-primary text-on-primary font-bold"> <?php echo e($page); ?> </span>
                    <?php else: ?>
                    <a href="<?php echo e($products->url($page)); ?>" class="w-12 h-12 flex items-center justify-center rounded-xl glass-panel bg-white/5 border border-outline-variant/20 text-on-surface-variant hover:bg-white/10 transition-all"> <?php echo e($page); ?> </a>
                    <?php endif; ?>
                    <?php endfor; ?>
                    
                    <?php if($products->hasMorePages()): ?>
                    <a href="<?php echo e($products->nextPageUrl()); ?>" class="w-12 h-12 flex items-center justify-center rounded-xl glass-panel bg-white/5 border border-outline-variant/20 text-on-surface-variant hover:bg-primary hover:text-on-primary transition-all">
                        <span class="material-symbols-outlined"> chevron_right </span>
                    </a>
                    <?php else: ?>
                    <span class="w-12 h-12 flex items-center justify-center rounded-xl glass-panel bg-white/5 border border-outline-variant/20 text-on-surface-variant opacity-30">
                        <span class="material-symbols-outlined"> chevron_right </span>
                    </span>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </section>
        </main>
    </div>
</div>
<canvas class="fixed inset-0 z-0" height="2861" id="bg-canvas" width="1280"></canvas>
<script>
    // Accordion Logic 
    function toggleAccordion(menuId, iconId, event) {
        if (event) {
            event.preventDefault();
        }
        const menu = document.getElementById(menuId);
        const icon = document.getElementById(iconId);
        if (menu && icon) {
            menu.classList.toggle("active");
            icon.classList.toggle("active");
        }
    }
    // Smooth scrolling for navigation links 
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
    // Hover animation for product cards 
    const cards = document.querySelectorAll('.glass-panel');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            if (!card.closest('header') && !card.closest('footer') && !card.closest('aside')) {
                card.style.transform = 'translateY(-8px)';
                card.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
            }
        });
        card.addEventListener('mouseleave', () => {
            if (!card.closest('header') && !card.closest('footer') && !card.closest('aside')) {
                card.style.transform = 'translateY(0)';
            }
        });
    });
    // High-Definition Tech Background Animation 
    const canvas = document.getElementById('bg-canvas');
    const ctx = canvas.getContext('2d');
    let width, height, particles = [];
    function init() {
        width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;
        particles = [];
        for (let i = 0; i < 80; i++) {
            particles.push({
                x: Math.random() * width,
                y: Math.random() * height,
                vx: (Math.random() - 0.5) * 0.4,
                vy: (Math.random() - 0.5) * 0.4,
                size: Math.random() * 2 + 1
            });
        }
    }
    function draw() {
        const gradient = ctx.createRadialGradient(width / 2, height / 2, 0, width / 2, height / 2, width);
        gradient.addColorStop(0, '#0d1117');
        gradient.addColorStop(1, '#050608');
        ctx.fillStyle = gradient;
        ctx.fillRect(0, 0, width, height);
        ctx.strokeStyle = 'rgba(185, 199, 228, 0.03)';
        ctx.lineWidth = 1;
        const gridSize = 100;
        for (let x = 0; x < width; x += gridSize) {
            ctx.beginPath();
            ctx.moveTo(x, 0);
            ctx.lineTo(x, height);
            ctx.stroke();
        }
        for (let y = 0; y < height; y += gridSize) {
            ctx.beginPath();
            ctx.moveTo(0, y);
            ctx.lineTo(width, y);
            ctx.stroke();
        }
        particles.forEach((p, index) => {
            p.x += p.vx;
            p.y += p.vy;
            if (p.x < 0 || p.x > width) p.vx *= -1;
            if (p.y < 0 || p.y > height) p.vy *= -1;
            ctx.fillStyle = 'rgba(185, 199, 228, 0.3)';
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
            ctx.fill();
            for (let j = index + 1; j < particles.length; j++) {
                const p2 = particles[j];
                const dx = p.x - p2.x;
                const dy = p.y - p2.y;
                const dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < 200) {
                    ctx.strokeStyle = `rgba(185, 199, 228, ${0.15 * (1 - dist / 200)})`;
                    ctx.lineWidth = 0.5;
                    ctx.beginPath();
                    ctx.moveTo(p.x, p.y);
                    ctx.lineTo(p2.x, p2.y);
                    ctx.stroke();
                }
            }
        });
        requestAnimationFrame(draw);
    }
    window.addEventListener('resize', init);
    init();
    draw();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Praktikum_CMS\resources\views/catalog/index.blade.php ENDPATH**/ ?>