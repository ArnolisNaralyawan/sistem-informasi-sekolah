@extends('layouts.app')

@section('title', 'Pengaturan Website')

@section('content')
<div class="max-w-4xl">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Pengaturan Website</h1>
        <p class="text-gray-600 mt-2">Atur identitas dan kontak sekolah yang tampil di landing page dan galeri</p>
    </div>

    <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Identitas -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-2">
                <i class="fas fa-school text-blue-600"></i> Identitas Sekolah
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Sekolah <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_sekolah" value="{{ old('nama_sekolah', $setting->nama_sekolah) }}" required
                           class="form-input {{ $errors->has('nama_sekolah') ? 'border-red-400' : '' }}">
                    @error('nama_sekolah') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Singkat <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_singkat" value="{{ old('nama_singkat', $setting->nama_singkat) }}" required
                           class="form-input {{ $errors->has('nama_singkat') ? 'border-red-400' : '' }}">
                    @error('nama_singkat') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Motto</label>
                    <input type="text" name="motto" value="{{ old('motto', $setting->motto) }}"
                           placeholder="Contoh: MALUKU TENGAH"
                           class="form-input {{ $errors->has('motto') ? 'border-red-400' : '' }}">
                    @error('motto') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Logo -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Logo Sekolah</label>
                    <div class="flex items-center gap-5 flex-wrap">
                        <div class="w-20 h-20 rounded-2xl school-badge flex items-center justify-center flex-shrink-0 overflow-hidden">
                            @if($setting->logo)
                            <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo saat ini" class="w-12 h-12 object-contain">
                            @else
                            <i class="fas fa-graduation-cap text-white text-xl"></i>
                            @endif
                        </div>
                        <div class="flex-1 min-w-48">
                            <input type="file" name="logo" accept="image/png,image/jpeg"
                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                            <p class="text-xs text-gray-500 mt-1.5">Format JPG/PNG, maks 2 MB. Kosongkan untuk mempertahankan logo saat ini.</p>
                        </div>
                    </div>
                    @error('logo') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Kontak -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-2">
                <i class="fas fa-phone text-blue-600"></i> Kontak & Sosial Media
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Alamat <span class="text-red-500">*</span></label>
                    <textarea name="alamat" rows="2" required
                              class="form-input {{ $errors->has('alamat') ? 'border-red-400' : '' }}">{{ old('alamat', $setting->alamat) }}</textarea>
                    @error('alamat') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Telepon <span class="text-red-500">*</span></label>
                    <input type="text" name="telepon" value="{{ old('telepon', $setting->telepon) }}" required
                           class="form-input {{ $errors->has('telepon') ? 'border-red-400' : '' }}">
                    @error('telepon') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $setting->email) }}" required
                           class="form-input {{ $errors->has('email') ? 'border-red-400' : '' }}">
                    @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Instagram</label>
                    <div class="flex items-center">
                        <span class="inline-flex items-center px-3 py-2.5 bg-gray-100 border border-r-0 border-gray-300 rounded-l-lg text-sm text-gray-500">@</span>
                        <input type="text" name="instagram" value="{{ old('instagram', $setting->instagram) }}"
                               placeholder="username_instagram"
                               class="form-input rounded-l-none {{ $errors->has('instagram') ? 'border-red-400' : '' }}">
                    </div>
                    @error('instagram') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Profil Sekolah -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-2">
                <i class="fas fa-user-tie text-blue-600"></i> Profil Sekolah
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Kepala Sekolah</label>
                    <input type="text" name="kepsek_nama" value="{{ old('kepsek_nama', $setting->kepsek_nama) }}"
                           placeholder="Nama Kepala Sekolah"
                           class="form-input {{ $errors->has('kepsek_nama') ? 'border-red-400' : '' }}">
                    @error('kepsek_nama') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Foto Kepala Sekolah</label>
                    <input type="file" name="kepsek_foto" accept="image/png,image/jpeg"
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                    <p class="text-xs text-gray-500 mt-1.5">JPG/PNG maks 2 MB. Kosongkan untuk mempertahankan foto saat ini.</p>
                    @error('kepsek_foto') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Visi</label>
                    <textarea name="visi" rows="3" class="form-input {{ $errors->has('visi') ? 'border-red-400' : '' }}">{{ old('visi', $setting->visi) }}</textarea>
                    @error('visi') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Misi</label>
                    <textarea name="misi" rows="6" class="form-input font-mono text-sm {{ $errors->has('misi') ? 'border-red-400' : '' }}"
                              placeholder="Satu misi per baris">{{ old('misi', $setting->misi) }}</textarea>
                    <p class="text-xs text-gray-500 mt-1.5">Setiap baris menjadi satu poin misi di landing page.</p>
                    @error('misi') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Statistik -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-2">
                <i class="fas fa-chart-simple text-blue-600"></i> Statistik Sekolah
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @foreach(['siswa' => 'Siswa', 'guru' => 'Guru', 'rombel' => 'Rombongan Belajar', 'kelulusan' => 'Tingkat Kelulusan'] as $k => $judulStat)
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3">{{ $judulStat }}</p>
                    <div class="flex gap-2">
                        <div class="flex-1">
                            <input type="text" name="stats[{{ $k }}][nilai]" value="{{ old('stats.'.$k.'.nilai', $setting->stats[$k]['nilai'] ?? '') }}"
                                   placeholder="Angka, contoh: 550"
                                   class="form-input {{ $errors->has('stats.'.$k.'.nilai') ? 'border-red-400' : '' }}">
                        </div>
                        <div class="w-20">
                            <input type="text" name="stats[{{ $k }}][suffix]" value="{{ old('stats.'.$k.'.suffix', $setting->stats[$k]['suffix'] ?? '') }}"
                                   placeholder="+ / %"
                                   class="form-input text-center">
                        </div>
                    </div>
                    <input type="text" name="stats[{{ $k }}][label]" value="{{ old('stats.'.$k.'.label', $setting->stats[$k]['label'] ?? '') }}"
                           placeholder="Keterangan, contoh: Siswa Aktif"
                           class="form-input mt-2 {{ $errors->has('stats.'.$k.'.label') ? 'border-red-400' : '' }}">
                </div>
                @endforeach
            </div>
        </div>
        <div class="flex items-center justify-end gap-3">
            <button type="submit" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-all duration-300 hover:shadow-lg">
                <i class="fas fa-floppy-disk"></i> Simpan Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection
