@extends('layouts.frontend')

@section('title', 'Hubungi Kami - AsiaPhone')

@section('content')

<style>
    :root {
        --glass-border: rgba(255, 255, 255, 0.1);
        --titanium-silver: #c8c6c8;
        --primary-glow: rgba(200, 198, 200, 0.4);
    }

    body {
        background-color: #0e0e0e;
        color: #e5e2e1;
        overflow-x: hidden;
        font-family: 'Inter', sans-serif;
    }

    .tech-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        background: url('https://lh3.googleusercontent.com/aida/AP1WRLvxYNyxzcfYvUaoGPZOiQEPk55GMzkDj-69YwQFSFVlwsETQD0norSdVXDvvT_awQxPYHrvfEU7BKCWK0SNUX-2uPOTEL41mQiBc5FKIA_aMWAFkjyJZDZbfyC4F4YcxjY1HlyPqqDSIDORyiIB3HJLr3L0Tc3eOFBqDxMCjj5v5jBosDeLoKI3iEZy_TQ4ddxn800JYNzVG5RZRmumZ7U8g_G3wFoWeT-8LgfGV4Lg0O8teZ9rzXBySA') no-repeat center center;
        background-size: cover;
        opacity: 0.6;
    }

    .tech-bg::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 50% 50%, transparent 0%, rgba(14, 13, 13, 0.8) 100%);
    }

    .glass-panel {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(40px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        transition: all 500ms cubic-bezier(0.22, 1, 0.36, 1);
    }

    .glass-panel:hover {
        background: rgba(255, 255, 255, 0.07);
        border-color: var(--primary-glow);
        box-shadow: 0 0 30px rgba(200, 198, 200, 0.1);
        transform: translateY(-4px);
    }

    .input-field {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .input-field:focus {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(200, 198, 200, 0.5);
        box-shadow: 0 0 20px rgba(200, 198, 200, 0.2);
        outline: none;
    }

    .btn-submit {
        background: linear-gradient(135deg, #c8c6c8 0%, #a8a6a8 100%);
        color: #0e0e0e;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s;
    }

    .btn-submit:hover::before {
        left: 100%;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(200, 198, 200, 0.3);
    }

    .scroll-reveal {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s ease-out;
    }

    .scroll-reveal.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .alert-success {
        animation: slideInRight 0.5s ease-out;
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(100px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>

<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                "colors": {
                    "primary": "#c8c6c8",
                    "on-secondary": "#2f3131",
                    "surface-container": "#201f1f",
                    "outline": "#919095",
                    "on-background": "#e5e2e1",
                    "surface": "#141313",
                    "background": "#141313",
                    "on-surface": "#e5e2e1",
                    "on-surface-variant": "#c8c5ca"
                },
                "borderRadius": {
                    "DEFAULT": "0.125rem",
                    "lg": "0.25rem",
                    "xl": "0.5rem",
                    "full": "0.75rem"
                },
                "spacing": {
                    "margin-desktop": "64px",
                    "container-max-width": "1280px",
                    "gutter": "24px"
                },
                "fontFamily": {
                    "label-caps": ["Inter"],
                    "h1": ["Montserrat"],
                    "body-md": ["Inter"],
                    "h3": ["Montserrat"],
                    "h2": ["Montserrat"]
                }
            },
        },
    }
</script>

<div class="tech-bg"></div>

<main class="max-w-[1280px] mx-auto px-margin-desktop pt-44 pb-32">

    {{-- Header Section --}}
    <header class="text-center mb-20 flex flex-col items-center gap-4 scroll-reveal">
        <span class="font-label-caps text-xs tracking-[0.4em] text-primary uppercase font-bold">Customer Service</span>
        <h1 class="font-h1 text-5xl md:text-7xl text-on-surface font-extrabold tracking-tight uppercase italic">
            Hubungi Kami
        </h1>
        <p class="text-xl text-on-surface-variant max-w-2xl leading-relaxed font-light">
            Dedikasi kami melampaui sekadar transaksi. Temukan pengalaman layanan personal yang dirancang khusus untuk memenuhi standar eksklusivitas Anda.
        </p>
    </header>

    {{-- Success/Error Alerts --}}
    @if(session('success'))
    <div class="max-w-3xl mx-auto mb-8 alert-success glass-panel p-6 rounded-2xl border border-emerald-500/30 bg-emerald-500/10 flex items-start gap-4">
        <div class="w-12 h-12 rounded-full bg-emerald-500/20 flex items-center justify-center flex-shrink-0">
            <i class="fas fa-check-circle text-emerald-400 text-2xl"></i>
        </div>
        <div class="flex-1">
            <h4 class="text-white font-semibold mb-1">Pesan Terkirim!</h4>
            <p class="text-emerald-200 text-sm">{{ session('success') }}</p>
        </div>
        <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-white transition-colors">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="max-w-3xl mx-auto mb-8 alert-success glass-panel p-6 rounded-2xl border border-rose-500/30 bg-rose-500/10 flex items-start gap-4">
        <div class="w-12 h-12 rounded-full bg-rose-500/20 flex items-center justify-center flex-shrink-0">
            <i class="fas fa-exclamation-circle text-rose-400 text-2xl"></i>
        </div>
        <div class="flex-1">
            <h4 class="text-white font-semibold mb-1">Terjadi Kesalahan</h4>
            <p class="text-rose-200 text-sm">{{ session('error') }}</p>
        </div>
        <button onclick="this.parentElement.remove()" class="text-rose-400 hover:text-white transition-colors">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    {{-- Contact Form & Info Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start mb-20">

        {{-- Contact Form --}}
        <section class="glass-panel p-8 md:p-12 rounded-3xl transition-all duration-700 ease-out scroll-reveal">
            <div class="mb-8">
                <h2 class="font-h3 text-3xl text-on-surface font-bold mb-3">Kirim Pesan</h2>
                <p class="text-on-surface-variant text-sm">Isi form di bawah dan tim kami akan segera merespon.</p>
            </div>

            <form action="{{ route('contact.submit') }}" method="POST" class="flex flex-col gap-6">
                @csrf

                {{-- Nama Lengkap --}}
                <div class="group">
                    <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2 transition-colors group-focus-within:text-primary">
                        NAMA LENGKAP <span class="text-rose-400">*</span>
                    </label>
                    <input
                        name="name"
                        value="{{ old('name') }}"
                        class="input-field w-full bg-transparent border-0 border-b border-outline-variant py-3 px-0 text-on-surface placeholder:text-surface-variant focus:ring-0 focus:border-primary transition-all duration-400 @error('name') border-rose-500 @enderror"
                        placeholder="Masukkan nama Anda"
                        type="text"
                        required />
                    @error('name')
                        <p class="text-rose-400 text-xs mt-2 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle text-sm"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="group">
                    <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2 transition-colors group-focus-within:text-primary">
                        EMAIL <span class="text-rose-400">*</span>
                    </label>
                    <input
                        name="email"
                        value="{{ old('email') }}"
                        class="input-field w-full bg-transparent border-0 border-b border-outline-variant py-3 px-0 text-on-surface placeholder:text-surface-variant focus:ring-0 focus:border-primary transition-all duration-400 @error('email') border-rose-500 @enderror"
                        placeholder="email@provider.com"
                        type="email"
                        required />
                    @error('email')
                        <p class="text-rose-400 text-xs mt-2 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle text-sm"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Nomor Telepon --}}
                <div class="group">
                    <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2 transition-colors group-focus-within:text-primary">
                        NOMOR TELEPON <span class="text-on-surface-variant text-xs">(Opsional)</span>
                    </label>
                    <input
                        name="phone"
                        value="{{ old('phone') }}"
                        class="input-field w-full bg-transparent border-0 border-b border-outline-variant py-3 px-0 text-on-surface placeholder:text-surface-variant focus:ring-0 focus:border-primary transition-all duration-400 @error('phone') border-rose-500 @enderror"
                        placeholder="+62 812 3456 7890"
                        type="tel" />
                    @error('phone')
                        <p class="text-rose-400 text-xs mt-2 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle text-sm"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Subjek --}}
                <div class="group">
                    <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2 transition-colors group-focus-within:text-primary">
                        SUBJEK <span class="text-rose-400">*</span>
                    </label>
                    <input
                        name="subject"
                        value="{{ old('subject') }}"
                        class="input-field w-full bg-transparent border-0 border-b border-outline-variant py-3 px-0 text-on-surface placeholder:text-surface-variant focus:ring-0 focus:border-primary transition-all duration-400 @error('subject') border-rose-500 @enderror"
                        placeholder="Perihal pesan Anda"
                        type="text"
                        required />
                    @error('subject')
                        <p class="text-rose-400 text-xs mt-2 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle text-sm"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Pesan --}}
                <div class="group">
                    <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2 transition-colors group-focus-within:text-primary">
                        PESAN <span class="text-rose-400">*</span>
                    </label>
                    <textarea
                        name="message"
                        class="input-field w-full bg-transparent border-0 border-b border-outline-variant py-3 px-0 text-on-surface placeholder:text-surface-variant focus:ring-0 focus:border-primary transition-all duration-400 resize-none @error('message') border-rose-500 @enderror"
                        placeholder="Bagaimana kami dapat membantu Anda?"
                        rows="5"
                        required>{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-rose-400 text-xs mt-2 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle text-sm"></i>
                            {{ $message }}
                        </p>
                    @enderror
                    <p class="text-on-surface-variant text-xs mt-2">
                        <span id="charCount">0</span>/5000 karakter
                    </p>
                </div>

                {{-- Submit Button --}}
                <button
                    class="mt-4 btn-submit py-4 px-10 font-label-caps text-label-caps tracking-widest font-bold flex items-center justify-center gap-2 group"
                    type="submit">
                    KIRIM PESAN
                    <i class="fas fa-arrow-right text-xl group-hover:translate-x-1 transition-transform"></i>
                </button>
            </form>
        </section>

        {{-- Contact Information --}}
        <section class="flex flex-col gap-12 scroll-reveal">
            <div class="space-y-8">
                <h2 class="font-h3 text-3xl text-on-surface font-bold">Informasi Kontak</h2>

                {{-- Jakarta Hub --}}
                <div class="flex gap-6 group">
                    <div class="w-12 h-12 flex items-center justify-center rounded-full glass-panel border-white/20 text-white shrink-0 transition-transform duration-500 group-hover:scale-110">
                        <i class="fas fa-location-dot text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-label-caps text-label-caps text-primary mb-2">JAKARTA HUB</h4>
                        <p class="text-on-surface leading-relaxed opacity-90 font-medium">
                            SCBD Treasury Tower Lt. 52, Sudirman Central Business District,<br />
                            Jakarta Selatan 12190
                        </p>
                        <p class="mt-4 text-on-surface-variant text-sm flex items-center gap-2 font-medium">
                            <i class="far fa-clock text-[16px]"></i>
                            09:00 - 18:00 WIB
                        </p>
                        <p class="text-on-surface-variant text-sm flex items-center gap-2 font-medium">
                            <i class="fas fa-phone text-[16px]"></i>
                            +62 21 5000 8888
                        </p>
                    </div>
                </div>

                {{-- Surabaya Gallery --}}
                <div class="flex gap-6 group">
                    <div class="w-12 h-12 flex items-center justify-center rounded-full glass-panel border-white/20 text-white shrink-0 transition-transform duration-500 group-hover:scale-110">
                        <i class="fas fa-location-dot text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-label-caps text-label-caps text-primary mb-2">SURABAYA GALLERY</h4>
                        <p class="text-on-surface leading-relaxed opacity-90 font-medium">
                            Graha Famili Boulevard Blok A-12, Surabaya Barat,<br />
                            Jawa Timur 60227
                        </p>
                        <p class="mt-4 text-on-surface-variant text-sm flex items-center gap-2 font-medium">
                            <i class="far fa-clock text-[16px]"></i>
                            10:00 - 17:00 WIB
                        </p>
                        <p class="text-on-surface-variant text-sm flex items-center gap-2 font-medium">
                            <i class="fas fa-phone text-[16px]"></i>
                            +62 31 7000 9999
                        </p>
                    </div>
                </div>

                {{-- Email & Social --}}
                <div class="flex gap-6 group">
                    <div class="w-12 h-12 flex items-center justify-center rounded-full glass-panel border-white/20 text-white shrink-0 transition-transform duration-500 group-hover:scale-110">
                        <i class="fas fa-envelope text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-label-caps text-label-caps text-primary mb-2">EMAIL & SOSIAL MEDIA</h4>
                        <p class="text-on-surface leading-relaxed opacity-90 font-medium">
                            support@asiaphone.com<br />
                            info@asiaphone.com
                        </p>
                        <div class="mt-4 flex gap-3">
                            <a href="#" class="w-10 h-10 rounded-full glass-panel flex items-center justify-center hover:scale-110 transition-transform">
                                <i class="fab fa-instagram text-white"></i>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full glass-panel flex items-center justify-center hover:scale-110 transition-transform">
                                <i class="fab fa-facebook text-white"></i>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full glass-panel flex items-center justify-center hover:scale-110 transition-transform">
                                <i class="fab fa-twitter text-white"></i>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full glass-panel flex items-center justify-center hover:scale-110 transition-transform">
                                <i class="fab fa-whatsapp text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quote Card --}}
            <div class="glass-panel p-8 rounded-3xl relative overflow-hidden group">
                <div class="relative z-10">
                    <p class="font-label-caps text-label-caps text-primary mb-2">RESERVASI KHUSUS</p>
                    <p class="font-body-md text-on-surface italic font-medium leading-relaxed">
                        "Kenyamanan Anda adalah prioritas utama kami dalam setiap perjalanan."
                    </p>
                </div>
                <div class="absolute -right-10 -bottom-10 opacity-10 group-hover:opacity-20 transition-opacity duration-700">
                    <i class="fas fa-star text-[160px] text-primary"></i>
                </div>
            </div>
        </section>
    </div>

</main>

<script>
    // Character counter untuk textarea
    const messageTextarea = document.querySelector('textarea[name="message"]');
    const charCount = document.getElementById('charCount');

    if (messageTextarea && charCount) {
        messageTextarea.addEventListener('input', function() {
            charCount.textContent = this.value.length;
        });
        // Initialize count
        charCount.textContent = messageTextarea.value.length;
    }

    // Smooth scroll reveal
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, {
        threshold: 0.1
    });

    document.querySelectorAll('.scroll-reveal').forEach(el => observer.observe(el));

    // Auto-hide alert setelah 5 detik
    setTimeout(() => {
        document.querySelectorAll('.alert-success').forEach(alert => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
</script>
@endsection