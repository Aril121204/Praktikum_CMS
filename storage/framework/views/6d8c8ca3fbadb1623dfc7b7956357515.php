

<?php $__env->startSection('title', 'Add Category'); ?>
<?php $__env->startSection('page-title', 'ADD NEW BRAND'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto animate-fade-in">

    <!-- Header -->
    <div class="mb-8">
        <a href="<?php echo e(route('admin.categories.index')); ?>" 
           class="inline-flex items-center gap-2 text-cyan-400 hover:text-cyan-300 transition-colors mb-4 font-rajdhani">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Daftar
        </a>
        <h2 class="font-orbitron text-3xl font-bold text-white neon-text">TAMBAH BRAND BARU</h2>
        <p class="text-cyan-300/60 text-sm mt-2 font-rajdhani">Isi form di bawah untuk menambahkan brand/kategori baru</p>
    </div>

    <!-- Form -->
    <form action="<?php echo e(route('admin.categories.store')); ?>" 
          method="POST" 
          enctype="multipart/form-data"
          class="glass rounded-3xl p-8 neon-border">
        <?php echo csrf_field(); ?>

        <div class="space-y-6">
            <!-- Name -->
            <div>
                <label class="block text-cyan-300/80 text-sm font-bold mb-3 font-rajdhani tracking-wide">
                    <i class="fas fa-tag mr-2"></i>
                    NAMA BRAND <span class="text-rose-400">*</span>
                </label>
                <input type="text" 
                       name="name" 
                       value="<?php echo e(old('name')); ?>"
                       placeholder="Contoh: Samsung, Apple, Xiaomi"
                       class="w-full px-5 py-4 glass bg-black/20 border border-cyan-500/30 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 transition-all font-rajdhani text-lg <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-rose-500/50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       required>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-rose-400 text-xs mt-2 font-rajdhani"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Slug -->
            <div>
                <label class="block text-cyan-300/80 text-sm font-bold mb-3 font-rajdhani tracking-wide">
                    <i class="fas fa-link mr-2"></i>
                    SLUG <span class="text-rose-400">*</span>
                </label>
                <input type="text" 
                       name="slug" 
                       value="<?php echo e(old('slug')); ?>"
                       placeholder="Contoh: samsung, apple, xiaomi"
                       class="w-full px-5 py-4 glass bg-black/20 border border-cyan-500/30 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 transition-all font-rajdhani text-lg <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-rose-500/50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       required>
                <p class="text-cyan-300/40 text-xs mt-2 font-rajdhani">Gunakan huruf kecil dan tanda hubung (-) untuk spasi</p>
                <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-rose-400 text-xs mt-2 font-rajdhani"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-cyan-300/80 text-sm font-bold mb-3 font-rajdhani tracking-wide">
                    <i class="fas fa-align-left mr-2"></i>
                    DESKRIPSI
                </label>
                <textarea name="description" 
                          rows="4" 
                          placeholder="Deskripsi singkat tentang brand ini..."
                          class="w-full px-5 py-4 glass bg-black/20 border border-cyan-500/30 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 transition-all font-rajdhani text-lg resize-none <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-rose-500/50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('description')); ?></textarea>
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-rose-400 text-xs mt-2 font-rajdhani"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Image -->
            <div>
                <label class="block text-cyan-300/80 text-sm font-bold mb-3 font-rajdhani tracking-wide">
                    <i class="fas fa-image mr-2"></i>
                    LOGO BRAND
                </label>
                <div class="flex items-center gap-6">
                    <input type="file" 
                           name="image" 
                           id="imageInput"
                           accept="image/*"
                           class="hidden"
                           onchange="previewImage(this)">
                    <label for="imageInput" 
                           class="flex-1 px-5 py-12 glass bg-black/20 border-2 border-dashed border-cyan-500/30 rounded-xl text-center cursor-pointer hover:border-cyan-400 transition-all group">
                        <div id="imagePreview" class="hidden">
                            <img src="" alt="Preview" class="max-h-48 mx-auto rounded-xl">
                        </div>
                        <div id="uploadPlaceholder">
                            <i class="fas fa-cloud-upload-alt text-5xl text-cyan-400/50 group-hover:text-cyan-400 transition-colors mb-3"></i>
                            <p class="text-cyan-300/60 font-rajdhani">Klik untuk upload logo</p>
                            <p class="text-gray-500 text-xs mt-1 font-rajdhani">PNG, JPG, GIF (Max 2MB)</p>
                        </div>
                    </label>
                </div>
                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-rose-400 text-xs mt-2 font-rajdhani"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Sort Order & Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Sort Order -->
                <div>
                    <label class="block text-cyan-300/80 text-sm font-bold mb-3 font-rajdhani tracking-wide">
                        <i class="fas fa-sort-numeric-down mr-2"></i>
                        URUTAN <span class="text-rose-400">*</span>
                    </label>
                    <input type="number" 
                           name="sort_order" 
                           value="<?php echo e(old('sort_order', 0)); ?>"
                           min="0"
                           placeholder="0"
                           class="w-full px-5 py-4 glass bg-black/20 border border-cyan-500/30 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 transition-all font-rajdhani text-lg <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-rose-500/50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           required>
                    <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-rose-400 text-xs mt-2 font-rajdhani"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-cyan-300/80 text-sm font-bold mb-3 font-rajdhani tracking-wide">
                        <i class="fas fa-toggle-on mr-2"></i>
                        STATUS <span class="text-rose-400">*</span>
                    </label>
                    <div class="flex gap-4">
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" 
                                   name="is_active" 
                                   value="Y" 
                                   <?php echo e(old('is_active', 'Y') === 'Y' ? 'checked' : ''); ?>

                                   class="peer sr-only">
                            <div class="px-5 py-4 glass bg-black/20 border border-cyan-500/30 rounded-xl text-center transition-all peer-checked:bg-emerald-500/20 peer-checked:border-emerald-500/50">
                                <i class="fas fa-check-circle text-emerald-400 text-2xl mb-1"></i>
                                <p class="text-white font-rajdhani font-bold">Aktif</p>
                            </div>
                        </label>
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" 
                                   name="is_active" 
                                   value="N" 
                                   <?php echo e(old('is_active') === 'N' ? 'checked' : ''); ?>

                                   class="peer sr-only">
                            <div class="px-5 py-4 glass bg-black/20 border border-cyan-500/30 rounded-xl text-center transition-all peer-checked:bg-rose-500/20 peer-checked:border-rose-500/50">
                                <i class="fas fa-times-circle text-rose-400 text-2xl mb-1"></i>
                                <p class="text-white font-rajdhani font-bold">Nonaktif</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end gap-4 pt-6 border-t border-cyan-500/20">
                <a href="<?php echo e(route('admin.categories.index')); ?>" 
                   class="px-8 py-4 glass hover:bg-white/5 text-gray-300 rounded-xl transition-all font-rajdhani font-semibold tracking-wide">
                    Batal
                </a>
                <button type="submit" 
                        class="px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white rounded-xl transition-all btn-neon font-rajdhani font-semibold tracking-wide flex items-center gap-3">
                    <i class="fas fa-save text-xl"></i>
                    SIMPAN BRAND
                </button>
            </div>
        </div>
    </form>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').classList.remove('hidden');
                document.getElementById('imagePreview').querySelector('img').src = e.target.result;
                document.getElementById('uploadPlaceholder').classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Auto-generate slug from name
    document.querySelector('input[name="name"]').addEventListener('input', function() {
        const slugInput = document.querySelector('input[name="slug"]');
        if (!slugInput.value || slugInput.value === this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '')) {
            slugInput.value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Praktikum_CMS\resources\views/admin/categories/create.blade.php ENDPATH**/ ?>