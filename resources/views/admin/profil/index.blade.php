@extends('layouts.app')

@section('title', 'Ganti Email dan Password')

@section('content')
<div class="max-w-2xl">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Ganti Email dan Password</h1>
        <p class="text-gray-600 mt-2">Perbarui password akun admin secara berkala untuk menjaga keamanan</p>
    </div>

    <!-- Info Akun (read-only) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
        <div class="flex items-center gap-4">
            @if(Auth::user()->photo)
            <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="{{ Auth::user()->name }}"
                 class="w-14 h-14 rounded-full object-cover ring-2 ring-blue-100">
            @else
            <span class="w-14 h-14 rounded-full bg-gradient-to-br from-blue-600 to-indigo-600 text-white text-xl font-bold flex items-center justify-center">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </span>
            @endif
            <div>
                <h2 class="font-bold text-gray-900">{{ Auth::user()->name }}</h2>
                <p class="text-sm text-gray-500">{{ Auth::user()->email }} · <span class="capitalize">{{ Auth::user()->role }}</span></p>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-2">
        <i class="fas fa-circle-check"></i> {{ session('success') }}
    </div>
    @endif
    <!-- Form Ganti Email -->
    <form action="{{ route('admin.profil.email') }}" method="POST" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
        @csrf
        @method('PUT')

        <h2 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-2">
            <i class="fas fa-envelope text-blue-600"></i> Email Baru
        </h2>

        <div class="space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email Baru <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                       class="form-input {{ $errors->has('email') ? 'border-red-400' : '' }}"
                       autocomplete="email">
                @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 mt-6">
            <button type="submit" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-all duration-300 hover:shadow-lg">
                <i class="fas fa-envelope"></i> Ganti Email
            </button>
        </div>
    </form>
    <!-- Form Ganti Password -->
    <form action="{{ route('admin.profil.password') }}" method="POST" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        @csrf
        @method('PUT')

        <h2 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-2">
            <i class="fas fa-lock text-blue-600"></i> Password Baru
        </h2>

        <div class="space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Password Saat Ini <span class="text-red-500">*</span></label>
                <input type="password" name="password_saat_ini" required
                       class="form-input {{ $errors->has('password_saat_ini') ? 'border-red-400' : '' }}"
                       autocomplete="current-password">
                @error('password_saat_ini') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Password Baru <span class="text-red-500">*</span></label>
                    <input type="password" name="password" required
                           class="form-input {{ $errors->has('password') ? 'border-red-400' : '' }}"
                           autocomplete="new-password">
                    <p class="text-xs text-gray-500 mt-1.5">Minimal 8 karakter.</p>
                    @error('password') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password Baru <span class="text-red-500">*</span></label>
                    <input type="password" name="password_confirmation" required
                           class="form-input"
                           autocomplete="new-password">
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 mt-6">
            <button type="submit" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-all duration-300 hover:shadow-lg">
                <i class="fas fa-key"></i> Ganti Password
            </button>
        </div>
    </form>
</div>
@endsection
