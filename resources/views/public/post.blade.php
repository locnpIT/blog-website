@extends('layouts.public')
@section('title', $post->title . ' - ' . ($globalSettings['site_title'] ?? 'PhuocLocBlog'))
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?: $post->content), 155))
@section('og_type', 'article')

@section('jsonld')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BlogPosting',
    'mainEntityOfPage' => [
        '@type' => 'WebPage',
        '@id' => url()->current(),
    ],
    'headline' => $post->title,
    'description' => \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?: $post->content), 155),
    'datePublished' => optional($post->published_at)?->toAtomString(),
    'dateModified' => optional($post->updated_at)?->toAtomString(),
    'author' => [
        '@type' => 'Person',
        'name' => $globalSettings['author_name'] ?? 'Phuoc Loc',
    ],
    'publisher' => [
        '@type' => 'Organization',
        'name' => $globalSettings['site_title'] ?? 'PhuocLocBlog',
        'logo' => [
            '@type' => 'ImageObject',
            'url' => asset('images/PhuocLocBlogLogoHeader.png'),
        ],
    ],
    'image' => $post->thumbnail ? [$post->thumbnail_url] : [asset('images/PhuocLocBlogLogoHeader.png')],
    'articleSection' => $post->category?->name,
    'url' => url()->current(),
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
@endsection

@section('content')
<div class="content-layout">
    <article class="post-page">
        <p class="post-meta mb-2">{{ $post->category->name }} · {{ optional($post->published_at)->format('d/m/Y H:i') }}</p>
        <h1 class="post-page-title">{{ $post->title }}</h1>
        <p class="post-page-subtitle">{{ $post->excerpt }}</p>

        @if($post->thumbnail)
            <div class="post-page-image">
                <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}">
            </div>
        @endif

        <div class="post-page-content article-content">{!! $post->content !!}</div>
    </article>

    <aside class="home-sidebar">
        @include('public.partials.categories-card', ['categories' => $sidebarCategories ?? collect()])
    </aside>
</div>

@if(isset($relatedPosts) && $relatedPosts->count())
<section class="related-simple">
    <h2 class="section-title">Bài viết liên quan</h2>
    <div class="post-list">
        @foreach($relatedPosts as $item)
            <article class="post-row">
                <a href="{{ route('posts.show', $item->slug) }}" class="post-row-media">
                    @if($item->thumbnail)
                        <img src="{{ $item->thumbnail_url }}" alt="{{ $item->title }}">
                    @else
                        <div class="post-row-fallback"></div>
                    @endif
                </a>
                <div class="post-row-body">
                    <p class="post-row-meta">{{ optional($item->published_at)->format('d/m/Y') }}</p>
                    <a class="post-row-title" href="{{ route('posts.show', $item->slug) }}">{{ $item->title }}</a>
                </div>
            </article>
        @endforeach
    </div>
</section>
@endif
@endsection
