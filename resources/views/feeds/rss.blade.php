{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
    <title>SDTQ Daarul Ukhuwwah Blog</title>
    <link>{{ route('home') }}</link>
    <description>Artikel dan kegiatan terbaru SDTQ Daarul Ukhuwwah.</description>
    <language>id-ID</language>
    <atom:link href="{{ url('/feed.xml') }}" rel="self" type="application/rss+xml" />
    @if($posts->isNotEmpty())
    <lastBuildDate>{{ $posts->first()->published_at->toRssString() }}</lastBuildDate>
    @endif
    @foreach($posts as $post)
    <item>
        <title><![CDATA[{{ $post->title }}]]></title>
        <link>{{ route('posts.show', $post->slug) }}</link>
        <guid>{{ route('posts.show', $post->slug) }}</guid>
        <pubDate>{{ optional($post->published_at)->toRssString() }}</pubDate>
        <description><![CDATA[{{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 220) }}]]></description>
        <content:encoded><![CDATA[{!! $post->content !!}]]></content:encoded>
        @if($post->category)
        <category><![CDATA[{{ $post->category->name }}]]></category>
        @endif
    </item>
    @endforeach
</channel>
</rss>
