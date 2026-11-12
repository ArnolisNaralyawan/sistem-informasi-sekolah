@extends('layouts.app')

@section('title', 'Edit Fasilitas')

@section('content')
<div class="max-w-3xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-1">Edit Fasilitas</h1>
    <p class="text-gray-600">{{ $fasilita->nama }}</p>
    @include('admin.fasilitas._form')
</div>
@endsection
