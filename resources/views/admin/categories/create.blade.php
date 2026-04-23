@extends('layouts.app')

@section('title', 'Tambah Category')

@section('content')
<div class="mb-4">
    <div class="section-label">Admin Blog</div>
    <h1 class="h3 mb-1">Tambah Kategori</h1>
    <p class="text-muted mb-0">Buat kelompok kategori baru untuk artikel blog.</p>
</div>

<form action="{{ route('admin.blog.categories.store') }}" method="POST">
    @include('admin.categories._form')
</form>
@endsection
