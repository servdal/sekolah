@extends('layouts.app')

@section('title', 'Kelola Post')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <div class="section-label">Admin Blog</div>
        <h1 class="h3 mb-1">Daftar Artikel</h1>
        <p class="text-muted mb-0">Kelola artikel blog seperti pola WordPress.</p>
    </div>
    <a href="{{ route('admin.blog.posts.create') }}" class="btn btn-brand">+ Tambah Post</a>
</div>

<form method="GET" class="row g-2 mb-4">
    <div class="col-md-8">
        <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari judul artikel...">
    </div>
    <div class="col-md-4">
        <button class="btn btn-outline-secondary w-100">Cari</button>
    </div>
</form>

<div class="table-responsive">
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Author</th>
                <th>Status</th>
                <th>Comment</th>
                <th>Publish</th>
                <th class="text-end">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <td>
                        <div class="fw-semibold">{{ $post->title }}</div>
                        <div class="small text-muted">/{{ $post->slug }}</div>
                    </td>
                    <td>{{ $post->category->name ?? '-' }}</td>
                    <td>{{ $post->author->name ?? '-' }}</td>
                    <td><span class="badge text-bg-{{ $post->status === 'published' ? 'success' : 'secondary' }}">{{ $post->status }}</span></td>
                    <td>{{ $post->enable_comments ? 'Enable' : 'Disable' }}</td>
                    <td>{{ optional($post->published_at)->format('d M Y H:i') ?? '-' }}</td>
                    <td class="text-end">
                        <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-sm btn-outline-secondary">Lihat</a>
                        <a href="{{ route('admin.blog.posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.blog.posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus artikel ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">Belum ada artikel.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4 blog-pagination">
    {{ $posts->links('pagination::bootstrap-5') }}
</div>
@endsection
