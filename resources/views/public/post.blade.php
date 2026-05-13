@extends('layouts.public')

@section('content')
<div class="article-layout">
    <div class="article-main">
        <article class="article-shell">
            <header class="article-header">
                <a href="{{ route('categories.show', $post->category->slug) }}" class="article-category">{{ $post->category->name }}</a>
                <h1 class="article-title">{{ $post->title }}</h1>
                <div class="article-meta-row">
                    <span>{{ optional($post->published_at)->format('d/m/Y H:i') }}</span>
                    <span>•</span>
                    <span>{{ str_word_count(strip_tags($post->content)) > 0 ? ceil(str_word_count(strip_tags($post->content)) / 220) : 1 }} phút đọc</span>
                </div>
            </header>

            @if($post->thumbnail)
                <div class="article-hero-media">
                    <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}">
                </div>
            @endif

            <div class="article-content-wrap">
                <div class="article-content">{!! $post->content !!}</div>
            </div>
        </article>
    </div>

    <aside class="article-aside">
        <div class="panel sidebar-sticky">
            <div class="panel-header">Thông tin bài viết</div>
            <div class="panel-body">
                <div class="d-flex justify-content-between mb-2"><span class="meta">Chuyên mục</span><strong>{{ $post->category->name }}</strong></div>
                <div class="d-flex justify-content-between mb-2"><span class="meta">Xuất bản</span><strong>{{ optional($post->published_at)->format('d/m/Y') }}</strong></div>
                <div class="d-flex justify-content-between"><span class="meta">Tác giả</span><strong>{{ $globalSettings['author_name'] ?? 'Quản trị viên' }}</strong></div>
                <hr>
                <a href="{{ route('contact') }}" class="btn btn-dark w-100">Liên hệ hợp tác</a>
            </div>
        </div>
    </aside>
</div>

@if(isset($relatedPosts) && $relatedPosts->count())
<section class="mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="section-title mb-0" style="font-size:1.6rem">Bài viết liên quan</h3>
        <a href="{{ route('categories.show', $post->category->slug) }}" class="btn btn-light border btn-sm">Xem danh mục</a>
    </div>
    <div class="row g-4">
        @foreach($relatedPosts as $item)
            <div class="col-md-4">
                <article class="recent-card">
                    @if($item->thumbnail)
                        <img src="{{ $item->thumbnail_url }}" class="recent-thumb" alt="{{ $item->title }}">
                    @else
                        <div class="recent-fallback"></div>
                    @endif
                    <div class="recent-body">
                        <a class="recent-title" href="{{ route('posts.show', $item->slug) }}">{{ $item->title }}</a>
                        <p class="recent-excerpt">{{ \Illuminate\Support\Str::limit($item->excerpt, 90) }}</p>
                        <div class="meta">{{ optional($item->published_at)->format('d/m/Y') }}</div>
                    </div>
                </article>
            </div>
        @endforeach
    </div>
</section>
@endif
@endsection
