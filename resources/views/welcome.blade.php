<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ \App\Models\Setting::get('nama_sekolah') }} - Sistem Informasi Sekolah Terpadu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'] },
                    colors: {
                        brand: {
                            50: '#eff6ff', 100: '#dbeafe', 200: '#bfdbfe', 500: '#3b82f6',
                            600: '#2563eb', 700: '#1d4ed8', 800: '#1e40af', 900: '#1e3a8a', 950: '#172554',
                        }
                    },
                    boxShadow: {
                        soft: '0 2px 12px -2px rgb(15 23 42 / 0.08)',
                        card: '0 10px 40px -12px rgb(15 23 42 / 0.15)',
                        glow: '0 0 0 1px rgb(255 255 255 / 0.1), 0 20px 60px -12px rgb(29 78 216 / 0.45)',
                    }
                }
            }
        }
    </script>
    <script>
        // Dark mode: terapkan tema tersimpan / preferensi sistem SEBELUM halaman dirender (anti-kilau)
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }

        .hero-bg {
            background:
                radial-gradient(ellipse 80% 60% at 70% 20%, rgba(59,130,246,.35) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 10% 90%, rgba(79,70,229,.25) 0%, transparent 60%),
                linear-gradient(160deg, #172554 0%, #1e3a8a 45%, #1d4ed8 100%);
        }
        .bg-grid {
            background-image:
                linear-gradient(rgba(255,255,255,.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.06) 1px, transparent 1px);
            background-size: 56px 56px;
            mask-image: radial-gradient(ellipse 70% 70% at 50% 40%, #000 40%, transparent 100%);
        }
        .school-badge {
            background: radial-gradient(circle at 30% 30%, #ef4444 0%, #b91c1c 100%);
        }
        .gradient-text {
            background: linear-gradient(135deg, #1d4ed8 0%, #4f46e5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hover-lift { transition: transform .3s ease, box-shadow .3s ease; }
        .hover-lift:hover {
            transform: translateY(-6px);
            box-shadow: 0 24px 48px -16px rgb(15 23 42 / 0.18);
        }

        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }

        .slide-in { animation: slideIn .8s cubic-bezier(.16,1,.3,1) both; }
        @keyframes slideIn {
            from { transform: translateY(32px); opacity: 0; }
            to   { transform: translateY(0); opacity: 1; }
        }

        .reveal { opacity: 0; transform: translateY(28px); transition: opacity .7s ease, transform .7s ease; }
        .reveal.is-visible { opacity: 1; transform: translateY(0); }
        @media (prefers-reduced-motion: reduce) {
            .reveal { opacity: 1; transform: none; transition: none; }
            .slide-in { animation: none; }
        }

        .map-container {
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 20px 60px -20px rgb(15 23 42 / .25);
            border: 1px solid #e2e8f0;
        }
        .map-container iframe { width: 100%; height: 420px; border: 0; display: block; }

        /* ================= DARK MODE ================= */
        .dark body { background-color: #0f172a; color: #e2e8f0; }
        .dark .bg-white { background-color: #1e293b; }
        .dark .bg-white\/85 { background-color: rgba(30, 41, 59, .85); }
        .dark .bg-white\/95 { background-color: rgba(30, 41, 59, .95); }
        .dark .bg-slate-50 { background-color: #0f172a; }
        .dark .bg-slate-50\/70 { background-color: rgba(15, 23, 42, .7); }
        .dark .bg-slate-100 { background-color: #1e293b; }
        .dark .text-slate-900, .dark .text-slate-800 { color: #f1f5f9; }
        .dark .text-slate-700 { color: #e2e8f0; }
        .dark .text-slate-600, .dark .text-slate-500 { color: #94a3b8; }
        .dark .border-slate-100, .dark .border-slate-200 { border-color: #334155; }
        .dark .hover\:bg-slate-50:hover, .dark .hover\:bg-slate-100:hover { background-color: #334155; }
        .dark .hover\:bg-white:hover { background-color: #334155; }
        .dark .text-blue-600, .dark .text-blue-700 { color: #60a5fa; }
        .dark .bg-blue-50 { background-color: rgba(59, 130, 246, .12); }
        .dark .hover\:bg-blue-50:hover { background-color: rgba(59, 130, 246, .18); }
        .dark .bg-blue-100 { background-color: rgba(59, 130, 246, .18); }
        .dark .border-blue-100, .dark .border-blue-200 { border-color: rgba(59, 130, 246, .35); }
        .dark .bg-emerald-50 { background-color: rgba(16, 185, 129, .12); }
        .dark .bg-emerald-100 { background-color: rgba(16, 185, 129, .18); }
        .dark .text-emerald-600, .dark .text-emerald-700 { color: #6ee7b7; }
        .dark .border-emerald-100, .dark .border-emerald-200 { border-color: rgba(16, 185, 129, .3); }
        .dark .hover\:bg-emerald-500:hover { background-color: #059669; }
        .dark .bg-violet-100 { background-color: rgba(139, 92, 246, .2); }
        .dark .text-violet-700 { color: #c4b5fd; }
        .dark .bg-orange-50 { background-color: rgba(249, 115, 22, .15); }
        .dark .text-orange-700 { color: #fdba74; }
        .dark .bg-red-50 { background-color: rgba(239, 68, 68, .14); }
        .dark .text-red-600, .dark .text-red-700 { color: #fca5a5; }
        .dark .border-red-100, .dark .border-red-200 { border-color: rgba(239, 68, 68, .3); }
        .dark .hover\:bg-red-50:hover { background-color: rgba(239, 68, 68, .22); }
        .dark .map-container { border-color: #334155; }
    </style>
</head>
<body class="bg-white text-slate-800 antialiased">
@php use App\Models\Setting; @endphp
    <!-- Navigation -->
    <nav id="navbar" class="fixed w-full z-50 transition-all duration-300 bg-white/85 backdrop-blur-md border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-3">
                <!-- Logo -->
                <a href="#home" class="flex items-center gap-3 group min-w-0">
                    @if(\App\Models\Setting::get('logo'))
                    <!-- Logo asli: tampil mandiri tanpa kotak -->
                    <img src="{{ asset('storage/' . Setting::get('logo')) }}" alt="Logo {{ \App\Models\Setting::get('nama_singkat') }}"
                         class="w-11 h-11 object-contain flex-shrink-0 drop-shadow-md transition-transform duration-300 group-hover:scale-105">
                    @else
                    <!-- Fallback: kotak merah + ikon -->
                    <div class="school-badge w-11 h-11 rounded-2xl flex items-center justify-center shadow-lg shadow-red-500/20 transition-transform duration-300 group-hover:scale-105 flex-shrink-0">
                        <i class="fas fa-graduation-cap text-white text-lg"></i>
                    </div>
                    @endif
                    <div class="leading-tight min-w-0">
                        <span class="block text-base sm:text-lg font-extrabold tracking-tight text-slate-900 truncate">{{ \App\Models\Setting::get('nama_singkat') }}</span>
                        <span class="block text-[11px] font-semibold tracking-widest text-red-600 uppercase truncate max-w-[200px] sm:max-w-[260px] lg:max-w-none">{{ \App\Models\Setting::get('motto') }}</span>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center gap-1">
                    <a href="#home" class="px-4 py-2 rounded-xl text-sm font-medium text-slate-600 hover:text-blue-700 hover:bg-blue-50 transition-colors duration-200">Beranda</a>
                    <a href="#profile" class="px-4 py-2 rounded-xl text-sm font-medium text-slate-600 hover:text-blue-700 hover:bg-blue-50 transition-colors duration-200">Profil</a>
                    <a href="#fasilitas" class="px-4 py-2 rounded-xl text-sm font-medium text-slate-600 hover:text-blue-700 hover:bg-blue-50 transition-colors duration-200">Fasilitas</a>
                    <a href="#galery" class="px-4 py-2 rounded-xl text-sm font-medium text-slate-600 hover:text-blue-700 hover:bg-blue-50 transition-colors duration-200">Galeri</a>
                    <a href="#pengumuman" class="px-4 py-2 rounded-xl text-sm font-medium text-slate-600 hover:text-blue-700 hover:bg-blue-50 transition-colors duration-200">Pengumuman</a>
                    <a href="#kontak" class="px-4 py-2 rounded-xl text-sm font-medium text-slate-600 hover:text-blue-700 hover:bg-blue-50 transition-colors duration-200">Kontak</a>
                </div>

                <!-- CTA + Mobile toggle -->
                <div class="flex items-center gap-3">
                    <button id="themeToggle" class="w-10 h-10 rounded-xl flex items-center justify-center text-slate-600 hover:bg-slate-100 transition-colors" aria-label="Ganti mode gelap/terang">
                        <i class="fas fa-moon text-base dark:hidden"></i>
                        <i class="fas fa-sun text-base hidden dark:inline-block"></i>
                    </button>
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-blue-600/25 hover:shadow-blue-600/40 hover:-translate-y-0.5 transition-all duration-300">
                        <i class="fas fa-right-to-bracket"></i>Masuk Sistem
                    </a>
                    <button id="mobileMenuButton" class="lg:hidden w-10 h-10 rounded-xl flex items-center justify-center text-slate-700 hover:bg-slate-100 transition-colors" aria-label="Buka menu">
                        <i id="mobileMenuIcon" class="fas fa-bars text-lg"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="lg:hidden hidden bg-white/95 backdrop-blur-md border-t border-slate-100 shadow-lg">
            <div class="px-4 py-4 space-y-1">
                <a href="#home" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-700 font-medium hover:bg-blue-50 hover:text-blue-700 transition-colors"><i class="fas fa-home w-5 text-center text-sm"></i>Beranda</a>
                <a href="#profile" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-700 font-medium hover:bg-blue-50 hover:text-blue-700 transition-colors"><i class="fas fa-circle-info w-5 text-center text-sm"></i>Profil Sekolah</a>
                <a href="#fasilitas" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-700 font-medium hover:bg-blue-50 hover:text-blue-700 transition-colors"><i class="fas fa-building w-5 text-center text-sm"></i>Fasilitas</a>
                <a href="#galery" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-700 font-medium hover:bg-blue-50 hover:text-blue-700 transition-colors"><i class="fas fa-images w-5 text-center text-sm"></i>Galeri</a>
                <a href="#pengumuman" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-700 font-medium hover:bg-blue-50 hover:text-blue-700 transition-colors"><i class="fas fa-bullhorn w-5 text-center text-sm"></i>Pengumuman</a>
                <a href="#kontak" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-700 font-medium hover:bg-blue-50 hover:text-blue-700 transition-colors"><i class="fas fa-phone w-5 text-center text-sm"></i>Kontak</a>
                <div class="pt-2 border-t border-slate-100 sm:hidden">
                    <a href="{{ route('login') }}" class="mt-2 flex items-center justify-center gap-2 bg-blue-600 text-white px-4 py-3 rounded-xl font-semibold"><i class="fas fa-right-to-bracket"></i>Masuk Sistem</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ================= HERO ================= -->
    <section id="home" class="hero-bg relative overflow-hidden">
        <!-- Foto latar belakang lingkungan sekolah -->
        <div class="absolute inset-0">
            <img src="{{ asset('storage/photos/lingkungan.jpeg') }}"
                 alt="Lingkungan SMAN 17 Maluku Tengah"
                 class="w-full h-full object-cover">
            <!-- Overlay gradasi agar teks tetap kontras -->
            <div class="absolute inset-0 bg-gradient-to-br from-slate-950/90 via-blue-950/75 to-blue-900/55"></div>
        </div>
        <div class="absolute inset-0 bg-grid"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-24 lg:pt-36 lg:pb-28">
            @php
                use App\Models\Pengumuman;
                use Carbon\Carbon;
                use Illuminate\Support\Str;
                use Illuminate\Support\Facades\Storage;

                /* Kartu pengumuman di hero hanya tampil jika ada pengumuman aktif */
                try {
                    $pengumumanUtama = Pengumuman::where('status', 1)
                        ->orderBy('created_at', 'desc')
                        ->limit(3)
                        ->get();
                } catch (\Exception $e) {
                    $pengumumanUtama = collect();
                }

                $punyaPengumuman = $pengumumanUtama->count() > 0;
            @endphp
            <div class="grid grid-cols-1 gap-14 items-stretch {{ $punyaPengumuman ? 'lg:grid-cols-2' : '' }}">
                <!-- Hero content -->
                <div class="text-white slide-in self-center">
                    <div class="mb-8">
                        <div class="leading-tight">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-400"></span>
                                </span>
                                <span class="text-xs font-semibold text-blue-200 uppercase tracking-widest">Sistem Informasi Sekolah</span>
                            </div>
                            <h3 class="text-3xl md:text-4xl font-extrabold tracking-tight">{{ \App\Models\Setting::get('nama_singkat') }}</h3>
                            <p class="text-sm text-blue-200 font-semibold tracking-widest uppercase mt-1">{{ \App\Models\Setting::get('motto') }}</p>
                        </div>
                    </div>

                    <h2 class="text-4xl md:text-5xl font-extrabold leading-[1.1] tracking-tight mb-6">
                        Mencerdaskan
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-sky-300 to-blue-300">Generasi Penerus Bangsa</span>
                    </h2>

                    <p class="text-lg text-blue-100/90 leading-relaxed mb-8 max-w-xl">
                        Sekolah Menengah Atas Negeri 17 Maluku Tengah — lembaga pendidikan unggulan yang berkomitmen
                        mencetak generasi berkarakter, berprestasi, dan berwawasan global.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2.5 bg-white text-blue-700 px-8 py-4 rounded-2xl font-bold shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
                            <i class="fas fa-right-to-bracket group-hover:translate-x-1 transition-transform"></i>
                            Masuk Sistem
                        </a>
                        <a href="#profile" class="inline-flex items-center justify-center gap-2.5 border border-white/25 bg-white/5 backdrop-blur-sm text-white px-8 py-4 rounded-2xl font-semibold hover:bg-white/10 hover:border-white/40 transition-all duration-300 group">
                            <i class="fas fa-compass group-hover:rotate-45 transition-transform duration-300"></i>
                            Jelajahi Sekolah
                        </a>
                    </div>

                    <!-- Stats (dari menu Pengaturan → Profil & Statistik) -->
                    @php
                        $statsHero = \App\Models\Setting::get('stats') ?? [];
                        $statsHeroList = array_filter([
                            $statsHero['siswa'] ?? null,
                            $statsHero['guru'] ?? null,
                            $statsHero['kelulusan'] ?? null,
                        ], fn ($s) => ($s['nilai'] ?? '') !== '');
                    @endphp
                    <div class="grid grid-cols-3 gap-4 max-w-lg border-t border-white/10 pt-8">
                        @foreach($statsHeroList as $stat)
                        <div>
                            <div class="text-3xl font-extrabold tracking-tight">{{ $stat['nilai'] }}<span class="text-blue-300">{{ $stat['suffix'] ?? '' }}</span></div>
                            <div class="text-blue-200/80 text-sm mt-1">{{ $stat['label'] ?? '' }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Hero card: pengumuman terbaru (hanya tampil jika ada pengumuman) -->
                @if($punyaPengumuman)
                <div class="relative slide-in flex" style="animation-delay:.15s">
                    <div class="relative bg-white rounded-3xl p-7 shadow-glow w-full flex flex-col">
                        <div class="flex items-center justify-between mb-5">
                            <h3 class="text-xl font-bold text-slate-900 flex items-center gap-2.5">
                                <span class="w-9 h-9 rounded-xl bg-blue-600/10 text-blue-600 flex items-center justify-center"><i class="fas fa-bullhorn text-sm"></i></span>
                                Pengumuman Terbaru
                            </h3>
                            <span class="w-2.5 h-2.5 bg-emerald-400 rounded-full animate-pulse"></span>
                        </div>

                        <div class="space-y-3 flex-1">
                                @foreach($pengumumanUtama as $pengumuman)
                                <div class="group flex items-start gap-4 p-4 rounded-2xl border border-slate-100 bg-slate-50/70 hover:bg-white hover:border-blue-200 hover:shadow-md transition-all duration-300">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br
                                        {{ $pengumuman->tipe == 'event' ? 'from-emerald-500 to-teal-600' :
                                           ($pengumuman->tipe == 'berita' ? 'from-violet-500 to-purple-600' :
                                           'from-blue-500 to-indigo-600') }}
                                        flex items-center justify-center shadow-md">
                                        <i class="fas fa-{{ $pengumuman->tipe == 'event' ? 'calendar' : ($pengumuman->tipe == 'berita' ? 'newspaper' : 'bullhorn') }} text-white text-sm"></i>
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between gap-2 mb-1">
                                            <span class="text-[11px] font-bold px-2 py-0.5 rounded-full
                                                {{ $pengumuman->tipe == 'event' ? 'bg-emerald-100 text-emerald-700' :
                                                   ($pengumuman->tipe == 'berita' ? 'bg-violet-100 text-violet-700' :
                                                   'bg-blue-100 text-blue-700') }}">
                                                {{ ucfirst($pengumuman->tipe) }}
                                            </span>
                                            <span class="text-xs text-slate-400 whitespace-nowrap">
                                                {{ Carbon::parse($pengumuman->tanggal_mulai)->format('d M Y') }}
                                            </span>
                                        </div>

                                        <h4 class="font-semibold text-slate-800 mb-1 line-clamp-2 group-hover:text-blue-700 transition-colors">
                                            {{ $pengumuman->judul }}
                                        </h4>
                                        <p class="text-sm text-slate-500 line-clamp-1">
                                            {{ Str::limit(strip_tags($pengumuman->isi), 70) }}
                                        </p>
                                    </div>
                                </div>
                                @endforeach
                        </div>

                        <div class="mt-5 pt-5 border-t border-slate-100">
                            <a href="#pengumuman" class="flex items-center justify-center gap-2 text-blue-600 hover:text-blue-700 font-semibold text-sm group">
                                Lihat Semua Pengumuman
                                <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Divider wave -->
        <svg class="w-full h-12 text-white relative block" viewBox="0 0 1440 48" fill="none" preserveAspectRatio="none"><path d="M0 48h1440V24c-180 16-360 24-720 12C420 27 180 16 0 0v48z" fill="currentColor"></path></svg>
    </section>

    <!-- ================= PROFILE ================= -->
    <section id="profile" class="py-20 lg:py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal">
                <span class="text-xs font-bold uppercase tracking-widest text-blue-600">Profil Sekolah</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight mt-2 mb-4">Mengenal Lebih Dekat</h2>
                <div class="w-16 h-1.5 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="relative reveal">
                    <div class="absolute -inset-3 bg-gradient-to-tr from-blue-200 via-indigo-100 to-transparent rounded-[2rem] rotate-1"></div>

                    @php
                        /*
                        ┌───────────────────────────────────────────────────────┐
                        │  Kepala Sekolah: berasal dari menu Pengaturan admin   │
                        │  (nama + foto). Foto kosong = ikon placeholder.       │
                        └───────────────────────────────────────────────────────┘
                        */
                        $fotoKepsek    = \App\Models\Setting::get('kepsek_foto');
                        $namaKepsek    = \App\Models\Setting::get('kepsek_nama') ?: 'Nama Kepala Sekolah';
                        $jabatanKepsek = 'Kepala ' . \App\Models\Setting::get('nama_sekolah');
                    @endphp

                    <!-- Label Kepala Sekolah: badge terpisah di atas kartu, tidak menimpa isi kartu -->
                    <div class="relative flex justify-center mb-6">
                        <span class="inline-flex items-center gap-2 bg-white text-blue-700 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full shadow-soft border border-blue-100">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> Kepala Sekolah
                        </span>
                    </div>

                    <div class="relative bg-white rounded-[1.75rem] shadow-card p-5 sm:p-6 border border-slate-100 max-w-sm mx-auto">
                        <!-- Foto potret penuh -->
                        <div class="relative w-full aspect-[3/4] rounded-2xl overflow-hidden ring-1 ring-slate-200/70 shadow-inner">
                            @if($fotoKepsek)
                                <img src="{{ asset('storage/' . $fotoKepsek) }}"
                                     alt="{{ $namaKepsek }}"
                                     class="w-full h-full object-cover object-top">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-700 to-indigo-900 flex items-center justify-center">
                                    <i class="fas fa-user-tie text-white/90 text-7xl"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Nama & jabatan -->
                        <div class="mt-5 border-l-4 border-blue-600 pl-4 text-left">
                            <h3 class="text-lg sm:text-xl font-bold italic text-slate-900 tracking-tight">{{ $namaKepsek }}</h3>
                            <p class="text-[11px] font-bold uppercase tracking-widest text-slate-500 mt-1">{{ strtoupper($jabatanKepsek) }}</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-5 reveal">
                    <h3 class="text-3xl font-extrabold text-slate-900 tracking-tight">Visi &amp; Misi Sekolah</h3>
                    <div class="bg-white p-7 rounded-3xl shadow-soft border border-slate-100">
                        <h4 class="flex items-center gap-2.5 text-lg font-bold text-blue-700 mb-3">
                            <span class="w-8 h-8 rounded-lg bg-blue-600/10 flex items-center justify-center"><i class="fas fa-eye text-sm"></i></span>
                            Visi
                        </h4>
                        <p class="text-slate-600 leading-relaxed">
                            {{ \App\Models\Setting::get('visi') }}
                        </p>
                    </div>
                    <div class="bg-white p-7 rounded-3xl shadow-soft border border-slate-100">
                        <h4 class="flex items-center gap-2.5 text-lg font-bold text-blue-700 mb-4">
                            <span class="w-8 h-8 rounded-lg bg-blue-600/10 flex items-center justify-center"><i class="fas fa-flag text-sm"></i></span>
                            Misi
                        </h4>
                        <ul class="text-slate-600 space-y-3">
                            @php $misiList = preg_split('/\r\n|\r|\n/', \App\Models\Setting::get('misi') ?? '', -1, PREG_SPLIT_NO_EMPTY); @endphp
                            @foreach($misiList as $misiItem)
                            <li class="flex items-start gap-3"><span class="w-5 h-5 mt-0.5 rounded-full bg-emerald-100 text-emerald-600 flex-shrink-0 flex items-center justify-center"><i class="fas fa-check text-[10px]"></i></span>{{ $misiItem }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= FASILITAS ================= -->
    <section id="fasilitas" class="py-20 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal">
                <span class="text-xs font-bold uppercase tracking-widest text-blue-600">Fasilitas</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight mt-2 mb-4">Fasilitas Sekolah</h2>
                <p class="text-slate-500 max-w-2xl mx-auto text-lg">Fasilitas modern dan lengkap untuk mendukung proses belajar mengajar yang optimal</p>
            </div>

            @php
                /*
                ┌───────────────────────────────────────────────────────┐
                │  Fasilitas: dikelola admin (menu Fasilitas).          │
                │  • Punya deskripsi → kartu besar (nama + poin)        │
                │  • Tanpa deskripsi → kartu kecil (ikon + nama)        │
                │  Warna gradien/chip bergilir otomatis.                │
                └───────────────────────────────────────────────────────┘
                */
                $semuaFasilitas = \App\Models\Fasilitas::aktif();
                $fasilitasBesar = $semuaFasilitas->filter(fn ($f) => $f->deskripsi)->values();
                $fasilitasKecil = $semuaFasilitas->filter(fn ($f) => ! $f->deskripsi)->values();
                $gradienKartu = [
                    ['from-blue-500 to-blue-600', 'shadow-blue-500/25', 'hover:border-blue-100'],
                    ['from-indigo-500 to-violet-600', 'shadow-indigo-500/25', 'hover:border-indigo-100'],
                    ['from-sky-500 to-cyan-600', 'shadow-sky-500/25', 'hover:border-sky-100'],
                ];
                $warnaChip = ['bg-orange-100 text-orange-600', 'bg-red-100 text-red-600', 'bg-blue-100 text-blue-600', 'bg-emerald-100 text-emerald-600'];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($fasilitasBesar as $i => $f)
                @php $gradien = $gradienKartu[$i % count($gradienKartu)]; @endphp
                <div class="reveal group bg-slate-50 border border-slate-100 rounded-3xl p-8 hover-lift {{ $gradien[2] }}" style="transition-delay:{{ number_format($i * 0.08, 2) }}s">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br {{ $gradien[0] }} flex items-center justify-center shadow-lg {{ $gradien[1] }} mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas {{ $f->ikon }} text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $f->nama }}</h3>
                    <p class="text-slate-500 text-sm mb-5">{{ $f->deskripsi }}</p>
                    <ul class="space-y-2 text-sm text-slate-600">
                        @foreach(preg_split('/\r\n|\r|\n/', $f->poin ?? '', -1, PREG_SPLIT_NO_EMPTY) as $poin)
                        <li class="flex items-center gap-2"><i class="fas fa-check text-emerald-500 text-xs"></i>{{ $poin }}</li>
                        @endforeach
                    </ul>
                </div>
                @empty
                <p class="col-span-full text-center text-slate-400">Belum ada fasilitas yang ditampilkan.</p>
                @endforelse
            </div>

            <!-- Fasilitas lainnya -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-5 mt-10">
                @forelse($fasilitasKecil as $i => $f)
                <div class="reveal flex items-center gap-4 bg-white border border-slate-100 shadow-soft rounded-2xl px-6 py-5 hover-lift" style="transition-delay:{{ number_format($i * 0.06, 2) }}s">
                    <span class="w-11 h-11 rounded-xl {{ $warnaChip[$i % count($warnaChip)] }} flex items-center justify-center flex-shrink-0"><i class="fas {{ $f->ikon }}"></i></span>
                    <h4 class="font-semibold text-slate-800 text-sm">{{ $f->nama }}</h4>
                </div>
                @empty
                @endforelse
            </div>
        </div>
    </section>

    <!-- ================= STATISTIK ================= -->
    <section class="hero-bg py-16 relative overflow-hidden">
        <div class="absolute inset-0 bg-grid"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @php
                    /* Statistik dari menu Pengaturan (Profil & Statistik) */
                    $statsSetting = \App\Models\Setting::get('stats') ?? [];
                    $statsSection = array_filter([
                        $statsSetting['siswa'] ?? null,
                        $statsSetting['guru'] ?? null,
                        $statsSetting['rombel'] ?? null,
                    ], fn ($s) => ($s['nilai'] ?? '') !== '');
                @endphp
                @foreach ($statsSection as $statistik)
                <div class="text-center reveal">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-sm flex items-center justify-center">
                        <i class="fas fa-{{ $statistik['ikon'] ?? 'users' }} text-sky-300 text-2xl"></i>
                    </div>
                    <h3 class="text-4xl font-extrabold tracking-tight">{{ $statistik['nilai'] }}{{ $statistik['suffix'] ?? '' }}</h3>
                    <p class="text-blue-200/80 mt-1.5">{{ $statistik['label'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ================= GALERI ================= -->
    <section id="galery" class="py-20 lg:py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12 reveal">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-blue-600">Galeri</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight mt-2 mb-2">Galeri Kegiatan</h2>
                    <p class="text-slate-500 text-lg">Dokumentasi kegiatan dan acara sekolah</p>
                </div>
                <a href="{{ route('galeri') }}" class="inline-flex items-center gap-2 text-blue-700 font-semibold hover:gap-3 transition-all group shrink-0">
                    Lihat Semua Galeri <i class="fas fa-arrow-right group-hover:translate-x-0.5 transition-transform"></i>
                </a>
            </div>

            @php
                $recentDokumentasi = \App\Models\Dokumentasi::with('files')
                    ->withCount('files')
                    ->orderBy('tanggal_kegiatan', 'desc')
                    ->get();
            @endphp

            @if($recentDokumentasi->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                @foreach($recentDokumentasi->take(6) as $doc)
                <a href="{{ route('galeri.show', $doc->id) }}" class="group bg-white rounded-3xl border border-slate-100 shadow-soft overflow-hidden hover-lift flex flex-col reveal">
                    <div class="relative h-52 overflow-hidden">
                        @if($doc->first_image)
                        <img src="{{ Storage::url($doc->first_image) }}" alt="{{ $doc->judul_kegiatan }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
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
                        <h3 class="font-bold text-slate-900 mb-2 line-clamp-2 group-hover:text-blue-700 transition-colors">{{ $doc->judul_kegiatan }}</h3>
                        <p class="text-slate-500 text-sm mb-4 line-clamp-2">{{ $doc->deskripsi }}</p>
                        <div class="mt-auto flex items-center justify-between text-sm">
                            <span class="text-slate-400 flex items-center gap-1.5"><i class="far fa-calendar-alt text-blue-600"></i>{{ $doc->tanggal_kegiatan->translatedFormat('d F Y') }}</span>
                            <span class="text-blue-700 font-semibold inline-flex items-center gap-1.5 group-hover:gap-2.5 transition-all">Lihat Detail <i class="fas fa-arrow-right text-xs"></i></span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('galeri') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-7 py-3.5 rounded-2xl font-semibold shadow-lg shadow-blue-600/25 hover:-translate-y-0.5 transition-all duration-300">
                    <i class="fas fa-images"></i> Lihat Semua Galeri
                </a>
            </div>
            @else
            <div class="text-center py-16 bg-white rounded-3xl border border-dashed border-slate-200 reveal">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-slate-100 flex items-center justify-center">
                    <i class="fas fa-image text-slate-300 text-2xl"></i>
                </div>
                <p class="text-slate-500 text-lg font-medium">Belum ada dokumentasi kegiatan</p>
                <p class="text-slate-400 text-sm mt-1">Dokumentasi akan tampil di sini setelah diunggah.</p>
            </div>
            @endif
        </div>
    </section>

    <!-- ================= PENGUMUMAN ================= -->
    <section id="pengumuman" class="py-20 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14 reveal">
                <span class="text-xs font-bold uppercase tracking-widest text-blue-600">Informasi</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight mt-2 mb-4">Pengumuman &amp; Berita</h2>
                <p class="text-slate-500 max-w-2xl mx-auto text-lg">Informasi terbaru seputar kegiatan, berita, dan pengumuman dari SMAN 17 Maluku Tengah</p>
            </div>

            @php
                try {
                    $semuaPengumuman = Pengumuman::where('status', 1)
                        ->orderBy('created_at', 'desc')
                        ->limit(6)
                        ->get();
                } catch (\Exception $e) {
                    $semuaPengumuman = collect();
                }
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                @forelse($semuaPengumuman as $pengumuman)
                <article class="group bg-white rounded-3xl border border-slate-100 shadow-soft overflow-hidden hover-lift flex flex-col reveal">
                    <div class="relative h-48 overflow-hidden">
                        @if($pengumuman->gambar)
                            @if(Storage::disk('public')->exists($pengumuman->gambar))
                            <img src="{{ Storage::url($pengumuman->gambar) }}" alt="{{ $pengumuman->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-100 to-indigo-200 flex items-center justify-center">
                                <i class="fas fa-{{ $pengumuman->tipe == 'event' ? 'calendar' : ($pengumuman->tipe == 'berita' ? 'newspaper' : 'bullhorn') }} text-blue-500/60 text-4xl"></i>
                            </div>
                            @endif
                        @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-100 to-indigo-200 flex items-center justify-center">
                            <i class="fas fa-{{ $pengumuman->tipe == 'event' ? 'calendar' : ($pengumuman->tipe == 'berita' ? 'newspaper' : 'bullhorn') }} text-blue-500/60 text-4xl"></i>
                        </div>
                        @endif
                        <span class="absolute top-3 left-3 text-[11px] font-bold px-3 py-1.5 rounded-full shadow-sm
                            {{ $pengumuman->tipe == 'event' ? 'bg-emerald-500 text-white' :
                               ($pengumuman->tipe == 'berita' ? 'bg-violet-500 text-white' :
                               'bg-blue-600 text-white') }}">
                            {{ ucfirst($pengumuman->tipe) }}
                        </span>
                    </div>

                    <div class="p-6 flex flex-col flex-1">
                        <span class="text-xs text-slate-400 mb-2 flex items-center gap-1.5">
                            <i class="far fa-calendar"></i>{{ Carbon::parse($pengumuman->tanggal_mulai)->format('d M Y') }}
                            @if($pengumuman->tanggal_selesai)
                                · s/d {{ Carbon::parse($pengumuman->tanggal_selesai)->format('d M Y') }}
                            @endif
                        </span>
                        <h3 class="text-lg font-bold text-slate-900 mb-2 line-clamp-2 leading-snug group-hover:text-blue-700 transition-colors">
                            {{ $pengumuman->judul }}
                        </h3>
                        <p class="text-slate-500 text-sm mb-5 line-clamp-3">
                            {{ Str::limit(strip_tags($pengumuman->isi), 120) }}
                        </p>
                        <span class="mt-auto text-xs text-slate-400 flex items-center gap-1.5">
                            <i class="far fa-clock"></i>{{ Carbon::parse($pengumuman->created_at)->diffForHumans() }}
                        </span>
                    </div>
                </article>
                @empty
                <div class="col-span-full text-center py-16 bg-slate-50 rounded-3xl border border-dashed border-slate-200 reveal">
                    <div class="w-20 h-20 mx-auto mb-5 rounded-3xl bg-white shadow-soft flex items-center justify-center">
                        <i class="fas fa-bullhorn text-slate-300 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Pengumuman</h3>
                    <p class="text-slate-500">Tidak ada pengumuman yang ditampilkan saat ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ================= KONTAK ================= -->
    <section id="kontak" class="hero-bg py-20 lg:py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-grid"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-14">
                <div class="text-white reveal">
                    <span class="text-xs font-bold uppercase tracking-widest text-sky-300">Kontak</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight mt-2 mb-4">Hubungi Kami</h2>
                    <p class="text-blue-100/90 text-lg mb-10 max-w-md">Mari berkomunikasi untuk informasi lebih lanjut tentang SMAN 17 Maluku Tengah.</p>

                    <div class="space-y-5 mb-10">
                        <div class="flex items-center gap-4 group">
                            <div class="w-12 h-12 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-sm flex items-center justify-center flex-shrink-0 group-hover:bg-white/15 transition-colors">
                                <i class="fas fa-location-dot text-sky-300"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold">Alamat</h4>
                                <p class="text-blue-100/80 text-sm">{{ \App\Models\Setting::get('alamat') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 group">
                            <div class="w-12 h-12 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-sm flex items-center justify-center flex-shrink-0 group-hover:bg-white/15 transition-colors">
                                <i class="fas fa-phone text-emerald-300"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold">Telepon</h4>
                                <p class="text-blue-100/80 text-sm">{{ \App\Models\Setting::get('telepon') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 group">
                            <div class="w-12 h-12 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-sm flex items-center justify-center flex-shrink-0 group-hover:bg-white/15 transition-colors">
                                <i class="fas fa-envelope text-violet-300"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold">Email</h4>
                                <p class="text-blue-100/80 text-sm">{{ \App\Models\Setting::get('email') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <a href="https://www.tiktok.com/@sman17malteng" target="_blank" rel="noopener" class="w-12 h-12 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-sm flex items-center justify-center hover:bg-white/20 hover:-translate-y-1 transition-all duration-300" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                        <a href="https://wa.me/6282120793392" target="_blank" rel="noopener" class="w-12 h-12 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-sm flex items-center justify-center hover:bg-white/20 hover:-translate-y-1 transition-all duration-300" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        @if(\App\Models\Setting::get('instagram'))
                        <a href="https://www.instagram.com/{{ \App\Models\Setting::get('instagram') }}" target="_blank" rel="noopener" class="w-12 h-12 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-sm flex items-center justify-center hover:bg-white/20 hover:-translate-y-1 transition-all duration-300" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        @endif
                    </div>
                </div>

                <div class="reveal">
                    <div class="bg-white rounded-3xl p-8 shadow-glow">
                        <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                            <span class="w-10 h-10 rounded-xl bg-blue-600/10 text-blue-600 flex items-center justify-center"><i class="fas fa-paper-plane text-sm"></i></span>
                            Kirim Pesan
                        </h3>
                        <form action="{{ route('pesan.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <input type="text" name="nama" placeholder="Nama Lengkap" required
                                        class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all">
                                </div>
                                <div>
                                    <input type="email" name="email" placeholder="Email" required
                                        class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all">
                                </div>
                            </div>
                            <input type="text" name="subjek" placeholder="Subjek" required
                                class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all">
                            <textarea name="pesan" placeholder="Pesan" rows="5" required
                                class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all resize-none"></textarea>
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-bold shadow-lg shadow-blue-600/25 hover:-translate-y-0.5 transition-all duration-300">
                                <i class="fas fa-paper-plane"></i> Kirim Pesan
                            </button>
                        </form>

                        @if(session('success'))
                        <div class="mt-5 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-xs"></i></span>
                            <p class="text-sm font-medium">{{ session('success') }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= LOKASI ================= -->
    <section id="lokasi" class="py-20 lg:py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14 reveal">
                <span class="text-xs font-bold uppercase tracking-widest text-blue-600">Lokasi</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight mt-2 mb-4">Lokasi Sekolah</h2>
                <p class="text-slate-500 max-w-2xl mx-auto text-lg">Temukan lokasi SMAN 17 Maluku Tengah dengan mudah melalui peta interaktif di bawah ini</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start reveal">
                <div class="lg:col-span-2 map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3340.3962946730207!2d129.02035117407314!3d-3.2049002967703304!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d6bbff8bcd6223f%3A0xbf87588bd851280f!2sSMA%20N%2017%20MALUKU%20TENGAH!5e1!3m2!1sid!2sid!4v1794283700705!5m2!1sid!2sid"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <div class="space-y-5">
                    <div class="bg-white rounded-3xl border border-slate-100 shadow-soft p-7">
                        <h3 class="flex items-center gap-3 text-lg font-bold text-slate-900 mb-5">
                            <span class="w-10 h-10 rounded-xl bg-blue-600/10 text-blue-600 flex items-center justify-center"><i class="fas fa-location-dot text-sm"></i></span>
                            Alamat Lengkap
                        </h3>
                        <div class="space-y-4 text-sm">
                            <p class="flex items-start gap-3 text-slate-600"><i class="fas fa-location-dot text-blue-500 mt-1"></i>{{ \App\Models\Setting::get('alamat') }}</p>
                            <p class="flex items-center gap-3 text-slate-600"><i class="fas fa-clock text-amber-500"></i>Senin - Jumat: 07:00 - 16:00 WIT</p>
                        </div>
                        <a href="https://www.google.com/maps/search/?api=1&query=SMA+N+17+MALUKU+TENGAH" target="_blank" rel="noopener"
                           class="mt-6 inline-flex items-center justify-center gap-2 w-full bg-blue-600 hover:bg-blue-700 text-white py-3.5 rounded-2xl font-semibold shadow-lg shadow-blue-600/25 transition-all duration-300 hover:-translate-y-0.5">
                            <i class="fas fa-diamond-turn-right"></i> Buka di Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= FOOTER ================= -->
    <footer class="bg-slate-950 text-white relative overflow-hidden">
        <div class="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-blue-500/60 to-transparent"></div>
        <div class="absolute -top-24 -right-24 w-72 h-72 bg-blue-600/10 rounded-full blur-3xl"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-14 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-10">
                <!-- Brand -->
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-5">
                        @if(\App\Models\Setting::get('logo'))
                        <img src="{{ asset('storage/' . Setting::get('logo')) }}" alt="Logo {{ \App\Models\Setting::get('nama_singkat') }}"
                             class="w-11 h-11 object-contain flex-shrink-0">
                        @else
                        <div class="school-badge w-11 h-11 rounded-2xl flex items-center justify-center shadow-lg flex-shrink-0">
                            <i class="fas fa-graduation-cap text-white"></i>
                        </div>
                        @endif
                        <div class="leading-tight min-w-0">
                            <span class="block text-lg font-extrabold">{{ \App\Models\Setting::get('nama_singkat') }}</span>
                            <span class="block text-[11px] font-semibold tracking-widest text-blue-300 uppercase">{{ \App\Models\Setting::get('motto') }}</span>
                        </div>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-sm">
                        Sekolah Menengah Atas Negeri 17 Maluku Tengah — berkomitmen mencerdaskan kehidupan bangsa melalui pendidikan berkualitas.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-widest text-slate-300 mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="#home" class="text-slate-400 hover:text-white transition flex items-center gap-2 group"><i class="fas fa-chevron-right text-[10px] text-blue-500 group-hover:translate-x-0.5 transition-transform"></i>Beranda</a></li>
                        <li><a href="#profile" class="text-slate-400 hover:text-white transition flex items-center gap-2 group"><i class="fas fa-chevron-right text-[10px] text-blue-500 group-hover:translate-x-0.5 transition-transform"></i>Profil Sekolah</a></li>
                        <li><a href="#fasilitas" class="text-slate-400 hover:text-white transition flex items-center gap-2 group"><i class="fas fa-chevron-right text-[10px] text-blue-500 group-hover:translate-x-0.5 transition-transform"></i>Fasilitas</a></li>
                        <li><a href="#galery" class="text-slate-400 hover:text-white transition flex items-center gap-2 group"><i class="fas fa-chevron-right text-[10px] text-blue-500 group-hover:translate-x-0.5 transition-transform"></i>Galeri</a></li>
                        <li><a href="#pengumuman" class="text-slate-400 hover:text-white transition flex items-center gap-2 group"><i class="fas fa-chevron-right text-[10px] text-blue-500 group-hover:translate-x-0.5 transition-transform"></i>Pengumuman</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-widest text-slate-300 mb-4">Kontak</h4>
                    <div class="space-y-3 text-sm text-slate-400">
                        <p class="flex items-start gap-3"><i class="fas fa-location-dot text-blue-500 mt-1"></i>{{ \App\Models\Setting::get('alamat') }}</p>
                        <p class="flex items-center gap-3"><i class="fas fa-phone text-emerald-500"></i>{{ \App\Models\Setting::get('telepon') }}</p>
                        <p class="flex items-center gap-3"><i class="fas fa-envelope text-violet-500"></i>{{ \App\Models\Setting::get('email') }}</p>
                        <p class="flex items-center gap-3"><i class="fas fa-clock text-amber-500"></i>Senin - Jumat: 07:00 - 16:00</p>
                    </div>
                </div>
            </div>
            

            <div class="border-t border-slate-800 pt-6 text-center">
                <p class="text-slate-500 text-xs">
                    &copy; {{ date('Y') }} {{ \App\Models\Setting::get('nama_sekolah') }}. Hak cipta dilindungi.
                </p>
                <p class="text-slate-600 text-xs mt-1.5">
                    Sistem dikembangkan oleh Kelompok KKN Waipia 64 <i class="fas fa-heart text-red-500/70 mx-0.5"></i> dengan penuh dedikasi
                </p>
            </div>
        </div>
    </footer>

    <!-- Back to top -->
    <button id="backToTop" class="fixed bottom-6 right-6 w-11 h-11 bg-blue-600 text-white rounded-2xl shadow-lg shadow-blue-600/30 flex items-center justify-center opacity-0 pointer-events-none translate-y-2 transition-all duration-300 z-50 hover:bg-blue-700" aria-label="Kembali ke atas">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Mobile menu
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuIcon = document.getElementById('mobileMenuIcon');
        document.getElementById('mobileMenuButton').addEventListener('click', function () {
            mobileMenu.classList.toggle('hidden');
            mobileMenuIcon.classList.toggle('fa-bars');
            mobileMenuIcon.classList.toggle('fa-xmark');
        });
        // Tutup menu mobile setelah pilih link
        mobileMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
            mobileMenuIcon.classList.add('fa-bars');
            mobileMenuIcon.classList.remove('fa-xmark');
        }));

        // Back to top
        const backToTop = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 400) {
                backToTop.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-2');
            } else {
                backToTop.classList.add('opacity-0', 'pointer-events-none', 'translate-y-2');
            }
        });
        backToTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

        // Scroll reveal
        document.addEventListener('DOMContentLoaded', function () {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

            document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
        });
    </script>

    <!-- Dark mode toggle -->
    <script>
        const themeToggle = document.getElementById('themeToggle');
        if (themeToggle) themeToggle.addEventListener('click', function () {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.theme = isDark ? 'dark' : 'light';
        });
    </script>
</body>
</html>
