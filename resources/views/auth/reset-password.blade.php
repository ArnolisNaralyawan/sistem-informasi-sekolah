<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - {{ \App\Models\Setting::get('nama_singkat') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'] },
                }
            }
        }
    </script>
    <script>
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

        input { font-size: 16px; }

        .dark body { background-color: #0f172a; color: #e2e8f0; }
        .dark .bg-white { background-color: #1e293b; }
        .dark .bg-white\/95 { background-color: rgba(30, 41, 59, .95); }
        .dark .text-slate-900, .dark .text-slate-800 { color: #f1f5f9; }
        .dark .text-slate-700 { color: #e2e8f0; }
        .dark .text-slate-600, .dark .text-slate-500 { color: #94a3b8; }
        .dark .border-slate-100, .dark .border-slate-200 { border-color: #334155; }
        .dark .bg-slate-50 { background-color: #0f172a; }
    </style>
</head>
<body class="min-h-screen panel-bg relative overflow-x-hidden">
    <div class="absolute inset-0 bg-grid pointer-events-none"></div>

    <div class="relative min-h-screen flex items-center justify-center px-4 sm:px-6 py-10">
        <div class="w-full max-w-md slide-in">
            <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl p-7 sm:p-9">
                <!-- Logo -->
                <div class="text-center mb-7">
                    @if(\App\Models\Setting::get('logo'))
                    <img src="{{ asset('storage/' . \App\Models\Setting::get('logo')) }}" alt="Logo {{ \App\Models\Setting::get('nama_singkat') }}"
                         class="w-14 h-14 object-contain mx-auto mb-3 drop-shadow-lg">
                    @else
                    <div class="school-badge w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                        <i class="fas fa-graduation-cap text-white text-xl"></i>
                    </div>
                    @endif
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight mb-1.5">Password Baru</h1>
                    <p class="text-sm text-slate-500">Buat password baru untuk akun <span class="font-semibold text-slate-700">{{ $email }}</span></p>
                </div>

                <form class="space-y-4" method="POST" action="{{ route('password.update') }}">
                    @csrf

                    @if($errors->any())
                    <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 p-4 rounded-2xl" role="alert">
                        <span class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center flex-shrink-0"><i class="fas fa-triangle-exclamation text-xs"></i></span>
                        <p class="text-sm">{{ $errors->first() }}</p>
                    </div>
                    @endif

                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <!-- Password baru -->
                    <div class="space-y-1.5">
                        <label for="password" class="block text-sm font-semibold text-slate-700">Password Baru</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><i class="fas fa-lock text-sm"></i></span>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                required
                                minlength="8"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300"
                                placeholder="Minimal 8 karakter"
                                autocomplete="new-password"
                            >
                        </div>
                    </div>

                    <!-- Konfirmasi -->
                    <div class="space-y-1.5">
                        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700">Ulangi Password Baru</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><i class="fas fa-lock text-sm"></i></span>
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                required
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300"
                                placeholder="Ulangi password baru"
                                autocomplete="new-password"
                            >
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-bold shadow-lg shadow-blue-600/25 hover:shadow-blue-600/40 hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2"
                    >
                        <i class="fas fa-key"></i> Simpan Password Baru
                    </button>
                </form>

                <div class="mt-7 pt-5 border-t border-slate-100 text-center">
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-blue-700 text-sm font-medium transition-colors group">
                        <i class="fas fa-arrow-left group-hover:translate-x-0.5 transition-transform"></i> Kembali ke Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
