@extends('layouts.app')

@section('title', $page->title)

@section('content')
<div class="mb-4">
    <div class="section-label">Halaman</div>
    <h1 class="display-6 fw-bold">{{ $page->title }}</h1>
</div>

<div class="content-page">
    {!! $page->content !!}
</div>

@include('partials.comments', [
    'commentable' => $page,
    'action' => route('pages.comments.store', $page),
])
@endsection
