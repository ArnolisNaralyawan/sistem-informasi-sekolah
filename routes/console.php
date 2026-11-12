<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('debug:routes', function () {
    $routes = \Illuminate\Support\Facades\Route::getRoutes();
    
    foreach ($routes as $route) {
        $this->line($route->uri() . ' -> ' . $route->getName());
    }
})->purpose('Display all registered routes');

Artisan::command('debug:models', function () {
    $models = [
        'User' => \App\Models\User::class,
        'Guru' => \App\Models\Guru::class,
        'Siswa' => \App\Models\Siswa::class,
        'Kelas' => \App\Models\Kelas::class,
        'MataPelajaran' => \App\Models\MataPelajaran::class,
        'Absensi' => \App\Models\Absensi::class,
    ];
    
    foreach ($models as $name => $class) {
        $count = $class::count();
        $this->line("{$name}: {$count} records");
    }
})->purpose('Display model counts');