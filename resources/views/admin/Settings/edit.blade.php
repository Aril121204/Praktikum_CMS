@extends('admin.layouts.app')

@section('title', 'Site Settings')
@section('page-title', 'PENGATURAN WEBSITE')

@section('content')
<div class="max-w-7xl mx-auto animate-fade-in">

    <div class="mb-8">
        <a href="{{ route('admin.dashboard') }}" 
           class="inline-flex items-center gap-2 text-blue-400 hover:text-blue-300 transition-colors mb-4 font-space">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
        <h2 class="font-space text-3xl font-bold text-white mb-2">PENGATURAN WEBSITE</h2>
        <p class="text-slate-400">Kelola semua pengaturan tampilan website ASIAPHONE</p>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/30 rounded-xl flex items-center gap-3">
        <i class="fas fa-check-circle text-emerald-400 text-xl"></i>
        <p class="text-emerald-400 font-medium">{{ session('success') }}</p>
    </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="space-y-8">
        @csrf
        @method('PUT')

        {{-- TAB NAVIGATION --}}
        <div class="modern-card p-2">
            <div class="flex flex-wrap gap-2" id="settingsTabs">
                <button type="button" 
                        class="tab-btn px-6 py-3 rounded-xl font-space font-semibold transition-all bg-primary text-on-primary"
                        data-tab="branding">
                    <i class="fas fa-palette mr-2"></i>Branding & Logo
                </button>
                <button type="button" 
                        class="tab-btn px-6 py-3 rounded-xl font-space font-semibold transition-all bg-slate-800/50 text-slate-300 hover:bg-slate-700/50"
                        data-tab="hero">
                    <i class="fas fa-home mr-2"></i>Hero Section
                </button>
                <button type="button" 
                        class="tab-btn px-6 py-3 rounded-xl font-space font-semibold transition-all bg-slate-800/50 text-slate-300 hover:bg-slate-700/50"
                        data-tab="about">
                    <i class="fas fa-info-circle mr-2"></i>Tentang & Visi
                </button>
                <button type="button" 
                        class="tab-btn px-6 py-3 rounded-xl font-space font-semibold transition-all bg-slate-800/50 text-slate-300 hover:bg-slate-700/50"
                        data-tab="catalog">
                    <i class="fas fa-store mr-2"></i>Katalog
                </button>
                <button type="button" 
                        class="tab-btn px-6 py-3 rounded-xl font-space font-semibold transition-all bg-slate-800/50 text-slate-300 hover:bg-slate-700/50"
                        data-tab="contact">
                    <i class="fas fa-address-book mr-2"></i>Kontak
                </button>
                <button type="button" 
                        class="tab-btn px-6 py-3 rounded-xl font-space font-semibold transition-all bg-slate-800/50 text-slate-300 hover:bg-slate-700/50"
                        data-tab="footer">
                    <i class="fas fa-compress-arrows-alt mr-2"></i>Footer
                </button>
            </div>
        </div>

        {{-- TAB 1: BRANDING & LOGO --}}
        <div class="tab-content modern-card p-8" id="tab-branding">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                    <i class="fas fa-palette text-white"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-white">BRANDING & LOGO</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Logo Upload --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Logo Website</label>
                    <div class="space-y-4">
                        @if($setting->logo)
                        <div class="relative inline-block">
                            <img src="{{ asset('storage/' . $setting->logo) }}" 
                                 alt="Current Logo" 
                                 class="h-20 object-contain bg-white/5 rounded-lg p-4">
                            <button type="button" 
                                    onclick="deleteImage('logo')"
                                    class="absolute -top-2 -right-2 w-6 h-6 bg-rose-500 hover:bg-rose-600 text-white rounded-full flex items-center justify-center transition-all">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        </div>
                        @endif
                        <input type="file" 
                               name="logo" 
                               accept="image/*"
                               class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-blue-500/50 transition-all">
                        <p class="text-slate-500 text-xs">Format: JPG, PNG, GIF, SVG (Max 2MB)</p>
                    </div>
                </div>

                {{-- Logo Text --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Teks Logo</label>
                    <input type="text" 
                           name="logo_text" 
                           value="{{ old('logo_text', $setting->logo_text) }}"
                           placeholder="ASIAPHONE"
                           class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-blue-500/50 transition-all font-space">
                    @error('logo_text')
                        <p class="text-rose-400 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- TAB 2: HERO SECTION --}}
        <div class="tab-content modern-card p-8 hidden" id="tab-hero">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center">
                    <i class="fas fa-home text-white"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-white">HERO SECTION</h3>
            </div>

            <div class="space-y-6">
                {{-- Hero Label --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Label Hero</label>
                    <input type="text" 
                           name="hero_label" 
                           value="{{ old('hero_label', $setting->hero_label) }}"
                           placeholder="PREMIUM SMARTPHONE COLLECTION"
                           class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 transition-all font-space">
                </div>

                {{-- Hero Title --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Judul Hero</label>
                    <input type="text" 
                           name="hero_title" 
                           value="{{ old('hero_title', $setting->hero_title) }}"
                           placeholder="Temukan Smartphone Impian Anda"
                           class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 transition-all font-space">
                </div>

                {{-- Hero Description --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Deskripsi Hero</label>
                    <textarea name="hero_description" 
                              rows="4"
                              class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-purple-500/50 transition-all font-space resize-none">{{ old('hero_description', $setting->hero_description) }}</textarea>
                </div>

                {{-- Hero Image --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Gambar Hero</label>
                    <div class="space-y-4">
                        @if($setting->hero_image)
                        <div class="relative inline-block">
                            <img src="{{ asset('storage/' . $setting->hero_image) }}" 
                                 alt="Hero Image" 
                                 class="h-48 object-cover rounded-lg">
                            <button type="button" 
                                    onclick="deleteImage('hero')"
                                    class="absolute top-2 right-2 w-8 h-8 bg-rose-500 hover:bg-rose-600 text-white rounded-full flex items-center justify-center transition-all">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        @endif
                        <input type="file" 
                               name="hero_image" 
                               accept="image/*"
                               class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-purple-500/50 transition-all">
                        <p class="text-slate-500 text-xs">Format: JPG, PNG, GIF (Max 5MB) - Recommended: 1920x1080px</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- TAB 3: ABOUT & VISION --}}
        <div class="tab-content modern-card p-8 hidden" id="tab-about">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center">
                    <i class="fas fa-info-circle text-white"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-white">TENTANG & VISI</h3>
            </div>

            <div class="space-y-6">
                {{-- Vision --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Visi</label>
                    <textarea name="vision" 
                              rows="3"
                              class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500/50 transition-all font-space resize-none">{{ old('vision', $setting->vision) }}</textarea>
                </div>

                {{-- Mission --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Misi</label>
                    <textarea name="mission" 
                              rows="3"
                              class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500/50 transition-all font-space resize-none">{{ old('mission', $setting->mission) }}</textarea>
                </div>

                {{-- About Store --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Tentang Toko</label>
                    <textarea name="about_store" 
                              rows="5"
                              class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500/50 transition-all font-space resize-none">{{ old('about_store', $setting->about_store) }}</textarea>
                </div>
            </div>
        </div>

        {{-- TAB 4: CATALOG --}}
        <div class="tab-content modern-card p-8 hidden" id="tab-catalog">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center">
                    <i class="fas fa-store text-white"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-white">KATALOG PRODUK</h3>
            </div>

            <div class="space-y-6">
                {{-- Catalog Title --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Judul Katalog</label>
                    <input type="text" 
                           name="catalog_title" 
                           value="{{ old('catalog_title', $setting->catalog_title) }}"
                           placeholder="Katalog Produk"
                           class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-amber-500/50 transition-all font-space">
                </div>

                {{-- Catalog Description --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Deskripsi Katalog</label>
                    <textarea name="catalog_description" 
                              rows="3"
                              class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-amber-500/50 transition-all font-space resize-none">{{ old('catalog_description', $setting->catalog_description) }}</textarea>
                </div>

                {{-- Catalog Banner --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Banner Katalog</label>
                    <div class="space-y-4">
                        @if($setting->catalog_banner)
                        <div class="relative inline-block">
                            <img src="{{ asset('storage/' . $setting->catalog_banner) }}" 
                                 alt="Catalog Banner" 
                                 class="h-48 object-cover rounded-lg">
                            <button type="button" 
                                    onclick="deleteImage('banner')"
                                    class="absolute top-2 right-2 w-8 h-8 bg-rose-500 hover:bg-rose-600 text-white rounded-full flex items-center justify-center transition-all">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        @endif
                        <input type="file" 
                               name="catalog_banner" 
                               accept="image/*"
                               class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white focus:outline-none focus:border-amber-500/50 transition-all">
                        <p class="text-slate-500 text-xs">Format: JPG, PNG, GIF (Max 5MB)</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- TAB 5: CONTACT --}}
        <div class="tab-content modern-card p-8 hidden" id="tab-contact">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-rose-500 to-rose-600 flex items-center justify-center">
                    <i class="fas fa-address-book text-white"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-white">INFORMASI KONTAK</h3>
            </div>

            <div class="space-y-8">
                {{-- General Contact --}}
                <div>
                    <h4 class="text-lg font-bold text-blue-400 mb-4 font-space">Kontak Umum</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Telepon</label>
                            <input type="text" 
                                   name="phone" 
                                   value="{{ old('phone', $setting->phone) }}"
                                   placeholder="+62 21 12345678"
                                   class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-rose-500/50 transition-all font-space">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">WhatsApp</label>
                            <input type="text" 
                                   name="whatsapp" 
                                   value="{{ old('whatsapp', $setting->whatsapp) }}"
                                   placeholder="+62 812 3456 7890"
                                   class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-rose-500/50 transition-all font-space">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Email Utama</label>
                            <input type="email" 
                                   name="email" 
                                   value="{{ old('email', $setting->email) }}"
                                   placeholder="info@asiaphone.com"
                                   class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-rose-500/50 transition-all font-space">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Alamat</label>
                            <input type="text" 
                                   name="address" 
                                   value="{{ old('address', $setting->address) }}"
                                   placeholder="Jakarta, Indonesia"
                                   class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-rose-500/50 transition-all font-space">
                        </div>
                    </div>
                </div>

                {{-- Jakarta Location --}}
                <div>
                    <h4 class="text-lg font-bold text-blue-400 mb-4 font-space">Lokasi Jakarta</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-300 mb-2">Judul</label>
                            <input type="text" 
                                   name="contact_jakarta_title" 
                                   value="{{ old('contact_jakarta_title', $setting->contact_jakarta_title) }}"
                                   placeholder="Jakarta Hub"
                                   class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-rose-500/50 transition-all font-space">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-300 mb-2">Alamat Lengkap</label>
                            <textarea name="contact_jakarta_address" 
                                      rows="2"
                                      class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-rose-500/50 transition-all font-space resize-none">{{ old('contact_jakarta_address', $setting->contact_jakarta_address) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Jam Operasional</label>
                            <input type="text" 
                                   name="contact_jakarta_hours" 
                                   value="{{ old('contact_jakarta_hours', $setting->contact_jakarta_hours) }}"
                                   placeholder="09:00 - 18:00 WIB"
                                   class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-rose-500/50 transition-all font-space">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Telepon</label>
                            <input type="text" 
                                   name="contact_jakarta_phone" 
                                   value="{{ old('contact_jakarta_phone', $setting->contact_jakarta_phone) }}"
                                   placeholder="+62 21 12345678"
                                   class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-rose-500/50 transition-all font-space">
                        </div>
                    </div>
                </div>

                {{-- Surabaya Location --}}
                <div>
                    <h4 class="text-lg font-bold text-blue-400 mb-4 font-space">Lokasi Surabaya</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-300 mb-2">Judul</label>
                            <input type="text" 
                                   name="contact_surabaya_title" 
                                   value="{{ old('contact_surabaya_title', $setting->contact_surabaya_title) }}"
                                   placeholder="Surabaya Gallery"
                                   class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-rose-500/50 transition-all font-space">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-300 mb-2">Alamat Lengkap</label>
                            <textarea name="contact_surabaya_address" 
                                      rows="2"
                                      class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-rose-500/50 transition-all font-space resize-none">{{ old('contact_surabaya_address', $setting->contact_surabaya_address) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Jam Operasional</label>
                            <input type="text" 
                                   name="contact_surabaya_hours" 
                                   value="{{ old('contact_surabaya_hours', $setting->contact_surabaya_hours) }}"
                                   placeholder="10:00 - 17:00 WIB"
                                   class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-rose-500/50 transition-all font-space">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Telepon</label>
                            <input type="text" 
                                   name="contact_surabaya_phone" 
                                   value="{{ old('contact_surabaya_phone', $setting->contact_surabaya_phone) }}"
                                   placeholder="+62 31 12345678"
                                   class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-rose-500/50 transition-all font-space">
                        </div>
                    </div>
                </div>

                {{-- Google Maps --}}
                <div>
                    <h4 class="text-lg font-bold text-blue-400 mb-4 font-space">Google Maps</h4>
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Embed Code</label>
                        <textarea name="google_maps_embed" 
                                  rows="4"
                                  placeholder='<iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'
                                  class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-rose-500/50 transition-all font-space resize-none font-mono text-sm">{{ old('google_maps_embed', $setting->google_maps_embed) }}</textarea>
                        <p class="text-slate-500 text-xs mt-2">Paste embed code dari Google Maps</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- TAB 6: FOOTER --}}
        <div class="tab-content modern-card p-8 hidden" id="tab-footer">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-slate-500 to-slate-600 flex items-center justify-center">
                    <i class="fas fa-compress-arrows-alt text-white"></i>
                </div>
                <h3 class="font-space text-xl font-bold text-white">FOOTER</h3>
            </div>

            <div class="space-y-6">
                {{-- Footer Text --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Teks Footer</label>
                    <input type="text" 
                           name="footer_text" 
                           value="{{ old('footer_text', $setting->footer_text) }}"
                           placeholder="© 2024 ASIAPHONE. All rights reserved."
                           class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-slate-500/50 transition-all font-space">
                </div>

                {{-- Copyright --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Copyright</label>
                    <input type="text" 
                           name="copyright" 
                           value="{{ old('copyright', $setting->copyright) }}"
                           placeholder="© 2024 ASIAPHONE. ELEGANCE REFINED. ALL RIGHTS RESERVED."
                           class="w-full px-4 py-3 bg-slate-800/50 border border-slate-700/50 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:border-slate-500/50 transition-all font-space">
                </div>
            </div>
        </div>

        {{-- SUBMIT BUTTON --}}
        <div class="flex items-center justify-end gap-4">
            <a href="{{ route('admin.dashboard') }}" 
               class="px-6 py-3 bg-slate-700/50 hover:bg-slate-600/50 text-slate-300 rounded-xl transition-all font-space font-semibold">
                Batal
            </a>
            <button type="submit" 
                    class="btn-modern px-8 py-3 rounded-xl font-space font-semibold flex items-center gap-3">
                <i class="fas fa-save text-xl"></i>
                SIMPAN PENGATURAN
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Tab Navigation
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetTab = this.dataset.tab;
            
            // Remove active class from all buttons and contents
            tabBtns.forEach(b => {
                b.classList.remove('bg-primary', 'text-on-primary');
                b.classList.add('bg-slate-800/50', 'text-slate-300');
            });
            tabContents.forEach(c => c.classList.add('hidden'));
            
            // Add active class to clicked button and target content
            this.classList.remove('bg-slate-800/50', 'text-slate-300');
            this.classList.add('bg-primary', 'text-on-primary');
            document.getElementById('tab-' + targetTab).classList.remove('hidden');
        });
    });

    // Delete Image Function
    function deleteImage(type) {
        if (!confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
            return;
        }

        fetch(`/admin/settings/image/${type}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Gagal menghapus gambar: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus gambar');
        });
    }
</script>
@endpush
@endsection