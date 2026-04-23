@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="mb-4">
    <div class="section-label">Admin Blog</div>
    <h1 class="h3 mb-1">Edit Artikel</h1>
    <p class="text-muted mb-0">Perbarui konten, kategori, dan metadata artikel.</p>
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('adminlte3/plugins/summernote/summernote-lite.min.css') }}">
@endpush

<form action="{{ route('admin.blog.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
    @include('admin.posts._form')
</form>

@push('scripts')
    <script src="{{ asset('adminlte3/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte3/plugins/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('adminlte3/plugins/summernote/lang/summernote-id-ID.js') }}"></script>
    @include('admin.posts._summernote')
@endpush
@endsection
