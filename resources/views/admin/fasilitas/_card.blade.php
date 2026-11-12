<div class="bg-white rounded-2xl shadow-sm border {{ $f->is_aktif ? 'border-gray-100' : 'border-gray-200 opacity-70' }} p-5 flex flex-col">
    <div class="flex items-start gap-4">
        <div class="w-11 h-11 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0">
            <i class="fas {{ $f->ikon }} text-lg"></i>
        </div>
        <div class="flex-1 min-w-0">
            <div class="flex items-center gap-2 flex-wrap">
                <h3 class="font-bold text-gray-900">{{ $f->nama }}</h3>
                @if(! $f->is_aktif)
                <span class="text-[10px] font-bold bg-gray-200 text-gray-600 px-2 py-0.5 rounded-full">Nonaktif</span>
                @endif
            </div>
            <p class="text-xs text-gray-400 mt-1 font-mono">fas {{ $f->ikon }} • urutan {{ $f->urutan }}</p>
        </div>
    </div>

    @if($f->deskripsi)
    <p class="text-sm text-gray-600 mt-3 line-clamp-2">{{ $f->deskripsi }}</p>
    @endif

    <div class="flex items-center gap-2 mt-4 pt-4 border-t border-gray-100">
        <a href="{{ route('admin.fasilitas.edit', $f->id) }}"
           class="flex-1 bg-blue-50 text-blue-700 text-center py-2 rounded-lg text-sm font-medium hover:bg-blue-100 transition-colors">
            Edit
        </a>
        <form action="{{ route('admin.fasilitas.destroy', $f->id) }}" method="POST" onsubmit="return confirm('Hapus fasilitas {{ $f->nama }}?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-50 text-red-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-100 transition-colors">
                Hapus
            </button>
        </form>
    </div>
</div>
