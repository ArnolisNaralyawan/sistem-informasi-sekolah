<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dokumentasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_kegiatan',
        'deskripsi',
        'tanggal_kegiatan',
        'kategori',
        'created_by'
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function files(): HasMany
    {
        return $this->hasMany(DokumentasiFile::class);
    }

    public function getJumlahFotoAttribute(): int
    {
        return $this->files()->count();
    }

    public function getFirstImageAttribute(): ?string
    {
        $firstFile = $this->files()->first();
        return $firstFile ? $firstFile->path_file : null;
    }
}