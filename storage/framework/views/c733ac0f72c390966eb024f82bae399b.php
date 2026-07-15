

<?php $__env->startSection('title', 'Produk'); ?>
<?php $__env->startSection('page-title', 'MANAGE PRODUCTS'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6 animate-fade-in">

    
    <div class="flex items-center justify-between flex-wrap gap-4">
        <div>
            <h2 class="font-space text-2xl font-bold text-white">PRODUK HANDPHONE</h2>
            <p class="text-slate-400 text-sm mt-1">Kelola semua produk handphone di sistem</p>
        </div>
        <a href="<?php echo e(route('admin.products.create')); ?>" 
           class="btn-modern px-6 py-3 rounded-xl font-medium font-space flex items-center gap-3">
            <i class="fas fa-plus text-xl"></i>
            TAMBAH PRODUK
        </a>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="modern-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-xs uppercase tracking-wider">Total Produk</p>
                    <h3 class="font-space text-3xl font-bold text-white mt-2"><?php echo e($stats['total']); ?></h3>
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
                    <h3 class="font-space text-3xl font-bold text-white mt-2"><?php echo e($stats['active']); ?></h3>
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
                    <h3 class="font-space text-3xl font-bold text-white mt-2"><?php echo e($stats['featured']); ?></h3>
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
                    <h3 class="font-space text-3xl font-bold text-white mt-2"><?php echo e($stats['low_stock']); ?></h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-rose-500 to-rose-600 flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modern-card p-6">
        <form action="<?php echo e(route('admin.products.index')); ?>" method="GET" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[250px]">
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" 
                           name="search" 
                           value="<?php echo e(request('search')); ?>" 
                           placeholder="Cari nama, brand, atau model..."
                           class="w-full pl-12 pr-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all font-space">
                </div>
            </div>

            <select name="category" class="px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-blue-500/50 transition-all font-space">
                <option value="">Semua Kategori</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cat->id); ?>" <?php echo e(request('category') == $cat->id ? 'selected' : ''); ?>>
                        <?php echo e($cat->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <select name="status" class="px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-blue-500/50 transition-all font-space">
                <option value="">Semua Status</option>
                <option value="Y" <?php echo e(request('status') == 'Y' ? 'selected' : ''); ?>>Aktif</option>
                <option value="N" <?php echo e(request('status') == 'N' ? 'selected' : ''); ?>>Nonaktif</option>
            </select>

            <button type="submit" class="px-6 py-3 bg-blue-500/20 hover:bg-blue-500/30 border border-blue-500/30 text-blue-400 rounded-xl transition-all font-space font-semibold">
                TERAPKAN
            </button>

            <?php if(request('search') || request('category') || request('status')): ?>
            <a href="<?php echo e(route('admin.products.index')); ?>" class="px-6 py-3 bg-rose-500/20 hover:bg-rose-500/30 border border-rose-500/30 text-rose-400 rounded-xl transition-all font-space font-semibold">
                RESET
            </a>
            <?php endif; ?>
        </form>
    </div>

    
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
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="group hover:bg-slate-800/30 transition-all">
                        
                        
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-500/20 to-purple-600/20 flex items-center justify-center flex-shrink-0 overflow-hidden">
                                    <?php if($product->image): ?>
                                        <img src="<?php echo e(asset('product/' . strtolower($product->brand) . '/' . $product->image)); ?>" 
                                             alt="<?php echo e($product->name); ?>"
                                             class="w-full h-full object-cover"
                                             onerror="this.parentElement.innerHTML='<i class=\'fas fa-mobile-alt text-blue-400 text-xl\'></i>'">
                                    <?php else: ?>
                                        <i class="fas fa-mobile-alt text-blue-400 text-xl"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-sm font-bold text-white font-space truncate"><?php echo e($product->name); ?></h4>
                                    <p class="text-xs text-slate-400 truncate"><?php echo e($product->brand); ?> - <?php echo e($product->model ?? '-'); ?></p>
                                    <p class="text-xs text-slate-500 font-mono truncate"><?php echo e($product->slug); ?></p>
                                </div>
                            </div>
                        </td>

                        
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 bg-blue-500/10 text-blue-400 text-xs font-bold rounded-full border border-blue-500/30 font-space">
                                <?php echo e($product->category->name ?? '-'); ?>

                            </span>
                        </td>

                        
                        <td class="py-4 px-6 text-right">
                            <?php if($product->discount_price && $product->discount_price < $product->price): ?>
                                <div class="flex flex-col items-end">
                                    <span class="text-sm font-bold text-emerald-400 font-space">
                                        Rp <?php echo e(number_format($product->discount_price, 0, ',', '.')); ?>

                                    </span>
                                    <span class="text-xs text-slate-500 line-through">
                                        Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>

                                    </span>
                                </div>
                            <?php else: ?>
                                <span class="text-sm font-bold text-white font-space">
                                    Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>

                                </span>
                            <?php endif; ?>
                        </td>

                        
                        <td class="py-4 px-6 text-center">
                            <?php
                                $stockClass = $product->stock > 10 
                                    ? 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30' 
                                    : ($product->stock > 0 
                                        ? 'bg-amber-500/20 text-amber-400 border-amber-500/30' 
                                        : 'bg-rose-500/20 text-rose-400 border-rose-500/30');
                            ?>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold <?php echo e($stockClass); ?> border font-space">
                                <?php echo e($product->stock); ?>

                            </span>
                        </td>

                        
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-1">
                                <?php if($product->is_featured === 'Y'): ?>
                                    <span class="w-7 h-7 rounded-full bg-yellow-500/20 border border-yellow-500/30 flex items-center justify-center" title="Featured">
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    </span>
                                <?php endif; ?>
                                <?php if($product->is_hot_deal === 'Y'): ?>
                                    <span class="w-7 h-7 rounded-full bg-orange-500/20 border border-orange-500/30 flex items-center justify-center" title="Hot Deal">
                                        <i class="fas fa-fire text-orange-400 text-xs"></i>
                                    </span>
                                <?php endif; ?>
                                <?php if($product->is_gaming === 'Y'): ?>
                                    <span class="w-7 h-7 rounded-full bg-purple-500/20 border border-purple-500/30 flex items-center justify-center" title="Gaming">
                                        <i class="fas fa-gamepad text-purple-400 text-xs"></i>
                                    </span>
                                <?php endif; ?>
                                <?php if($product->is_featured !== 'Y' && $product->is_hot_deal !== 'Y' && $product->is_gaming !== 'Y'): ?>
                                    <span class="text-slate-500 text-xs">-</span>
                                <?php endif; ?>
                            </div>
                        </td>

                        
                        <td class="py-4 px-6 text-center">
                            <?php if($product->is_active === 'Y'): ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 font-space">
                                    <i class="fas fa-check mr-1"></i> AKTIF
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-500/20 text-slate-400 border border-slate-500/30 font-space">
                                    <i class="fas fa-times mr-1"></i> NONAKTIF
                                </span>
                            <?php endif; ?>
                        </td>

                        
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center gap-2">
                                <a href="<?php echo e(route('admin.products.edit', $product)); ?>" 
                                   class="w-10 h-10 rounded-lg bg-blue-500/10 hover:bg-blue-500/20 text-blue-400 transition-all flex items-center justify-center border border-blue-500/30"
                                   title="Edit Produk">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="<?php echo e(route('admin.products.destroy', $product)); ?>" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus produk \'<?php echo e($product->name); ?>\'? Data tidak dapat dikembalikan!')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" 
                                            class="w-10 h-10 rounded-lg bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 transition-all flex items-center justify-center border border-rose-500/30"
                                            title="Hapus Produk">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="py-16 text-center">
                            <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-blue-500/20 to-purple-600/20 flex items-center justify-center">
                                <i class="fas fa-inbox text-blue-400 text-5xl"></i>
                            </div>
                            <p class="text-slate-400 font-space text-lg tracking-wide mb-2">Belum ada produk</p>
                            <p class="text-slate-500 text-sm mb-4">Mulai tambahkan produk pertama Anda</p>
                            <a href="<?php echo e(route('admin.products.create')); ?>" 
                               class="inline-flex items-center gap-2 px-6 py-3 bg-blue-500/10 hover:bg-blue-500/20 text-blue-400 rounded-xl transition-all border border-blue-500/30 font-space font-semibold">
                                <i class="fas fa-plus"></i>
                                Tambah Produk Pertama
                            </a>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <?php if($products->hasPages()): ?>
        <div class="mt-8 flex items-center justify-center gap-2">
            <?php echo e($products->appends(request()->query())->links()); ?>

        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Praktikum_CMS\resources\views/admin/products/index.blade.php ENDPATH**/ ?>