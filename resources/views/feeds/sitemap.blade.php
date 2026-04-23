{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ route('home') }}</loc>
        @if($blogLastModified)
        <lastmod>{{ $blogLastModified->toAtomString() }}</lastmod>
        @endif
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    @foreach($categories as $category)
    <url>
        <loc>{{ route('posts.category', $category->slug) }}</loc>
        @if($category->lastmod)
        <lastmod>{{ \Carbon\Carbon::createFromTimestamp($category->lastmod)->toAtomString() }}</lastmod>
        @endif
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach
    @foreach($archives as $archive)
    <url>
        <loc>{{ route('posts.archive', ['year' => $archive->year, 'month' => $archive->month]) }}</loc>
        @if($archive->lastmod)
        <lastmod>{{ $archive->lastmod->toAtomString() }}</lastmod>
        @endif
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach
    @foreach($pages as $page)
    <url>
        <loc>{{ route('pages.show', $page->slug) }}</loc>
        <lastmod>{{ optional($page->updated_at)->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach
    @foreach($posts as $post)
    <url>
        <loc>{{ route('posts.show', $post->slug) }}</loc>
        <lastmod>{{ optional($post->updated_at)->toAtomString() ?: optional($post->published_at)->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    @endforeach
</urlset>
