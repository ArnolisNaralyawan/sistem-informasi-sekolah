<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $table = 'site_settings';

    protected $fillable = [
        'nama_sekolah',
        'nama_singkat',
        'motto',
        'logo',
        'alamat',
        'telepon',
        'email',
        'instagram',
        'kepsek_nama',
        'kepsek_foto',
        'visi',
        'misi',
        'stats',
    ];

    protected $casts = [
        'stats' => 'array',
    ];

    /**
     * Ambil nilai pengaturan dari baris pertama (id=1) dengan cache.
     * Cache otomatis dibersihkan setiap pengaturan disimpan.
     */
    public static function get(?string $key = null)
    {
        $settings = Cache::rememberForever('site_settings', fn () => self::find(1));

        if ($key === null) {
            return $settings;
        }

        return $settings?->{$key};
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('site_settings'));
        static::deleted(fn () => Cache::forget('site_settings'));
    }
}
