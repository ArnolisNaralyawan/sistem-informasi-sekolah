<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'isi',
        'gambar',
        'tipe',
        'tanggal_mulai',
        'tanggal_selesai',
        'status'
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'status' => 'boolean'
    ];

    /**
     * Scope untuk pengumuman aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status', true)
                    ->where('tanggal_mulai', '<=', now())
                    ->where(function($q) {
                        $q->where('tanggal_selesai', '>=', now())
                          ->orWhereNull('tanggal_selesai');
                    });
    }
}