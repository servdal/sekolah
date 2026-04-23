@extends('layouts.app')

@section('title', 'Kelola Halaman')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <div class="section-label">Admin Blog</div>
        <h1 class="h3 mb-1">Daftar Halaman</h1>
        <p class="text-muted mb-0">Kelola halaman statis seperti Tentang Kami, Kontak, atau Info PSB.</p>
    </div>
    <a href="{{ route('pages.create') }}" class="btn btn-brand">+ Tambah Halaman</a>
</div>

<form method="GET" class="row g-2 mb-4">
    <div class="col-md-8">
        <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari judul halaman...">
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
                <th>Slug</th>
                <th>Status</th>
                <th>Menu</th>
                <th>Comment</th>
                <th class="text-end">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($pages as $page)
            <tr>
                <td>{{ $page->title }}</td>
                <td>{{ $page->slug }}</td>
                <td><span class="badge text-bg-{{ $page->status === 'published' ? 'success' : 'secondary' }}">{{ $page->status }}</span></td>
                <td>{{ $page->show_in_menu ? 'Ya' : 'Tidak' }}</td>
                <td>{{ $page->enable_comments ? 'Enable' : 'Disable' }}</td>
                <td class="text-end">
                    <a href="{{ route('pages.show', $page->slug) }}" class="btn btn-sm btn-outline-secondary">Lihat</a>
                    <a href="{{ route('pages.edit', $page) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                    <form action="{{ route('pages.destroy', $page) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus halaman ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center text-muted py-4">Belum ada halaman.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4 blog-pagination">
    {{ $pages->links('pagination::bootstrap-5') }}
</div>
@endsection
