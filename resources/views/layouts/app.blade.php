<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Informasi Sekolah')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'] },
                    colors: {
                        primary: { 50: '#eff6ff', 100: '#dbeafe', 600: '#2563eb', 700: '#1d4ed8', 800: '#1e40af', 900: '#1e3a8a' },
                        secondary: '#06B6D4',
                        success: '#16A34A',
                        danger: '#DC2626',
                    },
                    boxShadow: {
                        soft: '0 2px 12px -2px rgb(15 23 42 / 0.08)',
                        card: '0 10px 40px -12px rgb(15 23 42 / 0.15)',
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

        ::-webkit-scrollbar { width: 10px; height: 10px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 8px; border: 2px solid #f8fafc; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* Admin sidebar */
        .sidebar-bg {
            background: linear-gradient(180deg, #172554 0%, #1e3a8a 60%, #1e40af 100%);
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 0.9rem;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #bfdbfe;
            transition: all .2s ease;
        }
        .sidebar-link:hover {
            background: rgba(255,255,255,.08);
            color: #fff;
            transform: translateX(3px);
        }
        .sidebar-link.active-menu {
            background: rgba(255,255,255,.15);
            color: #fff;
            font-weight: 600;
            box-shadow: 0 4px 16px -4px rgb(0 0 0 / .3);
        }
        .sidebar-link.active-menu .nav-icon {
            background: rgba(255,255,255,.15);
            color: #fff;
        }
        .nav-icon {
            width: 2rem; height: 2rem;
            border-radius: 0.6rem;
            display: inline-flex;
            align-items: center; justify-content: center;
            font-size: 0.8rem;
            background: rgba(255,255,255,.06);
            color: #93c5fd;
            transition: all .2s ease;
            flex-shrink: 0;
        }

        /* Komponen umum */
        .btn-primary {
            display: inline-flex; align-items: center; gap: .5rem;
            background-color: #2563eb; color: #fff;
            font-weight: 600; font-size: .875rem;
            padding: .625rem 1.125rem; border-radius: .75rem;
            box-shadow: 0 8px 20px -6px rgb(37 99 235 / .4);
            transition: all .2s ease;
        }
        .btn-primary:hover { background-color: #1d4ed8; transform: translateY(-1px); }
        .btn-secondary {
            display: inline-flex; align-items: center; gap: .5rem;
            background-color: #f1f5f9; color: #334155;
            font-weight: 600; font-size: .875rem;
            padding: .625rem 1.125rem; border-radius: .75rem;
            transition: all .2s ease;
        }
        .btn-secondary:hover { background-color: #e2e8f0; }
        .btn-success {
            display: inline-flex; align-items: center; gap: .5rem;
            background-color: #16A34A; color: #fff;
            font-weight: 600; font-size: .875rem;
            padding: .625rem 1.125rem; border-radius: .75rem;
            box-shadow: 0 8px 20px -6px rgb(22 163 74 / .4);
            transition: all .2s ease;
        }
        .btn-success:hover { background-color: #15803d; transform: translateY(-1px); }
        .btn-danger {
            display: inline-flex; align-items: center; gap: .5rem;
            background-color: #DC2626; color: #fff;
            font-weight: 600; font-size: .875rem;
            padding: .625rem 1.125rem; border-radius: .75rem;
            box-shadow: 0 8px 20px -6px rgb(220 38 38 / .4);
            transition: all .2s ease;
        }
        .btn-danger:hover { background-color: #b91c1c; transform: translateY(-1px); }

        .form-input {
            width: 100%;
            padding: .75rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: .75rem;
            background-color: #f8fafc;
            font-size: .875rem;
            color: #1e293b;
            transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
        }
        .form-input:focus {
            outline: none;
            border-color: #2563eb;
            background-color: #fff;
            box-shadow: 0 0 0 4px rgb(37 99 235 / .1);
        }

        .card {
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 2px 12px -2px rgb(15 23 42 / 0.08);
            border: 1px solid #f1f5f9;
            padding: 1.5rem;
        }

        /* ================= DARK MODE ================= */
        .dark body { background-color: #0f172a; color: #e2e8f0; }
        .dark .bg-white { background-color: #1e293b; }
        .dark .bg-white\/85 { background-color: rgba(30, 41, 59, .85); }
        .dark .bg-white\/95 { background-color: rgba(30, 41, 59, .95); }
        .dark .bg-slate-50 { background-color: #0f172a; }
        .dark .bg-slate-50\/70 { background-color: rgba(15, 23, 42, .7); }
        .dark .bg-slate-100 { background-color: #1e293b; }
        .dark .bg-slate-200 { background-color: #334155; }
        .dark .bg-slate-300 { background-color: #475569; }
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

        /* Komponen admin dalam mode gelap */
        .dark .form-input { background-color: #0f172a; border-color: #334155; color: #e2e8f0; }
        .dark .form-input:focus { background-color: #0f172a; border-color: #3b82f6; box-shadow: 0 0 0 4px rgb(59 130 246 / .15); }
        .dark .btn-secondary { background-color: #334155; color: #e2e8f0; }
        .dark .btn-secondary:hover { background-color: #475569; }
        .dark .card { background-color: #1e293b; border-color: #334155; }
        .dark ::-webkit-scrollbar-thumb { background: #475569; border-color: #0f172a; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800">
    <div class="flex h-screen overflow-hidden">

        <!-- ===== Overlay mobile sidebar ===== -->
        <div id="sidebarOverlay" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity"></div>

        <!-- ===== Sidebar ===== -->
        <aside id="sidebar" class="sidebar-bg text-white w-72 absolute lg:relative inset-y-0 left-0 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-50 flex flex-col">
            <!-- Logo -->
            <div class="flex items-center gap-3 px-6 h-20 border-b border-white/10 shrink-0 min-w-0">
                @if(\App\Models\Setting::get('logo'))
                <!-- Logo asli dari Pengaturan (sama dengan beranda) -->
                <img src="{{ asset('storage/' . \App\Models\Setting::get('logo')) }}"
                     alt="Logo {{ \App\Models\Setting::get('nama_singkat') }}"
                     class="w-10 h-10 object-contain flex-shrink-0 drop-shadow-md">
                @else
                <!-- Fallback: ikon dalam kotak -->
                <div class="w-10 h-10 rounded-xl bg-white/10 border border-white/15 flex items-center justify-center shrink-0">
                    <i class="fas fa-school text-sky-300"></i>
                </div>
                @endif
                <div class="leading-tight min-w-0">
                    <span class="block text-lg font-extrabold tracking-tight truncate">{{ \App\Models\Setting::get('nama_singkat', 'SIS SEKOLAH') }}</span>
                    <span class="block text-[10px] font-semibold tracking-[0.2em] text-blue-300 uppercase">Panel Admin</span>
                </div>
            </div>

            <!-- Menu -->
            <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1.5">
                @auth
                    @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active-menu' : '' }}">
                        <span class="nav-icon"><i class="fas fa-gauge-high"></i></span> Dashboard
                    </a>

                    <p class="px-3 pt-5 pb-2 text-[10px] font-bold uppercase tracking-[0.15em] text-blue-400/70">Konten Sekolah</p>

                    <a href="{{ route('admin.pengumuman.index') }}" class="sidebar-link {{ request()->routeIs('admin.pengumuman.*') ? 'active-menu' : '' }}">
                        <span class="nav-icon"><i class="fas fa-bullhorn"></i></span> Pengumuman
                    </a>
                    <a href="{{ route('admin.fasilitas.index') }}" class="sidebar-link {{ request()->routeIs('admin.fasilitas.*') ? 'active-menu' : '' }}">
                        <span class="nav-icon"><i class="fas fa-building"></i></span> Fasilitas
                    </a>
                    <a href="{{ route('admin.dokumentasi.index') }}" class="sidebar-link {{ request()->routeIs('admin.dokumentasi.*') ? 'active-menu' : '' }}">
                        <span class="nav-icon"><i class="fas fa-images"></i></span> Dokumentasi
                    </a>
                    <a href="{{ route('admin.pesan.index') }}" class="sidebar-link {{ request()->routeIs('admin.pesan.*') ? 'active-menu' : '' }}">
                        <span class="nav-icon relative"><i class="fas fa-envelope"></i>
                            @php
                                $unreadCount = \App\Models\Pesan::where('status', 'unread')->count();
                            @endphp
                            @if($unreadCount > 0)
                            <span class="absolute -top-1 -right-1 min-w-[1.15rem] h-[1.15rem] px-1 flex items-center justify-center rounded-full bg-red-500 text-white text-[10px] font-bold shadow-lg">
                                {{ $unreadCount }}
                            </span>
                            @endif
                        </span>
                        <span class="flex-1">Pesan</span>
                        @if($unreadCount > 0)
                        <span class="text-[10px] font-bold bg-red-500 text-white px-2 py-0.5 rounded-full">{{ $unreadCount }} baru</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.setting.edit') }}" class="sidebar-link {{ request()->routeIs('admin.setting.*') ? 'active-menu' : '' }}">
                        <span class="nav-icon"><i class="fas fa-gear"></i></span> Pengaturan
                    </a>
                    @endif
                @endauth

                <p class="px-3 pt-5 pb-2 text-[10px] font-bold uppercase tracking-[0.15em] text-blue-400/70">Website Publik</p>
                <a href="{{ url('/') }}" target="_blank" rel="noopener" class="sidebar-link">
                    <span class="nav-icon"><i class="fas fa-globe"></i></span> Lihat Website
                </a>
            </nav>

            <!-- Sidebar footer -->
            <div class="px-4 py-5 border-t border-white/10 shrink-0 space-y-1">
                <a href="{{ route('admin.profil.edit') }}" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-blue-200 hover:text-white hover:bg-white/10 transition-colors {{ request()->routeIs('admin.profil.*') ? 'bg-white/10 text-white' : '' }}">
                    <span class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center"><i class="fas fa-key text-xs"></i></span>
                    Ganti Password
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-blue-200 hover:text-white hover:bg-white/10 transition-colors">
                        <span class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center"><i class="fas fa-arrow-right-from-bracket text-xs"></i></span>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- ===== Main ===== -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Topbar -->
            <header class="bg-white/85 backdrop-blur-md border-b border-slate-200 z-30 shrink-0">
                <div class="flex items-center justify-between px-4 sm:px-6 h-20 gap-4">
                    <div class="flex items-center gap-3 min-w-0">
                        <!-- Mobile hamburger -->
                        <button onclick="toggleSidebar()" class="lg:hidden w-10 h-10 rounded-xl flex items-center justify-center text-slate-600 hover:bg-slate-100 transition-colors" aria-label="Buka menu">
                            <i class="fas fa-bars text-lg"></i>
                        </button>
                        <div class="min-w-0">
                            <h1 class="text-lg sm:text-xl font-bold text-slate-900 truncate">@yield('title', 'Dashboard')</h1>
                            <p class="hidden sm:block text-xs text-slate-500">{{ now()->translatedFormat('l, d F Y') }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button id="themeToggle" class="w-10 h-10 rounded-xl flex items-center justify-center text-slate-600 hover:bg-slate-100 transition-colors" aria-label="Ganti mode gelap/terang">
                            <i class="fas fa-moon text-base dark:hidden"></i>
                            <i class="fas fa-sun text-base hidden dark:inline-block"></i>
                        </button>

                        @auth
                        <div class="relative" id="userMenuWrapper">
                        <button id="userMenuBtn" class="flex items-center gap-3 p-1.5 pr-3 rounded-2xl hover:bg-slate-100 transition-colors">
                            @if(Auth::user()->photo)
                                <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profil" class="w-9 h-9 rounded-full object-cover ring-2 ring-blue-100">
                            @else
                                <span class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-600 to-indigo-600 text-white text-sm font-bold flex items-center justify-center">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                            @endif
                            <span class="hidden sm:block text-left leading-tight">
                                <span class="block text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</span>
                                <span class="block text-xs text-slate-400 capitalize">{{ Auth::user()->role }}</span>
                            </span>
                            <i class="fas fa-chevron-down text-[10px] text-slate-400"></i>
                        </button>

                        <!-- Dropdown -->
                        <div id="userMenu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-slate-100 py-2">
                            <a href="{{ url('/') }}" target="_blank" rel="noopener" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50 hover:text-blue-700 transition-colors">
                                <i class="fas fa-globe w-4 text-slate-400"></i> Lihat Website
                            </a>
                            <a href="{{ route('admin.profil.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50 hover:text-blue-700 transition-colors">
                                <i class="fas fa-key w-4 text-slate-400"></i> Ganti Password
                            </a>
                            <div class="my-1.5 border-t border-slate-100"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <i class="fas fa-arrow-right-from-bracket w-4"></i> Logout
                                </button>
                            </form>
                        </div>
                        </div>
                        @endauth
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                @if(session('success'))
                <div class="flex items-start gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3.5 rounded-2xl mb-6" role="alert">
                    <span class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center flex-shrink-0"><i class="fas fa-check text-xs"></i></span>
                    <div>
                        <p class="text-sm font-semibold">Berhasil</p>
                        <p class="text-xs text-emerald-600 mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 px-4 py-3.5 rounded-2xl mb-6" role="alert">
                    <span class="w-8 h-8 rounded-full bg-red-500 text-white flex items-center justify-center flex-shrink-0"><i class="fas fa-xmark text-xs"></i></span>
                    <div>
                        <p class="text-sm font-semibold">Terjadi Kesalahan</p>
                        <p class="text-xs text-red-600 mt-0.5">{{ session('error') }}</p>
                    </div>
                </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const sidebar      = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        }
        sidebarOverlay.addEventListener('click', toggleSidebar);

        // User dropdown
        const userMenuBtn = document.getElementById('userMenuBtn');
        const userMenu    = document.getElementById('userMenu');
        if (userMenuBtn) {
            userMenuBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                userMenu.classList.toggle('hidden');
            });
            document.addEventListener('click', function () {
                if (!userMenu.classList.contains('hidden')) userMenu.classList.add('hidden');
            });
        }
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
