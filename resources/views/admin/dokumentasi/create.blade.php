@extends('layouts.app')

@section('title', 'Tambah Dokumentasi')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div>
            <nav class="flex items-center gap-2 text-sm text-slate-400 mb-1.5">
                <a href="{{ route('admin.dokumentasi.index') }}" class="hover:text-blue-700 transition-colors">Dokumentasi</a>
                <i class="fas fa-chevron-right text-[9px]"></i>
                <span class="text-slate-700 font-medium">Tambah Baru</span>
            </nav>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">Tambah Dokumentasi</h1>
            <p class="text-slate-500 mt-1.5">Upload foto dokumentasi kegiatan sekolah</p>
        </div>
        <a href="{{ route('admin.dokumentasi.index') }}" class="btn-secondary self-start">
            <i class="fas fa-arrow-left text-xs"></i> Kembali
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-soft p-7">
        <form action="{{ route('admin.dokumentasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8 gap-y-6">
                <!-- Kolom kiri -->
                <div class="space-y-6">
                    <div>
                        <label for="judul_kegiatan" class="block text-sm font-semibold text-slate-700 mb-2">Judul Kegiatan <span class="text-red-500">*</span></label>
                        <input type="text" name="judul_kegiatan" id="judul_kegiatan" value="{{ old('judul_kegiatan') }}"
                               class="form-input @error('judul_kegiatan') border-red-400 bg-red-50/40 @enderror"
                               placeholder="Contoh: Upacara Peringatan Hari Guru Nasional" required>
                        @error('judul_kegiatan')
                            <p class="mt-1.5 text-xs text-red-600"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kategori" class="block text-sm font-semibold text-slate-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                        <select name="kategori" id="kategori" class="form-input @error('kategori') border-red-400 bg-red-50/40 @enderror" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Upacara" {{ old('kategori') == 'Upacara' ? 'selected' : '' }}>Upacara Bendera</option>
                            <option value="Porseni" {{ old('kategori') == 'Porseni' ? 'selected' : '' }}>Porseni</option>
                            <option value="Study Tour" {{ old('kategori') == 'Study Tour' ? 'selected' : '' }}>Study Tour</option>
                            <option value="Pentas Seni" {{ old('kategori') == 'Pentas Seni' ? 'selected' : '' }}>Pentas Seni</option>
                            <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori')
                            <p class="mt-1.5 text-xs text-red-600"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_kegiatan" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Kegiatan <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan" value="{{ old('tanggal_kegiatan') }}"
                               class="form-input @error('tanggal_kegiatan') border-red-400 bg-red-50/40 @enderror" required>
                        @error('tanggal_kegiatan')
                            <p class="mt-1.5 text-xs text-red-600"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Kolom kanan -->
                <div class="space-y-6">
                    <div>
                        <label for="deskripsi" class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                                  class="form-input @error('deskripsi') border-red-400 bg-red-50/40 @enderror resize-y"
                                  placeholder="Tuliskan deskripsi singkat kegiatan...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1.5 text-xs text-red-600"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="files" class="block text-sm font-semibold text-slate-700 mb-2">Upload Foto <span class="text-red-500">*</span></label>
                        <label class="block border-2 border-dashed border-slate-200 hover:border-blue-400 hover:bg-blue-50/40 rounded-2xl p-8 text-center cursor-pointer transition-colors group">
                            <input type="file" name="files[]" id="files" multiple accept="image/*" class="hidden" required>
                            <span class="w-14 h-14 mx-auto rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center mb-3 group-hover:scale-105 transition-transform"><i class="fas fa-cloud-arrow-up text-xl"></i></span>
                            <span class="block text-sm font-semibold text-slate-700">Klik untuk memilih foto</span>
                            <span class="block text-xs text-slate-400 mt-1.5">Bisa pilih beberapa foto sekaligus</span>
                            <span class="block text-[11px] text-slate-400 mt-2.5 bg-slate-50 border border-slate-100 rounded-full px-3 py-1 inline-block">JPEG, PNG, JPG, GIF · maks 2MB per file</span>
                        </label>
                        @error('files')
                            <p class="mt-1.5 text-xs text-red-600"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                        @enderror
                        @error('files.*')
                            <p class="mt-1.5 text-xs text-red-600"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Aksi -->
            <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('admin.dokumentasi.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-floppy-disk text-xs"></i> Simpan Dokumentasi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
