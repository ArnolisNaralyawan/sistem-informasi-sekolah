<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    // TAMBAHKAN INI
    protected $table = 'pesan';

    protected $fillable = [
        'nama',
        'email',
        'subjek',
        'pesan',
        'status',
        'tipe'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Scope untuk pesan belum dibaca
     */
    public function scopeBelumDibaca($query)
    {
        return $query->where('status', 'unread');
    }

    /**
     * Scope untuk pesan masuk
     */
    public function scopePesanMasuk($query)
    {
        return $query->where('tipe', 'masuk');
    }

    /**
     * Mark as read
     */
    public function markAsRead()
    {
        $this->update(['status' => 'read']);
    }
}