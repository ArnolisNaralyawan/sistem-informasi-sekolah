<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('kepsek_nama')->nullable();
            $table->string('kepsek_foto')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable(); // satu misi per baris
            $table->json('stats')->nullable(); // statistik hero & section
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['kepsek_nama', 'kepsek_foto', 'visi', 'misi', 'stats']);
        });
    }
};
