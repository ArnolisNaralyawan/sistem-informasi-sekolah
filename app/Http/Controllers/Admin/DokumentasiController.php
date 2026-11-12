<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumentasi;
use App\Models\DokumentasiFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DokumentasiController extends Controller
{
    public function index()
    {
        $dokumentasi = Dokumentasi::withCount('files')
            ->with('user')
            ->orderBy('tanggal_kegiatan', 'desc')
            ->get();

        return view('admin.dokumentasi.index', compact('dokumentasi'));
    }

    public function create()
    {
        return view('admin.dokumentasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_kegiatan' => 'required|date',
            'kategori' => 'required|in:Upacara,Porseni,Study Tour,Pentas Seni,Lainnya',
            'files' => 'required|array',
            'files.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            DB::transaction(function () use ($request) {
                $dokumentasi = Dokumentasi::create([
                    'judul_kegiatan' => $request->judul_kegiatan,
                    'deskripsi' => $request->deskripsi,
                    'tanggal_kegiatan' => $request->tanggal_kegiatan,
                    'kategori' => $request->kategori,
                    'created_by' => auth()->id(),
                ]);

                if ($request->hasFile('files')) {
                    foreach ($request->file('files') as $file) {
                        $path = $file->store('dokumentasi', 'public');
                        
                        DokumentasiFile::create([
                            'dokumentasi_id' => $dokumentasi->id,
                            'nama_file' => $file->getClientOriginalName(),
                            'path_file' => $path,
                        ]);
                    }
                }
            });

            return redirect()->route('admin.dokumentasi.index')
                ->with('success', 'Dokumentasi berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Dokumentasi $dokumentasi)
    {
        $dokumentasi->load('files');
        return view('admin.dokumentasi.show', compact('dokumentasi'));
    }

    public function edit($id)
{
    try {
        $dokumentasi = Dokumentasi::with('files')->findOrFail($id);
        return view('admin.dokumentasi.edit', compact('dokumentasi'));
    } catch (\Exception $e) {
        return redirect()->route('admin.dokumentasi.index')
            ->with('error', 'Dokumentasi tidak ditemukan!');
    }
}

public function update(Request $request, $id)
{
    $request->validate([
        'judul_kegiatan' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'tanggal_kegiatan' => 'required|date',
        'kategori' => 'required|in:Upacara,Porseni,Study Tour,Pentas Seni,Lainnya',
        'files' => 'sometimes|array',
        'files.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    try {
        DB::transaction(function () use ($request, $id) {
            $dokumentasi = Dokumentasi::findOrFail($id);
            
            // Update data dasar
            $dokumentasi->update([
                'judul_kegiatan' => $request->judul_kegiatan,
                'deskripsi' => $request->deskripsi,
                'tanggal_kegiatan' => $request->tanggal_kegiatan,
                'kategori' => $request->kategori,
            ]);

            // Debug: Cek apakah ada file yang diupload
            \Log::info('Files uploaded:', $request->hasFile('files') ? ['count' => count($request->file('files'))] : ['no files']);

            // Tambah file baru jika ada
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    // Validasi file individual
                    if ($file->isValid()) {
                        $path = $file->store('dokumentasi', 'public');
                        
                        DokumentasiFile::create([
                            'dokumentasi_id' => $dokumentasi->id,
                            'nama_file' => $file->getClientOriginalName(),
                            'path_file' => $path,
                        ]);
                        
                        \Log::info('File stored:', ['path' => $path]);
                    }
                }
            }
        });

        return redirect()->route('admin.dokumentasi.show', $id)
            ->with('success', 'Dokumentasi berhasil diperbarui!');

    } catch (\Exception $e) {
        \Log::error('Update error:', ['error' => $e->getMessage()]);
        return redirect()->back()
            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
            ->withInput();
    }
}

    public function destroy(Dokumentasi $dokumentasi)
    {
        try {
            DB::transaction(function () use ($dokumentasi) {
                // Hapus file fisik
                foreach ($dokumentasi->files as $file) {
                    Storage::disk('public')->delete($file->path_file);
                }
                
                $dokumentasi->delete();
            });

            return redirect()->route('admin.dokumentasi.index')
                ->with('success', 'Dokumentasi berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function getGalleryData()
    {
        $dokumentasi = Dokumentasi::with('files')
            ->withCount('files')
            ->orderBy('tanggal_kegiatan', 'desc')
            ->take(6)
            ->get();

        return $dokumentasi;
    }
}

