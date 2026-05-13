@extends('layouts.public')
@section('content')
<div class="panel" style="max-width:980px;">
    <div class="panel-header">Giới thiệu bản thân</div>
    <div class="panel-body">
        @if($profile)
            <h2 class="mb-1">{{ $profile->full_name ?: ($globalSettings['author_name'] ?? 'Đang cập nhật') }}</h2>
            <p class="meta mb-3">{{ $profile->headline ?: 'Thông tin nghề nghiệp đang được cập nhật.' }}</p>

            <div class="row g-3 mb-3">
                <div class="col-md-4"><strong>Email:</strong> {{ $profile->email ?: '---' }}</div>
                <div class="col-md-4"><strong>Điện thoại:</strong> {{ $profile->phone ?: '---' }}</div>
                <div class="col-md-4"><strong>Địa chỉ:</strong> {{ $profile->address ?: '---' }}</div>
            </div>

            <div class="article-content">
                <h4>Tóm tắt</h4>
                <div>{!! $profile->summary ?: '<p>Đang cập nhật.</p>' !!}</div>

                <h4>Kỹ năng</h4>
                <div>{!! $profile->skills ?: '<p>Đang cập nhật.</p>' !!}</div>

                <h4>Kinh nghiệm làm việc</h4>
                <div>{!! $profile->experience ?: '<p>Đang cập nhật.</p>' !!}</div>

                <h4>Học vấn</h4>
                <div>{!! $profile->education ?: '<p>Đang cập nhật.</p>' !!}</div>

                <h4>Dự án nổi bật</h4>
                <div>{!! $profile->projects ?: '<p>Đang cập nhật.</p>' !!}</div>
            </div>
        @else
            <p class="meta mb-0">Chưa có dữ liệu hồ sơ. Vui lòng vào trang quản trị để cập nhật hồ sơ giới thiệu.</p>
        @endif
    </div>
</div>
@endsection
