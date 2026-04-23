@php
    $approvedComments = $commentable->comments ?? collect();
@endphp

<section class="mt-5">
    <div class="section-label mb-2">Komentar</div>
    <h2 class="h4 mb-4">{{ $approvedComments->count() }} Komentar</h2>

    @forelse($approvedComments as $comment)
        <div class="border rounded-4 p-3 mb-3">
            <div class="d-flex justify-content-between align-items-start gap-3">
                <div>
                    <div class="fw-semibold">{{ e($comment->author_name) }}</div>
                    <div class="small text-muted">{{ $comment->created_at->translatedFormat('d F Y H:i') }}</div>
                </div>
                @if($comment->author_website)
                    <a href="{{ $comment->author_website }}" target="_blank" rel="nofollow noopener noreferrer" class="small text-decoration-none">Website</a>
                @endif
            </div>
            <p class="mb-0 mt-3">{{ e($comment->content) }}</p>

            @if($comment->replies->isNotEmpty())
                <div class="ms-md-4 mt-3 pt-3 border-top">
                    @foreach($comment->replies as $reply)
                        <div class="mb-3">
                            <div class="fw-semibold">{{ e($reply->author_name) }}</div>
                            <div class="small text-muted">{{ $reply->created_at->translatedFormat('d F Y H:i') }}</div>
                            <p class="mb-0 mt-2">{{ e($reply->content) }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @empty
        <div class="alert alert-light border">Belum ada komentar yang disetujui.</div>
    @endforelse

    @if($commentable->enable_comments)
        <div class="border rounded-4 p-4 mt-4">
            <h3 class="h5 mb-3">Tinggalkan Komentar</h3>
            <form method="POST" action="{{ $action }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" name="author_name" class="form-control" value="{{ old('author_name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="author_email" class="form-control" value="{{ old('author_email') }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Website</label>
                        <input type="url" name="author_website" class="form-control" value="{{ old('author_website') }}" placeholder="Opsional">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Komentar</label>
                        <textarea name="content" rows="5" class="form-control" required>{{ old('content') }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-brand mt-3">Kirim Komentar</button>
            </form>
            <div class="small text-muted mt-2">Script HTML tidak akan diproses. Komentar masuk ke moderasi admin.</div>
        </div>
    @else
        <div class="alert alert-secondary mt-4 mb-0">Komentar dinonaktifkan untuk konten ini.</div>
    @endif
</section>
