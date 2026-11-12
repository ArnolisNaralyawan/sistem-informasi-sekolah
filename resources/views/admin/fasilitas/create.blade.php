@extends('layouts.app')

@section('title', 'Tambah Fasilitas')

@section('content')
<div class="max-w-3xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-1">Tambah Fasilitas</h1>
    <p class="text-gray-600">Fasilitas akan tampil di section "Fasilitas Sekolah" landing page</p>
    @include('admin.fasilitas._form')
</div>
@endsection
