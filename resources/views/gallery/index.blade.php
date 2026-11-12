@extends('layouts.public')

@section('title', 'Galeri Kegiatan')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Hero Header -->
    <div class="relative bg-gradient-to-br from-blue-700 via-blue-800 to-indigo-900 rounded-3xl p-8 md:p-12 text-white mb-12 overflow-hidden shadow-card">
        <div class="absolute inset-0 opacity-40"
             style="background-image: linear-gradient(rgba(255,255,255,.06) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.06) 1px, transparent 1px); background-size: 56px 56px;"></div>
        <div class="absolute -top-10 -right-10 w-48 h-48 bg-sky-400/20 rounded-full blur-2xl"></div>
        <div class="absolute -bottom-16 -left-8 w-56 h-56 bg-indigo-400/20 rounded-full blur-2xl"></div>
        <div class="relative z-10">
            <span class="bg-white/10 backdrop-blur-sm border border-white/15 text-xs font-semibold px-3.5 py-1.5 rounded-full inline-flex items-center gap-2 mb-5">
                <i class="fas fa-images"></i> Galeri
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-3">Galeri Kegiatan Sekolah</h1>
            <p class="text-blue-100/90 max-w-2xl leading-relaxed">
                Dokumentasi foto berbagai kegiatan di SMAN 17 Maluku Tengah — mulai dari pembelajaran,
                ekstrakurikuler, hingga acara resmi sekolah. Klik kegiatan untuk melihat seluruh foto.
            </p>
        </div>
    </div>

    <!-- Grid Dokumentasi -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($dokumentasi as $doc)
        <a href="{{ route('galeri.show', $doc->id) }}"
           class="group bg-white rounded-3xl border border-slate-100 shadow-soft overflow-hidden hover-lift flex flex-col">
            <div class="relative h-56 overflow-hidden">
                @if($doc->files->first())
                <img src="{{ Storage::url($doc->files->first()->path_file) }}"
                     alt="{{ $doc->judul_kegiatan }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                <div class="w-full h-full bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
                    <i class="fas fa-image text-slate-300 text-4xl"></i>
                </div>
                @endif

                <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-slate-700 text-xs font-semibold px-3 py-1.5 rounded-full shadow-sm">
                    {{ $doc->kategori }}
                </span>

                @if($doc->files_count)
                <div class="absolute bottom-3 right-3 bg-slate-900/70 backdrop-blur-sm text-white text-xs font-medium px-2.5 py-1 rounded-full flex items-center gap-1.5">
                    <i class="fas fa-camera text-[10px]"></i> {{ $doc->files_count }} foto
                </div>
                @endif
            </div>

            <div class="p-6 flex flex-col flex-1">
                <h3 class="text-lg font-bold text-slate-900 mb-2 line-clamp-2 leading-snug group-hover:text-blue-700 transition-colors">
                    {{ $doc->judul_kegiatan }}
                </h3>
                <p class="text-slate-500 text-sm mb-5 line-clamp-2">
                    {{ Str::limit($doc->deskripsi, 120) }}
                </p>
                <div class="flex items-center justify-between text-sm mt-auto">
                    <div class="flex items-center gap-2 text-slate-400">
                        <i class="far fa-calendar-alt text-blue-600"></i>
                        {{ $doc->tanggal_kegiatan->translatedFormat('d F Y') }}
                    </div>
                    <span class="text-blue-700 font-semibold inline-flex items-center gap-1.5 group-hover:gap-2.5 transition-all">
                        Detail <i class="fas fa-arrow-right text-xs"></i>
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <!-- Empty State -->
    @if($dokumentasi->isEmpty())
    <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-slate-200">
        <div class="w-20 h-20 bg-slate-50 rounded-3xl flex items-center justify-center mx-auto mb-5 shadow-soft">
            <i class="fas fa-image text-slate-300 text-3xl"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-800 mb-2">Belum Ada Dokumentasi</h3>
        <p class="text-slate-500">Galeri masih kosong. Dokumentasi kegiatan yang diunggah admin akan tampil di sini.</p>
    </div>
    @endif

    <!-- Pagination -->
    @if($dokumentasi->hasPages())
    <div class="mt-12 flex justify-center">
        {{ $dokumentasi->onEachSide(1)->links() }}
    </div>
    @endif
</div>
@endsection
