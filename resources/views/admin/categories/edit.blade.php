@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="mb-4">
    <div class="section-label">Admin Blog</div>
    <h1 class="h3 mb-1">Edit Kategori</h1>
    <p class="text-muted mb-0">Perbarui nama kategori, slug, dan deskripsinya.</p>
</div>

<form action="{{ route('admin.blog.categories.update', $category) }}" method="POST">
    @include('admin.categories._form')
</form>
@endsection
