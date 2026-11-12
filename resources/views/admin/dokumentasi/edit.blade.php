@extends('layouts.app')

@section('title', 'Edit Dokumentasi - ' . $dokumentasi->judul_kegiatan)

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div>
            <nav class="flex items-center gap-2 text-sm text-slate-400 mb-1.5">
                <a href="{{ route('admin.dokumentasi.index') }}" class="hover:text-blue-700 transition-colors">Dokumentasi</a>
                <i class="fas fa-chevron-right text-[9px]"></i>
                <a href="{{ route('admin.dokumentasi.show', $dokumentasi->id) }}" class="hover:text-blue-700 transition-colors">Detail</a>
                <i class="fas fa-chevron-right text-[9px]"></i>
                <span class="text-slate-700 font-medium">Edit</span>
            </nav>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">Edit Dokumentasi</h1>
            <p class="text-slate-500 mt-1.5">Perbarui informasi dokumentasi kegiatan</p>
        </div>

        <div class="flex items-center gap-3 self-start">
            <a href="{{ route('admin.dokumentasi.show', $dokumentasi->id) }}" class="btn-secondary">
                <i class="fas fa-eye text-xs"></i> Lihat Detail
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-soft p-7">
        <form action="{{ route('admin.dokumentasi.update', $dokumentasi->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8 gap-y-6">
                <!-- Kolom kiri -->
                <div class="space-y-6">
                    <div>
                        <label for="judul_kegiatan" class="block text-sm font-semibold text-slate-700 mb-2">Judul Kegiatan <span class="text-red-500">*</span></label>
                        <input type="text" name="judul_kegiatan" id="judul_kegiatan" value="{{ old('judul_kegiatan', $dokumentasi->judul_kegiatan) }}"
                               class="form-input @error('judul_kegiatan') border-red-400 bg-red-50/40 @enderror" required>
                        @error('judul_kegiatan')
                            <p class="mt-1.5 text-xs text-red-600"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kategori" class="block text-sm font-semibold text-slate-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                        <select name="kategori" id="kategori" class="form-input @error('kategori') border-red-400 bg-red-50/40 @enderror" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Upacara" {{ old('kategori', $dokumentasi->kategori) == 'Upacara' ? 'selected' : '' }}>Upacara Bendera</option>
                            <option value="Porseni" {{ old('kategori', $dokumentasi->kategori) == 'Porseni' ? 'selected' : '' }}>Porseni</option>
                            <option value="Study Tour" {{ old('kategori', $dokumentasi->kategori) == 'Study Tour' ? 'selected' : '' }}>Study Tour</option>
                            <option value="Pentas Seni" {{ old('kategori', $dokumentasi->kategori) == 'Pentas Seni' ? 'selected' : '' }}>Pentas Seni</option>
                            <option value="Lainnya" {{ old('kategori', $dokumentasi->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori')
                            <p class="mt-1.5 text-xs text-red-600"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_kegiatan" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Kegiatan <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan"
                               value="{{ old('tanggal_kegiatan', $dokumentasi->tanggal_kegiatan->format('Y-m-d')) }}"
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
                                  class="form-input @error('deskripsi') border-red-400 bg-red-50/40 @enderror resize-y">{{ old('deskripsi', $dokumentasi->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1.5 text-xs text-red-600"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="files" class="block text-sm font-semibold text-slate-700 mb-2">Tambah Foto Baru <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <label class="block border-2 border-dashed border-slate-200 hover:border-blue-400 hover:bg-blue-50/40 rounded-2xl p-6 text-center cursor-pointer transition-colors group">
                            <input type="file" name="files[]" id="files" multiple accept="image/*" class="hidden">
                            <span class="w-12 h-12 mx-auto rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center mb-3 group-hover:scale-105 transition-transform"><i class="fas fa-cloud-arrow-up text-lg"></i></span>
                            <span class="block text-sm font-semibold text-slate-700">Klik untuk menambah foto</span>
                            <span class="block text-xs text-slate-400 mt-1.5">JPEG, PNG, JPG, GIF · maks 2MB per file</span>
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

            <!-- Foto existing -->
            @if($dokumentasi->files->count() > 0)
            <div class="pt-2">
                <h3 class="text-base font-bold text-slate-900 mb-4 flex items-center gap-2.5">
                    <span class="w-8 h-8 rounded-lg bg-blue-600/10 text-blue-600 flex items-center justify-center"><i class="fas fa-images text-xs"></i></span>
                    Foto yang Sudah Diupload
                    <span class="text-xs font-semibold text-slate-500 bg-slate-100 px-2.5 py-0.5 rounded-full">{{ $dokumentasi->files->count() }} foto</span>
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    @foreach($dokumentasi->files as $file)
                    <div class="relative group bg-slate-50 rounded-2xl border border-slate-200 overflow-hidden">
                        <img src="{{ Storage::url($file->path_file) }}"
                             alt="{{ $dokumentasi->judul_kegiatan }}" loading="lazy"
                             class="w-full h-32 object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-slate-900/80 to-transparent p-2">
                            <p class="text-white text-[11px] truncate">{{ $file->nama_file }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Aksi -->
            <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('admin.dokumentasi.show', $dokumentasi->id) }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-floppy-disk text-xs"></i> Perbarui Dokumentasi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
