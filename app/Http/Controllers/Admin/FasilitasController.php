<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    /**
     * Ikon FontAwesome yang boleh dipilih admin.
     */
    public const IKONS = [
        'fa-microscope' => 'Mikroskop (Lab Sains)',
        'fa-laptop-code' => 'Laptop (Lab Komputer)',
        'fa-book-open' => 'Buku (Perpustakaan)',
        'fa-basketball-ball' => 'Bola (Olahraga)',
        'fa-utensils' => 'Piring (Kantin)',
        'fa-wifi' => 'WiFi',
        'fa-shield-halved' => 'Perisai (Keamanan)',
        'fa-school' => 'Gedung Sekolah',
        'fa-flask' => 'Tabung Reaksi',
        'fa-palette' => 'Palet (Seni)',
        'fa-music' => 'Musik',
        'fa-mosque' => 'Musholla',
        'fa-bus' => 'Bus (Transportasi)',
        'fa-leaf' => 'Daun (Taman)',
        'fa-camera' => 'Kamera',
        'fa-heartbeat' => 'UKS / Kesehatan',
        'fa-building-columns' => 'Aula',
        'fa-star' => 'Bintang (Prestasi)',
    ];

    public function index()
    {
        $fasilitas = Fasilitas::orderBy('urutan')->orderBy('id')->get();
        $ikons = self::IKONS;
        return view('admin.fasilitas.index', compact('fasilitas', 'ikons'));
    }

    public function create()
    {
        $ikons = self::IKONS;
        return view('admin.fasilitas.create', compact('ikons'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateFasilitas($request);
        Fasilitas::create($validated);

        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit(Fasilitas $fasilita)
    {
        $ikons = self::IKONS;
        return view('admin.fasilitas.edit', compact('fasilita', 'ikons'));
    }

    public function update(Request $request, Fasilitas $fasilita)
    {
        $validated = $this->validateFasilitas($request);
        $fasilita->update($validated);

        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Fasilitas $fasilita)
    {
        $fasilita->delete();
        return back()->with('success', 'Fasilitas berhasil dihapus.');
    }

    private function validateFasilitas(Request $request): array
    {
        $ikons = implode(',', array_keys(self::IKONS));

        return $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'poin' => 'nullable|string|max:2000',
            'ikon' => 'required|in:' . $ikons,
            'urutan' => 'nullable|integer|min:0|max:999',
            'is_aktif' => 'nullable|boolean',
        ]);
    }
}
