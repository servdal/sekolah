<!DOCTYPE html>
<html lang="id">
<head>
    @php
        $metaTitle = trim($__env->yieldContent('title', 'Beranda'));
        $metaTitle = $metaTitle !== '' ? $metaTitle . ' | SDTQ Daarul Ukhuwwah' : 'SDTQ Daarul Ukhuwwah';
        $metaDescription = trim($__env->yieldContent('meta_description'));
        if ($metaDescription === '') {
            if (isset($post)) {
                $metaDescription = $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 160);
            } elseif (isset($page)) {
                $metaDescription = \Illuminate\Support\Str::limit(strip_tags($page->content), 160);
            } else {
                $metaDescription = 'Blog resmi SDTQ Daarul Ukhuwwah berisi artikel, kegiatan santri, profil sekolah, dan informasi terbaru.';
            }
        }
        $metaCanonical = trim($__env->yieldContent('canonical', url()->current()));
        $metaRobots = trim($__env->yieldContent('meta_robots', 'index,follow,max-image-preview:large'));
        $metaImage = trim($__env->yieldContent('meta_image'));
        if ($metaImage === '') {
            if (isset($post) && $post->thumbnail_url) {
                $metaImage = $post->thumbnail_url;
            } else {
                $metaImage = 'https://sdtqdu.sch.id/logo/1-1722477870logo.png';
            }
        }
        $schemaType = trim($__env->yieldContent('schema_type', isset($post) ? 'Article' : 'WebPage'));
    @endphp
    @php($isFullWidth = trim($__env->yieldContent('full_width')) === '1')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="robots" content="{{ $metaRobots }}">
    <link rel="canonical" href="{{ $metaCanonical }}">
    <link rel="alternate" type="application/rss+xml" title="SDTQ Daarul Ukhuwwah RSS Feed" href="{{ route('feed.rss') }}">
    <meta property="og:type" content="{{ isset($post) ? 'article' : 'website' }}">
    <meta property="og:site_name" content="SDTQ Daarul Ukhuwwah">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ $metaCanonical }}">
    <meta property="og:image" content="{{ $metaImage }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $metaImage }}">
    <link rel="icon" type="image/png" href="https://sdtqdu.sch.id/logo/1-1722477870logo.png">
    <link rel="apple-touch-icon" href="https://sdtqdu.sch.id/logo/1-1722477870logo.png">
    @stack('styles')
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => $schemaType,
            'headline' => isset($post) ? $post->title : (isset($page) ? $page->title : 'SDTQ Daarul Ukhuwwah'),
            'name' => isset($post) ? $post->title : (isset($page) ? $page->title : 'SDTQ Daarul Ukhuwwah'),
            'description' => $metaDescription,
            'url' => $metaCanonical,
            'image' => [$metaImage],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'SDTQ Daarul Ukhuwwah',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => 'https://sdtqdu.sch.id/logo/1-1722477870logo.png',
                ],
            ],
            'datePublished' => isset($post) && $post->published_at ? $post->published_at->toAtomString() : null,
            'dateModified' => isset($post) && $post->updated_at ? $post->updated_at->toAtomString() : (isset($page) && $page->updated_at ? $page->updated_at->toAtomString() : null),
            'mainEntityOfPage' => $metaCanonical,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --brand-green: #1f5f4a;
            --brand-gold: #d8b15d;
            --brand-cream: #f8f4eb;
            --brand-ink: #1e2930;
        }

        body {
            background:
                radial-gradient(circle at top right, rgba(216, 177, 93, 0.18), transparent 24%),
                linear-gradient(180deg, #f9f6ef 0%, #ffffff 34%, #f5f7f4 100%);
            color: var(--brand-ink);
        }

        .topbar {
            background: var(--brand-green);
            color: #fff;
            font-size: 0.92rem;
        }

        .site-title {
            color: #344f7d;
            font-weight: 800;
            letter-spacing: 0.04em;
            text-decoration: none;
        }

        .site-tagline {
            color: #6b7280;
            font-size: 1rem;
            letter-spacing: 0.18em;
        }

        .main-nav {
            background: #173e31;
            box-shadow: 0 14px 40px rgba(15, 23, 42, 0.08);
        }

        .main-nav .nav-link,
        .main-nav .navbar-brand {
            color: rgba(255, 255, 255, 0.92) !important;
        }

        .main-nav .nav-link:hover,
        .main-nav .nav-link:focus {
            color: #fff !important;
        }

        .content-shell {
            margin-top: 2rem;
            margin-bottom: 3rem;
        }

        .content-card,
        .widget-card {
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(31, 95, 74, 0.08);
            border-radius: 1rem;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.07);
        }

        .widget-card {
            overflow: hidden;
        }

        .widget-title {
            background: linear-gradient(135deg, var(--brand-green), #2f7a60);
            color: #fff;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            padding: 0.9rem 1rem;
            margin: 0;
        }

        .sidebar-list a {
            color: #24343d;
            text-decoration: none;
        }

        .sidebar-list a:hover {
            color: var(--brand-green);
        }

        .footer-shell {
            background: #173e31;
            color: rgba(255, 255, 255, 0.9);
        }

        .footer-shell a {
            color: #fff;
        }

        .btn-brand {
            background: var(--brand-green);
            border-color: var(--brand-green);
            color: #fff;
        }

        .btn-brand:hover {
            background: #184c3b;
            border-color: #184c3b;
            color: #fff;
        }

        .section-label {
            color: var(--brand-green);
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .admin-shortcut {
            border-top: 1px dashed rgba(255, 255, 255, 0.18);
            padding-top: 0.75rem;
            margin-top: 0.75rem;
        }

        .card-body .stretched-link {
            color: var(--brand-ink) !important;
        }

        .card-body .stretched-link:hover {
            color: var(--brand-green) !important;
        }

        .blog-pagination .pagination {
            margin-bottom: 0;
            gap: 0.35rem;
            flex-wrap: wrap;
        }

        .blog-pagination .page-link {
            border-radius: 0.6rem;
            color: var(--brand-green);
            border: 1px solid rgba(31, 95, 74, 0.18);
            padding: 0.55rem 0.85rem;
            font-size: 0.95rem;
            line-height: 1.15;
            box-shadow: none;
        }

        .blog-pagination .page-item.active .page-link {
            background: var(--brand-green);
            border-color: var(--brand-green);
            color: #fff;
        }

        .blog-pagination .page-item.disabled .page-link {
            color: #94a3b8;
            background: #f8fafc;
        }

        .widget-embed {
            width: 100%;
            min-height: 260px;
            border: 0;
            display: block;
        }

        .header-shell {
            background: #fff;
        }

        .brand-lockup {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .brand-logo {
            width: 88px;
            height: 88px;
            object-fit: contain;
        }

        .brand-copy {
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
        }

        .header-search .form-control {
            min-width: 320px;
            border-radius: 999px 0 0 999px;
            padding: 0.95rem 1.25rem;
        }

        .header-search .btn {
            border-radius: 0 999px 999px 0;
            padding-left: 1.3rem;
            padding-right: 1.3rem;
        }

        @media (max-width: 991.98px) {
            .brand-logo {
                width: 70px;
                height: 70px;
            }

            .header-search .form-control {
                min-width: 0;
            }
        }
    </style>
</head>
<body>
    <div class="topbar py-2">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between gap-2">
                <div>SDTQ Daarul Ukhuwwah Malang</div>
                <div>Mulia Bersama Al Qur'an</div>
            </div>
        </div>
    </div>

    <header class="header-shell py-4">
        <div class="container d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4">
            <div class="brand-lockup">
                <img src="https://sdtqdu.sch.id/logo/1-1722477870logo.png" alt="Logo SDTQ Daarul Ukhuwwah" class="brand-logo">
                <div class="brand-copy">
                    <a class="site-title fs-1" href="{{ route('home') }}">SDTQ DAARUL UKHUWWAH</a>
                    <div class="site-tagline">Mulia Bersama Al Qur'an</div>
                </div>
            </div>
            <form action="{{ route('home') }}" method="GET" class="header-search d-flex gap-0">
                <input type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari artikel...">
                <button type="submit" class="btn btn-brand">Cari</button>
            </form>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg main-nav navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="{{ route('home') }}">Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                    @foreach($menuPages as $menuPage)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pages.show', $menuPage->slug) }}">{{ $menuPage->title }}</a>
                        </li>
                    @endforeach
                </ul>
                @if(session('id') && session('previlage') !== null && session('previlage') !== '' && session('previlage') !== 'ortu')
                    <div class="admin-shortcut text-white small">
                        <a class="text-white text-decoration-none me-3" href="{{ route('admin.blog.posts.index') }}">Kelola Post</a>
                        <a class="text-white text-decoration-none me-3" href="{{ route('pages.index') }}">Kelola Page</a>
                        <a class="text-white text-decoration-none me-3" href="{{ route('admin.blog.categories.index') }}">Kelola Category</a>
                        <a class="text-white text-decoration-none" href="{{ route('admin.blog.comments.index') }}">Moderasi Komentar</a>
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <div class="container content-shell">
        <div class="row g-4">
            <main class="{{ $isFullWidth ? 'col-12' : 'col-lg-8' }}">
                <div class="content-card p-4 p-lg-5">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>

            @unless($isFullWidth)
                <aside class="col-lg-4">
                    <div class="widget-card mb-4">
                        <h2 class="widget-title">Kategori</h2>
                        <div class="p-3">
                            <ul class="list-unstyled sidebar-list mb-0">
                                @if($sidebarCategories->isEmpty())
                                    <li class="text-muted">Belum ada kategori.</li>
                                @else
                                    @foreach($sidebarCategories as $sidebarCategory)
                                        <li class="d-flex justify-content-between py-2 border-bottom">
                                            <a href="{{ route('posts.category', $sidebarCategory->slug) }}">{{ $sidebarCategory->name }}</a>
                                            <span class="text-muted">{{ $sidebarCategory->posts_count }}</span>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="widget-card mb-4">
                        <h2 class="widget-title">Artikel Terbaru</h2>
                        <div class="p-3">
                            <ul class="list-unstyled sidebar-list mb-0">
                                @if($recentPosts->isEmpty())
                                    <li class="text-muted">Belum ada artikel.</li>
                                @else
                                    @foreach($recentPosts as $recentPost)
                                        <li class="py-2 border-bottom">
                                            <a href="{{ route('posts.show', $recentPost->slug) }}">{{ $recentPost->title }}</a>
                                            <div class="small text-muted mt-1">{{ optional($recentPost->published_at)->translatedFormat('d F Y') }}</div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="widget-card mb-4">
                        <h2 class="widget-title">Profil Sekolah</h2>
                        <iframe
                            class="widget-embed"
                            src="https://www.youtube.com/embed/FxlwV3AGgEY"
                            title="Profil SD Tahfidz Al Quran Daarul Ukhuwwah"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin"
                            allowfullscreen>
                        </iframe>
                    </div>

                    <div class="widget-card mb-4">
                        <h2 class="widget-title">Lokasi Sekolah</h2>
                        <iframe
                            class="widget-embed"
                            src="https://www.google.com/maps?q=-7.960238129472215,112.68316472197425&z=17&output=embed"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Lokasi SDTQ Daarul Ukhuwwah">
                        </iframe>
                        <div class="p-3 pt-2">
                            <a href="https://maps.app.goo.gl/H1UJGGtRUYgpZuSB7" target="_blank" rel="noopener noreferrer" class="text-decoration-none">Buka di Google Maps</a>
                        </div>
                    </div>

                    
                </aside>
            @endunless
        </div>
    </div>

    <footer class="footer-shell py-4 mt-5">
        <div class="container d-flex flex-column flex-md-row justify-content-between gap-2">
            <div>&copy; 2026 SDTQ Daarul Ukhuwwah</div>
            <div>Mulia Bersama Al Quran</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
