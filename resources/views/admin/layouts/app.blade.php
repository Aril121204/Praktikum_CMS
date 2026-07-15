<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Admin Panel</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'jakarta': ['Plus Jakarta Sans', 'sans-serif'],
                        'space': ['Space Grotesk', 'sans-serif'],
                    },
                    colors: {
                        // Modern Slate Color Palette
                        'slate-50': '#f8fafc',
                        'slate-100': '#f1f5f9',
                        'slate-200': '#e2e8f0',
                        'slate-300': '#cbd5e1',
                        'slate-400': '#94a3b8',
                        'slate-500': '#64748b',
                        'slate-600': '#475569',
                        'slate-700': '#334155',
                        'slate-800': '#1e293b',
                        'slate-900': '#0f172a',
                        'slate-950': '#020617',
                        
                        // Accent Colors (Modern & Elegant)
                        'accent': '#3b82f6',
                        'accent-dark': '#2563eb',
                        'success': '#10b981',
                        'warning': '#f59e0b',
                        'danger': '#ef4444',
                        
                        // Background
                        'bg-dark': '#0f172a',
                        'bg-card': '#1e293b',
                        'bg-sidebar': '#0b1120',
                    },
                    boxShadow: {
                        'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
                        'modern': '0 4px 20px rgba(0, 0, 0, 0.08)',
                        'glow': '0 0 20px rgba(59, 130, 246, 0.15)',
                    }
                }
            }
        }
    </script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #0f172a;
            color: #e2e8f0;
            overflow-x: hidden;
        }

        /* Modern Sidebar */
        .sidebar {
            background: linear-gradient(180deg, #0b1120 0%, #0f172a 100%);
            border-right: 1px solid rgba(148, 163, 184, 0.1);
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.15);
        }

        .sidebar-link {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .sidebar-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: linear-gradient(180deg, #3b82f6, #60a5fa);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .sidebar-link:hover::before,
        .sidebar-link.active::before {
            transform: scaleY(1);
        }

        .sidebar-link:hover {
            background: rgba(59, 130, 246, 0.08);
            padding-left: 28px;
            color: #60a5fa;
        }

        .sidebar-link.active {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.15), transparent);
            color: #60a5fa;
        }

        /* Modern Card */
        .modern-card {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.8) 0%, rgba(15, 23, 42, 0.9) 100%);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(148, 163, 184, 0.1);
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .modern-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            border-color: rgba(148, 163, 184, 0.2);
        }

        /* Modern Button */
        .btn-modern {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #0f172a;
        }

        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        /* Badge */
        .badge-modern {
            background: rgba(59, 130, 246, 0.15);
            border: 1px solid rgba(59, 130, 246, 0.3);
            color: #60a5fa;
        }

        /* Top Bar */
        .top-bar {
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(148, 163, 184, 0.1);
        }
    </style>
