<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $siteTitle = $globalSettings['site_title'] ?? 'PhuocLocBlog';
        $siteDescription = $globalSettings['site_description'] ?? ($globalSettings['author_bio'] ?? 'Blog chia sẻ kiến thức Laravel, hệ thống web và kinh nghiệm kỹ thuật thực chiến.');
        $pageTitle = trim($__env->yieldContent('title', $siteTitle));
        $seoTitle = trim($pageTitle);
        if ($seoTitle !== '' && !str_contains($seoTitle, $siteTitle)) {
            $seoTitle = $seoTitle . ' | ' . $siteTitle;
        }
        $seoDescription = trim($__env->yieldContent('meta_description', $siteDescription));
        $canonical = url()->current();
        $ogImage = asset('images/PhuocLocBlogLogoHeader.png');
    @endphp
    <meta name="robots" content="index,follow">
    <meta name="description" content="{{ $seoDescription }}">
    <link rel="canonical" href="{{ $canonical }}">
    <meta property="og:locale" content="vi_VN">
    <meta property="og:site_name" content="{{ $siteTitle }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $ogImage }}">
    <title>{{ $seoTitle }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('meta')
</head>
<body>
<div class="app-shell">
    <nav class="navbar navbar-expand-lg topbar">
        <div class="container">
            <a class="navbar-brand brand" href="{{ route('home') }}" aria-label="{{ $globalSettings['site_title'] ?? 'PhuocLocBlog' }}">
                <img src="{{ asset('images/PhuocLocBlogLogoHeader.png') }}" alt="{{ $globalSettings['site_title'] ?? 'PhuocLocBlog' }}">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-label="Mở menu"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Giới thiệu</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('work') ? 'active' : '' }}" href="{{ route('work') }}">Làm việc</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Liên hệ</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="page-wrap">
        @if(session('success'))
            <div class="container">
                <div class="alert alert-success soft-alert">{{ session('success') }}</div>
            </div>
        @endif
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="main-footer">
        <div class="container footer-wrap">
            <div class="footer-grid">
                <section class="footer-brand-block">
                    <img class="footer-logo" src="{{ asset('images/PhuocLocBlogLogoHeader.png') }}" alt="{{ $globalSettings['site_title'] ?? 'PhuocLocBlog' }}">
                    <p class="footer-bio">{{ $globalSettings['author_bio'] ?? 'Blog chia sẻ về đời sống hằng ngày, kiến thức lập trình, hệ thống web và kinh nghiệm kỹ thuật thực chiến.' }}</p>
                </section>

                <section class="footer-links-block">
                    <h3>Điều hướng</h3>
                    <a href="{{ route('home') }}">Trang chủ</a>
                    <a href="{{ route('about') }}">Giới thiệu</a>
                    <a href="{{ route('work') }}">Làm việc</a>
                    <a href="{{ route('contact') }}">Liên hệ</a>
                </section>

                <section class="footer-contact-block">
                    <h3>Kết nối</h3>
                    <div class="footer-social-row">
                        @if($globalSettings['social_facebook'] ?? '')
                            <a href="{{ $globalSettings['social_facebook'] }}" target="_blank" rel="noreferrer" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if($globalSettings['social_instagram'] ?? '')
                            <a href="{{ $globalSettings['social_instagram'] }}" target="_blank" rel="noreferrer" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if($globalSettings['social_linkedin'] ?? '')
                            <a href="{{ $globalSettings['social_linkedin'] }}" target="_blank" rel="noreferrer" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        @endif
                        @if($globalSettings['social_github'] ?? '')
                            <a href="{{ $globalSettings['social_github'] }}" target="_blank" rel="noreferrer" aria-label="GitHub"><i class="fab fa-github"></i></a>
                        @endif
                    </div>
                    <a class="footer-contact-link" href="{{ route('contact') }}">Gửi lời nhắn</a>
                </section>
            </div>

            <div class="footer-bottom">
                <p class="mb-0">© {{ date('Y') }} {{ $globalSettings['site_title'] ?? 'PhuocLocBlog' }}</p>
                <p class="mb-0">Nguyễn Phước Lộc</p>
            </div>
        </div>
    </footer>
</div>
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    'name' => $siteTitle,
    'url' => url('/'),
    'description' => $siteDescription,
    'potentialAction' => [
        '@type' => 'SearchAction',
        'target' => url('/').'?s={search_term_string}',
        'query-input' => 'required name=search_term_string',
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('jsonld')
</body>
</html>
