<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumentasi;
use App\Models\Pengumuman;
use App\Models\Pesan;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $stats = [
                'total_users' => User::count(),
                'total_pengumuman' => Pengumuman::count(),
                'total_dokumentasi' => Dokumentasi::count(),
                'total_pesan_baru' => Pesan::whereNull('read_at')->count(),
            ];

            return view('admin.dashboard', compact('stats'));
        } catch (\Exception $e) {
            // Fallback jika ada error
            $stats = [
                'total_users' => 0,
                'total_pengumuman' => 0,
                'total_dokumentasi' => 0,
                'total_pesan_baru' => 0,
            ];
            return view('admin.dashboard', compact('stats'));
        }
    }
}
