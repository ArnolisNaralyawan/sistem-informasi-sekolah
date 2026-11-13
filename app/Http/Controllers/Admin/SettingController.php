<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Kunci statistik statis beserta ikonnya (kunci tetap supaya feather penampilan stabil).
     */
    private const STAT_KEYS = ['siswa', 'guru', 'rombel', 'kelulusan'];

    public function edit()
    {
        $setting = Setting::get();
        return view('admin.setting.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::get();

        $validated = $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'nama_singkat' => 'required|string|max:255',
            'motto' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'hero_bg' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'alamat' => 'required|string|max:1000',
            'telepon' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'instagram' => 'nullable|string|max:255',

            // Profil & statistik
            'kepsek_nama' => 'nullable|string|max:255',
            'kepsek_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'visi' => 'nullable|string|max:2000',
            'misi' => 'nullable|string|max:5000',
            'stats' => 'nullable|array',
            'stats.*.nilai' => 'nullable|string|max:20',
            'stats.*.suffix' => 'nullable|string|max:5',
            'stats.*.label' => 'nullable|string|max:100',
        ]);

        // Logo
        if ($request->hasFile('logo')) {
            if ($setting->logo && !str_starts_with($setting->logo, 'photos/logosma.png')) {
                Storage::delete('public/' . $setting->logo);
            }
            $validated['logo'] = $request->file('logo')->store('settings', 'public');
        }

        // Gambar latar belakang beranda
        if ($request->hasFile('hero_bg')) {
            if ($setting->hero_bg) {
                Storage::delete('public/' . $setting->hero_bg);
            }
            $validated['hero_bg'] = $request->file('hero_bg')->store('settings', 'public');
        }

        // Foto kepala sekolah
        if ($request->hasFile('kepsek_foto')) {
            if ($setting->kepsek_foto) {
                Storage::delete('public/' . $setting->kepsek_foto);
            }
            $validated['kepsek_foto'] = $request->file('kepsek_foto')->store('settings', 'public');
        }

        // Statistik: isi dari data lama jika field kosong supaya tidak hilang
        $statsBaru = [];
        $statsLama = $setting->stats ?? [];
        foreach (self::STAT_KEYS as $kunci) {
            $statsBaru[$kunci] = [
                'nilai' => trim($validated['stats'][$kunci]['nilai'] ?? '') !== '' ? $validated['stats'][$kunci]['nilai'] : ($statsLama[$kunci]['nilai'] ?? ''),
                'suffix' => trim($validated['stats'][$kunci]['suffix'] ?? '') !== '' ? $validated['stats'][$kunci]['suffix'] : ($statsLama[$kunci]['suffix'] ?? ''),
                'label' => trim($validated['stats'][$kunci]['label'] ?? '') !== '' ? $validated['stats'][$kunci]['label'] : ($statsLama[$kunci]['label'] ?? ''),
                'ikon' => $statsLama[$kunci]['ikon'] ?? 'users',
            ];
        }
        unset($validated['stats']);
        $validated['stats'] = $statsBaru;

        $setting->update($validated);

        return back()->with('success', 'Pengaturan website berhasil disimpan.');
    }
}
