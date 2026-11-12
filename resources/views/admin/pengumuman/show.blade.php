@extends('layouts.app')

@section('title', $pengumuman->judul)

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div>
            <nav class="flex items-center gap-2 text-sm text-slate-400 mb-1.5">
                <a href="{{ route('admin.pengumuman.index') }}" class="hover:text-blue-700 transition-colors">Pengumuman</a>
                <i class="fas fa-chevron-right text-[9px]"></i>
                <span class="text-slate-700 font-medium truncate max-w-xs sm:max-w-sm">Detail</span>
            </nav>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">{{ $pengumuman->judul }}</h1>
            <div class="flex flex-wrap items-center gap-2 mt-3">
                @php
                    $tipeChip = [
                        'pengumuman' => ['bg-emerald-50 text-emerald-700 border-emerald-100', 'fa-circle-check'],
                        'berita'     => ['bg-violet-50 text-violet-700 border-violet-100', 'fa-newspaper'],
                        'event'      => ['bg-orange-50 text-orange-700 border-orange-100', 'fa-calendar-days'],
                    ][$pengumuman->tipe] ?? ['bg-slate-100 text-slate-700 border-slate-200', 'fa-tag'];
                @endphp
                <span class="px-3 py-1 text-xs font-semibold rounded-full border {{ $tipeChip[0] }}">
                    <i class="fas {{ $tipeChip[1] }} text-[10px] mr-1"></i>{{ $pengumuman->tipe }}
                </span>
                <span class="px-3 py-1 text-xs font-semibold rounded-full border {{ $pengumuman->status == 1 ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-red-50 text-red-700 border-red-100' }}">
                    <span class="w-1.5 h-1.5 rounded-full inline-block mr-1.5 {{ $pengumuman->status == 1 ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                    {{ $pengumuman->status == 1 ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>
        </div>
        <div class="flex gap-3 self-start">
            <a href="{{ route('admin.pengumuman.edit', $pengumuman->id) }}" class="btn-primary">
                <i class="fas fa-pen text-xs"></i> Edit
            </a>
            <a href="{{ route('admin.pengumuman.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left text-xs"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-soft overflow-hidden">
        <!-- Image -->
        @if($pengumuman->gambar)
        <div class="relative h-72 md:h-80 bg-slate-100">
            <img src="{{ Storage::url($pengumuman->gambar) }}" alt="{{ $pengumuman->judul }}" class="w-full h-full object-cover">
        </div>
        @endif

        <!-- Metainfo -->
        <div class="px-7 pt-7 pb-0">
            <div class="flex flex-wrap gap-x-6 gap-y-2.5 text-sm text-slate-500 pb-6 border-b border-slate-100">
                <div class="flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center"><i class="far fa-calendar text-xs"></i></span>
                    <span>Dibuat: <strong class="text-slate-700">{{ \Carbon\Carbon::parse($pengumuman->created_at)->translatedFormat('d F Y H:i') }}</strong></span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center"><i class="fas fa-clock text-xs"></i></span>
                    <span>
                        Tanggal:
                        <strong class="text-slate-700">{{ \Carbon\Carbon::parse($pengumuman->tanggal_mulai)->translatedFormat('d F Y') }}</strong>
                        @if($pengumuman->tanggal_selesai)
                        — {{ \Carbon\Carbon::parse($pengumuman->tanggal_selesai)->translatedFormat('d F Y') }}
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Isi -->
        <div class="p-7">
            <div class="prose-admin max-w-none">
                {!! $pengumuman->isi !!}
            </div>
        </div>
    </div>
</div>

<style>
    .prose-admin {
        line-height: 1.8;
        color: #334155;
    }
    .prose-admin h1, .prose-admin h2, .prose-admin h3 {
        color: #0f172a;
        font-weight: 700;
        margin: 1.5rem 0 .75rem;
    }
    .prose-admin p { margin-bottom: 1rem; }
    .prose-admin ul, .prose-admin ol { margin: 1rem 0; padding-left: 1.5rem; }
    .prose-admin ul { list-style: disc; }
    .prose-admin ol { list-style: decimal; }
    .prose-admin li { margin-bottom: .5rem; }
    .prose-admin strong { font-weight: 600; color: #0f172a; }
    .prose-admin a { color: #2563eb; text-decoration: underline; }
    .prose-admin img { border-radius: 1rem; margin: 1rem 0; max-width: 100%; }
</style>
@endsection
