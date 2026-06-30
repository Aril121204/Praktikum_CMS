    @extends('layouts.front')
    @section('content')
    <div id="header">
        <!DOCTYPE html>

        <html class="dark" lang="id">

        <head>
            <meta charset="utf-8" />
            <meta content="width=device-width, initial-scale=1.0" name="viewport" />
            <title>TECHNOVA - Masa Depan di Tangan Anda</title>
            <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
            <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&amp;family=JetBrains+Mono:wght@500&amp;display=swap" rel="stylesheet" />
            <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
            <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
            <style>
                .material-symbols-outlined {
                    font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
                }

                .glass-card {
                    background: rgba(15, 23, 42, 0.6);
                    backdrop-filter: blur(20px);
                    border: 1px solid rgba(255, 255, 255, 0.1);
                }

                .electric-glow {
                    box-shadow: 0 0 30px rgba(0, 87, 255, 0.3);
                }

                .hide-scrollbar::-webkit-scrollbar {
                    display: none;
                }

                .hide-scrollbar {
                    -ms-overflow-style: none;
                    scrollbar-width: none;
                }
            </style>
            <script id="tailwind-config">
                tailwind.config = {
                    darkMode: "class",
                    theme: {
                        extend: {
                            "colors": {
                                "inverse-on-surface": "#2a3043",
                                "surface-container-lowest": "#070d1f",
                                "on-error-container": "#ffdad6",
                                "on-tertiary-fixed": "#131b2e",
                                "tertiary-container": "#60687f",
                                "error-container": "#93000a",
                                "surface-container": "#191f31",
                                "inverse-surface": "#dce1fb",
                                "on-primary-container": "#e5e8ff",
                                "surface": "#0c1324",
                                "on-surface": "#dce1fb",
                                "on-primary-fixed": "#001550",
                                "secondary-fixed-dim": "#c1c7cf",
                                "secondary-container": "#41474e",
                                "error": "#ffb4ab",
                                "on-tertiary": "#283044",
                                "on-secondary-fixed-variant": "#41474e",
                                "surface-tint": "#b6c4ff",
                                "on-primary-fixed-variant": "#003ab2",
                                "primary-container": "#0057ff",
                                "surface-container-high": "#23293c",
                                "on-primary": "#00277f",
                                "outline-variant": "#434656",
                                "surface-dim": "#0c1324",
                                "inverse-primary": "#004ee7",
                                "surface-variant": "#2e3447",
                                "on-error": "#690005",
                                "on-tertiary-fixed-variant": "#3f465c",
                                "on-secondary-container": "#afb6bd",
                                "on-secondary": "#2b3137",
                                "primary": "#b6c4ff",
                                "on-surface-variant": "#c3c5d9",
                                "tertiary-fixed-dim": "#bec6e0",
                                "surface-bright": "#33394c",
                                "primary-fixed-dim": "#b6c4ff",
                                "surface-container-highest": "#2e3447",
                                "surface-container-low": "#151b2d",
                                "primary-fixed": "#dce1ff",
                                "on-background": "#dce1fb",
                                "on-tertiary-container": "#e3e8ff",
                                "tertiary-fixed": "#dae2fd",
                                "secondary": "#c1c7cf",
                                "outline": "#8d90a2",
                                "tertiary": "#bec6e0",
                                "secondary-fixed": "#dde3eb",
                                "on-secondary-fixed": "#161c22",
                                "background": "#0c1324"
                            },
                            "borderRadius": {
                                "DEFAULT": "0.25rem",
                                "lg": "0.5rem",
                                "xl": "0.75rem",
                                "full": "9999px"
                            },
                            "spacing": {
                                "section-gap-sm": "40px",
                                "container-margin": "24px",
                                "unit": "8px",
                                "section-gap-lg": "80px",
                                "gutter": "16px"
                            },
                            "fontFamily": {
                                "headline-md": ["Inter"],
                                "body-md": ["Inter"],
                                "body-lg": ["Inter"],
                                "display-lg": ["Inter"],
                                "display-lg-mobile": ["Inter"],
                                "label-caps": ["JetBrains Mono"]
                            },
                            "fontSize": {
                                "headline-md": ["24px", {
                                    "lineHeight": "32px",
                                    "letterSpacing": "-0.02em",
                                    "fontWeight": "700"
                                }],
                                "body-md": ["16px", {
                                    "lineHeight": "24px",
                                    "fontWeight": "400"
                                }],
                                "body-lg": ["18px", {
                                    "lineHeight": "28px",
                                    "fontWeight": "400"
                                }],
                                "display-lg": ["48px", {
                                    "lineHeight": "56px",
                                    "letterSpacing": "-0.04em",
                                    "fontWeight": "800"
                                }],
                                "display-lg-mobile": ["36px", {
                                    "lineHeight": "42px",
                                    "letterSpacing": "-0.04em",
                                    "fontWeight": "800"
                                }],
                                "label-caps": ["12px", {
                                    "lineHeight": "16px",
                                    "letterSpacing": "0.1em",
                                    "fontWeight": "500"
                                }]
                            }
                        },
                    },
                }
            </script>
            <style>
                body {
                    min-height: max(884px, 100dvh);
                }
            </style>
        </head>

        <body class="bg-background text-on-background min-h-screen selection:bg-primary selection:text-on-primary">
            <!-- TopAppBar -->
            <header class="fixed top-0 w-full z-50 bg-surface/80 dark:bg-surface/80 backdrop-blur-xl border-b border-white/10 shadow-[0_0_30px_rgba(0,87,255,0.1)] flex items-center justify-between px-container-margin h-16">
                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-primary cursor-pointer active:scale-95 duration-200">menu</span>
                    <h1 class="font-display-lg-mobile text-display-lg-mobile tracking-tighter text-primary">TECHNOVA</h1>
                </div>
                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-primary cursor-pointer active:scale-95 duration-200">search</span>
                </div>
            </header>
            <main class="pt-16 pb-24">
                <!-- Hero Section -->
                <section class="relative w-full h-[751px] flex flex-col items-center justify-center overflow-hidden px-container-margin text-center">
                    <div class="absolute inset-0 z-0">
                        <img class="w-full h-full object-cover opacity-60" data-alt="A sleek, flagship smartphone floating in a void of deep obsidian black, illuminated from behind by a vibrant electric blue neon glow. The lighting creates sharp rim lights on the titanium frame of the phone. The atmosphere is high-tech, premium, and futuristic, with subtle light leaks dancing across the lens. The composition is centered and powerful, evoking a sense of high-performance luxury technology." src="https://lh3.googleusercontent.com/aida-public/AB6AXuApkoUJG_7GvTz0dIcVGMbdw63VEfF1ePMbfiW13aZP32UKGBIU5RHEvtNgy9g9Y-ZU4li2wib8qzPZChR1kEk7ABggalPIDDZuGeLdeLIGEO7Pa6vPqLJDycPEmx1bMZg0Mbu7eBRizJwPMbi32HXDwvMr9SFboXIHcwm9T9D1_fWJTWFYojwwxYtfVXWpv-wdfc1zCFu0CwamDhzpINyfMR6TJ4raDnc3UyKoVUiog7IOPAZs8j1oDMwS2NOn9Y99hMch97FsAr0" />
                        <div class="absolute inset-0 bg-gradient-to-t from-background via-transparent to-transparent"></div>
                    </div>
                    <div class="relative z-10 max-w-2xl">
                        <span class="font-label-caps text-label-caps text-primary mb-4 block tracking-[0.2em]">FLAGSHIP TERBARU 2024</span>
                        <h2 class="font-display-lg-mobile text-display-lg-mobile md:font-display-lg md:text-display-lg mb-6 leading-tight">Masa Depan di Tangan Anda</h2>
                        <p class="font-body-lg text-body-lg text-on-surface-variant mb-10">Temukan inovasi terbaru dengan performa tanpa batas. Pengalaman teknologi premium yang belum pernah Anda rasakan sebelumnya.</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <button class="bg-primary-container text-on-primary-container px-8 py-4 rounded-xl font-bold flex items-center justify-center gap-2 hover:opacity-90 active:scale-95 transition-all electric-glow">
                                Beli Sekarang <span class="material-symbols-outlined">arrow_forward</span>
                            </button>
                            <button class="border border-white/20 backdrop-blur-md px-8 py-4 rounded-xl font-bold hover:bg-white/10 active:scale-95 transition-all">
                                Pelajari Lebih Lanjut
                            </button>
                        </div>
                    </div>
                </section>
                <!-- Categories Section -->
                <section class="mt-section-gap-sm px-container-margin overflow-hidden">
                    <h3 class="font-headline-md text-headline-md mb-6">Kategori Unggulan</h3>
                    <div class="flex gap-gutter overflow-x-auto hide-scrollbar pb-4 snap-x">
                        <div class="min-w-[160px] aspect-[4/5] relative rounded-2xl overflow-hidden snap-start group cursor-pointer">
                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" data-alt="A macro shot of a sleek smartphone camera lens with metallic accents and deep blue reflections. The background is a dark, tech-inspired texture. High-key lighting emphasizes the precision engineering of the flagship device. The aesthetic is clean, professional, and sophisticated." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD1Z-Ffqp1Vd1pER_mWj0YnS_iyBoYvCvdB_pstUzr8qEJnrKaMM5HnfBU78Yt_DB1S_o8CT0jfTNfqDaDrxpV2n9ppt1xSMHCFKpplxu-roWN6JyJsij9xP3NFw3TnsxORMPKcpE4RnVtIDNju605mA3HjY7shN1XgYPRpItTTLLeFy1_sZcp9a243oxeZJCvKKxqaSCGhUhjRINtDiaNRCAgS97Rtoisa7yMPv73PvileHBNKa4J1zv7Ve9AurcpJxdzu8_vhjoU" />
                            <div class="absolute inset-0 bg-black/40 flex items-end p-4">
                                <span class="font-headline-md text-headline-md text-white">Flagship</span>
                            </div>
                        </div>
                        <div class="min-w-[160px] aspect-[4/5] relative rounded-2xl overflow-hidden snap-start group cursor-pointer">
                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" data-alt="A glowing gaming smartphone with RGB lighting strips on the back, held in a dark room with purple and blue neon ambient light. The device looks aggressive and powerful. The overall mood is high-energy, futuristic, and focused on extreme performance for gaming enthusiasts." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCBVmZqFw-_r5p9KUbQ87uRNDJ8igDG7f5J2AUDe8PtGcxrXYu0004KPfJPflZxNDGjqSIMxeHVPKGyAXVUx53hheuzTS70AN0n0VY8RCjzeljxMR3AZaFLuzTgkP1WAivIE37NvI7FMxh7oTZAD87IvFXM_FApd8P9trojaUQml0dQTaePbbP9pH2B9Z_8V8I7I8hYA6Vn61cD6qIG4DbEpImTDIUWal93OLYL8x2v4O9prw3o8PDLcnu_RMNqHXoGKxRY-0Q4sK4" />
                            <div class="absolute inset-0 bg-black/40 flex items-end p-4">
                                <span class="font-headline-md text-headline-md text-white">Gaming</span>
                            </div>
                        </div>
                        <div class="min-w-[160px] aspect-[4/5] relative rounded-2xl overflow-hidden snap-start group cursor-pointer">
                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" data-alt="A modern smartphone with a bright, colorful screen displaying abstract art, resting on a minimalist desk. The lighting is soft and natural, emphasizing the accessible and friendly nature of the budget device. The color palette is vibrant and fresh." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDa4p_HUpEHjX8qSCBWVwR1WHC17ssfahDXdKZi8eQlrCjk9FtgaMmIJCLm7ZyPdjtt2C9pKOxgpzwcsz8hR88mdyDc3CUDzNFYU-idhNZ-nsnRwtzzByTF1WeGdwpHmNUistiDwk_1TcLypRpXfI5Aa9zj1J0Zclozqn5CZ31krq4T9E8XzE6X4aQp0eCkrc8SZqZ_ycguoJIlCS30G0kPQ0jFoWIQM9ZCDiTD4MgAPwNt02G2jkaGoXZ9Q69VRQfELIN3Z9F5GSI" />
                            <div class="absolute inset-0 bg-black/40 flex items-end p-4">
                                <span class="font-headline-md text-headline-md text-white">Budget</span>
                            </div>
                        </div>
                        <div class="min-w-[160px] aspect-[4/5] relative rounded-2xl overflow-hidden snap-start group cursor-pointer">
                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" data-alt="Premium wireless earbuds and a smartwatch arranged artistically on a dark surface with sharp shadows. The lighting is cold and clinical, highlighting the metallic and glass textures of the high-end accessories. The style is minimalist and high-fashion." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBf6jpcdoDuMLIdQ286aiA1yLQXKzpay0KIGPMuBpHbbhbTJnUtYbxvIfZt8uSh32zNyPWJDeku1UT5xRZviJmoVsiGGLPukHvetP7Bjs5zUUdq3oVysnfhTXdsSLS4HtZsoxicvxhAn1g9ncQUaFBzgrckBvMjOnv7vSuW_ugeh_GZb9bBLLfa-hEm5hfy7hYRcIx_aZKadxjeRAUCC9sSDFxhH1L_bCcmEOLQ2j5IH9Xu0MeDilKieOmoDkODFj0UiLP4JvJ9SqU" />
                            <div class="absolute inset-0 bg-black/40 flex items-end p-4">
                                <span class="font-headline-md text-headline-md text-white">Aksesoris</span>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Product Grid -->
                <section class="mt-section-gap-lg px-container-margin">
                    <div class="flex justify-between items-end mb-8">
                        <div>
                            <h3 class="font-headline-md text-headline-md">Produk Terpopuler</h3>
                            <p class="text-on-surface-variant">Pilihan terbaik untuk performa maksimal</p>
                        </div>
                        <button class="text-primary font-bold flex items-center gap-1 hover:underline">
                            Lihat Semua <span class="material-symbols-outlined text-sm">open_in_new</span>
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
                        <!-- Product Card 1 -->
                        <div class="glass-card rounded-2xl p-6 group transition-all hover:scale-[1.02]">
                            <div class="relative mb-6 overflow-hidden rounded-xl bg-surface-container aspect-square flex items-center justify-center">
                                <span class="absolute top-3 left-3 bg-primary-container text-on-primary-container text-[10px] font-bold px-3 py-1 rounded-full z-10">STUNNING</span>
                                <img class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500" data-alt="A portrait of a premium smartphone in a metallic silver finish, standing vertically. The lighting is dramatic, with a strong blue rim light highlighting the curved edges of the glass. The background is a deep charcoal gray with subtle textures. The design looks expensive and precise." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDwW1TKzp-XdXOrjI5K1JKo9MToJcAjcbkbf5LsTNUOEs7ohRMQCHBvcqvGuJZ0JB2skTtHuJJBlemQ-9QuxJRDnpkdQTwm2xClKDqOHymlhbvsxscD_S8x58MJ3v_d4H8TRvVIcst1N5gNfeL86C7RfP_gScb6U_8RJ6ZlfsY7_HmjHubglF28t7hgvU7srOMBRI1S7WjMyuKJ0PlF_HYZ8LmW6F5p7UnT8922d9hJo4qjZeE_7fpOXzX3Kf7aoxEXKuGOwegznnU" />
                            </div>
                            <div class="flex flex-col gap-1">
                                <h4 class="font-headline-md text-headline-md">X-Pro Max Ultra</h4>
                                <div class="flex gap-3 text-on-surface-variant font-label-caps text-[10px] py-2 border-y border-white/5 my-2">
                                    <span>12GB RAM</span>
                                    <span>|</span>
                                    <span>1TB STORAGE</span>
                                    <span>|</span>
                                    <span>5000mAh</span>
                                </div>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-primary font-bold text-xl">Rp 19.499.000</span>
                                    <button class="bg-primary text-on-primary w-10 h-10 rounded-full flex items-center justify-center active:scale-90 transition-transform">
                                        <span class="material-symbols-outlined">add_shopping_cart</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Product Card 2 -->
                        <div class="glass-card rounded-2xl p-6 group transition-all hover:scale-[1.02]">
                            <div class="relative mb-6 overflow-hidden rounded-xl bg-surface-container aspect-square flex items-center justify-center">
                                <img class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500" data-alt="A minimalist smartphone in a matte black finish, showing its slim profile and minimal camera bump. The lighting is high-contrast, with white highlights outlining the device against a deep black background. The mood is sleek, stealthy, and professional." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD9-7cE37pFplslHQT_HX6iDZP9oUnrDyFADN5T1GxjUh2wrjF7CiCQCdKJEFPfuA05SSyyP3QEhrxfh-MATpfzKRSBo83n9ZApOAnSX4pPbaGUOiaQIavNmNW61tCkrcbOZV5vX4CDuO3R-cZ-vl48dk4n3EvpG3RpDte7Ud5ZjvPoozzSjmCWjh40GAl31psRVUKtUccamPA9xJK4eZPYldK_ow1s4R4dh2V4PCk1vIBWDdvzRb6-t4eTqbVSGX4kKJumt-Y2LMU" />
                            </div>
                            <div class="flex flex-col gap-1">
                                <h4 class="font-headline-md text-headline-md">Nexus G1 Gaming</h4>
                                <div class="flex gap-3 text-on-surface-variant font-label-caps text-[10px] py-2 border-y border-white/5 my-2">
                                    <span>16GB RAM</span>
                                    <span>|</span>
                                    <span>512GB SSD</span>
                                    <span>|</span>
                                    <span>144Hz DISPLAY</span>
                                </div>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-primary font-bold text-xl">Rp 15.999.000</span>
                                    <button class="bg-primary text-on-primary w-10 h-10 rounded-full flex items-center justify-center active:scale-90 transition-transform">
                                        <span class="material-symbols-outlined">add_shopping_cart</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Product Card 3 -->
                        <div class="glass-card rounded-2xl p-6 group transition-all hover:scale-[1.02]">
                            <div class="relative mb-6 overflow-hidden rounded-xl bg-surface-container aspect-square flex items-center justify-center">
                                <span class="absolute top-3 left-3 bg-primary-container text-on-primary-container text-[10px] font-bold px-3 py-1 rounded-full z-10">STUNNING</span>
                                <img class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500" data-alt="A stunning white smartphone with a ceramic finish, reflecting a soft blue light. The camera module is prominent and features several large lenses. The lighting is bright and clean, emphasizing the pure, high-quality material of the phone. The aesthetic is luxurious and sophisticated." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCWnvQs4ca0OrDEkFBAFC6QvlGQmtdc9Ayi3B9sp2oLg3fEJGV98GEdO8qOsLZjIsMvHKtZohkp6x8aQ6BmKpFqm1_JV9PkvFYfTD5wUbATdTEfXOns-3z9ExNvK31EXE2KYiyr8hFSM4vrxCVEG1jOtoZrSQmrxxSBhX2fzt3wENGJELyYM1J_mbZ72_ceHWTplZjQTSqsIKZSqaTUcO3i4EBKGiX7s7xjSuuJupGJzKGS6gBdSK5GZ32Ht_mvho-K6MOVImXFsjk" />
                            </div>
                            <div class="flex flex-col gap-1">
                                <h4 class="font-headline-md text-headline-md">Vision Air Fold</h4>
                                <div class="flex gap-3 text-on-surface-variant font-label-caps text-[10px] py-2 border-y border-white/5 my-2">
                                    <span>8GB RAM</span>
                                    <span>|</span>
                                    <span>256GB</span>
                                    <span>|</span>
                                    <span>FOLDABLE OLED</span>
                                </div>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-primary font-bold text-xl">Rp 21.299.000</span>
                                    <button class="bg-primary text-on-primary w-10 h-10 rounded-full flex items-center justify-center active:scale-90 transition-transform">
                                        <span class="material-symbols-outlined">add_shopping_cart</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Promotional Banner -->
                <section class="mt-section-gap-lg px-container-margin">
                    <div class="relative w-full rounded-3xl overflow-hidden glass-card p-10 flex flex-col items-center text-center gap-6 border-primary/20 electric-glow">
                        <div class="absolute inset-0 z-0 bg-primary/5"></div>
                        <div class="relative z-10">
                            <span class="bg-error text-on-error font-bold px-4 py-1 rounded-full text-xs mb-4 inline-block">WAKTU TERBATAS</span>
                            <h3 class="font-display-lg-mobile text-display-lg-mobile mb-2">Promo Terbatas: Diskon hingga 20%</h3>
                            <p class="font-body-lg text-body-lg text-on-surface-variant">Hanya berlaku untuk pembelian seri terbaru minggu ini. Jangan lewatkan kesempatan Anda.</p>
                            <button class="mt-8 bg-white text-black px-10 py-4 rounded-xl font-bold hover:scale-105 transition-transform">Klaim Promo</button>
                        </div>
                    </div>
                </section>
                <!-- Spec Highlights (Extra value-add component) -->
                <section class="mt-section-gap-lg px-container-margin grid grid-cols-2 md:grid-cols-4 gap-gutter">
                    <div class="flex flex-col items-center gap-2 p-4">
                        <span class="material-symbols-outlined text-primary text-4xl">speed</span>
                        <span class="font-label-caps text-label-caps text-center">FASTEST CHIP</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 p-4">
                        <span class="material-symbols-outlined text-primary text-4xl">battery_charging_full</span>
                        <span class="font-label-caps text-label-caps text-center">ALL DAY BATTERY</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 p-4">
                        <span class="material-symbols-outlined text-primary text-4xl">camera</span>
                        <span class="font-label-caps text-label-caps text-center">PRO OPTICS</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 p-4">
                        <span class="material-symbols-outlined text-primary text-4xl">verified</span>
                        <span class="font-label-caps text-label-caps text-center">GARANSI RESMI</span>
                    </div>
                </section>
                <!-- Footer -->
                <footer class="w-full mt-section-gap-lg bg-surface-container-lowest dark:bg-surface-container-lowest flex flex-col gap-gutter px-container-margin py-section-gap-sm">
                    <div class="flex flex-col md:flex-row justify-between gap-10">
                        <div class="flex flex-col gap-4">
                            <h1 class="font-headline-md text-headline-md text-primary">TECHNOVA</h1>
                            <p class="max-w-xs text-on-surface-variant font-body-md text-body-md">Destinasi utama untuk teknologi smartphone termutakhir dengan pengalaman belanja premium.</p>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-8">
                            <div class="flex flex-col gap-4">
                                <span class="font-bold text-primary">Menu</span>
                                <a class="font-body-md text-body-md text-on-surface-variant hover:text-primary underline transition-all" href="#">Tentang Kami</a>
                                <a class="font-body-md text-body-md text-on-surface-variant hover:text-primary underline transition-all" href="#">Bantuan</a>
                            </div>
                            <div class="flex flex-col gap-4">
                                <span class="font-bold text-primary">Layanan</span>
                                <a class="font-body-md text-body-md text-on-surface-variant hover:text-primary underline transition-all" href="#">Kebijakan Pengembalian</a>
                            </div>
                            <div class="flex flex-col gap-4">
                                <span class="font-bold text-primary">Ikuti Kami</span>
                                <a class="font-body-md text-body-md text-on-surface-variant hover:text-primary underline transition-all" href="#">Instagram</a>
                                <a class="font-body-md text-body-md text-on-surface-variant hover:text-primary underline transition-all" href="#">Twitter</a>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4">
                        <span class="font-body-md text-body-md text-on-surface-variant opacity-60">© 2024 TECHNOVA Indonesia. Seluruh hak cipta dilindungi.</span>
                        <div class="flex gap-4">
                            <span class="material-symbols-outlined text-on-surface-variant opacity-60">payments</span>
                            <span class="material-symbols-outlined text-on-surface-variant opacity-60">contactless</span>
                        </div>
                    </div>
                </footer>
            </main>
            <!-- FAB -->
            <button class="fixed bottom-24 right-6 w-14 h-14 bg-primary-container text-on-primary-container rounded-full flex items-center justify-center electric-glow active:scale-90 transition-all z-40">
                <span class="material-symbols-outlined">forum</span>
            </button>
            <!-- BottomNavBar -->
            <nav class="fixed bottom-0 w-full z-50 rounded-t-xl bg-surface-container/80 dark:bg-surface-container/80 backdrop-blur-xl border-t border-white/10 shadow-[0_-4px_20px_rgba(0,0,0,0.5)] flex justify-around items-center h-20 px-4 pb-2">
                <a class="flex flex-col items-center justify-center text-primary font-bold bg-primary/10 rounded-xl py-1 px-3 active:scale-90 duration-200" href="#">
                    <span class="material-symbols-outlined">home</span>
                    <span class="font-label-caps text-label-caps mt-1">Beranda</span>
                </a>
                <a class="flex flex-col items-center justify-center text-on-surface-variant hover:text-primary transition-colors active:scale-90 duration-200" href="#">
                    <span class="material-symbols-outlined">storefront</span>
                    <span class="font-label-caps text-label-caps mt-1">Belanja</span>
                </a>
                <a class="flex flex-col items-center justify-center text-on-surface-variant hover:text-primary transition-colors active:scale-90 duration-200" href="#">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <span class="font-label-caps text-label-caps mt-1">Keranjang</span>
                </a>
                <a class="flex flex-col items-center justify-center text-on-surface-variant hover:text-primary transition-colors active:scale-90 duration-200" href="#">
                    <span class="material-symbols-outlined">person</span>
                    <span class="font-label-caps text-label-caps mt-1">Profil</span>
                </a>
            </nav>
            <script>
                // Micro-interaction for category scrolling
                const categoryScroll = document.querySelector('.overflow-x-auto');
                if (categoryScroll) {
                    let isDown = false;
                    let startX;
                    let scrollLeft;

                    categoryScroll.addEventListener('mousedown', (e) => {
                        isDown = true;
                        startX = e.pageX - categoryScroll.offsetLeft;
                        scrollLeft = categoryScroll.scrollLeft;
                    });
                    categoryScroll.addEventListener('mouseleave', () => {
                        isDown = false;
                    });
                    categoryScroll.addEventListener('mouseup', () => {
                        isDown = false;
                    });
                    categoryScroll.addEventListener('mousemove', (e) => {
                        if (!isDown) return;
                        e.preventDefault();
                        const x = e.pageX - categoryScroll.offsetLeft;
                        const walk = (x - startX) * 2;
                        categoryScroll.scrollLeft = scrollLeft - walk;
                    });
                }
            </script>
        </body>

        </html>
    </div>
    @endsection