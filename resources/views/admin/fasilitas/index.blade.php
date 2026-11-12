@extends('layouts.app')

@section('title', 'Kelola Fasilitas')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Kelola Fasilitas</h1>
            <p class="text-gray-600 mt-2">Fasilitas yang tampil di section "Fasilitas Sekolah" pada landing page</p>
        </div>
        <a href="{{ route('admin.fasilitas.create') }}"
           class="flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-all duration-300 hover:shadow-lg">
            <i class="fas fa-plus"></i> 
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
        {{ session('success') }}
    </div>
    @endif

    <!-- Kartu Besar (dengan deskripsi) -->
    <div>
        <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Kartu Besar (dengan deskripsi & poin)</p>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
            @forelse($fasilitas->filter(fn ($f) => $f->is_aktif && $f->deskripsi) as $f)
            @include('admin.fasilitas._card', ['f' => $f])
            @empty
            <div class="bg-gray-50 border border-dashed border-gray-200 rounded-xl p-6 text-center text-sm text-gray-500 col-span-full">
                Belum ada fasilitas besar. <a href="{{ route('admin.fasilitas.create') }}" class="text-blue-600 font-semibold">Tambah sekarang</a>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Kartu Kecil -->
    <div>
        <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Kartu Kecil (nama + ikon saja)</p>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
            @foreach($fasilitas->filter(fn ($f) => ! $f->deskripsi) as $f)
            @include('admin.fasilitas._card', ['f' => $f])
            @endforeach
        </div>
        @if($fasilitas->filter(fn ($f) => ! $f->deskripsi)->isEmpty())
        <div class="bg-gray-50 border border-dashed border-gray-200 rounded-xl p-6 text-center text-sm text-gray-500">
            Belum ada kartu kecil.
        </div>
        @endif
    </div>

    <a href="{{ route('admin.setting.edit') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium">
        <i class="fas fa-arrow-left"></i> Kembali ke Pengaturan
    </a>
</div>
@endsection
