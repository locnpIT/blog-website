@extends('layouts.public')
@section('title', ($globalSettings['site_title'] ?? 'PhuocLocBlog') . ' - Trang chủ')
@section('meta_description', $globalSettings['site_description'] ?? ($globalSettings['author_bio'] ?? 'Blog cá nhân chia sẻ về Laravel, hệ thống web, thiết kế giao diện và kinh nghiệm thực chiến.'))
@section('og_type', 'website')

@section('content')
<div class="home-page">
    @include('public.partials.hero-slider', ['posts' => $featuredPosts])

    <div class="home-content">
        <div class="home-main">
            <section class="section-block">
                <h2 class="section-title">Bài viết mới</h2>
                @include('public.partials.post-list', ['posts' => $posts])
            </section>
        </div>

        <aside class="home-sidebar">
            @include('public.partials.about-card', ['profile' => $profile])
            @include('public.partials.categories-card', ['categories' => $categories])
            @include('public.partials.social-card')
        </aside>
    </div>

    @include('public.partials.newsletter-banner')
</div>
@endsection
