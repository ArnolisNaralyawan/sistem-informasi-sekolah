@extends('layouts.app')

@section('title', 'Edit Pengumuman')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div>
            <nav class="flex items-center gap-2 text-sm text-slate-400 mb-1.5">
                <a href="{{ route('admin.pengumuman.index') }}" class="hover:text-blue-700 transition-colors">Pengumuman</a>
                <i class="fas fa-chevron-right text-[9px]"></i>
                <span class="text-slate-700 font-medium">Edit</span>
            </nav>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">Edit Pengumuman</h1>
            <p class="text-slate-500 mt-1.5">Ubah informasi pengumuman, berita, atau event</p>
        </div>
        <a href="{{ route('admin.pengumuman.index') }}" class="btn-secondary self-start">
            <i class="fas fa-arrow-left text-xs"></i> Kembali
        </a>
    </div>

    <!-- Error Validasi -->
    @if($errors->any())
    <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 p-5 rounded-2xl" role="alert">
        <span class="w-9 h-9 rounded-full bg-red-100 text-red-600 flex items-center justify-center flex-shrink-0"><i class="fas fa-triangle-exclamation"></i></span>
        <div>
            <h3 class="font-bold text-sm mb-1">Form belum valid:</h3>
            <ul class="list-disc list-inside text-sm text-red-600 space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <!-- Form -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-soft p-7">
        <form action="{{ route('admin.pengumuman.update', $pengumuman->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8 gap-y-6">
                <!-- Kolom kiri -->
                <div class="space-y-6">
                    <div>
                        <label for="judul" class="block text-sm font-semibold text-slate-700 mb-2">Judul <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $pengumuman->judul) }}"
                               class="form-input @error('judul') border-red-400 bg-red-50/40 @enderror"
                               placeholder="Masukkan judul pengumuman" required>
                        @error('judul')
                            <p class="mt-1.5 text-xs text-red-600"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tipe" class="block text-sm font-semibold text-slate-700 mb-2">Tipe <span class="text-red-500">*</span></label>
                        <select name="tipe" id="tipe" class="form-input @error('tipe') border-red-400 bg-red-50/40 @enderror" required>
                            <option value="">Pilih Tipe</option>
                            <option value="pengumuman" {{ old('tipe', $pengumuman->tipe) == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                            <option value="berita" {{ old('tipe', $pengumuman->tipe) == 'berita' ? 'selected' : '' }}>Berita</option>
                            <option value="event" {{ old('tipe', $pengumuman->tipe) == 'event' ? 'selected' : '' }}>Event</option>
                        </select>
                        @error('tipe')
                            <p class="mt-1.5 text-xs text-red-600"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="tanggal_mulai" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Mulai <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                                   value="{{ old('tanggal_mulai', $pengumuman->tanggal_mulai ? \Carbon\Carbon::parse($pengumuman->tanggal_mulai)->format('Y-m-d') : '') }}"
                                   class="form-input @error('tanggal_mulai') border-red-400 bg-red-50/40 @enderror" required>
                            @error('tanggal_mulai')
                                <p class="mt-1.5 text-xs text-red-600"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="tanggal_selesai" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                                   value="{{ old('tanggal_selesai', $pengumuman->tanggal_selesai ? \Carbon\Carbon::parse($pengumuman->tanggal_selesai)->format('Y-m-d') : '') }}"
                                   class="form-input @error('tanggal_selesai') border-red-400 bg-red-50/40 @enderror">
                            @error('tanggal_selesai')
                                <p class="mt-1.5 text-xs text-red-600"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Kolom kanan -->
                <div class="space-y-6 flex flex-col">
                    <div>
                        <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Status <span class="text-red-500">*</span></label>
                        <select name="status" id="status" class="form-input" required>
                            <option value="active" {{ old('status', $pengumuman->status) == 'active' ? 'selected' : '' }}>Aktif — tampil di website</option>
                            <option value="inactive" {{ old('status', $pengumuman->status) == 'inactive' ? 'selected' : '' }}>Nonaktif — disimpan sebagai draft</option>
                        </select>
                        @error('status')
                            <p class="mt-1.5 text-xs text-red-600"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="gambar" class="block text-sm font-semibold text-slate-700 mb-2">Gambar</label>

                        @if($pengumuman->gambar)
                        <div class="mb-5 flex items-center gap-4 p-4 bg-slate-50 border border-slate-100 rounded-2xl">
                            <img src="{{ Storage::url($pengumuman->gambar) }}" alt="{{ $pengumuman->judul }}" class="w-20 h-20 object-cover rounded-xl border border-slate-200">
                            <div>
                                <p class="text-sm font-semibold text-slate-700">Gambar saat ini</p>
                                <p class="text-xs text-slate-400 mt-0.5">Unggah gambar baru untuk mengganti</p>
                            </div>
                        </div>
                        @endif

                        <label class="block border-2 border-dashed border-slate-200 hover:border-blue-400 hover:bg-blue-50/40 rounded-2xl p-6 text-center cursor-pointer transition-colors group">
                            <input type="file" name="gambar" id="gambar" accept="image/*" class="hidden" onchange="previewImage(this)" id-upload="{{ rand() }}">
                            <span class="w-12 h-12 mx-auto rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center mb-3 group-hover:scale-105 transition-transform"><i class="fas fa-cloud-arrow-up text-lg"></i></span>
                            <span class="block text-sm font-semibold text-slate-700">Klik untuk pilih gambar baru</span>
                            <span class="block text-xs text-slate-400 mt-1">Kosongkan jika tidak ingin mengganti</span>
                        </label>

                        <div id="imagePreview" class="mt-3 hidden">
                            <p class="text-xs font-semibold text-slate-500 mb-1.5">Preview gambar baru:</p>
                            <img id="preview" class="w-28 h-28 object-cover rounded-xl border border-slate-200">
                        </div>

                        @error('gambar')
                            <p class="mt-1.5 text-xs text-red-600"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Isi -->
            <div>
                <label for="isi" class="block text-sm font-semibold text-slate-700 mb-2">Isi Pengumuman <span class="text-red-500">*</span></label>
                <textarea name="isi" id="isi" rows="13"
                          class="form-input @error('isi') border-red-400 bg-red-50/40 @enderror resize-y"
                          placeholder="Tulis isi pengumuman di sini..." required>{{ old('isi', $pengumuman->isi) }}</textarea>
                @error('isi')
                    <p class="mt-1.5 text-xs text-red-600"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <!-- Aksi -->
            <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('admin.pengumuman.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-floppy-disk text-xs"></i> Update Pengumuman
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const imagePreview = document.getElementById('imagePreview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            imagePreview.classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        imagePreview.classList.add('hidden');
    }
}
</script>
@endsection
