@extends('layouts.app')

@section('title', 'Kelola Pengumuman')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">Kelola Pengumuman</h1>
            <p class="text-slate-500 mt-1.5">Manajemen pengumuman, berita, dan event sekolah</p>
        </div>
        <a href="{{ route('admin.pengumuman.create') }}" class="btn-primary">
            <i class="fas fa-plus text-xs"></i> Tambah Pengumuman
        </a>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ([
            ['label' => 'Total Pengumuman', 'count' => $pengumumen->count(), 'icon' => 'fa-bullhorn', 'ring' => 'bg-blue-500/10 text-blue-600', 'bar' => 'from-blue-500 to-blue-600'],
            ['label' => 'Pengumuman', 'count' => $pengumumen->where('tipe', 'pengumuman')->count(), 'icon' => 'fa-circle-check', 'ring' => 'bg-emerald-500/10 text-emerald-600', 'bar' => 'from-emerald-500 to-teal-600'],
            ['label' => 'Berita', 'count' => $pengumumen->where('tipe', 'berita')->count(), 'icon' => 'fa-newspaper', 'ring' => 'bg-violet-500/10 text-violet-600', 'bar' => 'from-violet-500 to-purple-600'],
            ['label' => 'Event', 'count' => $pengumumen->where('tipe', 'event')->count(), 'icon' => 'fa-calendar-days', 'ring' => 'bg-orange-500/10 text-orange-600', 'bar' => 'from-orange-500 to-amber-600'],
        ] as $stat)
        <div class="bg-white rounded-3xl border border-slate-100 shadow-soft p-6 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b {{ $stat['bar'] }}"></div>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">{{ $stat['label'] }}</p>
                    <p class="text-3xl font-extrabold text-slate-900 mt-2 tracking-tight">{{ $stat['count'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl {{ $stat['ring'] }} flex items-center justify-center">
                    <i class="fas {{ $stat['icon'] }} text-lg"></i>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Filter -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-soft p-5">
        <div class="flex flex-wrap items-center gap-2.5">
            <span class="text-sm font-semibold text-slate-700 mr-1.5"><i class="fas fa-filter text-xs text-slate-400 mr-1.5"></i>Filter Tipe:</span>
            <a href="{{ route('admin.pengumuman.index') }}"
               class="px-3.5 py-1.5 text-sm rounded-full font-medium border transition-colors {{ request('tipe') ? 'bg-slate-50 border-slate-200 text-slate-600 hover:bg-slate-100' : 'bg-blue-600 border-blue-600 text-white shadow-md shadow-blue-600/25' }}">
                Semua ({{ $pengumumen->count() }})
            </a>
            <a href="{{ route('admin.pengumuman.index', ['tipe' => 'pengumuman']) }}"
               class="px-3.5 py-1.5 text-sm rounded-full font-medium border transition-colors {{ request('tipe') == 'pengumuman' ? 'bg-emerald-600 border-emerald-600 text-white shadow-md shadow-emerald-600/25' : 'bg-slate-50 border-slate-200 text-slate-600 hover:bg-slate-100' }}">
                Pengumuman ({{ $pengumumen->where('tipe', 'pengumuman')->count() }})
            </a>
            <a href="{{ route('admin.pengumuman.index', ['tipe' => 'berita']) }}"
               class="px-3.5 py-1.5 text-sm rounded-full font-medium border transition-colors {{ request('tipe') == 'berita' ? 'bg-violet-600 border-violet-600 text-white shadow-md shadow-violet-600/25' : 'bg-slate-50 border-slate-200 text-slate-600 hover:bg-slate-100' }}">
                Berita ({{ $pengumumen->where('tipe', 'berita')->count() }})
            </a>
            <a href="{{ route('admin.pengumuman.index', ['tipe' => 'event']) }}"
               class="px-3.5 py-1.5 text-sm rounded-full font-medium border transition-colors {{ request('tipe') == 'event' ? 'bg-orange-600 border-orange-600 text-white shadow-md shadow-orange-600/25' : 'bg-slate-50 border-slate-200 text-slate-600 hover:bg-slate-100' }}">
                Event ({{ $pengumumen->where('tipe', 'event')->count() }})
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-soft overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
            <h2 class="text-lg font-bold text-slate-900">Daftar Pengumuman</h2>
            <span class="text-sm text-slate-500 bg-slate-100 px-3 py-1 rounded-full">{{ $pengumumen->count() }} data</span>
        </div>

        @if($pengumumen->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50/60">
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($pengumumen as $pengumuman)
                    @php
                        $tipeChip = [
                            'pengumuman' => ['bg-emerald-50 text-emerald-700 border-emerald-100', 'fa-circle-check'],
                            'berita'     => ['bg-violet-50 text-violet-700 border-violet-100', 'fa-newspaper'],
                            'event'      => ['bg-orange-50 text-orange-700 border-orange-100', 'fa-calendar-days'],
                        ][$pengumuman->tipe] ?? ['bg-slate-100 text-slate-700 border-slate-200', 'fa-tag'];
                    @endphp
                    <tr class="hover:bg-slate-50/70 transition-colors duration-150">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($pengumuman->gambar)
                                <img class="h-11 w-11 rounded-xl object-cover border border-slate-200 mr-3.5 flex-shrink-0" src="{{ Storage::url($pengumuman->gambar) }}" alt="{{ $pengumuman->judul }}">
                                @else
                                <span class="h-11 w-11 rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center mr-3.5 flex-shrink-0"><i class="far fa-image"></i></span>
                                @endif
                                <div class="min-w-0">
                                    <div class="text-sm font-semibold text-slate-900 truncate max-w-xs">{{ $pengumuman->judul }}</div>
                                    <div class="text-xs text-slate-500 truncate max-w-xs mt-0.5">{{ Str::limit(strip_tags($pengumuman->isi), 60) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex items-center gap-1.5 text-xs font-semibold rounded-full border {{ $tipeChip[0] }}">
                                <i class="fas {{ $tipeChip[1] }} text-[10px]"></i>{{ $pengumuman->tipe }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                            <div class="font-medium text-slate-800">{{ \Carbon\Carbon::parse($pengumuman->tanggal_mulai)->translatedFormat('d M Y') }}</div>
                            @if($pengumuman->tanggal_selesai)
                            <div class="text-xs text-slate-400 mt-0.5">s/d {{ \Carbon\Carbon::parse($pengumuman->tanggal_selesai)->translatedFormat('d M Y') }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full border {{ $pengumuman->status == 1 ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-red-50 text-red-700 border-red-100' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $pengumuman->status == 1 ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                                {{ $pengumuman->status == 1 ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex gap-1.5">
                                <a href="{{ route('admin.pengumuman.show', $pengumuman->id) }}"
                                   class="w-9 h-9 rounded-xl bg-slate-50 text-slate-600 hover:bg-emerald-500 hover:text-white flex items-center justify-center transition-all" title="Lihat Detail">
                                    <i class="fas fa-eye text-sm"></i>
                                </a>
                                <a href="{{ route('admin.pengumuman.edit', $pengumuman->id) }}"
                                   class="w-9 h-9 rounded-xl bg-slate-50 text-slate-600 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-all" title="Edit">
                                    <i class="fas fa-pen text-sm"></i>
                                </a>
                                <form action="{{ route('admin.pengumuman.destroy', $pengumuman->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-9 h-9 rounded-xl bg-slate-50 text-slate-600 hover:bg-red-600 hover:text-white flex items-center justify-center transition-all" title="Hapus">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-16">
            <div class="w-20 h-20 mx-auto rounded-3xl bg-slate-50 flex items-center justify-center mb-5">
                <i class="fas fa-bullhorn text-slate-300 text-3xl"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-900">Belum ada pengumuman</h3>
            <p class="text-slate-500 text-sm mt-1">Mulai dengan membuat pengumuman pertama Anda.</p>
            <a href="{{ route('admin.pengumuman.create') }}" class="btn-primary mt-6">
                <i class="fas fa-plus text-xs"></i> Tambah Pengumuman
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
