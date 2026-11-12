<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Fasilitas extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
        'poin',
        'ikon',
        'urutan',
        'is_aktif',
    ];

    protected $casts = [
        'is_aktif' => 'boolean',
    ];

    /**
     * Ambil semua fasilitas aktif (urut) dengan cache.
     */
    public static function aktif()
    {
        return Cache::rememberForever('fasilitas_aktif', fn () => self::where('is_aktif', true)
            ->orderBy('urutan')
            ->orderBy('id')
            ->get());
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('fasilitas_aktif'));
        static::deleted(fn () => Cache::forget('fasilitas_aktif'));
    }
}
