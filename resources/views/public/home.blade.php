@extends('layouts.public')

@section('content')
@php
    $featuredPosts = $posts->getCollection()->take(6);
    $heroPost = $featuredPosts->first();
    $sideFeatured = $featuredPosts->slice(1, 5);
@endphp

@if($heroPost)
<section class="mb-5">
    <div class="home-feature-grid">
        <a href="{{ route('posts.show', $heroPost->slug) }}" class="hero-post-card">
            @if($heroPost->thumbnail)
                <img src="{{ $heroPost->thumbnail_url }}" alt="{{ $heroPost->title }}">
            @else
                <div class="hero-fallback"></div>
            @endif
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <span class="hero-tag">{{ $heroPost->category->name }}</span>
                <h1>{{ $heroPost->title }}</h1>
            </div>
        </a>

        <aside class="featured-side panel">
            <div class="panel-header d-flex justify-content-between align-items-center">
                <span>Bài nổi bật</span>
                <a href="{{ route('home') }}" class="text-decoration-none" style="font-size: 0.75rem; opacity: 0.8">Xem tất cả</a>
            </div>
            <div class="panel-body p-0">
                @forelse($sideFeatured as $post)
                    <a href="{{ route('posts.show', $post->slug) }}" class="featured-mini-item">
                        @if($post->thumbnail)
                            <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}">
                        @else
                            <div class="mini-fallback"></div>
                        @endif
                        <div>
                            <div class="featured-mini-title">{{ \Illuminate\Support\Str::limit($post->title, 72) }}</div>
                            <div class="meta">{{ $post->category->name }}</div>
                        </div>
                    </a>
                @empty
                    <div class="p-3 text-muted">Chưa có bài nổi bật.</div>
                @endforelse
            </div>
        </aside>
    </div>
</section>
@endif

<section>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="section-title mb-0">Bài viết mới</h2>
        <a href="{{ route('home') }}" class="btn btn-light btn-sm border">Tất cả bài viết</a>
    </div>
    @include('public._post_grid', ['posts' => $posts])
</section>
@endsection
