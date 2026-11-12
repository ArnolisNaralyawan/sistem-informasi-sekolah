<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel-tabel modul akademik tidak lagi dipakai:
        // sistem kini murni sistem informasi sekolah.
        Schema::dropIfExists('materi_pelajaran');
        Schema::dropIfExists('absensis');
        Schema::dropIfExists('siswas');
        Schema::dropIfExists('kelas');
        Schema::dropIfExists('mata_pelajarans');
        Schema::dropIfExists('gurus');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Pemulihan data dapat dilakukan dari backup:
        // backup_db_sitem_2026-11-10.sql
    }
};
