@csrf
@if(isset($post))
    @method('PUT')
@endif

<div class="row g-3">
    @php
        $selectedCategoryId = old('category_id', $post->category_id ?? ($categories->first()->id ?? ''));
        $authorName = session('nama', $post->author->name ?? 'Admin');
        $authorEmail = session('email', $post->author->email ?? '');
        $thumbnailUrl = old('thumbnail_existing', $post->thumbnail_url ?? null);
    @endphp

    <div class="col-md-9">
        <label class="form-label">Judul</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $post->title ?? '') }}" required>
    </div>
    <div class="col-md-3">
        <label class="form-label">Kategori</label>
        <select name="category_id" class="form-select">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected((string) $selectedCategoryId === (string) $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        <div class="form-text">Jika tidak dipilih, sistem memakai kategori pertama yang tersedia.</div>
    </div>
    <div class="col-12">
        <label class="form-label">Konten</label>
        <textarea name="content" id="post-content-editor" rows="14" class="form-control" required>{{ old('content', $post->content ?? '') }}</textarea>
    </div>
    <div class="col-md-7">
        <label class="form-label">Thumbnail</label>
        <input type="file" name="thumbnail_file" id="thumbnail_file" class="form-control" accept=".jpg,.jpeg,.png,.webp">
        <div class="form-text">Gunakan tombol choose file untuk upload foto. Thumbnail listing akan dibuat otomatis.</div>
    </div>
    <div class="col-md-5">
        <label class="form-label d-block">Preview Thumbnail</label>
        <div class="border rounded p-2 bg-light">
            <img
                id="thumbnail-preview"
                src="{{ $thumbnailUrl ?: 'https://placehold.co/640x360/e9ecef/6c757d?text=Thumbnail' }}"
                alt="Preview thumbnail"
                class="img-fluid rounded"
                style="max-height: 220px; object-fit: cover; width: 100%;">
        </div>
    </div>
    <div class="col-md-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="published" @selected(old('status', $post->status ?? 'published') === 'published')>Published</option>
            <option value="draft" @selected(old('status', $post->status ?? '') === 'draft')>Draft</option>
        </select>
    </div>
    <div class="col-md-5">
        <label class="form-label">Nama Author</label>
        <input type="text" class="form-control" value="{{ $authorName }}" readonly>
    </div>
    <div class="col-md-4">
        <label class="form-label">Email Author</label>
        <input type="email" class="form-control" value="{{ $authorEmail }}" readonly>
    </div>
    <div class="col-md-6">
        <label class="form-label">Tanggal Publish</label>
        <input type="datetime-local" name="published_at" class="form-control"
            value="{{ old('published_at', isset($post?->published_at) ? $post->published_at->format('Y-m-d\\TH:i') : now()->format('Y-m-d\\TH:i')) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Tags</label>
        <input type="text" name="tags" class="form-control" value="{{ old('tags', $tagNames ?? '') }}" placeholder="Pisahkan dengan koma">
    </div>
    <div class="col-md-6 d-flex align-items-end">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="enable_comments" value="1" id="enable_comments" @checked(old('enable_comments', $post->enable_comments ?? false))>
            <label class="form-check-label" for="enable_comments">
                Enable comment
            </label>
        </div>
    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-brand">Simpan</button>
    <a href="{{ route('admin.blog.posts.index') }}" class="btn btn-outline-secondary">Kembali</a>
</div>
