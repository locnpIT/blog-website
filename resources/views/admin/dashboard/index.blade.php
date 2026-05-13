@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">Tổng quan hệ thống</h2>
        <p class="meta mb-0">Theo dõi nhanh hiệu suất nội dung và trạng thái hệ thống CMS.</p>
    </div>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-dark">Tạo bài viết mới</a>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6 col-xl-3"><div class="stat-card"><div class="stat-label">Tổng bài viết</div><div class="stat-value">{{ $totalPosts }}</div></div></div>
    <div class="col-md-6 col-xl-3"><div class="stat-card"><div class="stat-label">Đã xuất bản</div><div class="stat-value">{{ $publishedPosts }}</div></div></div>
    <div class="col-md-6 col-xl-3"><div class="stat-card"><div class="stat-label">Bản nháp</div><div class="stat-value">{{ $draftPosts }}</div></div></div>
    <div class="col-md-6 col-xl-3"><div class="stat-card"><div class="stat-label">Liên hệ mới</div><div class="stat-value">{{ $newContacts }}</div></div></div>
</div>

<div class="panel">
    <div class="panel-header">Trạng thái hệ thống</div>
    <div class="panel-body">
        <div class="row g-3">
            <div class="col-lg-7">
                <p class="mb-2"><strong>Website:</strong> {{ $siteTitle }}</p>
                <p class="meta mb-0">Hệ thống đã sẵn sàng để quản lý nội dung, phản hồi liên hệ và cập nhật cấu hình website.</p>
            </div>
            <div class="col-lg-5">
                <div class="d-flex gap-2 justify-content-lg-end">
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-light border">Quản lý bài viết</a>
                    <a href="{{ route('admin.settings.edit') }}" class="btn btn-light border">Cài đặt website</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
