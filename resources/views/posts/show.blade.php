@extends('layouts.app')

@section('title', $post->title)

@section('content')
<article>
    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm mb-4">Kembali ke Blog</a>

    <div class="section-label mb-2">Artikel</div>
    <h1 class="display-6 fw-bold">{{ $post->title }}</h1>
    <p class="text-muted mb-4">
        {{ optional($post->published_at)->translatedFormat('d F Y H:i') }}
        @if($post->author)
            | oleh {{ $post->author->name }}
        @endif
        @if($post->category)
            | kategori <a href="{{ route('posts.category', $post->category->slug) }}" class="text-decoration-none">{{ $post->category->name }}</a>
        @endif
    </p>

    @if($post->thumbnail_url)
        <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}" class="img-fluid rounded-4 mb-4">
    @endif

    <div class="mb-4">
        {!! $post->content !!}
    </div>

    @if($post->tags->isNotEmpty())
        <div class="mb-4">
            @foreach($post->tags as $tag)
                <span class="badge rounded-pill text-bg-light border me-1">{{ $tag->name }}</span>
            @endforeach
        </div>
    @endif

    <div class="row g-3 my-4">
        <div class="col-md-6">
            <div class="border rounded-4 p-3 h-100">
                <div class="small text-muted mb-1">Previous Post</div>
                @if($previousPost)
                    <a href="{{ route('posts.show', $previousPost->slug) }}" class="text-decoration-none fw-semibold">{{ $previousPost->title }}</a>
                @else
                    <div class="text-muted">Tidak ada post sebelumnya.</div>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="border rounded-4 p-3 h-100">
                <div class="small text-muted mb-1">Next Post</div>
                @if($nextPost)
                    <a href="{{ route('posts.show', $nextPost->slug) }}" class="text-decoration-none fw-semibold">{{ $nextPost->title }}</a>
                @else
                    <div class="text-muted">Tidak ada post berikutnya.</div>
                @endif
            </div>
        </div>
    </div>

    @if($relatedPosts->isNotEmpty())
        <hr class="my-5">
        <div class="section-label mb-2">Terkait</div>
        <h2 class="h4 mb-3">Similar Post</h2>
        <div class="row g-3">
            @foreach($relatedPosts as $relatedPost)
                <div class="col-md-4">
                    <div class="border rounded-4 p-3 h-100">
                        <div class="small text-muted mb-2">{{ optional($relatedPost->published_at)->translatedFormat('d M Y') }}</div>
                        <div class="fw-semibold mb-2">{{ $relatedPost->title }}</div>
                        <a href="{{ route('posts.show', $relatedPost->slug) }}" class="text-decoration-none">Baca</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @include('partials.comments', [
        'commentable' => $post,
        'action' => route('posts.comments.store', $post),
    ])
</article>
@endsection
