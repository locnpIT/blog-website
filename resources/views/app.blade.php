<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $settings = $page['props']['globalSettings'] ?? [];
        $seo = $page['props']['seo'] ?? [];
        $siteTitle = $settings['site_title'] ?? 'PhuocLocBlog';
        $siteDescription = $settings['site_description'] ?? ($settings['author_bio'] ?? 'Blog chia sẻ kiến thức Laravel, hệ thống web và kinh nghiệm kỹ thuật thực chiến.');
        $seoTitle = $seo['title'] ?? $siteTitle;
        if ($seoTitle !== '' && !str_contains($seoTitle, $siteTitle)) {
            $seoTitle .= ' | '.$siteTitle;
        }
        $seoDescription = $seo['description'] ?? $siteDescription;
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
    <meta property="og:type" content="{{ $seo['type'] ?? 'website' }}">
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
    @vite('resources/js/app.js')
    @inertiaHead
</head>
<body>
@inertia
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    'name' => $siteTitle,
    'url' => url('/'),
    'description' => $siteDescription,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
