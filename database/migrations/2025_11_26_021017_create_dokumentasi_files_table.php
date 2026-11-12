<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dokumentasi_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dokumentasi_id')->constrained('dokumentasis')->onDelete('cascade');
            $table->string('nama_file');
            $table->string('path_file');
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dokumentasi_files');
    }
};