@extends('layouts.app')

@section('title', 'Detail Dokumentasi - ' . $dokumentasi->judul_kegiatan)

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div>
            <nav class="flex items-center gap-2 text-sm text-slate-400 mb-1.5">
                <a href="{{ route('admin.dokumentasi.index') }}" class="hover:text-blue-700 transition-colors">Dokumentasi</a>
                <i class="fas fa-chevron-right text-[9px]"></i>
                <span class="text-slate-700 font-medium truncate max-w-[10rem] sm:max-w-xs">Detail</span>
            </nav>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">{{ $dokumentasi->judul_kegiatan }}</h1>
            <div class="flex flex-wrap items-center gap-2 mt-3">
                <span class="bg-blue-600/10 text-blue-700 border border-blue-100 text-xs font-semibold px-3 py-1 rounded-full">{{ $dokumentasi->kategori }}</span>
                <span class="bg-emerald-50 text-emerald-700 border border-emerald-100 text-xs font-semibold px-3 py-1 rounded-full">
                    <i class="fas fa-camera mr-1 text-[10px]"></i>{{ $dokumentasi->files_count }} foto
                </span>
            </div>
        </div>

        <div class="flex items-center gap-3 self-start">
            <a href="{{ route('admin.dokumentasi.edit', $dokumentasi->id) }}" class="btn-secondary">
                <i class="fas fa-pen text-xs"></i> Edit
            </a>
            <form action="{{ route('admin.dokumentasi.destroy', $dokumentasi->id) }}" method="POST" onsubmit="return confirm('Hapus dokumentasi ini? Tindakan ini tidak dapat dibatalkan.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">
                    <i class="fas fa-trash text-xs"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Info + Foto -->
        <div class="xl:col-span-2 space-y-8">
            <!-- Info Card -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-soft p-7">
                @if($dokumentasi->deskripsi)
                <div class="mb-7">
                    <h3 class="text-base font-bold text-slate-900 mb-3 flex items-center gap-2.5">
                        <span class="w-8 h-8 rounded-lg bg-blue-600/10 text-blue-600 flex items-center justify-center"><i class="fas fa-file-lines text-xs"></i></span>
                        Deskripsi Kegiatan
                    </h3>
                    <p class="text-slate-600 leading-relaxed bg-slate-50 p-5 rounded-2xl border border-slate-100">
                        {{ $dokumentasi->deskripsi }}
                    </p>
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="flex items-center gap-3.5 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <div class="w-11 h-11 bg-blue-600/10 text-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-500">Tanggal Kegiatan</p>
                            <p class="font-semibold text-slate-900 text-sm truncate">{{ $dokumentasi->tanggal_kegiatan->translatedFormat('l, d F Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3.5 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <div class="w-11 h-11 bg-emerald-500/10 text-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="far fa-clock"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-500">Dibuat Pada</p>
                            <p class="font-semibold text-slate-900 text-sm truncate">{{ $dokumentasi->created_at->translatedFormat('d F Y H:i') }}</p>
                        </div>
                    </div>
                    @if($dokumentasi->user)
                    <div class="flex items-center gap-3.5 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <div class="w-11 h-11 bg-violet-500/10 text-violet-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-500">Dibuat Oleh</p>
                            <p class="font-semibold text-slate-900 text-sm truncate">{{ $dokumentasi->user->name }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Foto -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-soft p-7">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2.5">
                        <span class="w-9 h-9 rounded-xl bg-blue-600/10 text-blue-600 flex items-center justify-center"><i class="fas fa-images text-sm"></i></span>
                        Foto Dokumentasi
                    </h2>
                    <span class="text-xs font-semibold text-slate-500 bg-slate-100 px-3 py-1.5 rounded-full">{{ $dokumentasi->files_count }} foto</span>
                </div>

                @if($dokumentasi->files->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach($dokumentasi->files as $file)
                    <div class="group relative bg-slate-50 rounded-2xl border border-slate-200 overflow-hidden hover:shadow-card transition-all duration-300">
                        <img src="{{ Storage::url($file->path_file) }}"
                             alt="{{ $dokumentasi->judul_kegiatan }}"
                             loading="lazy"
                             class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-500 cursor-zoom-in"
                             onclick="openModal('{{ Storage::url($file->path_file) }}', '{{ $dokumentasi->judul_kegiatan }}')">

                        <div class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/30 transition-all duration-300 flex items-center justify-center cursor-zoom-in"
                             onclick="openModal('{{ Storage::url($file->path_file) }}', '{{ $dokumentasi->judul_kegiatan }}')">
                            <span class="w-10 h-10 rounded-full bg-white/90 text-blue-600 flex items-center justify-center opacity-0 group-hover:opacity-100 scale-75 group-hover:scale-100 transition-all duration-300 shadow-lg">
                                <i class="fas fa-magnifying-glass-plus"></i>
                            </span>
                        </div>

                        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-slate-900/80 to-transparent p-3 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                            <p class="text-xs font-medium truncate">{{ $file->nama_file }}</p>
                            <p class="text-[10px] opacity-75">{{ $file->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-14">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-100 flex items-center justify-center mb-4">
                        <i class="fas fa-image text-slate-300 text-2xl"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-1">Tidak ada foto</h3>
                    <p class="text-slate-500 text-sm">Belum ada foto yang diupload untuk dokumentasi ini.</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Sidebar Ringkasan -->
        <div>
            <div class="relative bg-gradient-to-br from-blue-700 via-blue-800 to-indigo-900 text-white rounded-3xl p-7 overflow-hidden shadow-card">
                <div class="absolute -top-8 -right-8 w-36 h-36 bg-sky-400/20 rounded-full blur-2xl"></div>
                <div class="relative">
                    <h3 class="text-lg font-bold mb-5 flex items-center gap-2.5">
                        <span class="w-8 h-8 rounded-lg bg-white/10 border border-white/15 flex items-center justify-center"><i class="fas fa-clipboard-list text-xs"></i></span>
                        Ringkasan
                    </h3>
                    <div class="space-y-3.5 text-sm">
                        <div class="flex justify-between items-center">
                            <span class="text-blue-200">Total Foto</span>
                            <span class="bg-white/15 border border-white/10 px-2.5 py-0.5 rounded-full font-semibold">{{ $dokumentasi->files_count }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-200">Kategori</span>
                            <span class="font-medium">{{ $dokumentasi->kategori }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-200">Status</span>
                            <span class="bg-emerald-500/20 border border-emerald-400/30 text-emerald-100 px-2.5 py-0.5 rounded-full text-xs font-semibold">Aktif</span>
                        </div>
                    </div>

                    <div class="mt-7 pt-5 border-t border-white/10">
                        <a href="{{ route('admin.dokumentasi.edit', $dokumentasi->id) }}"
                           class="w-full inline-flex items-center justify-center gap-2 bg-white text-blue-700 font-semibold py-3 rounded-2xl text-sm hover:bg-blue-50 transition-colors">
                            <i class="fas fa-pen text-xs"></i> Edit Dokumentasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Lightbox -->
<div id="imageModal" class="fixed inset-0 bg-slate-950/95 z-50 hidden items-center justify-center p-4" role="dialog" aria-modal="true">
    <button onclick="closeModal()" class="absolute top-5 right-5 w-11 h-11 rounded-full bg-white/10 text-white hover:bg-white/20 transition-colors flex items-center justify-center" aria-label="Tutup">
        <i class="fas fa-xmark text-xl"></i>
    </button>
    <div class="relative max-w-4xl max-h-full">
        <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-2xl shadow-2xl">
        <div id="modalCaption" class="text-white text-center mt-4 text-sm font-medium bg-white/10 backdrop-blur-sm border border-white/15 rounded-full py-2 px-5 inline-block w-full"></div>
    </div>
</div>

<script>
    function openModal(imageSrc, caption) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('modalCaption').textContent = caption;
        const modal = document.getElementById('imageModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });

    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    // Fallback gambar rusak
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('img').forEach(img => {
            img.addEventListener('error', function() {
                this.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjNmNGY2Ii8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzljYTNhZiIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPkdhbWJhciB0aWRhayBkYXBhdCBkaW11YXQ8L3RleHQ+PC9zdmc+';
            });
        });
    });
</script>
@endsection
