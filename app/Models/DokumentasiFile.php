<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DokumentasiFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'dokumentasi_id',
        'nama_file',
        'path_file',
        'urutan'
    ];

    public function dokumentasi(): BelongsTo
    {
        return $this->belongsTo(Dokumentasi::class);
    }
}