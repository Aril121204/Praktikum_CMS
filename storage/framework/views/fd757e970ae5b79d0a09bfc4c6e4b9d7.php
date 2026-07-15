

<?php $__env->startSection('title', $category->name . ' - ASIAPHONE'); ?>

<?php $__env->startSection('content'); ?>

<style>
    .category-hero {
        background: linear-gradient(135deg, rgba(200, 198, 200, 0.05) 0%, rgba(200, 198, 200, 0.01) 100%);
        backdrop-filter: blur(40px);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }
    
    .brand-glow {
        text-shadow: 0 0 40px rgba(200, 198, 200, 0.3);
    }
    
    .stat-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        transition: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);
    }
    
    .stat-card:hover {
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(200, 198, 200, 0.3);
        transform: translateY(-4px);
    }
</style>

<!-- MAIN CONTENT START -->
<main class="max-w-container-max-width mx-auto px-margin-mobile md:px-margin-desktop pt-40 pb-32">

    
    <nav class="mb-8">
        <ol class="flex items-center gap-2 text-sm flex-wrap">
            <li>
                <a href="<?php echo e(route('home')); ?>" class="text-on-surface-variant hover:text-primary transition-colors">
                    Beranda
                </a>
            </li>
            <li class="text-on-surface-variant/50">
                <span class="material-symbols-outlined text-xs">chevron_right</span>
            </li>
            <li>
                <a href="<?php echo e(route('catalog.index')); ?>" class="text-on-surface-variant hover:text-primary transition-colors">
                    Katalog
                </a>
            </li>
            <li class="text-on-surface-variant/50">
                <span class="material-symbols-outlined text-xs">chevron_right</span>
            </li>
            <li class="text-primary font-semibold"><?php echo e($category->name); ?></li>
        </ol>
    </nav>

    
    <section class="category-hero rounded-3xl p-12 md:p-16 mb-12 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl -z-10"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl -z-10"></div>
        
        <div class="relative z-10">
            <span class="font-label-caps text-label-caps text-primary uppercase tracking-[0.4em] inline-block mb-4">
                Brand Collection
            </span>
            
            <h1 class="font-h1 text-h1-mobile md:text-h1 text-on-surface leading-tight brand-glow mb-6">
                <?php echo e($category->name); ?>

            </h1>
            
            <?php if($category->description): ?>
                <p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl leading-relaxed mb-8">
                    <?php echo e($category->description); ?>

                </p>
            <?php else: ?>
                <p class="font-body-lg text-body-lg text-on-surface-variant max-w-3xl leading-relaxed mb-8">
                    Temukan koleksi lengkap produk <?php echo e($category->name); ?> dengan spesifikasi terbaik dan harga eksklusif.
                </p>
            <?php endif; ?>

            
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-10">
                <div class="stat-card rounded-2xl p-6">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">inventory_2</span>
                        </div>
                        <span class="text-xs font-label-caps uppercase tracking-wider text-on-surface-variant">Total Produk</span>
                    </div>
                    <p class="font-h2 text-h2 text-on-surface font-bold"><?php echo e($totalProducts); ?></p>
                </div>
                
                <div class="stat-card rounded-2xl p-6">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-xl bg-yellow-500/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-yellow-400">star</span>
                        </div>
                        <span class="text-xs font-label-caps uppercase tracking-wider text-on-surface-variant">Featured</span>
                    </div>
                    <p class="font-h2 text-h2 text-on-surface font-bold"><?php echo e($featuredCount); ?></p>
                </div>
                
                <div class="stat-card rounded-2xl p-6 col-span-2 md:col-span-1">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-emerald-400">verified</span>
                        </div>
                        <span class="text-xs font-label-caps uppercase tracking-wider text-on-surface-variant">Status</span>
                    </div>
                    <p class="font-h3 text-h3 text-emerald-400 font-bold">Authorized</p>
                </div>
            </div>
        </div>
    </section>

    
    <section class="mb-16">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-4">
            <div>
                <span class="font-label-caps text-label-caps text-primary tracking-widest uppercase mb-2 block">
                    Product List
                </span>
                <h2 class="font-h2 text-h2 text-on-surface">
                    Semua Produk <?php echo e($category->name); ?>

                </h2>
            </div>
            <p class="text-label-md text-on-surface-variant">
                Menampilkan <strong class="text-primary"><?php echo e($products->count()); ?></strong> dari <strong class="text-primary"><?php echo e($totalProducts); ?></strong> produk
            </p>
        </div>

        <?php if($products->count() > 0): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-gutter">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="glass-panel rounded-2xl overflow-hidden group transition-all duration-500">
                        
                        <div class="aspect-[4/3] overflow-hidden relative bg-surface-container/50">
                            <img 
                                class="w-full h-full object-contain p-6 transition-transform duration-500 group-hover:scale-110"
                                src="<?php echo e($product->image_path); ?>"
                                alt="<?php echo e($product->name); ?>"
                                onerror="this.src='<?php echo e(asset('Images/no-image.png')); ?>'"
                            />
                            
                            
                            <div class="absolute top-4 left-4 flex flex-col gap-2">
                                <?php if($product->is_featured === 'Y'): ?>
                                    <span class="px-3 py-1 bg-yellow-500 text-black rounded-full text-xs font-bold uppercase flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">star</span>
                                        Featured
                                    </span>
                                <?php endif; ?>
                                <?php if($product->is_hot_deal === 'Y'): ?>
                                    <span class="px-3 py-1 bg-error text-on-error rounded-full text-xs font-bold uppercase flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">local_fire_department</span>
                                        Hot Deal
                                    </span>
                                <?php endif; ?>
                                <?php if($product->is_gaming === 'Y'): ?>
                                    <span class="px-3 py-1 bg-purple-500 text-white rounded-full text-xs font-bold uppercase flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">sports_esports</span>
                                        Gaming
                                    </span>
                                <?php endif; ?>
                            </div>

                            
                            <?php if($product->discount_price && $product->discount_percent > 0): ?>
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 bg-emerald-500 text-white rounded-full text-xs font-bold">
                                        -<?php echo e($product->discount_percent); ?>%
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>

                        
                        <div class="p-6 space-y-4">
                            <div>
                                <p class="text-xs text-on-surface-variant uppercase tracking-wider mb-1"><?php echo e($product->brand); ?></p>
                                <h3 class="font-h3 text-xl text-on-surface line-clamp-1"><?php echo e($product->name); ?></h3>
                                <?php if($product->model): ?>
                                    <p class="text-sm text-on-surface-variant mt-1"><?php echo e($product->model); ?></p>
                                <?php endif; ?>
                            </div>

                            
                            <?php if($product->spec): ?>
                                <div class="flex flex-wrap gap-2">
                                    <?php if($product->spec->ram): ?>
                                        <span class="px-2 py-1 bg-surface-variant/50 rounded-md text-xs text-on-surface-variant">
                                            <?php echo e($product->spec->ram); ?>

                                        </span>
                                    <?php endif; ?>
                                    <?php if($product->spec->storage): ?>
                                        <span class="px-2 py-1 bg-surface-variant/50 rounded-md text-xs text-on-surface-variant">
                                            <?php echo e($product->spec->storage); ?>

                                        </span>
                                    <?php endif; ?>
                                    <?php if($product->spec->processor): ?>
                                        <span class="px-2 py-1 bg-surface-variant/50 rounded-md text-xs text-on-surface-variant line-clamp-1">
                                            <?php echo e(Str::limit($product->spec->processor, 20)); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            
                            <div class="pt-4 border-t border-white/5">
                                <?php if($product->discount_price && $product->discount_price < $product->price): ?>
                                    <div class="flex items-baseline gap-2 mb-2">
                                        <span class="text-2xl font-bold text-primary">
                                            <?php echo e($product->formatted_discount_price); ?>

                                        </span>
                                    </div>
                                    <span class="text-sm text-on-surface-variant line-through">
                                        <?php echo e($product->formatted_price); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="text-2xl font-bold text-primary">
                                        <?php echo e($product->formatted_price); ?>

                                    </span>
                                <?php endif; ?>
                            </div>

                            
                            <div class="flex items-center gap-2">
                                <?php if($product->stock > 10): ?>
                                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                                    <span class="text-xs text-emerald-400 font-semibold">Tersedia</span>
                                <?php elseif($product->stock > 0): ?>
                                    <span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
                                    <span class="text-xs text-amber-400 font-semibold">Stok Terbatas (<?php echo e($product->stock); ?>)</span>
                                <?php else: ?>
                                    <span class="w-2 h-2 bg-rose-500 rounded-full"></span>
                                    <span class="text-xs text-rose-400 font-semibold">Stok Habis</span>
                                <?php endif; ?>
                            </div>

                            
                            <a 
                                href="<?php echo e($product->detail_url); ?>" 
                                class="block w-full py-3 bg-primary/10 hover:bg-primary hover:text-on-primary text-primary border border-primary/20 rounded-xl transition-all font-semibold text-center group-hover:bg-primary group-hover:text-on-primary"
                            >
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <?php if($products->hasPages()): ?>
                <div class="mt-16 flex items-center justify-center gap-3">
                    
                    <?php if($products->onFirstPage()): ?>
                        <span class="w-12 h-12 flex items-center justify-center rounded-xl bg-white/5 border border-white/10 text-on-surface-variant opacity-30 cursor-not-allowed">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </span>
                    <?php else: ?>
                        <a href="<?php echo e($products->previousPageUrl()); ?>" class="w-12 h-12 flex items-center justify-center rounded-xl bg-white/5 border border-white/10 text-on-surface-variant hover:bg-primary hover:text-on-primary hover:border-primary transition-all">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </a>
                    <?php endif; ?>

                    
                    <?php for($page = 1; $page <= $products->lastPage(); $page++): ?>
                        <?php if($page == $products->currentPage()): ?>
                            <span class="w-12 h-12 flex items-center justify-center rounded-xl bg-primary text-on-primary font-bold">
                                <?php echo e($page); ?>

                            </span>
                        <?php else: ?>
                            <a href="<?php echo e($products->url($page)); ?>" class="w-12 h-12 flex items-center justify-center rounded-xl bg-white/5 border border-white/10 text-on-surface-variant hover:bg-white/10 transition-all">
                                <?php echo e($page); ?>

                            </a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    
                    <?php if($products->hasMorePages()): ?>
                        <a href="<?php echo e($products->nextPageUrl()); ?>" class="w-12 h-12 flex items-center justify-center rounded-xl bg-white/5 border border-white/10 text-on-surface-variant hover:bg-primary hover:text-on-primary hover:border-primary transition-all">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </a>
                    <?php else: ?>
                        <span class="w-12 h-12 flex items-center justify-center rounded-xl bg-white/5 border border-white/10 text-on-surface-variant opacity-30 cursor-not-allowed">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            
            <div class="text-center py-20 glass-panel rounded-3xl">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-primary/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-5xl">inventory_2</span>
                </div>
                <h3 class="font-h3 text-2xl text-on-surface mb-3">Produk Belum Tersedia</h3>
                <p class="text-on-surface-variant mb-8 max-w-md mx-auto">
                    Saat ini belum ada produk <?php echo e($category->name); ?> yang tersedia. Silakan cek kembali nanti atau jelajahi brand lainnya.
                </p>
                <div class="flex flex-wrap gap-3 justify-center">
                    <a href="<?php echo e(route('catalog.index')); ?>" class="px-6 py-3 bg-primary text-on-primary rounded-xl font-semibold hover:opacity-90 transition-all">
                        Lihat Semua Katalog
                    </a>
                    <a href="<?php echo e(route('home')); ?>" class="px-6 py-3 bg-white/5 border border-white/10 text-on-surface rounded-xl font-semibold hover:bg-white/10 transition-all">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </section>

    
    <section class="mt-20">
        <div class="text-center mb-10">
            <span class="font-label-caps text-label-caps text-primary tracking-widest uppercase mb-2 block">
                Explore More
            </span>
            <h2 class="font-h2 text-h2 text-on-surface">Brand Lainnya</h2>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
            <?php
                $otherBrands = \App\Models\Category::where('is_active', 'Y')
                    ->where('id', '!=', $category->id)
                    ->orderBy('sort_order')
                    ->limit(10)
                    ->get();
            ?>
            
            <?php $__currentLoopData = $otherBrands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $otherBrand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a 
                    href="<?php echo e(route('category.show', $otherBrand->slug)); ?>" 
                    class="glass-panel rounded-2xl p-6 text-center hover:border-primary/30 transition-all duration-300 group"
                >
                    <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-primary/10 flex items-center justify-center group-hover:bg-primary/20 transition-all">
                        <span class="material-symbols-outlined text-primary text-2xl">phone_android</span>
                    </div>
                    <h4 class="font-semibold text-on-surface group-hover:text-primary transition-colors">
                        <?php echo e($otherBrand->name); ?>

                    </h4>
                    <p class="text-xs text-on-surface-variant mt-1">
                        <?php echo e($otherBrand->products()->where('is_active', 'Y')->count()); ?> produk
                    </p>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

</main>
<!-- MAIN CONTENT END -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Praktikum_CMS\resources\views/catalog/category.blade.php ENDPATH**/ ?>