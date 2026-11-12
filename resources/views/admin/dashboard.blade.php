@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="relative bg-gradient-to-br from-blue-700 via-blue-800 to-indigo-900 rounded-3xl p-7 md:p-9 text-white overflow-hidden shadow-card">
        <div class="absolute inset-0 opacity-40"
             style="background-image: linear-gradient(rgba(255,255,255,.06) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.06) 1px, transparent 1px); background-size: 56px 56px;"></div>
        <div class="absolute -top-10 -right-10 w-44 h-44 bg-sky-400/20 rounded-full blur-2xl"></div>
        <div class="relative z-10 flex flex-col md:flex-row justify-between md:items-center gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-blue-300 mb-1.5">Panel Admin</p>
                <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">Selamat Datang, {{ Auth::user()->name }}</h1>
                <p class="text-blue-100/90 mt-2 text-sm md:text-base">Pantau dan kelola konten website SMAN 17 Maluku Tengah</p>
            </div>
            <div class="inline-flex items-center gap-2.5 bg-white/10 border border-white/15 backdrop-blur-sm px-4 py-2.5 rounded-2xl text-sm self-start">
                <i class="far fa-calendar text-sky-300"></i>{{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </div>

    @php
        $unreadCount = \App\Models\Pesan::where('status', 'unread')->count();
    @endphp

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ([
            ['label' => 'Total Pengguna',     'key' => 'total_users',        'icon' => 'fa-users',        'ring' => 'bg-blue-500/10 text-blue-600', 'bar' => 'from-blue-500 to-blue-600'],
            ['label' => 'Total Pengumuman',   'key' => 'total_pengumuman',   'icon' => 'fa-bullhorn',     'ring' => 'bg-emerald-500/10 text-emerald-600', 'bar' => 'from-emerald-500 to-teal-600'],
            ['label' => 'Total Dokumentasi',  'key' => 'total_dokumentasi',  'icon' => 'fa-images',       'ring' => 'bg-violet-500/10 text-violet-600', 'bar' => 'from-violet-500 to-purple-600'],
            ['label' => 'Pesan Belum Dibaca', 'key' => 'total_pesan_baru',   'icon' => 'fa-envelope-open-text', 'ring' => 'bg-orange-500/10 text-orange-600', 'bar' => 'from-orange-500 to-amber-600'],
        ] as $stat)
        <div class="bg-white rounded-3xl border border-slate-100 shadow-soft p-6 hover:shadow-card hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b {{ $stat['bar'] }}"></div>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">{{ $stat['label'] }}</p>
                    <p class="text-3xl font-extrabold text-slate-900 mt-2 tracking-tight">{{ $stats[$stat['key']] }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl {{ $stat['ring'] }} flex items-center justify-center">
                    <i class="fas {{ $stat['icon'] }} text-lg"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2 text-xs text-slate-400">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> Data terkini
            </div>
        </div>
        @endforeach
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Kolom kiri -->
        <div class="xl:col-span-2 space-y-8">
            <!-- Aksi Cepat -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-soft p-7">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-slate-900 flex items-center gap-3">
                        <span class="w-9 h-9 rounded-xl bg-blue-600/10 text-blue-600 flex items-center justify-center"><i class="fas fa-bolt text-sm"></i></span>
                        Aksi Cepat
                    </h2>
                    <span class="text-xs font-semibold text-blue-700 bg-blue-50 border border-blue-100 px-3 py-1.5 rounded-full">Menu Utama</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('admin.pengumuman.index') }}" class="group flex items-center p-5 bg-slate-50 hover:bg-blue-50 border border-slate-100 hover:border-blue-200 rounded-2xl transition-all duration-300 hover:-translate-y-1">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/25 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-base font-bold text-slate-900 group-hover:text-blue-700 transition-colors">Kelola Pengumuman</h3>
                            <p class="text-sm text-slate-500 mt-0.5">Buat dan kelola pengumuman sekolah</p>
                        </div>
                    </a>
                    <a href="{{ route('admin.pesan.index') }}" class="group flex items-center p-5 bg-slate-50 hover:bg-cyan-50 border border-slate-100 hover:border-cyan-200 rounded-2xl transition-all duration-300 hover:-translate-y-1 relative">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-cyan-500 to-sky-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-cyan-500/25 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-base font-bold text-slate-900 group-hover:text-cyan-700 transition-colors">Kelola Pesan</h3>
                            <p class="text-sm text-slate-500 mt-0.5">Lihat dan balas pesan pengunjung</p>
                        </div>
                        @if($unreadCount > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full px-2.5 py-1 h-7 flex items-center justify-center shadow-lg shadow-red-500/30 animate-pulse">
                            {{ $unreadCount }}
                        </span>
                        @endif
                    </a>
                    <a href="{{ route('admin.dokumentasi.index') }}" class="group flex items-center p-5 bg-slate-50 hover:bg-violet-50 border border-slate-100 hover:border-violet-200 rounded-2xl transition-all duration-300 hover:-translate-y-1 md:col-span-2">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-violet-500 to-purple-700 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-violet-500/25 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-images"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-base font-bold text-slate-900 group-hover:text-violet-700 transition-colors">Kelola Dokumentasi</h3>
                            <p class="text-sm text-slate-500 mt-0.5">Unggah dan kelola galeri kegiatan sekolah</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Aktivitas -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-soft p-7">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-slate-900 flex items-center gap-3">
                        <span class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center"><i class="fas fa-clock-rotate-left text-sm"></i></span>
                        Aktivitas Terbaru
                    </h2>
                    <span class="text-xs font-semibold text-slate-500 bg-slate-100 px-3 py-1.5 rounded-full">Hari ini</span>
                </div>
                <div class="space-y-3">
                    @foreach([
                        ['icon' => 'fa-bullhorn', 'ring' => 'bg-blue-50 text-blue-600',   'title' => 'Pengumuman', 'desc' => 'Pengumuman baru telah dipublikasikan', 'time' => 'Baru saja'],
                        ['icon' => 'fa-images',   'ring' => 'bg-violet-50 text-violet-600','title' => 'Dokumentasi', 'desc' => 'Foto kegiatan baru telah diunggah ke galeri', 'time' => 'Baru saja'],
                        ['icon' => 'fa-comment-dots', 'ring' => 'bg-emerald-50 text-emerald-600','title' => 'Pesan masuk', 'desc' => 'Pesan baru dari pengunjung website', 'time' => '5 menit lalu'],
                        ['icon' => 'fa-user-pen', 'ring' => 'bg-orange-50 text-orange-600','title' => 'Pengguna', 'desc' => 'Akun pengguna telah diperbarui', 'time' => '1 jam lalu'],
                    ] as $activity)
                    <div class="flex items-center justify-between p-4 bg-slate-50 border border-slate-100 rounded-2xl hover:bg-white hover:shadow-soft transition-all duration-300 group">
                        <div class="flex items-center">
                            <div class="w-11 h-11 {{ $activity['ring'] }} rounded-2xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas {{ $activity['icon'] }}"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-900">{{ $activity['title'] }}</p>
                                <p class="text-xs text-slate-500 mt-0.5">{{ $activity['desc'] }}</p>
                            </div>
                        </div>
                        <span class="text-xs text-slate-500 bg-white px-2.5 py-1 rounded-full border border-slate-200">{{ $activity['time'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Kolom kanan -->
        <div class="space-y-8">
            <!-- Kalender -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-soft p-7">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2.5">
                        <span class="w-9 h-9 rounded-xl bg-blue-600/10 text-blue-600 flex items-center justify-center"><i class="fas fa-calendar-days text-sm"></i></span>
                        Kalender
                    </h2>
                    <div class="flex items-center gap-1.5">
                        <button id="prevMonth" class="w-9 h-9 hover:bg-slate-100 rounded-xl transition-colors flex items-center justify-center text-slate-500" aria-label="Bulan sebelumnya">
                            <i class="fas fa-chevron-left text-xs"></i>
                        </button>
                        <button id="nextMonth" class="w-9 h-9 hover:bg-slate-100 rounded-xl transition-colors flex items-center justify-center text-slate-500" aria-label="Bulan berikutnya">
                            <i class="fas fa-chevron-right text-xs"></i>
                        </button>
                    </div>
                </div>

                <div class="text-center mb-4">
                    <h3 id="currentMonth" class="text-base font-bold text-slate-900">{{ now()->translatedFormat('F Y') }}</h3>
                </div>

                <div class="grid grid-cols-7 gap-1 mb-2">
                    @foreach(['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'] as $day)
                        <div class="text-center text-[11px] font-semibold text-slate-400 py-1.5 uppercase">{{ $day }}</div>
                    @endforeach
                </div>

                <div class="grid grid-cols-7 gap-1" id="calendarDays"></div>

                <div class="mt-5 pt-4 border-t border-slate-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Hari Ini</p>
                            <p class="text-xs text-slate-500">{{ now()->translatedFormat('l, d F Y') }}</p>
                        </div>
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-400"></span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Status Sistem -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-soft p-7">
                <h2 class="text-lg font-bold text-slate-900 mb-5 flex items-center gap-2.5">
                    <span class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center"><i class="fas fa-server text-sm"></i></span>
                    Status Sistem
                </h2>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3.5 bg-slate-50 hover:bg-emerald-50/60 border border-slate-100 rounded-2xl transition-colors">
                        <div class="flex items-center gap-3">
                            <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse"></span>
                            <span class="text-sm font-medium text-slate-800">Aplikasi</span>
                        </div>
                        <span class="text-xs text-emerald-700 font-bold bg-emerald-100 border border-emerald-200 px-2.5 py-1 rounded-full">Online</span>
                    </div>
                    <div class="flex items-center justify-between p-3.5 bg-slate-50 hover:bg-emerald-50/60 border border-slate-100 rounded-2xl transition-colors">
                        <div class="flex items-center gap-3">
                            <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse"></span>
                            <span class="text-sm font-medium text-slate-800">Database</span>
                        </div>
                        <span class="text-xs text-emerald-700 font-bold bg-emerald-100 border border-emerald-200 px-2.5 py-1 rounded-full">Connected</span>
                    </div>
                    <div class="flex items-center justify-between p-3.5 bg-slate-50 hover:bg-blue-50/60 border border-slate-100 rounded-2xl transition-colors">
                        <div class="flex items-center gap-3">
                            <span class="w-2.5 h-2.5 bg-blue-500 rounded-full"></span>
                            <span class="text-sm font-medium text-slate-800">Pengguna Aktif</span>
                        </div>
                        <span class="text-xs text-blue-700 font-bold bg-blue-100 border border-blue-200 px-2.5 py-1 rounded-full">{{ $stats['total_users'] }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3.5 bg-slate-50 hover:bg-violet-50/60 border border-slate-100 rounded-2xl transition-colors">
                        <div class="flex items-center gap-3">
                            <span class="w-2.5 h-2.5 bg-violet-500 rounded-full"></span>
                            <span class="text-sm font-medium text-slate-800">Versi Sistem</span>
                        </div>
                        <span class="text-xs text-violet-700 font-bold bg-violet-100 border border-violet-200 px-2.5 py-1 rounded-full">v2.0.0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Calendar JS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentDate = new Date();

    function renderCalendar(date) {
        const monthNames = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        const currentMonth = date.getMonth();
        const currentYear  = date.getFullYear();

        document.getElementById('currentMonth').textContent =
            `${monthNames[currentMonth]} ${currentYear}`;

        const firstDay  = new Date(currentYear, currentMonth, 1);
        const lastDay   = new Date(currentYear, currentMonth + 1, 0);
        const totalDays = lastDay.getDate();
        const firstDayIndex = firstDay.getDay() === 0 ? 6 : firstDay.getDay() - 1; // mulai Senin

        const calendarDays = document.getElementById('calendarDays');
        calendarDays.innerHTML = '';

        for (let i = 0; i < firstDayIndex; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.className = 'text-center text-sm text-slate-300 py-2';
            calendarDays.appendChild(emptyCell);
        }

        const today = new Date();
        for (let day = 1; day <= totalDays; day++) {
            const dayCell = document.createElement('div');
            dayCell.className = 'text-center text-sm py-2 rounded-xl transition-all cursor-default font-medium';

            const cellDate = new Date(currentYear, currentMonth, day);

            if (day === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear()) {
                dayCell.className += ' bg-blue-600 text-white shadow-md shadow-blue-600/30';
            } else if (cellDate.getDay() === 0) {
                dayCell.className += ' text-red-500 bg-red-50';
            } else {
                dayCell.className += ' text-slate-600 hover:bg-slate-100';
            }

            dayCell.textContent = day;
            calendarDays.appendChild(dayCell);
        }
    }

    document.getElementById('prevMonth').addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar(currentDate);
    });

    document.getElementById('nextMonth').addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar(currentDate);
    });

    renderCalendar(currentDate);
});
</script>
@endsection
