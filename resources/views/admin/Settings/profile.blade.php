@extends('admin.layouts.app')

@section('title', 'Pengaturan Akun')
@section('page-title', 'PENGATURAN AKUN')

@section('content')
<div class="max-w-4xl mx-auto animate-fade-in space-y-8">

    {{-- Header --}}
    <div class="mb-8">
        <h2 class="font-space text-3xl font-bold text-white mb-2">Pengaturan Akun</h2>
        <p class="text-slate-400">Kelola informasi profil dan keamanan akun Anda</p>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
    <div class="modern-card p-4 border-l-4 border-green-500 bg-green-500/10">
        <div class="flex items-center gap-3">
            <i class="fas fa-check-circle text-green-400 text-xl"></i>
            <p class="text-green-400 font-medium">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    {{-- ============================================
        CARD 1: PROFILE INFORMATION
        ============================================ --}}
    <div class="modern-card p-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                <i class="fas fa-user text-white"></i>
            </div>
            <h3 class="font-space text-xl font-bold text-white">Informasi Profil</h3>
        </div>

        <form action="{{ route('admin.settings.profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Name --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Nama Lengkap</label>
                    <input type="text" 
                           name="name" 
                           value="{{ old('name', auth()->user()->name) }}"
                           class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all"
                           required>
                    @error('name')
                        <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Email</label>
                    <input type="email" 
                           name="email" 
                           value="{{ old('email', auth()->user()->email) }}"
                           class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/20 transition-all"
                           required>
                    @error('email')
                        <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 pt-4 border-t border-slate-700/30">
                <button type="submit" class="btn-modern px-6 py-3 rounded-xl font-medium font-space">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    {{-- ============================================
        CARD 2: CHANGE PASSWORD
        ============================================ --}}
    <div class="modern-card p-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center">
                <i class="fas fa-lock text-white"></i>
            </div>
            <h3 class="font-space text-xl font-bold text-white">Ubah Password</h3>
        </div>

        <form action="{{ route('admin.settings.password.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                {{-- Current Password --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Password Saat Ini</label>
                    <input type="password" 
                           name="current_password" 
                           class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 focus:ring-2 focus:ring-purple-500/20 transition-all"
                           required>
                    @error('current_password')
                        <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- New Password --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Password Baru</label>
                        <input type="password" 
                               name="password" 
                               class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 focus:ring-2 focus:ring-purple-500/20 transition-all"
                               required>
                        @error('password')
                            <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Konfirmasi Password Baru</label>
                        <input type="password" 
                               name="password_confirmation" 
                               class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 focus:ring-2 focus:ring-purple-500/20 transition-all"
                               required>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 pt-4 border-t border-slate-700/30">
                <button type="submit" class="btn-modern px-6 py-3 rounded-xl font-medium font-space bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700">
                    <i class="fas fa-key mr-2"></i>
                    Ubah Password
                </button>
            </div>
        </form>
    </div>

    {{-- ============================================
        CARD 3: ACCOUNT INFO
        ============================================ --}}
    <div class="modern-card p-8">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center">
                <i class="fas fa-info-circle text-white"></i>
            </div>
            <h3 class="font-space text-xl font-bold text-white">Informasi Akun</h3>
        </div>

        <div class="space-y-4">
            <div class="flex items-center justify-between py-3 px-4 bg-slate-800/30 rounded-xl">
                <span class="text-slate-400">Role</span>
                <span class="badge-modern px-3 py-1 rounded-full text-sm font-medium">
                    {{ auth()->user()->role ?? 'Admin' }}
                </span>
            </div>

            <div class="flex items-center justify-between py-3 px-4 bg-slate-800/30 rounded-xl">
                <span class="text-slate-400">Terdaftar Sejak</span>
                <span class="text-white font-medium">
                    {{ auth()->user()->created_at ? auth()->user()->created_at->format('d M Y') : '-' }}
                </span>
            </div>

            <div class="flex items-center justify-between py-3 px-4 bg-slate-800/30 rounded-xl">
                <span class="text-slate-400">Terakhir Login</span>
                <span class="text-white font-medium">
                    {{ auth()->user()->last_login_at ? auth()->user()->last_login_at->format('d M Y, H:i') : 'Pertama kali' }}
                </span>
            </div>
        </div>
    </div>
</div>
@endsection