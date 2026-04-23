@extends('layouts.app')

@section('title', 'Kelola Komentar')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <div class="section-label">Admin Blog</div>
        <h1 class="h3 mb-1">Moderasi Komentar</h1>
        <p class="text-muted mb-0">Setujui atau hapus komentar publik yang masuk.</p>
    </div>
</div>

<div class="table-responsive">
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Konten</th>
                <th>Pengirim</th>
                <th>Komentar</th>
                <th>Status</th>
                <th class="text-end">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($comments as $comment)
                <tr>
                    <td>
                        @if($comment->commentable instanceof \App\Models\Post)
                            <a href="{{ route('posts.show', $comment->commentable->slug) }}" class="text-decoration-none">{{ $comment->commentable->title }}</a>
                        @elseif($comment->commentable instanceof \App\Models\Page)
                            <a href="{{ route('pages.show', $comment->commentable->slug) }}" class="text-decoration-none">{{ $comment->commentable->title }}</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <div>{{ $comment->author_name }}</div>
                        <div class="small text-muted">{{ $comment->author_email }}</div>
                    </td>
                    <td>{{ \Illuminate\Support\Str::limit($comment->content, 100) }}</td>
                    <td>
                        <span class="badge text-bg-{{ $comment->is_approved ? 'success' : 'warning' }}">
                            {{ $comment->is_approved ? 'Approved' : 'Pending' }}
                        </span>
                    </td>
                    <td class="text-end">
                        @unless($comment->is_approved)
                            <form action="{{ route('admin.blog.comments.approve', $comment) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-success">Approve</button>
                            </form>
                        @endunless
                        <form action="{{ route('admin.blog.comments.destroy', $comment) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus komentar ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">Belum ada komentar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $comments->links() }}
@endsection
