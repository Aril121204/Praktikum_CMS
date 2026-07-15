

<?php $__env->startSection('title', 'Categories'); ?>
<?php $__env->startSection('page-title', 'MANAGE CATEGORIES'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6 animate-fade-in">

    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="font-orbitron text-2xl font-bold text-white neon-text">KATEGORI BRAND</h2>
            <p class="text-cyan-300/60 text-sm mt-1 font-rajdhani">Kelola brand dan kategori produk</p>
        </div>
        <a href="<?php echo e(route('admin.categories.create')); ?>" 
           class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white rounded-xl transition-all btn-neon font-rajdhani font-semibold tracking-wide flex items-center gap-3">
            <i class="fas fa-plus text-xl"></i>
            TAMBAH BRAND
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="glass rounded-2xl p-6 neon-border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-cyan-300/60 text-xs font-rajdhani uppercase tracking-wider">Total Brand</p>
                    <h3 class="font-orbitron text-3xl font-bold text-white mt-2"><?php echo e($categories->count()); ?></h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center">
                    <i class="fas fa-tags text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="glass rounded-2xl p-6 neon-border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-300/60 text-xs font-rajdhani uppercase tracking-wider">Brand Aktif</p>
                    <h3 class="font-orbitron text-3xl font-bold text-white mt-2"><?php echo e($categories->where('is_active', 'Y')->count()); ?></h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-green-600 flex items-center justify-center">
                    <i class="fas fa-check-circle text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="glass rounded-2xl p-6 neon-border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-rose-300/60 text-xs font-rajdhani uppercase tracking-wider">Brand Nonaktif</p>
                    <h3 class="font-orbitron text-3xl font-bold text-white mt-2"><?php echo e($categories->where('is_active', 'N')->count()); ?></h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-rose-400 to-pink-600 flex items-center justify-center">
                    <i class="fas fa-times-circle text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Table -->
    <div class="glass rounded-3xl p-8 neon-border">
        <div class="mb-6">
            <h3 class="font-orbitron text-xl font-bold text-white tracking-wider">DAFTAR BRAND</h3>
            <p class="text-sm text-cyan-300/60 mt-1 font-rajdhani">Semua brand dan kategori produk</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-cyan-500/20">
                        <th class="text-left py-4 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Brand</th>
                        <th class="text-left py-4 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Slug</th>
                        <th class="text-center py-4 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Urutan</th>
                        <th class="text-center py-4 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Status</th>
                        <th class="text-center py-4 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Produk</th>
                        <th class="text-center py-4 px-6 text-xs font-bold text-cyan-400 uppercase tracking-widest font-rajdhani">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cyan-500/10">
                    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="group hover:bg-cyan-500/5 transition-all">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-4">
                                <?php if($category->image): ?>
                                    <img src="<?php echo e(asset($category->image)); ?>" 
                                         alt="<?php echo e($category->name); ?>" 
                                         class="w-12 h-12 rounded-xl object-cover border border-cyan-500/30">
                                <?php else: ?>
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500/20 to-purple-600/20 flex items-center justify-center">
                                        <i class="fas fa-tag text-cyan-400 text-xl"></i>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <h4 class="text-sm font-bold text-white font-rajdhani tracking-wide"><?php echo e($category->name); ?></h4>
                                    <?php if($category->description): ?>
                                        <p class="text-xs text-gray-400 truncate max-w-xs"><?php echo e(Str::limit($category->description, 50)); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <code class="text-xs text-purple-400 bg-purple-500/10 px-2 py-1 rounded"><?php echo e($category->slug); ?></code>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="text-sm font-bold text-white font-orbitron"><?php echo e($category->sort_order); ?></span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <?php if($category->is_active === 'Y'): ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 font-rajdhani">
                                    <i class="fas fa-check mr-1"></i> AKTIF
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-500/20 text-gray-400 border border-gray-500/30 font-rajdhani">
                                    <i class="fas fa-times mr-1"></i> NONAKTIF
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="text-sm font-bold text-cyan-400 font-orbitron"><?php echo e($category->products_count ?? 0); ?></span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center gap-2">
                                <a href="<?php echo e(route('admin.categories.edit', $category)); ?>" 
                                   class="w-10 h-10 rounded-lg bg-cyan-500/10 hover:bg-cyan-500/20 text-cyan-400 transition-all flex items-center justify-center border border-cyan-500/30 btn-neon">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?php echo e(route('admin.categories.destroy', $category)); ?>" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus brand \'<?php echo e($category->name); ?>\'?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" 
                                            class="w-10 h-10 rounded-lg bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 transition-all flex items-center justify-center border border-rose-500/30 btn-neon">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="py-16 text-center">
                            <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-cyan-500/20 to-purple-600/20 flex items-center justify-center">
                                <i class="fas fa-tags text-cyan-400 text-5xl"></i>
                            </div>
                            <p class="text-cyan-300/60 font-rajdhani text-lg tracking-wide mb-2">Belum ada brand</p>
                            <a href="<?php echo e(route('admin.categories.create')); ?>" 
                               class="inline-flex items-center gap-2 px-6 py-3 bg-cyan-500/10 hover:bg-cyan-500/20 text-cyan-400 rounded-xl transition-all border border-cyan-500/30 font-rajdhani font-semibold">
                                <i class="fas fa-plus"></i>
                                Tambah Brand Pertama
                            </a>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Praktikum_CMS\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>