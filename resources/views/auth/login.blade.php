<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SMAN 17 Maluku Tengah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'] },
                    colors: {
                        brand: {
                            50: '#eff6ff', 100: '#dbeafe', 500: '#3b82f6', 600: '#2563eb',
                            700: '#1d4ed8', 800: '#1e40af', 900: '#1e3a8a', 950: '#172554',
                        }
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
        * { font-family: 'Inter', sans-serif; -webkit-tap-highlight-color: transparent; }

        .panel-bg {
            background:
                radial-gradient(ellipse 70% 60% at 80% 10%, rgba(59,130,246,.4) 0%, transparent 60%),
                radial-gradient(ellipse 50% 50% at 5% 85%, rgba(79,70,229,.3) 0%, transparent 60%),
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
        .slide-in { animation: slideIn .8s cubic-bezier(.16,1,.3,1) both; }
        @keyframes slideIn {
            from { transform: translateY(28px); opacity: 0; }
            to   { transform: translateY(0); opacity: 1; }
        }
        @media (prefers-reduced-motion: reduce) { .slide-in { animation: none; } }

        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus {
            -webkit-text-fill-color: #fff;
            -webkit-box-shadow: 0 0 0 1000px rgba(255,255,255,.08) inset;
            transition: background-color 5000s ease-in-out 0s;
        }

        /* Prevent zoom on iOS */
        input { font-size: 16px; }

        /* ================= DARK MODE ================= */
        .dark body { background-color: #0f172a; color: #e2e8f0; }
        .dark .bg-white { background-color: #1e293b; }
        .dark .bg-white\/95 { background-color: rgba(30, 41, 59, .95); }
        .dark .bg-slate-50 { background-color: #0f172a; }
        .dark .bg-slate-100 { background-color: #1e293b; }
        .dark .text-slate-900, .dark .text-slate-800 { color: #f1f5f9; }
        .dark .text-slate-700 { color: #e2e8f0; }
        .dark .text-slate-600, .dark .text-slate-500 { color: #94a3b8; }
        .dark .border-slate-100, .dark .border-slate-200 { border-color: #334155; }
        .dark .hover\:bg-slate-50:hover, .dark .hover\:bg-slate-100:hover { background-color: #334155; }
        .dark .text-blue-600, .dark .text-blue-700 { color: #60a5fa; }
        .dark .bg-blue-50 { background-color: rgba(59, 130, 246, .12); }
        .dark .bg-blue-100 { background-color: rgba(59, 130, 246, .18); }
        .dark .border-blue-100, .dark .border-blue-200 { border-color: rgba(59, 130, 246, .35); }
        .dark .bg-emerald-50 { background-color: rgba(16, 185, 129, .12); }
        .dark .text-emerald-600, .dark .text-emerald-700 { color: #6ee7b7; }
        .dark .bg-red-50 { background-color: rgba(239, 68, 68, .14); }
        .dark .text-red-600, .dark .text-red-700 { color: #fca5a5; }
    </style>
</head>
<body class="min-h-screen panel-bg relative overflow-x-hidden">
    <div class="absolute inset-0 bg-grid pointer-events-none"></div>

    <!-- Toggle dark mode -->
    <button id="themeToggle" class="fixed top-4 right-4 z-50 w-10 h-10 rounded-xl flex items-center justify-center text-white/80 hover:bg-white/10 transition-colors" aria-label="Ganti mode gelap/terang">
        <i class="fas fa-moon text-base dark:hidden"></i>
        <i class="fas fa-sun text-base hidden dark:inline-block"></i>
    </button>

    <div class="relative min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 py-10">
        <div class="w-full max-w-5xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-14 items-center">

                <!-- Kiri: Brand -->
                <div class="hidden lg:block text-white slide-in">
                    <div class="flex items-center gap-4 mb-10">
                        @if(\App\Models\Setting::get('logo'))
                        <!-- Logo asli: tampil mandiri tanpa kotak -->
                        <img src="{{ asset('storage/' . \App\Models\Setting::get('logo')) }}" alt="Logo {{ \App\Models\Setting::get('nama_singkat') }}"
                             class="w-16 h-16 object-contain flex-shrink-0 drop-shadow-lg">
                        @else
                        <!-- Fallback: kotak merah + ikon -->
                        <div class="school-badge w-16 h-16 rounded-2xl flex items-center justify-center shadow-xl flex-shrink-0">
                            <i class="fas fa-graduation-cap text-white text-2xl"></i>
                        </div>
                        @endif
                        <div class="leading-tight min-w-0">
                            <h1 class="text-3xl font-extrabold tracking-tight">{{ \App\Models\Setting::get('nama_singkat') }}</h1>
                            <p class="text-sm font-semibold tracking-widest text-blue-200 uppercase truncate max-w-xs">{{ \App\Models\Setting::get('motto') }}</p>
                        </div>
                    </div>

                    <h2 class="text-4xl xl:text-5xl font-extrabold leading-[1.1] tracking-tight mb-6">
                        Selamat Datang
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-sky-300 to-blue-200">Kembali!</span>
                    </h2>

                    <p class="text-lg text-blue-100/90 leading-relaxed mb-10 max-w-md">
                        Akses sistem informasi sekolah terintegrasi untuk proses belajar mengajar yang lebih baik.
                    </p>

                    <div class="space-y-4">
                        <div class="flex items-center gap-3.5 bg-white/5 border border-white/10 backdrop-blur-sm rounded-2xl px-5 py-4">
                            <span class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0"><i class="fas fa-bullhorn text-sky-300 text-sm"></i></span>
                            <p class="text-sm text-blue-100">Pengumuman berita & event terbaru sekolah</p>
                        </div>
                        <div class="flex items-center gap-3.5 bg-white/5 border border-white/10 backdrop-blur-sm rounded-2xl px-5 py-4">
                            <span class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0"><i class="fas fa-images text-emerald-300 text-sm"></i></span>
                            <p class="text-sm text-blue-100">Galeri dokumentasi kegiatan sekolah</p>
                        </div>
                        <div class="flex items-center gap-3.5 bg-white/5 border border-white/10 backdrop-blur-sm rounded-2xl px-5 py-4">
                            <span class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0"><i class="fas fa-shield-halved text-violet-300 text-sm"></i></span>
                            <p class="text-sm text-blue-100">Kontrol data dan konten oleh administrator</p>
                        </div>
                    </div>
                </div>

                <!-- Kanan: Form -->
                <div class="slide-in" style="animation-delay:.1s">
                    <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl p-7 sm:p-9 w-full max-w-md mx-auto">
                        <!-- Logo mobile -->
                        <div class="lg:hidden text-center mb-7">
                            @if(\App\Models\Setting::get('logo'))
                            <img src="{{ asset('storage/' . \App\Models\Setting::get('logo')) }}" alt="Logo {{ \App\Models\Setting::get('nama_singkat') }}"
                                 class="w-14 h-14 object-contain mx-auto mb-3 drop-shadow-lg">
                            @else
                            <div class="school-badge w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                                <i class="fas fa-graduation-cap text-white text-xl"></i>
                            </div>
                            @endif
                            <h1 class="text-xl font-extrabold text-slate-900">{{ \App\Models\Setting::get('nama_singkat') }}</h1>
                            <p class="text-[11px] font-semibold tracking-widest text-slate-500 uppercase truncate max-w-[260px] mx-auto">{{ \App\Models\Setting::get('motto') }}</p>
                        </div>

                        <div class="text-center mb-7">
                            <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight mb-1.5">Masuk ke Sistem</h3>
                            <p class="text-sm text-slate-500">Silakan masukkan email dan password Anda</p>
                        </div>

                        <form class="space-y-4" method="POST" action="{{ route('login') }}" id="loginForm">
                            @csrf

                            <!-- Error messages -->
                            @if($errors->any())
                            <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 p-4 rounded-2xl" role="alert">
                                <span class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center flex-shrink-0"><i class="fas fa-triangle-exclamation text-xs"></i></span>
                                <div>
                                    <p class="text-sm font-semibold">Gagal masuk</p>
                                    <p class="text-xs text-red-600 mt-0.5">Email atau password yang Anda masukkan salah.</p>
                                </div>
                            </div>
                            @endif

                            @if(session('reset_success'))
                            <div class="flex items-start gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-2xl mb-4" role="alert">
                                <span class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0"><i class="fas fa-circle-check text-xs"></i></span>
                                <p class="text-sm">{{ session('reset_success') }}</p>
                            </div>
                            @endif

                            <!-- Email -->
                            <div class="space-y-1.5">
                                <label for="email" class="block text-sm font-semibold text-slate-700">Email</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><i class="far fa-envelope text-sm"></i></span>
                                    <input
                                        id="email"
                                        name="email"
                                        type="email"
                                        required
                                        class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300"
                                        placeholder="email@example.com"
                                        value="{{ old('email') }}"
                                        autocomplete="email"
                                    >
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="space-y-1.5">
                                <label for="password" class="block text-sm font-semibold text-slate-700">Password</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><i class="fas fa-lock text-sm"></i></span>
                                    <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        required
                                        class="w-full pl-11 pr-12 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300"
                                        placeholder="Masukkan password"
                                        autocomplete="current-password"
                                    >
                                    <button type="button" id="togglePassword"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-colors"
                                        aria-label="Tampilkan password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Remember -->
                            <div class="flex items-center justify-between">
                                <label class="flex items-center gap-2.5 cursor-pointer select-none">
                                    <input type="checkbox" name="remember"
                                        class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 focus:ring-offset-0">
                                    <span class="text-sm text-slate-600">Ingat saya</span>
                                </label>
                                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium hover:underline">Lupa password?</a>
                            </div>

                            <!-- Submit -->
                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-bold shadow-lg shadow-blue-600/25 hover:shadow-blue-600/40 hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed disabled:hover:translate-y-0"
                                id="submitBtn"
                            >
                                <i class="fas fa-right-to-bracket"></i> Masuk ke Sistem
                            </button>
                        </form>

                        <div class="mt-7 pt-5 border-t border-slate-100 text-center">
                            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-blue-700 text-sm font-medium transition-colors group">
                                <i class="fas fa-arrow-left group-hover:translate-x-0.5 transition-transform"></i> Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loginForm = document.getElementById('loginForm');
            const submitBtn = document.getElementById('submitBtn');
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            // Toggle password visibility
            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.innerHTML = type === 'password'
                    ? '<i class="fas fa-eye"></i>'
                    : '<i class="fas fa-eye-slash"></i>';
            });

            // Loading state saat submit
            loginForm.addEventListener('submit', function () {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            });

            // Fokus otomatis ke email di perangkat kecil
            if (window.innerWidth < 1024) {
                setTimeout(() => document.getElementById('email').focus(), 400);
            }
        });

        // Cegah resubmit saat refresh
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
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
