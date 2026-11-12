@extends('layouts.app')

@section('title', 'Kelola Dokumentasi')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">Kelola Dokumentasi</h1>
            <p class="text-slate-500 mt-1.5">Upload dan kelola galeri dokumentasi sekolah</p>
        </div>
        <a href="{{ route('admin.dokumentasi.create') }}" class="btn-primary self-start">
            <i class="fas fa-plus text-xs"></i> Tambah Dokumentasi
        </a>
    </div>

    <!-- Grid Dokumentasi -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
        @foreach($dokumentasi as $doc)
        <div class="bg-white rounded-3xl border border-slate-100 shadow-soft overflow-hidden hover:shadow-card hover:-translate-y-1 transition-all duration-300 group flex flex-col">
            <div class="relative h-48 overflow-hidden">
                @if($doc->first_image)
                <img src="{{ Storage::url($doc->first_image) }}"
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
                <span class="absolute bottom-3 right-3 bg-slate-900/70 backdrop-blur-sm text-white text-xs font-medium px-2.5 py-1 rounded-full flex items-center gap-1.5">
                    <i class="fas fa-camera text-[10px]"></i> {{ $doc->files_count }} foto
                </span>
            </div>

            <div class="p-6 flex flex-col flex-1">
                <h3 class="text-lg font-bold text-slate-900 mb-2 line-clamp-2 leading-snug">{{ $doc->judul_kegiatan }}</h3>
                <p class="text-slate-500 text-sm mb-4 line-clamp-2">{{ $doc->deskripsi }}</p>

                <div class="flex items-center gap-2.5 text-sm text-slate-400 mb-5">
                    <i class="far fa-calendar-alt text-blue-600"></i> {{ $doc->tanggal_kegiatan->translatedFormat('d F Y') }}
                </div>

                <div class="flex items-center gap-2 mt-auto">
                    <a href="{{ route('admin.dokumentasi.show', $doc->id) }}"
                       class="btn-secondary w-full justify-center !bg-blue-50 !text-blue-700 hover:!bg-blue-100">
                        <i class="fas fa-eye text-xs"></i> Lihat Detail
                    </a>
                    <a href="{{ route('admin.dokumentasi.edit', $doc->id) }}"
                       class="w-10 h-10 rounded-xl bg-slate-50 text-slate-500 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-all flex-shrink-0" title="Edit">
                        <i class="fas fa-pen text-sm"></i>
                    </a>
                    <form action="{{ route('admin.dokumentasi.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Hapus dokumentasi ini? Tindakan ini tidak dapat dibatalkan.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-10 h-10 rounded-xl bg-slate-50 text-slate-500 hover:bg-red-600 hover:text-white flex items-center justify-center transition-all flex-shrink-0" title="Hapus">
                            <i class="fas fa-trash text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($dokumentasi->isEmpty())
    <div class="text-center py-16 bg-white rounded-3xl border border-dashed border-slate-200">
        <div class="w-20 h-20 mx-auto rounded-3xl bg-slate-50 flex items-center justify-center mb-5">
            <i class="fas fa-images text-slate-300 text-3xl"></i>
        </div>
        <h3 class="text-lg font-bold text-slate-900 mb-2">Belum ada dokumentasi</h3>
        <p class="text-slate-500 text-sm mb-6">Mulai dengan mengupload dokumentasi kegiatan sekolah pertama Anda.</p>
        <a href="{{ route('admin.dokumentasi.create') }}" class="btn-primary">
            <i class="fas fa-plus text-xs"></i> Tambah Dokumentasi Pertama
        </a>
    </div>
    @endif
</div>
@endsection
