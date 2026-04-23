@extends('layouts.app')

@php
    $pageTitle = 'Blog';

    if (isset($archiveLabel)) {
        $pageTitle = 'Arsip ' . $archiveLabel;
    } elseif ($currentCategory) {
        $pageTitle = 'Kategori ' . $currentCategory->name;
    } elseif (request('q')) {
        $pageTitle = 'Pencarian Blog: ' . request('q');
    }

    $pageDescription = request('q')
        ? 'Hasil pencarian artikel blog SDTQ Daarul Ukhuwwah untuk kata kunci "' . request('q') . '".'
        : ($currentCategory
            ? 'Artikel blog SDTQ Daarul Ukhuwwah dalam kategori ' . $currentCategory->name . '.'
            : (isset($archiveLabel)
                ? 'Arsip artikel blog SDTQ Daarul Ukhuwwah untuk ' . $archiveLabel . '.'
                : 'Kumpulan artikel, kegiatan, dan informasi terbaru SDTQ Daarul Ukhuwwah.'));

    $canonicalUrl = request('q')
        ? route('home')
        : url()->current();
@endphp

@section('title', $pageTitle)
@section('meta_description', $pageDescription)
@section('canonical', $canonicalUrl)
@section('schema_type', 'CollectionPage')
@if(request('q'))
@section('meta_robots', 'noindex,follow,max-image-preview:large')
@endif

@section('content')
<div class="mb-4">
    <div class="section-label">Blog Sekolah</div>
    <h1 class="h2 mb-2">
        @isset($archiveLabel)
            Arsip {{ $archiveLabel }}
        @elseif($currentCategory)
            Kategori: {{ $currentCategory->name }}
        @else
            Artikel & Kegiatan Terbaru
        @endisset
    </h1>
    <p class="text-muted mb-0">
        @if(request('q'))
            Menampilkan hasil pencarian untuk "{{ request('q') }}".
        @else
            Kumpulan informasi kegiatan, profil, dan kabar terbaru SDTQ Daarul Ukhuwwah.
        @endif
    </p>
</div>

<div class="row g-4">
    @forelse($posts as $post)
        <article class="col-md-6">
            <div class="card border-0 h-100 shadow-sm">
                @if($post->thumbnail_thumb_url)
                    <a href="{{ route('posts.show', $post->slug) }}" class="d-block overflow-hidden rounded-top text-decoration-none">
                        <img src="{{ $post->thumbnail_thumb_url }}" class="card-img-top" alt="{{ $post->title }}" width="640" height="360" loading="lazy" decoding="async" style="height: 220px; object-fit: cover;">
                    </a>
                @endif
                <div class="card-body d-flex flex-column">
                    <div class="small text-muted mb-2">
                        {{ optional($post->published_at)->translatedFormat('d F Y') }}
                        @if($post->author)
                            | {{ $post->author->name }}
                        @endif
                        @if($post->category)
                            | <a href="{{ route('posts.category', $post->category->slug) }}" class="text-decoration-none">{{ $post->category->name }}</a>
                        @endif
                    </div>
                    <h2 class="h4 mb-3">
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-decoration-none text-dark stretched-link position-relative">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <p class="text-muted flex-grow-1">
                        {{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 160) }}
                    </p>
                    <div>
                        <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-brand">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        </article>
    @empty
        <div class="col-12">
            <div class="alert alert-light border mb-0">Belum ada artikel yang cocok dengan filter ini.</div>
        </div>
    @endforelse
</div>

<div class="mt-4 blog-pagination">
    {{ $posts->links('pagination::bootstrap-5') }}
</div>
@endsection
