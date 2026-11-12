<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah');
            $table->string('nama_singkat');
            $table->string('motto')->nullable();
            $table->string('logo')->nullable();
            $table->text('alamat');
            $table->string('telepon');
            $table->string('email');
            $table->string('instagram')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
};