</head>
<body class="font-jakarta antialiased">

    <div class="flex h-screen overflow-hidden bg-slate-950">

        <!-- ============================================
             SIDEBAR
             ============================================ -->
        <aside class="sidebar w-72 hidden md:flex flex-col">
            
            <!-- Logo & Brand -->
            <div class="h-20 flex items-center px-8 border-b border-slate-700/30">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg shadow-blue-500/30">
                        <i class="fas fa-shield-alt text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="font-space font-bold text-white text-lg tracking-tight">ADMIN PANEL</h1>
                        <p class="text-xs text-slate-400 font-medium">Management System</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 overflow-y-auto py-6 px-4">
                
                <!-- Menu Utama -->
                <div class="mb-6">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3 px-4 font-space">MENU UTAMA</p>
                    
                    <a href="{{ route('admin.dashboard') }}"
                       class="sidebar-link flex items-center gap-4 px-4 py-3.5 text-slate-300 rounded-xl mb-2 font-medium {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home w-5 text-lg"></i>
                        <span>Dashboard</span>
                        @if(request()->routeIs('admin.dashboard'))
                            <span class="ml-auto w-2 h-2 bg-blue-400 rounded-full"></span>
                        @endif
                    </a>
                </div>

                <!-- Konten -->
                <div class="mb-6">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3 px-4 font-space">KONTEN</p>
                    
                    {{-- Menu Kategori --}}
                    <a href="{{ route('admin.categories.index') }}"
                       class="sidebar-link flex items-center gap-4 px-4 py-3.5 text-slate-300 rounded-xl mb-2 font-medium {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="fas fa-tags w-5 text-lg"></i>
                        <span>Kategori</span>
                        @php
                            $totalCategories = \App\Models\Category::count();
                        @endphp
                        @if($totalCategories > 0)
                            <span class="ml-auto badge-modern text-xs font-bold px-2.5 py-1 rounded-full">
                                {{ $totalCategories }}
                            </span>
                        @endif
                    </a>

                    {{-- Menu Produk --}}
                    <a href="{{ route('admin.products.index') }}"
                       class="sidebar-link flex items-center gap-4 px-4 py-3.5 text-slate-300 rounded-xl mb-2 font-medium {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <i class="fas fa-mobile-alt w-5 text-lg"></i>
                        <span>Produk</span>
                        @php
                            $totalProducts = \App\Models\Product::count();
                        @endphp
                        @if($totalProducts > 0)
                            <span class="ml-auto badge-modern text-xs font-bold px-2.5 py-1 rounded-full">
                                {{ $totalProducts }}
                            </span>
                        @endif
                    </a>

                    {{-- Menu Pesan --}}
                    <a href="{{ route('admin.contacts.index') }}"
                       class="sidebar-link flex items-center gap-4 px-4 py-3.5 text-slate-300 rounded-xl mb-2 font-medium {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                        <i class="fas fa-envelope w-5 text-lg"></i>
                        <span>Pesan</span>
                        @php
                            $unreadContacts = \App\Models\Contact::where('is_read', 'N')->count();
                        @endphp
                        @if($unreadContacts > 0)
                            <span class="ml-auto bg-red-500/20 text-red-400 text-xs font-bold px-2.5 py-1 rounded-full border border-red-500/30">
                                {{ $unreadContacts }}
                            </span>
                        @endif
                    </a>
                </div>

                <!-- Pengaturan -->
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3 px-4 font-space">PENGATURAN</p>
                    
                    {{-- Menu Pengaturan Akun --}}
                    <a href="{{ route('admin.settings.profile') }}"
                       class="sidebar-link flex items-center gap-4 px-4 py-3.5 text-slate-300 rounded-xl mb-2 font-medium {{ request()->routeIs('admin.settings.profile') ? 'active' : '' }}">
                        <i class="fas fa-user-cog w-5 text-lg"></i>
                        <span>Pengaturan Akun</span>
                    </a>

                    {{-- Menu Pengaturan Website (BARU!) --}}
                    <a href="{{ route('admin.settings.site') }}"
                       class="sidebar-link flex items-center gap-4 px-4 py-3.5 text-slate-300 rounded-xl mb-2 font-medium {{ request()->routeIs('admin.settings.site') ? 'active' : '' }}">
                        <i class="fas fa-globe w-5 text-lg"></i>
                        <span>Pengaturan Website</span>
                    </a>
                </div>
            </nav>

            <!-- User Profile & Logout -->
            <div class="border-t border-slate-700/30 p-4 bg-gradient-to-t from-slate-900/50 to-transparent">
                
                <!-- User Info -->
                <div class="flex items-center gap-3 mb-4 px-2">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg shadow-blue-500/30">
                        <span class="text-white font-bold font-space">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-white font-space truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-slate-400 truncate">{{ auth()->user()->email ?? 'admin@example.com' }}</p>
                    </div>
                </div>

                {{-- Tombol Logout --}}
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-red-500/10 to-red-600/10 hover:from-red-500/20 hover:to-red-600/20 border border-red-500/30 text-red-400 rounded-xl transition-all font-medium font-space group">
                        <i class="fas fa-sign-out-alt group-hover:-translate-x-1 transition-transform"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- ============================================
             MAIN CONTENT
             ============================================ -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Top Bar -->
            <header class="top-bar h-20 flex items-center justify-between px-8">
                <div class="flex items-center gap-4">
                    <button class="md:hidden text-slate-300 hover:text-white">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h2 class="font-space font-bold text-xl text-white">@yield('page-title', 'Dashboard')</h2>
                </div>
                
                <div class="flex items-center gap-4">
                    {{-- Tanggal --}}
                    <div class="hidden lg:flex items-center gap-2 px-4 py-2 bg-slate-800/50 rounded-xl border border-slate-700/30">
                        <i class="far fa-calendar text-slate-400"></i>
                        <span class="text-sm text-slate-300 font-medium">{{ now()->format('d M Y') }}</span>
                    </div>
                    
                    {{-- Tombol Lihat Website --}}
                    <a href="{{ url('/') }}" target="_blank" 
                       class="hidden sm:flex items-center gap-2 px-4 py-2 bg-slate-800/50 hover:bg-slate-700/50 border border-slate-700/30 rounded-xl text-slate-300 hover:text-white transition-all font-medium font-space text-sm">
                        <i class="fas fa-external-link-alt"></i>
                        <span>Lihat Website</span>
                    </a>
                </div>
            </header>

            {{-- Main Content Area --}}
            <main class="flex-1 overflow-y-auto p-8">
                
                {{-- Alert Success --}}
                @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/30 rounded-xl flex items-center gap-3 animate-fade-in">
                    <i class="fas fa-check-circle text-emerald-400 text-xl"></i>
                    <p class="text-emerald-400 font-medium">{{ session('success') }}</p>
                </div>
                @endif

                {{-- Alert Error --}}
                @if(session('error'))
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/30 rounded-xl flex items-center gap-3 animate-fade-in">
                    <i class="fas fa-exclamation-circle text-red-400 text-xl"></i>
                    <p class="text-red-400 font-medium">{{ session('error') }}</p>
                </div>
                @endif

                {{-- Content dari child view --}}
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>