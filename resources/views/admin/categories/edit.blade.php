@extends('admin.layouts.app')

@section('title', 'Edit Category')
@section('page-title', 'EDIT BRAND')

@section('content')
<div class="max-w-4xl mx-auto animate-fade-in">

    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('admin.categories.index') }}" 
           class="inline-flex items-center gap-2 text-cyan-400 hover:text-cyan-300 transition-colors mb-4 font-rajdhani">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Daftar
        </a>
        <h2 class="font-orbitron text-3xl font-bold text-white neon-text">EDIT BRAND</h2>
        <p class="text-cyan-300/60 text-sm mt-2 font-rajdhani">Update informasi brand "{{ $category->name }}"</p>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.categories.update', $category) }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="glass rounded-3xl p-8 neon-border">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <!-- Name -->
            <div>
                <label class="block text-cyan-300/80 text-sm font-bold mb-3 font-rajdhani tracking-wide">
                    <i class="fas fa-tag mr-2"></i>
                    NAMA BRAND <span class="text-rose-400">*</span>
                </label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name', $category->name) }}"
                       placeholder="Contoh: Samsung, Apple, Xiaomi"
                       class="w-full px-5 py-4 glass bg-black/20 border border-cyan-500/30 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 transition-all font-rajdhani text-lg @error('name') border-rose-500/50 @enderror"
                       required>
                @error('name')
                    <p class="text-rose-400 text-xs mt-2 font-rajdhani">{{ $message }}</p>
                @enderror
            </div>

            <!-- Slug -->
            <div>
                <label class="block text-cyan-300/80 text-sm font-bold mb-3 font-rajdhani tracking-wide">
                    <i class="fas fa-link mr-2"></i>
                    SLUG <span class="text-rose-400">*</span>
                </label>
                <input type="text" 
                       name="slug" 
                       value="{{ old('slug', $category->slug) }}"
                       placeholder="Contoh: samsung, apple, xiaomi"
                       class="w-full px-5 py-4 glass bg-black/20 border border-cyan-500/30 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 transition-all font-rajdhani text-lg @error('slug') border-rose-500/50 @enderror"
                       required>
                @error('slug')
                    <p class="text-rose-400 text-xs mt-2 font-rajdhani">{{ $message }}</p>
                @enderror
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
                          class="w-full px-5 py-4 glass bg-black/20 border border-cyan-500/30 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 transition-all font-rajdhani text-lg resize-none @error('description') border-rose-500/50 @enderror">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="text-rose-400 text-xs mt-2 font-rajdhani">{{ $message }}</p>
                @enderror
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
                        @if($category->image)
                            <div id="currentImage">
                                <img src="{{ asset($category->image) }}" alt="Current Logo" class="max-h-48 mx-auto rounded-xl mb-3">
                                <p class="text-cyan-300/60 text-sm font-rajdhani">Klik untuk ganti logo</p>
                            </div>
                        @endif
                        <div id="imagePreview" class="hidden">
                            <img src="" alt="Preview" class="max-h-48 mx-auto rounded-xl">
                        </div>
                        <div id="uploadPlaceholder" class="{{ $category->image ? 'hidden' : '' }}">
                            <i class="fas fa-cloud-upload-alt text-5xl text-cyan-400/50 group-hover:text-cyan-400 transition-colors mb-3"></i>
                            <p class="text-cyan-300/60 font-rajdhani">Klik untuk upload logo</p>
                            <p class="text-gray-500 text-xs mt-1 font-rajdhani">PNG, JPG, GIF (Max 2MB)</p>
                        </div>
                    </label>
                </div>
                @error('image')
                    <p class="text-rose-400 text-xs mt-2 font-rajdhani">{{ $message }}</p>
                @enderror
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
                           value="{{ old('sort_order', $category->sort_order) }}"
                           min="0"
                           placeholder="0"
                           class="w-full px-5 py-4 glass bg-black/20 border border-cyan-500/30 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 transition-all font-rajdhani text-lg @error('sort_order') border-rose-500/50 @enderror"
                           required>
                    @error('sort_order')
                        <p class="text-rose-400 text-xs mt-2 font-rajdhani">{{ $message }}</p>
                    @enderror
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
                                   {{ old('is_active', $category->is_active) === 'Y' ? 'checked' : '' }}
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
                                   {{ old('is_active', $category->is_active) === 'N' ? 'checked' : '' }}
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
                <a href="{{ route('admin.categories.index') }}" 
                   class="px-8 py-4 glass hover:bg-white/5 text-gray-300 rounded-xl transition-all font-rajdhani font-semibold tracking-wide">
                    Batal
                </a>
                <button type="submit" 
                        class="px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white rounded-xl transition-all btn-neon font-rajdhani font-semibold tracking-wide flex items-center gap-3">
                    <i class="fas fa-save text-xl"></i>
                    UPDATE BRAND
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('currentImage').classList.add('hidden');
                document.getElementById('imagePreview').classList.remove('hidden');
                document.getElementById('imagePreview').querySelector('img').src = e.target.result;
                document.getElementById('uploadPlaceholder').classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush