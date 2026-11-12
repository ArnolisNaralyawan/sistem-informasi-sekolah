<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Galeri Kegiatan') - {{ \App\Models\Setting::get('nama_sekolah') }}</title>
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

        .gradient-bg {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 55%, #2563eb 100%);
        }
        .gradient-text {
            background: linear-gradient(135deg, #1d4ed8 0%, #4f46e5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .school-badge {
            background: radial-gradient(circle at 30% 30%, #ef4444 0%, #b91c1c 100%);
        }

        .hover-lift { transition: transform .3s ease, box-shadow .3s ease; }
        .hover-lift:hover {
            transform: translateY(-6px);
            box-shadow: 0 24px 48px -16px rgb(15 23 42 / 0.18);
        }

        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }

        /* Scroll reveal */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity .7s ease, transform .7s ease;
        }
        .reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
        @media (prefers-reduced-motion: reduce) {
            .reveal { opacity: 1; transform: none; transition: none; }
        }

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
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">
    <!-- Navigation -->
    <nav id="navbar" class="fixed w-full z-50 transition-all duration-300 bg-white/85 backdrop-blur-md border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-18 py-3">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <div class="school-badge w-11 h-11 rounded-2xl flex items-center justify-center shadow-lg shadow-red-500/20 transition-transform duration-300 group-hover:scale-105">
                        @if(\App\Models\Setting::get('logo'))
                        <img src="{{ asset('storage/' . \App\Models\Setting::get('logo')) }}" alt="Logo {{ \App\Models\Setting::get('nama_singkat') }}" class="w-7 h-7 object-contain">
                        @else
                        <i class="fas fa-graduation-cap text-white text-lg"></i>
                        @endif
                    </div>
                    <div class="leading-tight">
                        <span class="block text-lg font-extrabold tracking-tight text-slate-900">{{ \App\Models\Setting::get('nama_singkat') }}</span>
                        <span class="block text-[11px] font-semibold tracking-widest text-red-600 uppercase">{{ \App\Models\Setting::get('motto') }}</span>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center gap-1">
                    {{--
                        Gunakan section 'nav' agar halaman lain (galeri) bisa
                        menambahkan link beranda secara konsisten.
                    --}}
                    <a href="{{ url('/#home') }}" class="px-4 py-2 rounded-xl text-sm font-medium text-slate-600 hover:text-blue-700 hover:bg-blue-50 transition-colors duration-200 flex items-center gap-2">
                        <i class="fas fa-home text-xs"></i>Beranda
                    </a>
                    <a href="{{ route('galeri') }}" class="px-4 py-2 rounded-xl text-sm font-medium text-slate-600 hover:text-blue-700 hover:bg-blue-50 transition-colors duration-200 flex items-center gap-2">
                        <i class="fas fa-images text-xs"></i>Galeri
                    </a>
                    <a href="{{ url('/#pengumuman') }}" class="px-4 py-2 rounded-xl text-sm font-medium text-slate-600 hover:text-blue-700 hover:bg-blue-50 transition-colors duration-200 flex items-center gap-2">
                        <i class="fas fa-bullhorn text-xs"></i>Pengumuman
                    </a>
                    <a href="{{ url('/#kontak') }}" class="px-4 py-2 rounded-xl text-sm font-medium text-slate-600 hover:text-blue-700 hover:bg-blue-50 transition-colors duration-200 flex items-center gap-2">
                        <i class="fas fa-phone text-xs"></i>Kontak
                    </a>
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
                <a href="{{ url('/#home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-700 font-medium hover:bg-blue-50 hover:text-blue-700 transition-colors">
                    <i class="fas fa-home w-5 text-center text-sm"></i>Beranda
                </a>
                <a href="{{ route('galeri') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-700 font-medium hover:bg-blue-50 hover:text-blue-700 transition-colors">
                    <i class="fas fa-images w-5 text-center text-sm"></i>Galeri
                </a>
                <a href="{{ url('/#pengumuman') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-700 font-medium hover:bg-blue-50 hover:text-blue-700 transition-colors">
                    <i class="fas fa-bullhorn w-5 text-center text-sm"></i>Pengumuman
                </a>
                <a href="{{ url('/#kontak') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-700 font-medium hover:bg-blue-50 hover:text-blue-700 transition-colors">
                    <i class="fas fa-phone w-5 text-center text-sm"></i>Kontak
                </a>
                <div class="pt-2 border-t border-slate-100 sm:hidden">
                    <a href="{{ route('login') }}" class="mt-2 flex items-center justify-center gap-2 bg-blue-600 text-white px-4 py-3 rounded-xl font-semibold">
                        <i class="fas fa-right-to-bracket"></i>Masuk Sistem
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page content -->
    <main class="pt-24 pb-16 min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-950 text-white relative overflow-hidden">
        <div class="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-blue-500/60 to-transparent"></div>
        <div class="absolute -top-24 -right-24 w-72 h-72 bg-blue-600/10 rounded-full blur-3xl"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-14 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-10">
                <!-- Brand -->
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="school-badge w-11 h-11 rounded-2xl flex items-center justify-center shadow-lg">
                            @if(\App\Models\Setting::get('logo'))
                            <img src="{{ asset('storage/' . \App\Models\Setting::get('logo')) }}" alt="Logo {{ \App\Models\Setting::get('nama_singkat') }}" class="w-7 h-7 object-contain">
                            @else
                            <i class="fas fa-graduation-cap text-white"></i>
                            @endif
                        </div>
                        <div class="leading-tight">
                            <span class="block text-lg font-extrabold">{{ \App\Models\Setting::get('nama_singkat') }}</span>
                            <span class="block text-[11px] font-semibold tracking-widest text-blue-300 uppercase">{{ \App\Models\Setting::get('motto') }}</span>
                        </div>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Berkomitmen mencerdaskan kehidupan bangsa melalui pendidikan berkualitas.
                    </p>
                </div>

                <!-- Quick links -->
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-widest text-slate-300 mb-4">Tautan</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ url('/#home') }}" class="text-slate-400 hover:text-white transition flex items-center gap-2 group"><i class="fas fa-chevron-right text-[10px] text-blue-500 group-hover:translate-x-0.5 transition-transform"></i>Beranda</a></li>
                        <li><a href="{{ route('galeri') }}" class="text-slate-400 hover:text-white transition flex items-center gap-2 group"><i class="fas fa-chevron-right text-[10px] text-blue-500 group-hover:translate-x-0.5 transition-transform"></i>Galeri Kegiatan</a></li>
                        <li><a href="{{ url('/#pengumuman') }}" class="text-slate-400 hover:text-white transition flex items-center gap-2 group"><i class="fas fa-chevron-right text-[10px] text-blue-500 group-hover:translate-x-0.5 transition-transform"></i>Pengumuman</a></li>
                        <li><a href="{{ url('/#kontak') }}" class="text-slate-400 hover:text-white transition flex items-center gap-2 group"><i class="fas fa-chevron-right text-[10px] text-blue-500 group-hover:translate-x-0.5 transition-transform"></i>Kontak</a></li>
                    </ul>
                </div>

                <!-- Contact + social -->
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-widest text-slate-300 mb-4">Terhubung</h4>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li class="flex items-start gap-3"><i class="fas fa-location-dot text-blue-500 mt-1"></i><span>{{ \App\Models\Setting::get('alamat') }}</span></li>
                        <li class="flex items-center gap-3"><i class="fas fa-phone text-blue-500"></i><span>{{ \App\Models\Setting::get('telepon') }}</span></li>
                    </ul>
                    <div class="flex gap-3 mt-5">
                        <a href="https://www.tiktok.com/@sman17malteng" target="_blank" rel="noopener" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-300 hover:bg-blue-600 hover:text-white transition-all duration-300 hover:-translate-y-0.5" aria-label="TikTok">
                            <i class="fab fa-tiktok"></i>
                        </a>
                        <a href="https://wa.me/6282120793392" target="_blank" rel="noopener" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-300 hover:bg-green-600 hover:text-white transition-all duration-300 hover:-translate-y-0.5" aria-label="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        @if(\App\Models\Setting::get('instagram'))
                        <a href="https://www.instagram.com/{{ \App\Models\Setting::get('instagram') }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-300 hover:bg-pink-600 hover:text-white transition-all duration-300 hover:-translate-y-0.5" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-800 pt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-slate-500 text-xs text-center sm:text-left">
                    &copy; {{ date('Y') }} {{ \App\Models\Setting::get('nama_sekolah') }}. Hak cipta dilindungi.
                </p>
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-white bg-slate-800/60 hover:bg-slate-700 px-4 py-2 rounded-xl transition-all">
                    <i class="fas fa-right-to-bracket"></i> Masuk Sistem
                </a>
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

    @yield('scripts')
</body>
</html>
