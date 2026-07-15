

<?php $__env->startSection('title', 'Pengaturan Website'); ?>
<?php $__env->startSection('page-title', 'PENGATURAN WEBSITE'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto animate-fade-in space-y-8">

    
    <div class="mb-8">
        <h2 class="font-space text-3xl font-bold text-white mb-2">Pengaturan Website</h2>
        <p class="text-slate-400">Kelola konten halaman beranda, katalog, dan kontak</p>
    </div>

    
    <?php if(session('success')): ?>
    <div class="modern-card p-4 border-l-4 border-green-500 bg-green-500/10">
        <div class="flex items-center gap-3">
            <i class="fas fa-check-circle text-green-400 text-xl"></i>
            <p class="text-green-400 font-medium"><?php echo e(session('success')); ?></p>
        </div>
    </div>
    <?php endif; ?>

    
    <form action="<?php echo e(route('admin.settings.site.update')); ?>" method="POST" enctype="multipart/form-data" class="space-y-8">
        <?php echo csrf_field(); ?>

        
        <div class="modern-card p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                    <i class="fas fa-image text-white"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-white">Logo & Branding</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Upload Logo</label>
                    <?php if($settings && $settings->logo): ?>
                        <img src="<?php echo e(asset($settings->logo)); ?>" alt="Current Logo" class="w-full h-32 object-contain mb-3 bg-white rounded-lg p-2">
                    <?php endif; ?>
                    <input type="file" name="logo" accept="image/*"
                           class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-500/20 file:text-blue-400 hover:file:bg-blue-500/30">
                    <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-xs mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Teks Logo</label>
                    <input type="text" name="logo_text" 
                           value="<?php echo e(old('logo_text', $settings->logo_text ?? 'ASIAPHONE')); ?>"
                           class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all"
                           required>
                    <?php $__errorArgs = ['logo_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-xs mt-2"><?php echo e($message); ?></p>
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
                    <i class="fas fa-home text-white"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-white">Hero Section (Beranda)</h3>
            </div>

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Label Hero</label>
                        <input type="text" name="hero_label" 
                               value="<?php echo e(old('hero_label', $settings->hero_label ?? 'Premium Smartphone Collection')); ?>"
                               class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-purple-500/50 focus:ring-2 focus:ring-purple-500/20 transition-all"
                               required>
                        <?php $__errorArgs = ['hero_label'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-400 text-xs mt-2"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Judul Hero</label>
                        <input type="text" name="hero_title" 
                               value="<?php echo e(old('hero_title', $settings->hero_title ?? 'Temukan Smartphone Impian Anda')); ?>"
                               class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-purple-500/50 focus:ring-2 focus:ring-purple-500/20 transition-all"
                               required>
                        <?php $__errorArgs = ['hero_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-400 text-xs mt-2"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Deskripsi Hero</label>
                    <textarea name="hero_description" rows="3"
                              class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-purple-500/50 focus:ring-2 focus:ring-purple-500/20 transition-all resize-none"
                              required><?php echo e(old('hero_description', $settings->hero_description ?? '')); ?></textarea>
                    <?php $__errorArgs = ['hero_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-xs mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Upload Gambar Hero</label>
                    <?php if($settings && $settings->hero_image): ?>
                        <img src="<?php echo e(asset($settings->hero_image)); ?>" alt="Hero Image" class="w-full h-64 object-contain mb-3 bg-slate-900 rounded-lg p-4">
                    <?php endif; ?>
                    <input type="file" name="hero_image" accept="image/*"
                           class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-purple-500/20 file:text-purple-400 hover:file:bg-purple-500/30">
                    <?php $__errorArgs = ['hero_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-xs mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        
        <div class="modern-card p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center">
                    <i class="fas fa-info-circle text-white"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-white">Tentang & Visi</h3>
            </div>

            <div class="space-y-6">
                
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Tentang Toko</label>
                    <textarea name="about_store" rows="4"
                              class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-green-500/50 focus:ring-2 focus:ring-green-500/20 transition-all resize-none"
                              required><?php echo e(old('about_store', $settings->about_store ?? '')); ?></textarea>
                    <?php $__errorArgs = ['about_store'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-xs mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Visi</label>
                    <textarea name="vision" rows="2"
                              class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-green-500/50 focus:ring-2 focus:ring-green-500/20 transition-all resize-none"
                              required><?php echo e(old('vision', $settings->vision ?? '')); ?></textarea>
                    <?php $__errorArgs = ['vision'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-xs mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Misi (Opsional)</label>
                    <textarea name="mission" rows="2"
                              class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-green-500/50 focus:ring-2 focus:ring-green-500/20 transition-all resize-none"><?php echo e(old('mission', $settings->mission ?? '')); ?></textarea>
                    <?php $__errorArgs = ['mission'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-xs mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        
        <div class="modern-card p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center">
                    <i class="fas fa-th-large text-white"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-white">Banner Katalog</h3>
            </div>

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Judul Banner</label>
                        <input type="text" name="catalog_title" 
                               value="<?php echo e(old('catalog_title', $settings->catalog_title ?? 'Galaxy S24 Ultra')); ?>"
                               class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-orange-500/50 focus:ring-2 focus:ring-orange-500/20 transition-all"
                               required>
                        <?php $__errorArgs = ['catalog_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-400 text-xs mt-2"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Upload Banner</label>
                        <?php if($settings && $settings->catalog_banner): ?>
                            <img src="<?php echo e(asset($settings->catalog_banner)); ?>" alt="Banner" class="w-full h-32 object-cover mb-3 rounded-lg">
                        <?php endif; ?>
                        <input type="file" name="catalog_banner" accept="image/*"
                               class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-orange-500/20 file:text-orange-400 hover:file:bg-orange-500/30">
                        <?php $__errorArgs = ['catalog_banner'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-400 text-xs mt-2"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Deskripsi Banner</label>
                    <textarea name="catalog_description" rows="3"
                              class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-orange-500/50 focus:ring-2 focus:ring-orange-500/20 transition-all resize-none"
                              required><?php echo e(old('catalog_description', $settings->catalog_description ?? '')); ?></textarea>
                    <?php $__errorArgs = ['catalog_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-xs mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        
        <div class="modern-card p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center">
                    <i class="fas fa-envelope text-white"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-white">Informasi Kontak</h3>
            </div>

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Subtitle Kontak</label>
                        <input type="text" name="contact_subtitle" 
                               value="<?php echo e(old('contact_subtitle', $settings->contact_subtitle ?? 'CUSTOMER SERVICE')); ?>"
                               class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-red-500/50 focus:ring-2 focus:ring-red-500/20 transition-all"
                               required>
                        <?php $__errorArgs = ['contact_subtitle'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-400 text-xs mt-2"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Judul Kontak</label>
                        <input type="text" name="contact_title" 
                               value="<?php echo e(old('contact_title', $settings->contact_title ?? 'Hubungi Kami')); ?>"
                               class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-red-500/50 focus:ring-2 focus:ring-red-500/20 transition-all"
                               required>
                        <?php $__errorArgs = ['contact_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-400 text-xs mt-2"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Deskripsi Kontak</label>
                    <textarea name="contact_description" rows="2"
                              class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-red-500/50 focus:ring-2 focus:ring-red-500/20 transition-all resize-none"
                              required><?php echo e(old('contact_description', $settings->contact_description ?? '')); ?></textarea>
                    <?php $__errorArgs = ['contact_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-xs mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="p-6 bg-slate-800/30 rounded-xl border border-slate-700/30">
                    <h4 class="font-space font-bold text-white mb-4 flex items-center gap-2">
                        <i class="fas fa-map-marker-alt text-blue-400"></i>
                        Jakarta Hub
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Judul</label>
                            <input type="text" name="contact_jakarta_title" 
                                   value="<?php echo e(old('contact_jakarta_title', $settings->contact_jakarta_title ?? 'JAKARTA HUB')); ?>"
                                   class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-blue-500/50 transition-all"
                                   required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Telepon</label>
                            <input type="text" name="contact_jakarta_phone" 
                                   value="<?php echo e(old('contact_jakarta_phone', $settings->contact_jakarta_phone ?? '+62 21 5000 8888')); ?>"
                                   class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-blue-500/50 transition-all"
                                   required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-300 mb-2">Alamat</label>
                            <textarea name="contact_jakarta_address" rows="2"
                                      class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-blue-500/50 transition-all resize-none"
                                      required><?php echo e(old('contact_jakarta_address', $settings->contact_jakarta_address ?? '')); ?></textarea>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-300 mb-2">Jam Operasional</label>
                            <input type="text" name="contact_jakarta_hours" 
                                   value="<?php echo e(old('contact_jakarta_hours', $settings->contact_jakarta_hours ?? '09:00 - 18:00 WIB')); ?>"
                                   class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-blue-500/50 transition-all"
                                   required>
                        </div>
                    </div>
                </div>

                
                <div class="p-6 bg-slate-800/30 rounded-xl border border-slate-700/30">
                    <h4 class="font-space font-bold text-white mb-4 flex items-center gap-2">
                        <i class="fas fa-map-marker-alt text-purple-400"></i>
                        Surabaya Gallery
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Judul</label>
                            <input type="text" name="contact_surabaya_title" 
                                   value="<?php echo e(old('contact_surabaya_title', $settings->contact_surabaya_title ?? 'SURABAYA GALLERY')); ?>"
                                   class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-purple-500/50 transition-all"
                                   required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Telepon</label>
                            <input type="text" name="contact_surabaya_phone" 
                                   value="<?php echo e(old('contact_surabaya_phone', $settings->contact_surabaya_phone ?? '+62 31 7000 9999')); ?>"
                                   class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-purple-500/50 transition-all"
                                   required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-300 mb-2">Alamat</label>
                            <textarea name="contact_surabaya_address" rows="2"
                                      class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-purple-500/50 transition-all resize-none"
                                      required><?php echo e(old('contact_surabaya_address', $settings->contact_surabaya_address ?? '')); ?></textarea>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-300 mb-2">Jam Operasional</label>
                            <input type="text" name="contact_surabaya_hours" 
                                   value="<?php echo e(old('contact_surabaya_hours', $settings->contact_surabaya_hours ?? '10:00 - 17:00 WIB')); ?>"
                                   class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-purple-500/50 transition-all"
                                   required>
                        </div>
                    </div>
                </div>

                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Email Support</label>
                        <input type="email" name="contact_email_1" 
                               value="<?php echo e(old('contact_email_1', $settings->contact_email_1 ?? 'support@asiaphone.com')); ?>"
                               class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-red-500/50 transition-all"
                               required>
                        <?php $__errorArgs = ['contact_email_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-400 text-xs mt-2"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Email Info</label>
                        <input type="email" name="contact_email_2" 
                               value="<?php echo e(old('contact_email_2', $settings->contact_email_2 ?? 'info@asiaphone.com')); ?>"
                               class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-red-500/50 transition-all"
                               required>
                        <?php $__errorArgs = ['contact_email_2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-400 text-xs mt-2"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                
                <div class="p-6 bg-slate-800/30 rounded-xl border border-slate-700/30">
                    <h4 class="font-space font-bold text-white mb-4 flex items-center gap-2">
                        <i class="fas fa-quote-left text-amber-400"></i>
                        Quote Reservasi
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Judul Quote</label>
                            <input type="text" name="contact_quote_title" 
                                   value="<?php echo e(old('contact_quote_title', $settings->contact_quote_title ?? 'RESERVASI KHUSUS')); ?>"
                                   class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-amber-500/50 transition-all"
                                   required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-300 mb-2">Teks Quote</label>
                            <textarea name="contact_quote_text" rows="2"
                                      class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-amber-500/50 transition-all resize-none"
                                      required><?php echo e(old('contact_quote_text', $settings->contact_quote_text ?? '')); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="modern-card p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-gray-500 to-gray-600 flex items-center justify-center">
                    <i class="fas fa-copyright text-white"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-white">Footer</h3>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Teks Footer</label>
                    <textarea name="footer_text" rows="2"
                              class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-gray-500/50 focus:ring-2 focus:ring-gray-500/20 transition-all resize-none"
                              required><?php echo e(old('footer_text', $settings->footer_text ?? '')); ?></textarea>
                    <?php $__errorArgs = ['footer_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-xs mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Copyright</label>
                    <input type="text" name="copyright" 
                           value="<?php echo e(old('copyright', $settings->copyright ?? '© 2026 ASIAPHONE. All Rights Reserved.')); ?>"
                           class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-gray-500/50 focus:ring-2 focus:ring-gray-500/20 transition-all"
                           required>
                    <?php $__errorArgs = ['copyright'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-xs mt-2"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        
        <div class="flex items-center justify-end gap-4">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="px-6 py-3 bg-slate-700/50 hover:bg-slate-600/50 text-slate-300 rounded-xl transition-all font-medium font-space">
                Batal
            </a>
            <button type="submit" class="btn-modern px-8 py-3 rounded-xl font-medium font-space">
                <i class="fas fa-save mr-2"></i>
                Simpan Pengaturan
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Praktikum_CMS\resources\views/admin/settings/site.blade.php ENDPATH**/ ?>