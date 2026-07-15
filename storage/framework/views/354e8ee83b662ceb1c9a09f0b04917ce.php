
<?php $__env->startSection('content'); ?>

<!-- MAIN CONTENT START -->
<main class="max-w-container-max-width mx-auto px-margin-mobile md:px-margin-desktop pt-40">
    <!-- HERO SECTION START -->
    <section class="relative min-h-[70vh] flex flex-col items-center justify-center text-center overflow-hidden mb-margin-desktop">
        <div class="absolute inset-0 -z-10 blue-radial-glow scale-150 opacity-40"></div>
        <div class="max-w-4xl space-y-8 relative z-10">

            <span class="font-label-caps text-label-caps text-primary uppercase tracking-[0.4em] inline-block border-b border-primary/30 pb-2">
                <?php echo e($setting->hero_label ?? 'PREMIUM SMARTPHONE COLLECTION'); ?>

            </span>

            <h1 class="font-h1 text-h1-mobile md:text-h1 text-on-surface leading-tight">
                <?php echo e($setting->hero_title ?? 'Temukan Smartphone Impian Anda'); ?>

            </h1>

            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto leading-relaxed">
                <?php echo e($setting->hero_description ?? 'Prestige Mobile menghadirkan berbagai pilihan smartphone original dari brand terkemuka dengan garansi resmi, harga kompetitif, dan pelayanan terbaik.'); ?>

            </p>

        </div>
        <div class="mt-16 flex justify-center items-center">

            <div class="mt-12 flex justify-center items-center">

                <div class="relative group">

                    <div
                        class="absolute inset-0
               bg-primary/10
               blur-[70px]
               -z-10
               opacity-60
               group-hover:opacity-100
               transition-all
               duration-700">
                    </div>

                    <img
                        src="<?php echo e(isset($setting) && $setting->hero_image ? asset('storage/' . $setting->hero_image) : asset('Images/no-image.png')); ?>"
                        alt="<?php echo e($setting->hero_title ?? 'Hero Image'); ?>"
                        class="
                w-auto
                h-auto

                max-w-[340px]
                sm:max-w-[420px]
                md:max-w-[500px]
                lg:max-w-[580px]
                xl:max-w-[620px]

                object-contain
                rounded-3xl

                glass-panel

                shadow-[0_25px_60px_rgba(0,0,0,0.45)]

                transition-all
                duration-700

                group-hover:scale-105
            ">

                </div>

            </div>
    </section>
    <!-- HERO SECTION END -->
    
    <!-- STORE TRUST SECTION START -->
    <section class="mb-margin-desktop grid md:grid-cols-2 gap-gutter items-stretch">
        <div class="relative rounded-3xl overflow-hidden aspect-video md:aspect-auto">
            <img class="w-full h-full object-cover transition-transform duration-1000 hover:scale-105" data-alt="An ultra-modern, luxury mobile store interior for Prestige Mobile with a minimalist 'Starlight Edition' aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCo0gHvM_NLgf8c2eJc-C6NAEcQ20U2_f3yU6JfdfzjUWyc4E1c45QN8bwJVQV25topmDyG-m_IxWwPLiZj5IXJHVCiooM3qjJGdHMXfPWNVfMMzoKo7kcvcfj0a2AR9hses72GqakUmbrAOUT59tY5mYcY5japVDtym47aqeWxyxuZ6lA0P1GE29ssFt0qFlWuRFcnB6f_5rtUjUJzK3x8Peq_pIk2OI4qrp_ZXXyl4ucBiTe9urAubKrsWhfCE_71SnFquh34ML4" />
            <div class="absolute inset-0 bg-gradient-to-t from-background/80 via-transparent to-transparent"></div>
        </div>
        <div class="p-gutter md:p-16 space-y-8 glass-panel rounded-3xl flex flex-col justify-center border-l-0 md:border-l border-white/10">
            <h2 class="font-h2 text-h2 text-on-surface leading-tight">
                <?php echo e($setting->vision ?? 'Menjadi toko smartphone terpercaya dan terdepan dalam menyediakan perangkat teknologi berkualitas bagi masyarakat Indonesia.'); ?>

            </h2>
            <p class="font-body-md text-on-surface-variant leading-relaxed opacity-90">
                <?php echo e($setting->about_store ?? 'ASIAPHONE adalah pusat penjualan smartphone yang menyediakan berbagai pilihan perangkat terbaru dari Samsung, Apple, Xiaomi, Oppo, Vivo, Realme, ASUS ROG, Tecno, Infinix, dan berbagai brand resmi lainnya.'); ?>

            </p>
            <ul class="space-y-6">
                <li class="flex items-center gap-4 group">
                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center transition-colors group-hover:bg-primary/20">
                        <span class="material-symbols-outlined text-primary">verified</span>
                    </div>
                    <span class="font-medium">Garansi Resmi &amp; Sertifikat Keaslian Eksklusif</span>
                </li>
                <li class="flex items-center gap-4 group">
                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center transition-colors group-hover:bg-primary/20">
                        <span class="material-symbols-outlined text-primary">person_check</span>
                    </div>
                    <span class="font-medium">Konsultan Produk Terlatih untuk Pengalaman Custom</span>
                </li>
                <li class="flex items-center gap-4 group">
                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center transition-colors group-hover:bg-primary/20">
                        <span class="material-symbols-outlined text-primary">workspace_premium</span>
                    </div>
                    <span class="font-medium">Layanan Purna Jual 'Prestige Care' Prioritas</span>
                </li>
            </ul>
            <div class="pt-6">
                <button class="text-primary font-bold flex items-center gap-2 group hover:gap-4 transition-all duration-300">
                    Tentang Filosofi Kami <span class="material-symbols-outlined transition-transform">arrow_forward</span>
                </button>
            </div>
        </div>
    </section>
    <!-- STORE TRUST SECTION END -->
    
    <!-- PRODUCT CATALOG START -->
    <section class="mb-margin-desktop scroll-mt-32" id="katalog">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16 gap-6">
            <div>
                <span class="font-label-caps text-label-caps text-primary tracking-[0.3em] uppercase block mb-4">STELAR COLLECTION</span>
                <h2 class="font-h2 text-h2 text-on-surface"><?php echo e($setting->catalog_title ?? 'Katalog Produk'); ?></h2>
                
                
                <div class="flex flex-wrap gap-3 mt-8">
                    
                    
                    <a href="<?php echo e(route('home')); ?>"
                        class="px-5 py-2 rounded-full <?php echo e(empty($brand) ? 'bg-primary text-white' : 'bg-white/5 text-on-surface'); ?>">
                        Semua
                    </a>
                    
                    
                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('home', ['brand' => $item])); ?>"
                            class="px-5 py-2 rounded-full <?php echo e($brand == $item ? 'bg-primary text-white' : 'bg-white/5 text-on-surface'); ?>">
                            <?php echo e($item); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                </div>
            </div>
        </div>
    </section>

    
    <section class="mb-margin-desktop scroll-mt-32" id="produk-unggulan">
        <div class="mb-12">
            <span class="font-label-caps text-label-caps text-primary tracking-widest uppercase">Flagship Series</span>
            <h3 class="font-h2 text-h2 text-on-surface mt-2">Produk Unggulan</h3>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-gutter">
            <?php $__empty_1 = true; $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="glass-panel rounded-2xl overflow-hidden group">
                    <div class="aspect-[4/3] overflow-hidden relative">
                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                            src="<?php echo e(asset('product/'.strtolower($product->brand).'/'.$product->image)); ?>"
                            alt="<?php echo e($product->name); ?>" />
                    </div>
                    <div class="p-6 space-y-4">
                        <h3 class="font-h3 text-xl text-on-surface"><?php echo e($product->name); ?></h3>
                        <span class="px-2 py-1 bg-surface-variant rounded-md"><?php echo e(optional($product->spec)->ram); ?> </span>
                        <span class="px-2 py-1 bg-surface-variant rounded-md"><?php echo e(optional($product->spec)->storage); ?></span>
                        <div class="text-lg font-bold text-primary">Rp <?php echo e(number_format($product->price,0,',','.')); ?></div>
                        <a href="<?php echo e(route('catalog.detail', $product->slug)); ?>" class="block py-3 bg-white/5 border border-white/10 text-on-surface rounded-xl hover:bg-primary hover:text-on-primary transition-all font-semibold text-center">
                            Detail
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-3 text-center py-10 text-on-surface-variant">
                    Belum ada produk unggulan.
                </div>
            <?php endif; ?>
        </div>
    </section>

    
    <section class="mb-margin-desktop scroll-mt-32" id="hot-deal">
        <div class="mb-12">
            <span class="font-label-caps text-label-caps text-error tracking-widest uppercase">Limited Offer</span>
            <h3 class="font-h2 text-h2 text-on-surface mt-2">🔥 Hot Deals &amp; Discount</h3>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-gutter">
            <?php $__empty_1 = true; $__currentLoopData = $hotDealProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="glass-panel rounded-2xl overflow-hidden group relative">
                    <div class="absolute top-4 left-4 z-10 bg-error text-on-error px-3 py-1 rounded-full text-label-caps">-<?php echo e($product->discount_percent); ?>%</div>
                    <div class="aspect-square overflow-hidden">
                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                            src="<?php echo e(asset('product/'.strtolower($product->brand).'/'.$product->image)); ?>"
                            alt="<?php echo e($product->name); ?>" />
                    </div>
                    <div class="p-4 space-y-1">
                        <h3 class="font-h3 text-base text-on-surface truncate"><?php echo e($product->name); ?></h3>
                        <span class="px-2 py-1 bg-surface-variant rounded-md"><?php echo e(optional($product->spec)->ram); ?> </span>
                        <span class="px-2 py-1 bg-surface-variant rounded-md"><?php echo e(optional($product->spec)->storage); ?></span>
                        <div class="flex flex-col">
                            <span class="text-lg font-bold text-primary">Rp <?php echo e(number_format($product->discount_price,0,',','.')); ?></span>
                            <span class="text-xs text-on-surface-variant line-through">Rp <?php echo e(number_format($product->price,0,',','.')); ?></span>
                        </div>
                        <a href="<?php echo e(route('catalog.detail', $product->slug)); ?>" class="block py-3 bg-white/5 border border-white/10 text-on-surface rounded-xl hover:bg-primary hover:text-on-primary transition-all font-semibold text-center">
                            Detail
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-3 text-center py-10 text-on-surface-variant">
                    Belum ada hot deal.
                </div>
            <?php endif; ?>
        </div>
    </section>

    
    <section class="mb-margin-desktop scroll-mt-32" id="gaming">
        <div class="mb-12">
            <span class="font-label-caps text-label-caps text-primary tracking-widest uppercase">Pro Performance</span>
            <h3 class="font-h2 text-h2 text-on-surface mt-2">Gaming</h3>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-gutter">
            <?php $__empty_1 = true; $__currentLoopData = $gamingProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="glass-panel rounded-2xl overflow-hidden group">
                    <div class="aspect-video overflow-hidden relative">
                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                            src="<?php echo e(asset('product/'.strtolower($product->brand).'/'.$product->image)); ?>"
                            alt="<?php echo e($product->name); ?>" />
                    </div>
                    <div class="p-6 space-y-4">
                        <h3 class="font-h3 text-xl text-on-surface"><?php echo e($product->name); ?></h3>
                        <span class="px-2 py-1 bg-surface-variant rounded-md"><?php echo e(optional($product->spec)->ram); ?> </span>
                        <span class="px-2 py-1 bg-surface-variant rounded-md"><?php echo e(optional($product->spec)->storage); ?></span>
                        <div class="text-lg font-bold text-primary">Rp <?php echo e(number_format($product->price,0,',','.')); ?></div>
                        <a href="<?php echo e(route('catalog.detail', $product->slug)); ?>" class="block py-3 bg-white/5 border border-white/10 text-on-surface rounded-xl hover:bg-primary hover:text-on-primary transition-all font-semibold text-center">
                            Detail
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-3 text-center py-10 text-on-surface-variant">
                    Belum ada produk gaming.
                </div>
            <?php endif; ?>
        </div>
    </section>

    
    <section class="mb-margin-desktop scroll-mt-32" id="produk-terbaru">
        <div class="mb-12">
            <span class="font-label-caps text-label-caps text-primary tracking-widest uppercase">New Arrivals</span>
            <h3 class="font-h2 text-h2 text-on-surface mt-2">Produk Terbaru</h3>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-gutter">
            <?php $__empty_1 = true; $__currentLoopData = $latestProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="glass-panel rounded-2xl overflow-hidden group">
                    <div class="aspect-video overflow-hidden relative">
                        <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                            src="<?php echo e(asset('product/'.strtolower($product->brand).'/'.$product->image)); ?>"
                            alt="<?php echo e($product->name); ?>" />
                    </div>
                    <div class="p-4 space-y-3">
                        <h3 class="font-h3 text-lg text-on-surface truncate"><?php echo e($product->name); ?></h3>
                        <span class="px-2 py-1 bg-surface-variant rounded-md"><?php echo e(optional($product->spec)->ram); ?> </span>
                        <span class="px-2 py-1 bg-surface-variant rounded-md"><?php echo e(optional($product->spec)->storage); ?></span>
                        <div class="text-md font-bold text-primary">Rp <?php echo e(number_format($product->price,0,',','.')); ?></div>
                        <a href="<?php echo e(route('catalog.detail', $product->slug)); ?>" class="block py-3 bg-white/5 border border-white/10 text-on-surface rounded-xl hover:bg-primary hover:text-on-primary transition-all font-semibold text-center">
                            Detail
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-3 text-center py-10 text-on-surface-variant">
                    Belum ada produk terbaru.
                </div>
            <?php endif; ?>
        </div>
    </section>
    <!-- PRODUCT CATALOG END -->

    <!-- LOCATION SECTION START -->
    <section class="mb-margin-desktop grid lg:grid-cols-3 gap-gutter items-stretch scroll-mt-32" id="kontak">
        <div class="lg:col-span-1 glass-panel p-10 rounded-3xl flex flex-col justify-between border border-white/10">
            <div>
                <h2 class="font-h2 text-h2 mb-6">Lokasi Galeri</h2>
                <p class="text-on-surface-variant mb-10 leading-relaxed">Kunjungi galeri fisik kami untuk merasakan perangkat secara langsung dengan pendampingan personal dari ahli kami.</p>
                <div class="space-y-8">
                    <div class="flex gap-5">
                        <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary shrink-0">
                            <span class="material-symbols-outlined">location_on</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-1">Jakarta Hub</h4>
                            <p class="text-sm text-on-surface-variant">SCBD District 8, Jakarta Selatan</p>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary shrink-0">
                            <span class="material-symbols-outlined">location_on</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-1">Surabaya Gallery</h4>
                            <p class="text-sm text-on-surface-variant">Tunjungan Plaza 6, Surabaya Center</p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="w-full mt-12 py-5 bg-primary text-on-primary font-bold rounded-2xl titanium-glow transition-all shadow-lg shadow-primary/20">Kunjungi Toko</button>
        </div>
        <div class="lg:col-span-2 relative rounded-3xl overflow-hidden glass-panel h-[500px] lg:h-auto group border border-white/10">
            <div class="absolute inset-0 grayscale invert opacity-40 transition-opacity duration-1000 group-hover:opacity-60">
                <img class="w-full h-full object-cover" data-alt="A stylized, high-contrast dark mode map of Jakarta" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBxg3lSsTr5PhfjV7nj-nz3XgDG65MilUotqZPHmvtkijoIsHaVV6qbXT9Vb1PS7Bkjd31escMDlYkulQFoQytbbeR1YODWZuHVmodcWCQUxwXEgzmoEbNKckW6Sr8ALjiTZiROU_kfFpAU7Raf8dBIaSvkqJivPAP2pMtVj5QuAsGys_ojFSkhrar7D6FhXKkXV5BtP0JrERsP_6nZ9eculUWUfthRY40nMsqtAMlf7tjxj7NHalWBUBGGGs1xvP1PFMSYnATrjio" />
            </div>
            <div class="absolute inset-0 bg-blue-radial-glow pointer-events-none mix-blend-overlay"></div>
            <div class="absolute top-1/2 left-1/3 w-10 h-10 -mt-5 -ml-5">
                <span class="absolute inline-flex h-full w-full rounded-full bg-primary opacity-30 animate-ping"></span>
                <span class="relative inline-flex rounded-full h-10 w-10 bg-primary/80 border-2 border-white/50 shadow-[0_0_20px_rgba(200,198,200,0.8)]"></span>
            </div>
            <div class="absolute top-1/4 right-1/4 w-10 h-10 -mt-5 -ml-5">
                <span class="absolute inline-flex h-full w-full rounded-full bg-primary opacity-30 animate-ping"></span>
                <span class="relative inline-flex rounded-full h-10 w-10 bg-primary/80 border-2 border-white/50 shadow-[0_0_20px_rgba(200,198,200,0.8)]"></span>
            </div>
        </div>
    </section>
    <!-- LOCATION SECTION END -->
</main>
<!-- MAIN CONTENT END -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Praktikum_CMS\resources\views/frontend/home.blade.php ENDPATH**/ ?>