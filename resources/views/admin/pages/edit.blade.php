@extends('layouts.app')

@section('title', 'Edit Halaman')
@section('full_width', '1')

@section('content')
<div class="mb-4">
    <div class="section-label">Admin Blog</div>
    <h1 class="h3 mb-1">Edit Halaman</h1>
    <p class="text-muted mb-0">Perbarui konten dan pengaturan halaman.</p>
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('adminlte3/plugins/summernote/summernote-lite.min.css') }}">
@endpush

<form action="{{ route('pages.update', $page) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row g-3">
        <div class="col-md-8">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $page->title) }}" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug', $page->slug) }}" placeholder="otomatis jika kosong">
        </div>
        <div class="col-12">
            <label class="form-label">Konten</label>
            <textarea name="content" id="page-content-editor" rows="12" class="form-control" required>{{ old('content', $page->content) }}</textarea>
        </div>
        <div class="col-md-6">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="published" @selected(old('status', $page->status) === 'published')>Published</option>
                <option value="draft" @selected(old('status', $page->status) === 'draft')>Draft</option>
            </select>
        </div>
        <div class="col-md-6 d-flex align-items-end">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="show_in_menu" value="1" id="show_in_menu" @checked(old('show_in_menu', $page->show_in_menu))>
                <label class="form-check-label" for="show_in_menu">
                    Tampilkan di menu navigasi
                </label>
            </div>
        </div>
        <div class="col-md-6 d-flex align-items-end">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="enable_comments" value="1" id="enable_comments" @checked(old('enable_comments', $page->enable_comments))>
                <label class="form-check-label" for="enable_comments">
                    Enable comment
                </label>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-brand">Simpan</button>
        <a href="{{ route('pages.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
</form>

@push('scripts')
    <script src="{{ asset('adminlte3/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte3/plugins/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('adminlte3/plugins/summernote/lang/summernote-id-ID.js') }}"></script>
    <script>
        $('#page-content-editor').summernote({
            height: 420,
            lang: 'id-ID',
            placeholder: 'Tulis konten halaman di sini...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    </script>
@endpush
@endsection
