

<?php $__env->startSection('title', 'Edit Produk'); ?>
<?php $__env->startSection('page-title', 'EDIT PRODUCT'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto animate-fade-in">

    <div class="mb-8">
        <a href="<?php echo e(route('admin.products.index')); ?>" 
           class="inline-flex items-center gap-2 text-blue-400 hover:text-blue-300 transition-colors mb-4 font-space">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Produk
        </a>
        <h2 class="font-space text-3xl font-bold text-white mb-2">EDIT PRODUK</h2>
        <p class="text-slate-400">Update informasi produk "<?php echo e($product->name); ?>"</p>
    </div>

    <?php if(session('error')): ?>
    <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/30 rounded-xl flex items-center gap-3">
        <i class="fas fa-exclamation-circle text-rose-400 text-xl"></i>
        <p class="text-rose-400 font-medium"><?php echo e(session('error')); ?></p>
    </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.products.update', $product)); ?>" 
          method="POST" 
          enctype="multipart/form-data"
          class="space-y-8">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <div class="modern-card p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                    <i class="fas fa-info-circle text-white"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-white">INFORMASI DASAR</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Kategori <span class="text-rose-400">*</span></label>
                    <select name="category_id" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-blue-500/50 transition-all font-space" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->id); ?>" <?php echo e(old('category_id', $product->category_id) == $cat->id ? 'selected' : ''); ?>>
                                <?php echo e($cat->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-rose-400 text-xs mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Kondisi <span class="text-rose-400">*</span></label>
                    <select name="condition" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-blue-500/50 transition-all font-space" required>
                        <option value="new" <?php echo e(old('condition', $product->condition) == 'new' ? 'selected' : ''); ?>>Baru (New)</option>
                        <option value="used" <?php echo e(old('condition', $product->condition) == 'used' ? 'selected' : ''); ?>>Bekas (Used)</option>
                    </select>
                    <?php $__errorArgs = ['condition'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-rose-400 text-xs mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-300 mb-2">Nama Produk <span class="text-rose-400">*</span></label>
                    <input type="text" name="name" id="productName" value="<?php echo e(old('name', $product->name)); ?>" placeholder="Contoh: Samsung Galaxy S25 Ultra" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-blue-500/50 transition-all font-space" required>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-rose-400 text-xs mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Brand <span class="text-rose-400">*</span></label>
                    <input type="text" name="brand" id="productBrand" value="<?php echo e(old('brand', $product->brand)); ?>" placeholder="Contoh: Samsung" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-blue-500/50 transition-all font-space" required>
                    <?php $__errorArgs = ['brand'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-rose-400 text-xs mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Model / Chipset</label>
                    <input type="text" name="model" value="<?php echo e(old('model', $product->model)); ?>" placeholder="Contoh: Snapdragon 8 Elite" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-blue-500/50 transition-all font-space">
                    <?php $__errorArgs = ['model'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-rose-400 text-xs mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-300 mb-2">Slug (URL) <span class="text-rose-400">*</span></label>
                    <input type="text" name="slug" id="productSlug" value="<?php echo e(old('slug', $product->slug)); ?>" placeholder="Contoh: samsung-galaxy-s25-ultra" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-blue-500/50 transition-all font-space font-mono" required>
                    <p class="text-slate-500 text-xs mt-2">Gunakan huruf kecil, angka, dan tanda hubung (-). Jangan diubah jika tidak perlu.</p>
                    <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-rose-400 text-xs mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        
        <div class="modern-card p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-white"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-white">HARGA & STOK</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Harga Normal <span class="text-rose-400">*</span></label>
                    <input type="number" name="price" value="<?php echo e(old('price', $product->price)); ?>" placeholder="21999000" min="0" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500/50 transition-all font-space" required>
                    <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-rose-400 text-xs mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Harga Diskon</label>
                    <input type="number" name="discount_price" value="<?php echo e(old('discount_price', $product->discount_price)); ?>" placeholder="19999000" min="0" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500/50 transition-all font-space">
                    <?php $__errorArgs = ['discount_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-rose-400 text-xs mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Persentase Diskon</label>
                    <input type="number" name="discount_percent" value="<?php echo e(old('discount_percent', $product->discount_percent ?? 0)); ?>" placeholder="8" min="0" max="100" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500/50 transition-all font-space">
                    <?php $__errorArgs = ['discount_percent'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-rose-400 text-xs mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Stok <span class="text-rose-400">*</span></label>
                    <input type="number" name="stock" value="<?php echo e(old('stock', $product->stock)); ?>" placeholder="15" min="0" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500/50 transition-all font-space" required>
                    <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-rose-400 text-xs mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        
        <div class="modern-card p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center">
                    <i class="fas fa-microchip text-white"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-white">SPESIFIKASI TEKNIS</h3>
            </div>

            <div class="space-y-8">
                <div>
                    <h4 class="text-lg font-bold text-blue-400 mb-4 font-space"><i class="fas fa-bolt mr-2"></i>PERFORMA</h4>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Prosesor</label>
                            <input type="text" name="spec[processor]" value="<?php echo e(old('spec.processor', $product->spec->processor ?? '')); ?>" placeholder="Snapdragon 8 Elite" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 transition-all font-space">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">RAM</label>
                            <input type="text" name="spec[ram]" value="<?php echo e(old('spec.ram', $product->spec->ram ?? '')); ?>" placeholder="12GB" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 transition-all font-space">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Penyimpanan</label>
                            <input type="text" name="spec[storage]" value="<?php echo e(old('spec.storage', $product->spec->storage ?? '')); ?>" placeholder="512GB" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 transition-all font-space">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Slot Eksternal</label>
                            <select name="spec[expandable_storage]" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-purple-500/50 transition-all font-space">
                                <option value="N" <?php echo e(old('spec.expandable_storage', $product->spec->expandable_storage ?? 'N') == 'N' ? 'selected' : ''); ?>>Tidak Ada</option>
                                <option value="Y" <?php echo e(old('spec.expandable_storage', $product->spec->expandable_storage ?? 'N') == 'Y' ? 'selected' : ''); ?>>Ada (MicroSD)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-blue-400 mb-4 font-space"><i class="fas fa-desktop mr-2"></i>LAYAR</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Ukuran & Tipe</label>
                            <input type="text" name="spec[display]" value="<?php echo e(old('spec.display', $product->spec->display ?? '')); ?>" placeholder="6.8-inch AMOLED 144Hz" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 transition-all font-space">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Resolusi</label>
                            <input type="text" name="spec[resolution]" value="<?php echo e(old('spec.resolution', $product->spec->resolution ?? '')); ?>" placeholder="2436 x 1080 pixels" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 transition-all font-space">
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-blue-400 mb-4 font-space"><i class="fas fa-camera mr-2"></i>KAMERA</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Kamera Belakang</label>
                            <input type="text" name="spec[camera_rear]" value="<?php echo e(old('spec.camera_rear', $product->spec->camera_rear ?? '')); ?>" placeholder="108MP OIS + 50MP Ultra Wide" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 transition-all font-space">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Kamera Depan</label>
                            <input type="text" name="spec[camera_front]" value="<?php echo e(old('spec.camera_front', $product->spec->camera_front ?? '')); ?>" placeholder="50MP" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 transition-all font-space">
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-blue-400 mb-4 font-space"><i class="fas fa-battery-full mr-2"></i>BATERAI</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Kapasitas</label>
                            <input type="text" name="spec[battery]" value="<?php echo e(old('spec.battery', $product->spec->battery ?? '')); ?>" placeholder="5000mAh" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 transition-all font-space">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Fast Charging</label>
                            <input type="text" name="spec[charging]" value="<?php echo e(old('spec.charging', $product->spec->charging ?? '')); ?>" placeholder="45W Fast Charging" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 transition-all font-space">
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-blue-400 mb-4 font-space"><i class="fas fa-network-wired mr-2"></i>SISTEM</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Sistem Operasi</label>
                            <input type="text" name="spec[os]" value="<?php echo e(old('spec.os', $product->spec->os ?? '')); ?>" placeholder="Android 14" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 transition-all font-space">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Konektivitas</label>
                            <input type="text" name="spec[connectivity]" value="<?php echo e(old('spec.connectivity', $product->spec->connectivity ?? '')); ?>" placeholder="5G, WiFi 6E, Bluetooth 5.3" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 transition-all font-space">
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-blue-400 mb-4 font-space"><i class="fas fa-ruler-combined mr-2"></i>FISIK</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Dimensi</label>
                            <input type="text" name="spec[dimensions]" value="<?php echo e(old('spec.dimensions', $product->spec->dimensions ?? '')); ?>" placeholder="164.3 x 74.6 x 7.9 mm" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 transition-all font-space">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Warna</label>
                            <input type="text" name="spec[colors]" value="<?php echo e(old('spec.colors', $product->spec->colors ?? '')); ?>" placeholder="Rock Black, Violet Garden" class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 transition-all font-space">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Spesifikasi Lainnya</label>
                    <textarea name="spec[other_specs]" rows="3" placeholder="GoPro Mode, JBL Speaker, IP68, dll..." class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 transition-all font-space resize-none"><?php echo e(old('spec.other_specs', $product->spec->other_specs ?? '')); ?></textarea>
                </div>
            </div>
        </div>

        
        <div class="modern-card p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center">
                    <i class="fas fa-align-left text-white"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-white">DESKRIPSI & GAMBAR</h3>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Deskripsi Produk</label>
                    <textarea name="description" rows="4" placeholder="Deskripsi lengkap produk..." class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-amber-500/50 transition-all font-space resize-none"><?php echo e(old('description', $product->description)); ?></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Filosofi Produk</label>
                    <textarea name="philosophy" rows="3" placeholder="Filosofi atau nilai unik..." class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-amber-500/50 transition-all font-space resize-none"><?php echo e(old('philosophy', $product->philosophy)); ?></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Upload Gambar (opsional)</label>
                    <input type="file" name="image" id="imageInput" accept="image/*" class="hidden" onchange="previewImage(this)">
                    <label for="imageInput" class="flex-1 px-5 py-12 bg-slate-800/30 border-2 border-dashed border-slate-700/50 rounded-xl text-center cursor-pointer hover:border-blue-500/50 transition-all group block">
                        <div id="imagePreview" class="hidden">
                            <img src="" alt="Preview" class="max-h-64 mx-auto rounded-xl">
                        </div>
                        <div id="uploadPlaceholder">
                            <i class="fas fa-cloud-upload-alt text-5xl text-slate-400 group-hover:text-blue-400 transition-colors mb-3"></i>
                            <p class="text-slate-400 font-space">Klik untuk upload gambar baru</p>
                            <p class="text-slate-500 text-xs mt-1 font-space">PNG, JPG, GIF (Max 2MB)</p>
                        </div>
                    </label>
                    <?php if($product->image): ?>
                    <div class="mt-4">
                        <p class="text-slate-400 text-sm mb-2">Gambar saat ini:</p>
                        <img src="<?php echo e(asset('product/' . strtolower($product->brand) . '/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-48 object-contain rounded-xl bg-slate-900/50 p-4">
                    </div>
                    <?php endif; ?>
                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-rose-400 text-xs mt-2 font-space"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        
        <div class="modern-card p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-rose-500 to-rose-600 flex items-center justify-center">
                    <i class="fas fa-toggle-on text-white"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-white">STATUS & FLAG PRODUK</h3>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Status Produk <span class="text-rose-400">*</span></label>
                    <div class="flex gap-4">
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="is_active" value="Y" <?php echo e(old('is_active', $product->is_active) === 'Y' ? 'checked' : ''); ?> class="peer sr-only">
                            <div class="px-5 py-4 bg-slate-800/50 border border-slate-700/50 rounded-xl text-center transition-all peer-checked:bg-emerald-500/20 peer-checked:border-emerald-500/50">
                                <i class="fas fa-check-circle text-emerald-400 text-2xl mb-1"></i>
                                <p class="text-white font-space font-bold">Aktif</p>
                            </div>
                        </label>
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="is_active" value="N" <?php echo e(old('is_active', $product->is_active) === 'N' ? 'checked' : ''); ?> class="peer sr-only">
                            <div class="px-5 py-4 bg-slate-800/50 border border-slate-700/50 rounded-xl text-center transition-all peer-checked:bg-rose-500/20 peer-checked:border-rose-500/50">
                                <i class="fas fa-times-circle text-rose-400 text-2xl mb-1"></i>
                                <p class="text-white font-space font-bold">Nonaktif</p>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    
                    <label class="cursor-pointer">
                        <input type="hidden" name="is_featured" value="N">
                        <input type="checkbox" name="is_featured" value="Y" <?php echo e(old('is_featured', $product->is_featured) === 'Y' ? 'checked' : ''); ?> class="peer sr-only">
                        <div class="px-5 py-4 bg-slate-800/50 border border-slate-700/50 rounded-xl text-center transition-all peer-checked:bg-yellow-500/20 peer-checked:border-yellow-500/50">
                            <i class="fas fa-star text-yellow-400 text-2xl mb-1"></i>
                            <p class="text-white font-space font-bold">Featured</p>
                            <p class="text-xs text-slate-400">Produk unggulan</p>
                        </div>
                    </label>

                    
                    <label class="cursor-pointer">
                        <input type="hidden" name="is_hot_deal" value="N">
                        <input type="checkbox" name="is_hot_deal" value="Y" <?php echo e(old('is_hot_deal', $product->is_hot_deal) === 'Y' ? 'checked' : ''); ?> class="peer sr-only">
                        <div class="px-5 py-4 bg-slate-800/50 border border-slate-700/50 rounded-xl text-center transition-all peer-checked:bg-orange-500/20 peer-checked:border-orange-500/50">
                            <i class="fas fa-fire text-orange-400 text-2xl mb-1"></i>
                            <p class="text-white font-space font-bold">Hot Deal</p>
                            <p class="text-xs text-slate-400">Promo spesial</p>
                        </div>
                    </label>

                    
                    <label class="cursor-pointer">
                        <input type="hidden" name="is_gaming" value="N">
                        <input type="checkbox" name="is_gaming" value="Y" <?php echo e(old('is_gaming', $product->is_gaming) === 'Y' ? 'checked' : ''); ?> class="peer sr-only">
                        <div class="px-5 py-4 bg-slate-800/50 border border-slate-700/50 rounded-xl text-center transition-all peer-checked:bg-purple-500/20 peer-checked:border-purple-500/50">
                            <i class="fas fa-gamepad text-purple-400 text-2xl mb-1"></i>
                            <p class="text-white font-space font-bold">Gaming</p>
                            <p class="text-xs text-slate-400">Khusus gaming</p>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        
        <div class="flex items-center justify-end gap-4">
            <a href="<?php echo e(route('admin.products.index')); ?>" class="px-6 py-3 bg-slate-700/50 hover:bg-slate-600/50 text-slate-300 rounded-xl transition-all font-space font-semibold">
                Batal
            </a>
            <button type="submit" class="btn-modern px-8 py-3 rounded-xl font-space font-semibold flex items-center gap-3">
                <i class="fas fa-save text-xl"></i>
                UPDATE PRODUK
            </button>
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

    // Auto-generate slug
    document.getElementById('productName').addEventListener('input', function() {
        const slugInput = document.getElementById('productSlug');
        const brandInput = document.getElementById('productBrand');
        
        if (!slugInput.value || slugInput.dataset.auto === 'true') {
            const brandSlug = brandInput.value ? brandInput.value.toLowerCase().replace(/[^a-z0-9]+/g, '-') + '-' : '';
            slugInput.value = brandSlug + this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
            slugInput.dataset.auto = 'true';
        }
    });

    document.getElementById('productSlug').addEventListener('input', function() {
        this.dataset.auto = 'false';
    });

    document.getElementById('productBrand').addEventListener('input', function() {
        const slugInput = document.getElementById('productSlug');
        const nameInput = document.getElementById('productName');
        
        if (slugInput.dataset.auto === 'true' || !slugInput.value) {
            const brandSlug = this.value ? this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-') + '-' : '';
            const nameSlug = nameInput.value ? nameInput.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '') : '';
            slugInput.value = brandSlug + nameSlug;
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Praktikum_CMS\resources\views/admin/products/edit.blade.php ENDPATH**/ ?>