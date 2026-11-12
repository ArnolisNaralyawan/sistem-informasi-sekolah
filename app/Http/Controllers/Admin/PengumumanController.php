<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pengumuman::orderBy('created_at', 'desc');
        
        // Filter by tipe
        if ($request->has('tipe') && $request->tipe) {
            $query->where('tipe', $request->tipe);
        }
        
        // Filter by status
        if ($request->has('status') && $request->status) {
            $status = $request->status == 'active' ? 1 : 0;
            $query->where('status', $status);
        }
        
        $pengumumen = $query->paginate(10);
        
        return view('admin.pengumuman.index', compact('pengumumen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tipe' => 'required|in:pengumuman,berita,event',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:active,inactive'
        ]);

        // DEBUG: Log data sebelum disimpan
        Log::info('=== STORE PENGUMUMAN ===');
        Log::info('Data validated:', $validated);

        // Pastikan konversi status benar
        $validated['status'] = ($validated['status'] == 'active') ? 1 : 0;
        
        Log::info('Status setelah konversi: ' . $validated['status']);

        // Handle file upload dengan path yang benar
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('pengumuman', 'public');
            $validated['gambar'] = $gambarPath;
            Log::info('Gambar disimpan di: ' . $gambarPath);
        }

        try {
            $pengumuman = Pengumuman::create($validated);
            
            // DEBUG: Log data setelah disimpan
            Log::info('Pengumuman berhasil dibuat - ID: ' . $pengumuman->id);
            Log::info('Data tersimpan di database:', [
                'id' => $pengumuman->id,
                'judul' => $pengumuman->judul,
                'status' => $pengumuman->status,
                'tipe' => $pengumuman->tipe,
                'tanggal_mulai' => $pengumuman->tanggal_mulai,
                'gambar' => $pengumuman->gambar
            ]);

            return redirect()->route('admin.pengumuman.index')
                ->with('success', 'Pengumuman berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            Log::error('Error membuat pengumuman: ' . $e->getMessage());
            return back()->with('error', 'Gagal membuat pengumuman: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('admin.pengumuman.show', compact('pengumuman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        
        // Konversi status untuk form
        $pengumuman->status = $pengumuman->status == 1 ? 'active' : 'inactive';
        
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tipe' => 'required|in:pengumuman,berita,event',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:active,inactive'
        ]);

        // Konversi status string ke integer
        $validated['status'] = $validated['status'] == 'active' ? 1 : 0;

        // Handle file upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($pengumuman->gambar) {
                Storage::disk('public')->delete($pengumuman->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('pengumuman', 'public');
        }

        $pengumuman->update($validated);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        
        // Delete image if exists
        if ($pengumuman->gambar) {
            Storage::disk('public')->delete($pengumuman->gambar);
        }

        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus!');
    }
}