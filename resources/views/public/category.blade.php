@extends('layouts.public')
@section('title', 'Danh mục ' . $category->name . ' - ' . ($globalSettings['site_title'] ?? 'PhuocLocBlog'))
@section('meta_description', trim(($category->description ?: 'Các bài viết thuộc danh mục ' . $category->name . '.')))
@section('og_type', 'website')

@section('content')
<section class="category-hero">
    <div class="category-hero-copy">
        <p class="eyebrow">Danh mục</p>
        <h1>{{ $category->name }}</h1>
        <p>{{ $category->description ?: 'Các bài viết thuộc danh mục này.' }}</p>
    </div>
    <div class="category-hero-meta">
        <div class="category-stat">
            <span>Bài viết</span>
            <strong>{{ $posts->total() }}</strong>
        </div>
        <div class="category-stat">
            <span>Trạng thái</span>
            <strong>Đang cập nhật</strong>
        </div>
        <div class="category-stat">
            <span>Điều hướng</span>
            <strong>Xem thêm bên dưới</strong>
        </div>
    </div>
</section>

<div class="category-layout">
    <main class="category-main">
        <section class="category-list-block">
            <div class="section-head">
                <h2 class="section-title">Bài viết trong danh mục</h2>
            </div>
            <div class="category-post-list">
                @forelse($posts as $post)
                    <article class="category-post-card">
                        <a href="{{ route('posts.show', $post->slug) }}" class="category-post-media">
                            @if($post->thumbnail)
                                <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}">
                            @else
                                <div class="category-post-fallback"></div>
                            @endif
                        </a>
                        <div class="category-post-body">
                            <p class="post-meta">{{ optional($post->published_at)->format('d/m/Y') }}</p>
                            <a class="post-title" href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                            <p class="post-excerpt">{{ \Illuminate\Support\Str::limit($post->excerpt, 140) }}</p>
                            <a href="{{ route('posts.show', $post->slug) }}" class="read-more">Đọc thêm →</a>
                        </div>
                    </article>
                @empty
                    <div class="empty-state">Chưa có bài viết</div>
                @endforelse
            </div>

            <div class="pagination-wrap">{{ $posts->links() }}</div>
        </section>
    </main>

    <aside class="category-sidebar">
        @include('public.partials.about-card', ['profile' => $profile])
        @include('public.partials.categories-card', ['categories' => $sidebarCategories])
    </aside>
</div>
@endsection
