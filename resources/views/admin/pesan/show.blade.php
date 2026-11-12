@extends('layouts.app')

@section('title', 'Detail Pesan')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div>
            <nav class="flex items-center gap-2 text-sm text-slate-400 mb-1.5">
                <a href="{{ route('admin.pesan.index') }}" class="hover:text-blue-700 transition-colors">Pesan</a>
                <i class="fas fa-chevron-right text-[9px]"></i>
                <span class="text-slate-700 font-medium">Detail</span>
            </nav>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">Detail Pesan</h1>
            <p class="text-slate-500 mt-1.5">Lihat detail pesan dari pengunjung</p>
        </div>
        <a href="{{ route('admin.pesan.index') }}" class="btn-secondary self-start">
            <i class="fas fa-arrow-left text-xs"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Isi pesan -->
        <div class="xl:col-span-2 space-y-8">
            <div class="bg-white rounded-3xl border border-slate-100 shadow-soft overflow-hidden">
                <!-- Header pesan -->
                <div class="px-7 py-6 border-b border-slate-100 bg-slate-50/60">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                        <div class="min-w-0">
                            <h2 class="text-xl font-bold text-slate-900 truncate">{{ $pesan->subjek }}</h2>
                            <div class="flex flex-wrap items-center gap-x-5 gap-y-2 mt-3 text-sm text-slate-500">
                                <div class="flex items-center gap-2">
                                    <span class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-600 to-indigo-600 text-white text-xs font-bold flex items-center justify-center">{{ strtoupper(substr($pesan->nama, 0, 1)) }}</span>
                                    <span class="font-medium text-slate-700">{{ $pesan->nama }}</span>
                                </div>
                                <div class="flex items-center gap-1.5"><i class="far fa-envelope"></i><span>{{ $pesan->email }}</span></div>
                                <div class="flex items-center gap-1.5"><i class="far fa-clock"></i><span>{{ $pesan->created_at->translatedFormat('d F Y H:i') }}</span></div>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full border {{ $pesan->status == 'unread' ? 'bg-red-50 text-red-700 border-red-100' : 'bg-emerald-50 text-emerald-700 border-emerald-100' }}">
                                {{ $pesan->status == 'unread' ? 'Belum Dibaca' : 'Sudah Dibaca' }}
                            </span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full border {{ $pesan->tipe == 'masuk' ? 'bg-blue-50 text-blue-700 border-blue-100' : 'bg-emerald-50 text-emerald-700 border-emerald-100' }}">
                                {{ $pesan->tipe == 'masuk' ? 'Pesan Masuk' : 'Pesan Keluar' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Konten -->
                <div class="p-7">
                    <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-4">Isi Pesan</h3>
                    <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6">
                        <p class="text-slate-700 whitespace-pre-line leading-relaxed">{{ $pesan->pesan }}</p>
                    </div>

                    <!-- Aksi -->
                    <div class="flex flex-col sm:flex-row flex-wrap justify-between items-start sm:items-center gap-4 pt-6 mt-6 border-t border-slate-100">
                        <div class="flex flex-wrap gap-3">
                            @if($pesan->status == 'unread')
                            <form action="{{ route('admin.pesan.mark-read', $pesan->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-success">
                                    <i class="fas fa-check text-xs"></i> Tandai Sudah Dibaca
                                </button>
                            </form>
                            @endif
                            <a href="mailto:{{ $pesan->email }}?subject=Re: {{ $pesan->subjek }}" class="btn-primary">
                                <i class="fas fa-reply text-xs"></i> Balas Email
                            </a>
                        </div>

                        <form action="{{ route('admin.pesan.destroy', $pesan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger">
                                <i class="fas fa-trash text-xs"></i> Hapus Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-8">
            <!-- Informasi pengirim -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-soft p-7">
                <h3 class="text-lg font-bold text-slate-900 mb-5 flex items-center gap-2.5">
                    <span class="w-9 h-9 rounded-xl bg-blue-600/10 text-blue-600 flex items-center justify-center"><i class="fas fa-user text-sm"></i></span>
                    Informasi Pengirim
                </h3>
                <div class="space-y-5">
                    <div class="flex items-start gap-4">
                        <span class="w-10 h-10 bg-blue-600/10 text-blue-600 rounded-xl flex items-center justify-center flex-shrink-0"><i class="fas fa-user text-sm"></i></span>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-500">Nama</p>
                            <p class="font-semibold text-slate-900 truncate">{{ $pesan->nama }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <span class="w-10 h-10 bg-emerald-500/10 text-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0"><i class="far fa-envelope text-sm"></i></span>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-500">Email</p>
                            <p class="font-semibold text-slate-900 break-all">{{ $pesan->email }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <span class="w-10 h-10 bg-violet-500/10 text-violet-600 rounded-xl flex items-center justify-center flex-shrink-0"><i class="far fa-clock text-sm"></i></span>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-500">Dikirim Pada</p>
                            <p class="font-semibold text-slate-900">{{ $pesan->created_at->translatedFormat('l, d F Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-soft p-7">
                <h3 class="text-lg font-bold text-slate-900 mb-5 flex items-center gap-2.5">
                    <span class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center"><i class="fas fa-bolt text-sm"></i></span>
                    Aksi Cepat
                </h3>
                <div class="space-y-3">
                    <a href="mailto:{{ $pesan->email }}?subject=Re: {{ $pesan->subjek }}"
                       class="w-full inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl text-sm font-semibold transition-colors shadow-md shadow-blue-600/25">
                        <i class="fas fa-reply text-xs"></i> Balas via Email
                    </a>
                    <button onclick="copyToClipboard('{{ $pesan->email }}')"
                            class="w-full inline-flex items-center justify-center gap-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-100 py-3 rounded-xl text-sm font-semibold transition-colors">
                        <i class="fas fa-copy text-xs"></i> Salin Email
                    </button>
                    <a href="{{ route('admin.pesan.index') }}"
                       class="w-full inline-flex items-center justify-center gap-2 bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-100 py-3 rounded-xl text-sm font-semibold transition-colors">
                        <i class="fas fa-list text-xs"></i> Lihat Semua Pesan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Email berhasil disalin: ' + text);
    }, function(err) {
        console.error('Gagal menyalin email: ', err);
    });
}
</script>
@endsection
