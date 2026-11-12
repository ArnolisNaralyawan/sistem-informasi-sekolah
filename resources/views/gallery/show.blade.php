@extends('layouts.public')

@section('title', $dokumentasi->judul_kegiatan)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Breadcrumb + back -->
    <nav class="flex items-center gap-2 text-sm mb-7" aria-label="Breadcrumb">
        <a href="{{ url('/') }}" class="text-slate-400 hover:text-blue-600 transition-colors">Beranda</a>
        <i class="fas fa-chevron-right text-[9px] text-slate-300"></i>
        <a href="{{ route('galeri') }}" class="text-slate-400 hover:text-blue-600 transition-colors">Galeri</a>
        <i class="fas fa-chevron-right text-[9px] text-slate-300"></i>
        <span class="text-slate-700 font-medium truncate max-w-[12rem] sm:max-w-xs">{{ Str::limit($dokumentasi->judul_kegiatan, 40) }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Konten Utama -->
        <div class="lg:col-span-2 space-y-8">

            <!-- Info Kegiatan -->
            <div class="bg-white rounded-3xl shadow-soft border border-slate-100 p-6 md:p-9">
                <div class="flex flex-wrap items-center gap-2.5 mb-4">
                    <span class="bg-blue-600/10 text-blue-700 border border-blue-100 text-sm font-semibold px-3.5 py-1 rounded-full">
                        {{ $dokumentasi->kategori }}
                    </span>
                    <span class="bg-emerald-50 text-emerald-700 border border-emerald-100 text-sm font-semibold px-3.5 py-1 rounded-full">
                        <i class="fas fa-camera mr-1 text-xs"></i> {{ $dokumentasi->files->count() }} foto
                    </span>
                </div>

                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight leading-snug mb-4">{{ $dokumentasi->judul_kegiatan }}</h1>

                @if($dokumentasi->deskripsi)
                <p class="text-slate-600 leading-relaxed bg-slate-50 p-5 rounded-2xl border border-slate-100">
                    {{ $dokumentasi->deskripsi }}
                </p>
                @endif

                <div class="flex flex-wrap gap-x-7 gap-y-3 mt-7 text-sm text-slate-600">
                    <div class="flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center"><i class="far fa-calendar-alt text-xs"></i></span>
                        <span>{{ $dokumentasi->tanggal_kegiatan->translatedFormat('l, d F Y') }}</span>
                    </div>
                    @if($dokumentasi->user)
                    <div class="flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center"><i class="far fa-user text-xs"></i></span>
                        <span>Diunggah oleh <strong class="text-slate-800">{{ $dokumentasi->user->name }}</strong></span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Foto Kegiatan -->
            <div class="bg-white rounded-3xl shadow-soft border border-slate-100 p-6 md:p-9">
                <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                    <span class="w-9 h-9 rounded-xl bg-blue-600/10 text-blue-600 flex items-center justify-center"><i class="fas fa-images text-sm"></i></span>
                    Foto Kegiatan
                    <span class="text-xs font-semibold text-slate-500 bg-slate-100 px-3 py-1 rounded-full">{{ $dokumentasi->files->count() }} foto</span>
                </h2>

                @if($dokumentasi->files->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($dokumentasi->files as $file)
                    <button type="button"
                         class="group relative bg-slate-50 rounded-2xl border border-slate-200 overflow-hidden cursor-pointer focus:outline-none focus:ring-4 focus:ring-blue-200"
                         onclick="openModal('{{ Storage::url($file->path_file) }}', '{{ $dokumentasi->judul_kegiatan }}')">
                        <img src="{{ Storage::url($file->path_file) }}"
                             alt="{{ $dokumentasi->judul_kegiatan }}"
                             loading="lazy"
                             class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/30 transition-all duration-300 flex items-center justify-center">
                            <span class="w-11 h-11 rounded-full bg-white/90 text-blue-600 flex items-center justify-center opacity-0 group-hover:opacity-100 scale-75 group-hover:scale-100 transition-all duration-300 shadow-lg">
                                <i class="fas fa-magnifying-glass-plus"></i>
                            </span>
                        </div>
                    </button>
                    @endforeach
                </div>
                @else
                <div class="text-center py-14">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-slate-100 flex items-center justify-center">
                        <i class="fas fa-image text-slate-300 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-1">Tidak ada foto</h3>
                    <p class="text-slate-500">Dokumentasi ini belum memiliki foto.</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">

            <!-- Ringkasan -->
            <div class="relative bg-gradient-to-br from-blue-700 via-blue-800 to-indigo-900 text-white rounded-3xl p-7 overflow-hidden">
                <div class="absolute -top-8 -right-8 w-36 h-36 bg-sky-400/20 rounded-full blur-2xl"></div>
                <div class="relative">
                    <h3 class="text-lg font-bold mb-5 flex items-center gap-2.5">
                        <span class="w-8 h-8 rounded-lg bg-white/10 border border-white/15 flex items-center justify-center"><i class="fas fa-clipboard-list text-xs"></i></span>
                        Ringkasan
                    </h3>
                    <div class="space-y-3.5 text-sm">
                        <div class="flex justify-between items-center">
                            <span class="text-blue-200">Total Foto</span>
                            <span class="bg-white/15 border border-white/10 px-2.5 py-0.5 rounded-full font-semibold">{{ $dokumentasi->files->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-200">Kategori</span>
                            <span class="font-medium">{{ $dokumentasi->kategori }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-200">Tanggal</span>
                            <span class="font-medium">{{ $dokumentasi->tanggal_kegiatan->translatedFormat('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dokumentasi Lainnya -->
            <div class="bg-white rounded-3xl shadow-soft border border-slate-100 p-7">
                <h3 class="text-lg font-bold text-slate-900 mb-5 flex items-center gap-2.5">
                    <span class="w-8 h-8 rounded-lg bg-blue-600/10 text-blue-600 flex items-center justify-center"><i class="fas fa-layer-group text-xs"></i></span>
                    Kegiatan Lainnya
                </h3>

                @if($lainnya->count() > 0)
                <div class="space-y-2">
                    @foreach($lainnya as $doc)
                    <a href="{{ route('galeri.show', $doc->id) }}"
                       class="flex gap-4 p-2.5 rounded-2xl hover:bg-slate-50 transition-colors duration-200 group">
                        <div class="w-16 h-16 flex-shrink-0 rounded-xl overflow-hidden bg-slate-100">
                            @if($doc->files->first())
                            <img src="{{ Storage::url($doc->files->first()->path_file) }}"
                                 alt="{{ $doc->judul_kegiatan }}" loading="lazy"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-image text-slate-300"></i>
                            </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-slate-800 line-clamp-2 leading-snug group-hover:text-blue-700 transition-colors">
                                {{ $doc->judul_kegiatan }}
                            </p>
                            <p class="text-xs text-slate-400 mt-1.5">
                                <i class="far fa-calendar-alt mr-1"></i> {{ $doc->tanggal_kegiatan->translatedFormat('d M Y') }}
                            </p>
                        </div>
                    </a>
                    @endforeach
                </div>

                <a href="{{ route('galeri') }}" class="mt-5 flex items-center justify-center gap-2 text-sm font-semibold text-blue-700 bg-blue-50 hover:bg-blue-100 py-3 rounded-2xl transition-colors">
                    Lihat Semua <i class="fas fa-arrow-right text-xs"></i>
                </a>
                @else
                <p class="text-sm text-slate-500">Belum ada kegiatan lain.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Lightbox Modal -->
<div id="imageModal" class="fixed inset-0 bg-slate-950/95 z-[60] hidden items-center justify-center p-4" role="dialog" aria-modal="true">
    <button onclick="closeModal()" class="absolute top-5 right-5 w-11 h-11 rounded-full bg-white/10 text-white hover:bg-white/20 transition-colors flex items-center justify-center" aria-label="Tutup">
        <i class="fas fa-xmark text-xl"></i>
    </button>
    <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-2xl shadow-2xl">
    <div id="modalCaption" class="absolute bottom-6 left-1/2 -translate-x-1/2 text-white text-center text-base font-medium px-4 bg-white/10 backdrop-blur-sm border border-white/15 rounded-full py-2 px-5"></div>
</div>
@endsection

@section('scripts')
<script>
    function openModal(imageSrc, caption) {
        const modal = document.getElementById('imageModal');
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('modalCaption').textContent = caption;
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
        document.querySelectorAll('img').forEach(function(img) {
            img.addEventListener('error', function() {
                this.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjE1MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjNmNGY2Ii8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxMiIgZmlsbD0iIzljYTNhZiIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPkdhbWJhciB0aWRhayBkYXBhdCBkaW11YXQ8L3RleHQ+PC9zdmc+';
            });
        });
    });
</script>
@endsection
