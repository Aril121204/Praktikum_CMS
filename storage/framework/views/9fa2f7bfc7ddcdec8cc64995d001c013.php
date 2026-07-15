<aside id="sidebar" class="bg-dark-800 border-r border-dark-700 w-64 flex-shrink-0 flex flex-col transition-all duration-300 lg:translate-x-0 -translate-x-full fixed lg:static inset-y-0 left-0 z-30">
    
    <!-- Logo Area -->
    <div class="h-16 flex items-center px-6 border-b border-dark-700">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-white font-bold font-display">
                A
            </div>
            <span class="font-display font-bold text-xl text-white tracking-tight">ASIAPHONE</span>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-1">
        
        <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Menu Utama</p>
        
        <a href="<?php echo e(route('admin.dashboard')); ?>" 
           class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
            <i class="fas fa-tachometer-alt w-5 text-center"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mt-6 mb-2">Manajemen Konten</p>

        <a href="<?php echo e(route('admin.products.index')); ?>" 
           class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 <?php echo e(request()->routeIs('admin.products.*') ? 'active' : ''); ?>">
            <i class="fas fa-mobile-alt w-5 text-center"></i>
            <span class="font-medium">Produk</span>
        </a>

        <a href="<?php echo e(route('admin.categories.index')); ?>" 
           class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 <?php echo e(request()->routeIs('admin.categories.*') ? 'active' : ''); ?>">
            <i class="fas fa-tags w-5 text-center"></i>
            <span class="font-medium">Kategori / Brand</span>
        </a>

        <a href="<?php echo e(route('admin.contacts.index')); ?>" 
           class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 <?php echo e(request()->routeIs('admin.contacts.*') ? 'active' : ''); ?>">
            <i class="fas fa-envelope w-5 text-center"></i>
            <span class="font-medium">Pesan Masuk</span>
            <?php
                $unreadCount = \App\Models\Contact::where('is_read', 'N')->count();
            ?>
            <?php if($unreadCount > 0): ?>
                <span class="ml-auto bg-rose-500 text-white text-xs font-bold px-2 py-0.5 rounded-full"><?php echo e($unreadCount); ?></span>
            <?php endif; ?>
        </a>

        <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mt-6 mb-2">Pengaturan</p>

        <a href="<?php echo e(route('admin.settings.edit')); ?>" 
           class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-300 <?php echo e(request()->routeIs('admin.settings.*') ? 'active' : ''); ?>">
            <i class="fas fa-cog w-5 text-center"></i>
            <span class="font-medium">Site Settings</span>
        </a>

    </nav>

    <!-- Logout Area -->
    <div class="p-4 border-t border-dark-700">
        <form action="<?php echo e(route('admin.logout')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 transition-colors">
                <i class="fas fa-sign-out-alt w-5 text-center"></i>
                <span class="font-medium">Logout</span>
            </button>
        </form>
    </div>
</aside>

<!-- Overlay for mobile sidebar -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-20 hidden lg:hidden"></div>

<script>
    // Simple script to toggle sidebar on mobile
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');
        const overlay = document.getElementById('sidebarOverlay');

        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            });
        }

        if (overlay) {
            overlay.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            });
        }
    });
</script><?php /**PATH C:\xampp\htdocs\Praktikum_CMS\resources\views/admin/layouts/sidebar.blade.php ENDPATH**/ ?>