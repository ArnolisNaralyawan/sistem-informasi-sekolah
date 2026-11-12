<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $dokumentasi = Dokumentasi::with('files')
            ->withCount('files')
            ->orderBy('tanggal_kegiatan', 'desc')
            ->paginate(12);

        return view('gallery.index', compact('dokumentasi'));
    }

    /**
     * Tampilkan detail satu dokumentasi kegiatan beserta seluruh fotonya.
     */
    public function show(Dokumentasi $dokumentasi)
    {
        $dokumentasi->load('files', 'user');

        // Dokumentasi lain untuk rekomendasi di halaman detail
        $lainnya = Dokumentasi::with('files')
            ->withCount('files')
            ->where('id', '!=', $dokumentasi->id)
            ->orderBy('tanggal_kegiatan', 'desc')
            ->limit(4)
            ->get();

        return view('gallery.show', compact('dokumentasi', 'lainnya'));
    }
}