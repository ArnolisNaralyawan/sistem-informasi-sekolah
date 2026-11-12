@extends('layouts.app')

@section('title', 'Kelola Pesan')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">Kelola Pesan</h1>
            <p class="text-slate-500 mt-1.5">Manajemen pesan masuk dari pengunjung website</p>
        </div>
        <form action="{{ route('admin.pesan.mark-all-read') }}" method="POST" class="self-start">
            @csrf
            <button type="submit" class="btn-success">
                <i class="fas fa-check-double text-xs"></i> Tandai Semua Dibaca
            </button>
        </form>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ([
            ['label' => 'Total Pesan', 'value' => $stats['total'], 'icon' => 'fa-envelope', 'ring' => 'bg-blue-500/10 text-blue-600', 'bar' => 'from-blue-500 to-blue-600'],
            ['label' => 'Belum Dibaca', 'value' => $stats['unread'], 'icon' => 'fa-envelope-circle-check', 'ring' => 'bg-red-500/10 text-red-600', 'bar' => 'from-red-500 to-rose-600'],
            ['label' => 'Sudah Dibaca', 'value' => $stats['read'], 'icon' => 'fa-circle-check', 'ring' => 'bg-emerald-500/10 text-emerald-600', 'bar' => 'from-emerald-500 to-teal-600'],
            ['label' => 'Pesan Masuk', 'value' => $stats['masuk'], 'icon' => 'fa-inbox', 'ring' => 'bg-violet-500/10 text-violet-600', 'bar' => 'from-violet-500 to-purple-600'],
        ] as $stat)
        <div class="bg-white rounded-3xl border border-slate-100 shadow-soft p-6 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b {{ $stat['bar'] }}"></div>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">{{ $stat['label'] }}</p>
                    <p class="text-3xl font-extrabold text-slate-900 mt-2 tracking-tight">{{ $stat['value'] }}</p>
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
            <span class="text-sm font-semibold text-slate-700 mr-1.5"><i class="fas fa-filter text-xs text-slate-400 mr-1.5"></i>Filter Status:</span>
            <a href="{{ route('admin.pesan.index') }}"
               class="px-3.5 py-1.5 text-sm rounded-full font-medium border transition-colors {{ !request('status') && !request('tipe') ? 'bg-blue-600 border-blue-600 text-white shadow-md shadow-blue-600/25' : 'bg-slate-50 border-slate-200 text-slate-600 hover:bg-slate-100' }}">
                Semua ({{ $stats['total'] }})
            </a>
            <a href="{{ route('admin.pesan.index', ['status' => 'unread']) }}"
               class="px-3.5 py-1.5 text-sm rounded-full font-medium border transition-colors {{ request('status') == 'unread' ? 'bg-red-600 border-red-600 text-white shadow-md shadow-red-600/25' : 'bg-slate-50 border-slate-200 text-slate-600 hover:bg-slate-100' }}">
                Belum Dibaca ({{ $stats['unread'] }})
            </a>
            <a href="{{ route('admin.pesan.index', ['status' => 'read']) }}"
               class="px-3.5 py-1.5 text-sm rounded-full font-medium border transition-colors {{ request('status') == 'read' ? 'bg-emerald-600 border-emerald-600 text-white shadow-md shadow-emerald-600/25' : 'bg-slate-50 border-slate-200 text-slate-600 hover:bg-slate-100' }}">
                Sudah Dibaca ({{ $stats['read'] }})
            </a>
        </div>
    </div>

    <!-- Daftar Pesan -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-soft overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex flex-wrap justify-between items-center gap-2">
            <h2 class="text-lg font-bold text-slate-900">Daftar Pesan</h2>
            <span class="text-sm text-slate-500 bg-slate-100 px-3 py-1 rounded-full">Menampilkan {{ $pesan->count() }} dari {{ $pesan->total() }} pesan</span>
        </div>

        @if($pesan->count() > 0)
        <div class="divide-y divide-slate-100">
            @foreach($pesan as $item)
            <div class="p-6 hover:bg-slate-50/70 transition-colors duration-150 {{ $item->status == 'unread' ? 'bg-blue-50/60 border-l-4 border-l-blue-600' : '' }}">
                <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-2.5 mb-2">
                            @if($item->status == 'unread')
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-500 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                            </span>
                            @endif
                            <h3 class="text-base font-bold text-slate-900 truncate {{ $item->status == 'unread' ? '' : 'font-semibold text-slate-700' }}">
                                {{ $item->subjek }}
                            </h3>
                            <span class="px-2.5 py-0.5 text-[11px] font-semibold rounded-full border {{ $item->tipe == 'masuk' ? 'bg-blue-50 text-blue-700 border-blue-100' : 'bg-emerald-50 text-emerald-700 border-emerald-100' }}">
                                {{ $item->tipe == 'masuk' ? 'Pesan Masuk' : 'Pesan Keluar' }}
                            </span>
                        </div>

                        <div class="flex flex-wrap items-center gap-x-5 gap-y-1.5 text-sm text-slate-500 mb-3">
                            <div class="flex items-center gap-1.5">
                                <span class="w-7 h-7 rounded-full bg-gradient-to-br from-blue-600 to-indigo-600 text-white text-xs font-bold flex items-center justify-center">{{ strtoupper(substr($item->nama, 0, 1)) }}</span>
                                <span class="font-medium text-slate-600">{{ $item->nama }}</span>
                            </div>
                            <div class="flex items-center gap-1.5"><i class="far fa-envelope"></i><span>{{ $item->email }}</span></div>
                            <div class="flex items-center gap-1.5"><i class="far fa-clock"></i><span>{{ $item->created_at->diffForHumans() }}</span></div>
                        </div>

                        <p class="text-slate-600 text-sm line-clamp-2 mb-4">
                            {{ Str::limit($item->pesan, 150) }}
                        </p>

                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('admin.pesan.show', $item->id) }}"
                               class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:text-blue-800 transition-colors group">
                                <span class="w-7 h-7 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-100 transition-colors"><i class="fas fa-eye text-xs"></i></span>
                                Baca Pesan
                            </a>
                            @if($item->status == 'unread')
                            <form action="{{ route('admin.pesan.mark-read', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-700 hover:text-emerald-800 transition-colors group">
                                    <span class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-100 transition-colors"><i class="fas fa-check text-xs"></i></span>
                                    Tandai Dibaca
                                </button>
                            </form>
                            @endif
                            <form action="{{ route('admin.pesan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-2 text-sm font-semibold text-red-600 hover:text-red-800 transition-colors group">
                                    <span class="w-7 h-7 rounded-lg bg-red-50 text-red-600 flex items-center justify-center group-hover:bg-red-100 transition-colors"><i class="fas fa-trash text-xs"></i></span>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($pesan->hasPages())
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $pesan->onEachSide(1)->links() }}
        </div>
        @endif

        @else
        <div class="text-center py-16">
            <div class="w-20 h-20 mx-auto mb-5 rounded-3xl bg-slate-50 flex items-center justify-center">
                <i class="fas fa-envelope-open-text text-slate-300 text-3xl"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-900 mb-2">Tidak ada pesan</h3>
            <p class="text-slate-500 text-sm">Belum ada pesan yang diterima.</p>
        </div>
        @endif
    </div>
</div>
@endsection
