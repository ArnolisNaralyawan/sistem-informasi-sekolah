<form action="{{ isset($fasilita) ? route('admin.fasilitas.update', $fasilita->id) : route('admin.fasilitas.store') }}"
      method="POST"
      class="mt-6">
    @csrf
    @if(isset($fasilita)) @method('PUT') @endif
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-5">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Fasilitas <span class="text-red-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $fasilita->nama ?? '') }}" required class="form-input">
                @error('nama') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Ikon <span class="text-red-500">*</span></label>
                <select name="ikon" class="form-input" required>
                    @foreach($ikons as $ikonKey => $ikonLabel)
                    <option value="{{ $ikonKey }}" {{ old('ikon', $fasilita->ikon ?? 'fa-school') === $ikonKey ? 'selected' : '' }}>
                        {{ $ikonLabel }} ({{ $ikonKey }})
                    </option>
                    @endforeach
                </select>
                @error('ikon') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
            <textarea name="deskripsi" rows="2" class="form-input"
                      placeholder="Kosongkan jika hanya ingin kartu kecil (nama + ikon)">{{ old('deskripsi', $fasilita->deskripsi ?? '') }}</textarea>
            @error('deskripsi') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Poin Detail</label>
            <textarea name="poin" rows="4" class="form-input font-mono text-sm"
                      placeholder="Satu poin per baris, contoh:&#10;Laboratorium Fisika&#10;Laboratorium Kimia">{{ old('poin', $fasilita->poin ?? '') }}</textarea>
            <p class="text-xs text-gray-500 mt-1.5">Hanya tampil pada kartu besar (yang punya deskripsi). Satu baris = satu poin.</p>
            @error('poin') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Urutan</label>
                <input type="number" name="urutan" min="0" max="999" value="{{ old('urutan', $fasilita->urutan ?? 0) }}" class="form-input">
            </div>
            <div class="flex items-center">
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <input type="hidden" name="is_aktif" value="0">
                    <input type="checkbox" name="is_aktif" value="1" {{ old('is_aktif', $fasilita->is_aktif ?? true) ? 'checked' : '' }}
                           class="w-4.5 h-4.5 rounded text-blue-600 focus:ring-blue-500 cursor-pointer">
                    <span class="text-sm font-medium text-gray-700">Tampilkan di landing page</span>
                </label>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end gap-3 mt-6">
        <a href="{{ route('admin.fasilitas.index') }}" class="text-gray-600 hover:text-gray-800 text-sm font-medium">Batal</a>
        <button type="submit" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-all duration-300 hover:shadow-lg">
            <i class="fas fa-floppy-disk"></i> {{ isset($fasilita) ? 'Simpan Perubahan' : 'Tambah Fasilitas' }}
        </button>
    </div>
</form>
