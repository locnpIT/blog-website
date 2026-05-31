@extends('layouts.public')
@section('title', 'Giới thiệu - ' . ($globalSettings['site_title'] ?? 'PhuocLocBlog'))
@section('meta_description', $globalSettings['author_bio'] ?? 'Giới thiệu về tác giả, kinh nghiệm, kỹ năng và định hướng nội dung của blog.')
@section('og_type', 'profile')

@section('content')
@php
    $displayName = $profile?->full_name ?: ($globalSettings['author_name'] ?? 'Đang cập nhật');
    $headline = $profile?->headline ?: ($globalSettings['author_bio'] ?? 'Blog chia sẻ kiến thức Laravel, hệ thống web và kinh nghiệm kỹ thuật thực chiến.');
    $summary = $profile?->summary ?: '<p>Chưa có nội dung giới thiệu chi tiết. Bạn có thể cập nhật trong trang quản trị.</p>';
    $skills = $profile?->skills ?: '<p>Đang cập nhật.</p>';
    $experience = $profile?->experience ?: '<p>Đang cập nhật.</p>';
    $education = $profile?->education ?: '<p>Đang cập nhật.</p>';
    $projects = $profile?->projects ?: '<p>Đang cập nhật.</p>';
@endphp

<section class="about-hero">
    <div class="about-hero-copy">
        <p class="eyebrow">Giới thiệu</p>
        <h1>{{ $displayName }}</h1>
        <p class="about-lead">{{ $headline }}</p>
        <div class="about-actions">
            <a href="{{ route('contact') }}" class="btn-pastel">Liên hệ với tôi</a>
            <a href="{{ route('home') }}" class="about-link">Xem bài viết</a>
        </div>
    </div>

    <aside class="about-profile-card">
        <div class="about-avatar">
            @if(!empty($profile?->avatar_url))
                <img class="about-avatar-image" src="{{ $profile->avatar_url }}" alt="{{ $displayName }}">
            @else
                <div class="about-avatar-inner">{{ strtoupper(mb_substr($globalSettings['author_name'] ?? 'PL', 0, 2)) }}</div>
            @endif
        </div>
        <p class="about-name">{{ $displayName }}</p>
        <p class="about-text">{{ $headline }}</p>
        <div class="about-quickfacts">
            <div>
                <span>Email</span>
                <strong>{{ $profile?->email ?: '---' }}</strong>
            </div>
            <div>
                <span>Điện thoại</span>
                <strong>{{ $profile?->phone ?: '---' }}</strong>
            </div>
            <div>
                <span>Địa chỉ</span>
                <strong>{{ $profile?->address ?: '---' }}</strong>
            </div>
        </div>
    </aside>
</section>

<section class="about-stats">
    <div class="about-stat">
        <span>Nội dung</span>
        <strong>Personal blog</strong>
    </div>
    <div class="about-stat">
        <span>Trọng tâm</span>
        <strong>Laravel, web systems</strong>
    </div>
    <div class="about-stat">
        <span>Phong cách</span>
        <strong>Ngắn gọn, thực dụng</strong>
    </div>
    <div class="about-stat">
        <span>Phản hồi</span>
        <strong>Qua contact form</strong>
    </div>
</section>

<section class="about-grid">
    <article class="about-section-card">
        <h2>Tóm tắt</h2>
        <div class="article-content">{!! $summary !!}</div>
    </article>

    <article class="about-section-card">
        <h2>Kỹ năng</h2>
        <div class="article-content">{!! $skills !!}</div>
    </article>

    <article class="about-section-card">
        <h2>Kinh nghiệm làm việc</h2>
        <div class="article-content">{!! $experience !!}</div>
    </article>

    <article class="about-section-card">
        <h2>Học vấn</h2>
        <div class="article-content">{!! $education !!}</div>
    </article>

    <article class="about-section-card about-section-card-wide">
        <h2>Dự án nổi bật</h2>
        <div class="article-content">{!! $projects !!}</div>
    </article>
</section>
@endsection
